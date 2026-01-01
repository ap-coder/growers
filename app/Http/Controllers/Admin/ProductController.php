<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Client;

use App\Models\ClientPrice;
use App\Models\Product;
use App\Models\ProductBundleItem;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Gate;
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
            $query = Product::with(['categories', 'tags', 'clients', 'team'])->select(sprintf('%s.*', (new Product)->table));
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

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('published', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->published ? 'checked' : null) . '>';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
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
            $table->editColumn('clients', function ($row) {
                $labels = [];
                foreach ($row->clients as $client) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $client->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'published', 'category', 'photo', 'clients']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id');

        $tags = ProductTag::pluck('name', 'id');

        $clients = Client::pluck('name', 'id');

        return view('admin.products.create', compact('categories', 'clients', 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->categories()->sync($request->input('categories', []));
        $product->tags()->sync($request->input('tags', []));
        $product->clients()->sync($request->input('clients', []));

        $this->handlePhotoUpload($request, $product);
        $this->handleAdditionalPhotos($request, $product);
        $this->handleCKMedia($request, $product);

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('admin.products.index');
    }



    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id');

        $tags = ProductTag::pluck('name', 'id');
        $clients = Client::select('id', 'name')->get();

        $product->load('categories', 'tags', 'clients', 'clientPrices', 'clientPrices.client', 'team', 'accessories', 'bundleItems.itemProduct');

        $prices = $product->clientPrices;

        return view('admin.products.edit', compact('categories', 'clients', 'product', 'tags', 'prices'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {

        $product->update($request->all());

        $product->categories()->sync($request->input('categories', []));
        $product->tags()->sync($request->input('tags', []));
        $product->clients()->sync($request->input('clients', []));

        // Sync accessories with pivot data
        $accessoriesData = [];
        foreach ($request->input('accessories', []) as $accessoryId) {
            $accessoriesData[$accessoryId] = [
                'is_default' => $request->has("accessory_defaults.{$accessoryId}"),
                'is_required' => $request->has("accessory_required.{$accessoryId}"),
            ];
        }
        $product->accessories()->sync($accessoriesData);

        if ($request->has('client_prices')) {
            $clientPricesData = [];
            foreach ($request->input('client_prices') as $clientId => $clientPriceData) {
                $clientPricesData[] = [
                    'product_id' => $product->id,
                    'client_id' => $clientId,
                    'price' => $clientPriceData['price'] ?? null,
                    'sku' => $clientPriceData['sku'] ?? null,
                    'mpn' => $clientPriceData['mpn'] ?? null,
                    'gtin' => $clientPriceData['gtin'] ?? null,
                    'upc' => $clientPriceData['upc'] ?? null,
                    'qb_1' => $clientPriceData['qb_1'] ?? null,
                    'qb_2' => $clientPriceData['qb_2'] ?? null,
                    'published' => isset($clientPriceData['published']) ? (int)$clientPriceData['published'] : 1,
                ];
            }

            // Use upsert to insert or update client prices
            ClientPrice::upsert(
                $clientPricesData,
                ['product_id', 'client_id'],
                ['price', 'sku', 'mpn', 'gtin', 'upc', 'qb_1', 'qb_2']
            );
        }

        //dd($request->all());

        // Handle bundle items for sets
        if ($product->product_type === 'set' && $request->has('bundle_groups')) {
            $this->syncBundleItems($product, $request->input('bundle_groups'));
        }

        $this->handlePhotoUpload($request, $product);
        $this->handleAdditionalPhotos($request, $product);
        $this->handleCKMedia($request, $product);

        return redirect()->route('admin.products.index');
    }

    /**
     * Sync bundle items for a set/bundle product
     */
    private function syncBundleItems(Product $product, array $bundleGroups)
    {
        // Delete existing bundle items
        $product->bundleItems()->delete();
        
        $sortOrder = 0;
        foreach ($bundleGroups as $group) {
            $groupName = $group['name'] ?? 'Default';
            
            if (!isset($group['items'])) {
                continue;
            }
            
            foreach ($group['items'] as $item) {
                if (empty($item['product_id'])) {
                    continue;
                }
                
                ProductBundleItem::create([
                    'bundle_product_id' => $product->id,
                    'item_product_id' => $item['product_id'],
                    'quantity' => $item['quantity'] ?? 1,
                    'price_type' => $item['price_type'] ?? 'default',
                    'price_override' => !empty($item['price_override']) ? $item['price_override'] : null,
                    'price_adjustment' => !empty($item['price_adjustment']) ? $item['price_adjustment'] : null,
                    'is_required' => isset($item['is_required']),
                    'is_selectable' => isset($item['is_selectable']),
                    'group_name' => $groupName,
                    'sort_order' => $sortOrder++,
                ]);
            }
        }
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('categories', 'tags', 'clients', 'team');

        return view('admin.products.show', compact('product'));
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

    private function handleCKMedia($request, $product)
    {
        if ($request->input('ck-media', false)) {
            // Attach media uploaded by CKEditor to the product
            Media::whereIn('id', $request->input('ck-media'))->update(['model_id' => $product->id]);
        }
    }

    /**
     * @param $request
     * @param $product
     * @return void
     */
    private function handlePhotoUpload($request, $product)
    {
        if ($request->input('photo', false)) {
            if (!$product->photo || $request->input('photo') !== $product->photo->file_name) {
                if ($product->photo) {
                    $product->photo->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($product->photo) {
            $product->photo->delete();
        }
    }

    /**
     * @param $request
     * @param $product
     * @return void
     */
    private function handleAdditionalPhotos($request, $product)
    {
        if (count($product->additional_photos) > 0) {
            foreach ($product->additional_photos as $media) {
                if (!in_array($media->file_name, $request->input('additional_photos', []))) {
                    $media->delete();
                }
            }
        }

        $existingMediaFiles = $product->additional_photos->pluck('file_name')->toArray();
        foreach ($request->input('additional_photos', []) as $file) {
            if (count($existingMediaFiles) === 0 || !in_array($file, $existingMediaFiles)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('additional_photos');
            }
        }
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
}
