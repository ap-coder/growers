<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Client;
use App\Models\ClientPrice;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            try {
                // Updated to load product_categories instead of categories
                $query = Product::with(['product_categories', 'tags', 'clients', 'team'])
                    ->select(sprintf('%s.*', (new Product)->table));
                $table = Datatables::of($query);

                $table->addColumn('placeholder', '&nbsp;');
                $table->addColumn('actions', '&nbsp;');

                $table->editColumn('actions', function ($row) {
                    $viewGate      = 'product_show';
                    $editGate      = 'product_edit';
                    $deleteGate    = 'product_delete';
                    $crudRoutePart = 'products';

                    return view('partials.datatablesActions', compact(
                        'viewGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'row'
                    ));
                });

                $table->editColumn('id', fn ($row) => $row->id ? $row->id : '');
                $table->editColumn('name', fn ($row) => $row->name ? $row->name : '');
                $table->editColumn('description', fn ($row) => $row->description ? $row->description : '');

                // Updated to refer to product_categories instead of categories
                $table->editColumn('category', function ($row) {
                    $labels = [];
                    foreach ($row->product_categories as $category) {
                        $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                    }

                    return implode(' ', $labels);
                });

                $table->editColumn('tag', function ($row) {
                    $labels = [];
                    foreach ($row->tags as $tag) {
                        $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                    }

                    return implode(' ', $labels);
                });

                $table->editColumn('photo', function ($row) {
                    if ($photo = $row->photo) {
                        return sprintf(
                            '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                            $photo->url,
                            $photo->thumbnail
                        );
                    }

                    return '';
                });

                $table->rawColumns(['actions', 'placeholder', 'category', 'tag', 'photo']);
                return $table->make(true);

            } catch (\Exception $e) {
                Log::error('Error loading products datatable: ' . $e->getMessage());
                return response()->json(['error' => 'Something went wrong'], 500);
            }
        }

        return view('admin.products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_categories = ProductCategory::pluck('name', 'id');
        $tags = ProductTag::pluck('name', 'id');
        $clients = Client::pluck('name', 'id');

        return view('admin.products.create', compact('product_categories', 'clients', 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            // Create product
            $product = Product::create($request->all());

            // Sync categories, tags, and clients
            $product->product_categories()->sync($request->input('product_categories', []));
            $product->tags()->sync($request->input('tags', []));

            // Handle ClientPrice records
            $clients = $request->input('clients', []);

            foreach ($clients as $client_id) {
                ClientPrice::create([
                    'product_id' => $product->id,
                    'client_id' => $client_id,
                    'price' => $request->input("prices.$client_id") ?? null,
                    'sku' => $request->input("skus.$client_id") ?? null,
                    'mpn' => $request->input("mpns.$client_id") ?? null,
                    'gtin' => $request->input("gtins.$client_id") ?? null,
                    'upc' => $request->input("upcs.$client_id") ?? null,
                    'qb_1' => $request->input("qb_1.$client_id") ?? null,
                    'qb_2' => $request->input("qb_2.$client_id") ?? null,
                    'team_id' => auth()->user()->team_id,
                ]);
            }

            if ($request->input('photo', false)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }

            foreach ($request->input('additional_photos', []) as $file) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('additional_photos');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $product->id]);
            }

            Log::info('Product created successfully', [
                'product_id' => $product->id,
                'request_data' => $request->all(),
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create product', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
                'user_id' => auth()->id(),
            ]);

            return redirect()->back()->withErrors('There was an error creating the product. Please try again.');
        }
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product_categories = ProductCategory::pluck('name', 'id');
        $tags = ProductTag::pluck('name', 'id');
        $clients = Client::pluck('name', 'id');

        $product->load('product_categories', 'tags', 'clients', 'clientPrices.client', 'team');

        return view('admin.products.edit', compact('product_categories', 'clients', 'product', 'tags'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->categories()->sync($request->input('categories', []));
        $product->tags()->sync($request->input('tags', []));
        $product->clients()->sync($request->input('clients', []));

        $clientPrices = $request->input('client_price', []);

        foreach ($request->input('client_price', []) as $client_id => $clientPriceData) {
            ClientPrice::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'client_id' => $client_id
                ],
                [
                    'price' => $clientPriceData['price'] ?? 0,
                    'sku' => $clientPriceData['sku'] ?? null,
                    'mpn' => $clientPriceData['mpn'] ?? null,
                    'gtin' => $clientPriceData['gtin'] ?? null,
                    'upc' => $clientPriceData['upc'] ?? null,
                    'qb_1' => $clientPriceData['qb_1'] ?? null,
                    'qb_2' => $clientPriceData['qb_2'] ?? null
                ]
            );
        }

        if ($request->input('photo', false)) {
            if (! $product->photo || $request->input('photo') !== $product->photo->file_name) {
                if ($product->photo) {
                    $product->photo->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($product->photo) {
            $product->photo->delete();
        }

        if (count($product->additional_photos) > 0) {
            foreach ($product->additional_photos as $media) {
                if (! in_array($media->file_name, $request->input('additional_photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->additional_photos->pluck('file_name')->toArray();
        foreach ($request->input('additional_photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('additional_photos');
            }
        }

        return redirect()->route('admin.products.index');
    }

//    public function update(UpdateProductRequest $request, Product $product)
//    {
//        //dd($request->all());
//
//        Log::info('Update method called', $request->all());
//
//        try {
//            $validatedData = $request->validated();
//
//            $product->update($request->only(['name', 'description', 'published', 'featured']));
//
//            $product->product_categories()->sync($request->input('product_categories', []));
//            $product->tags()->sync($request->input('tags', []));
//
//            foreach ($request->input('clients', []) as $client_id) {
//                $clientPriceData = [
//                    'product_id' => $product->id,
//                    'client_id' => $client_id,
//                    'price' => $request->input("prices.$client_id") ?? 0,
//                    'sku' => $request->input("skus.$client_id") ?? null,
//                    'mpn' => $request->input("mpns.$client_id") ?? null,
//                    'gtin' => $request->input("gtins.$client_id") ?? null,
//                    'upc' => $request->input("upcs.$client_id") ?? null,
//                    'qb_1' => $request->input("qb_1.$client_id") ?? null,
//                    'qb_2' => $request->input("qb_2.$client_id") ?? null
//                ];
//
//                ClientPrice::updateOrCreate(
//                    ['product_id' => $product->id, 'client_id' => $client_id],
//                    $clientPriceData
//                );
//            }
//
//            $product->clients()->sync($request->input('clients', []));
//
//            Log::info('Product updated successfully', [
//                'product_id' => $product->id,
//                'user_id' => auth()->id(),
//                'request_data' => $request->all(),
//            ]);
//
//            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
//
//        } catch (\Exception $e) {
//            Log::error('Error updating product', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
//            return redirect()->back()->withErrors('An error occurred while updating the product. Please check all inputs and try again.');
//        }
//    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('categories', 'tags', 'clientPrices', 'team'); // Load clientPrices instead of clients

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        $products = Product::find(request('ids'));

        foreach ($products as $product) {
            $product->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
