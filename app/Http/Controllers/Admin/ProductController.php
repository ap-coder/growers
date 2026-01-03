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
use App\Models\ProductPriceTier;
use App\Models\ProductTag;
use App\Models\ProductVariation;
use App\Models\VariationClientPrice;
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
                if ($row->name) {
                    return sprintf('<a href="%s">%s</a>', route('admin.products.edit', $row->id), $row->name);
                }
                return '';
            });
            $table->editColumn('product_type', function ($row) {
                $types = [
                    'standard' => '<span class="badge badge-primary">Standard</span>',
                    'accessory' => '<span class="badge badge-info">Accessory</span>',
                    'set' => '<span class="badge badge-success">Set/Bundle</span>',
                ];
                return $types[$row->product_type] ?? '<span class="badge badge-secondary">' . ucfirst($row->product_type ?? 'standard') . '</span>';
            });
            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('photo', function ($row) {
                $placeholder = 'https://placehold.co/50x50/EEE/31343C.png?font=source-sans-pro&text=' . urlencode(substr($row->name, 0, 8));
                if ($photo = $row->photo) {
                    // Try thumbnail first, fall back to main URL
                    $thumbUrl = $photo->thumbnail ?: $photo->url;
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px" style="object-fit: cover;" onerror="this.src=\'%s\'"></a>',
                        $photo->url,
                        $thumbUrl,
                        $placeholder
                    );
                }
                return sprintf('<img src="%s" width="50px" height="50px">', $placeholder);
            });
            $table->editColumn('clients', function ($row) {
                $labels = [];
                foreach ($row->clients as $client) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $client->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'published', 'name', 'product_type', 'category', 'photo', 'clients']);

            return $table->make(true);
        }

        // Define columns and default visibility
        $columns = ['id', 'published', 'name', 'product_type', 'category', 'photo', 'clients'];
        $defaultVisible = ['name', 'product_type', 'category', 'photo', 'clients'];
        
        return view('admin.products.index', compact('columns', 'defaultVisible'));
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

        $product->load('categories', 'tags', 'clients', 'clientPrices', 'clientPrices.client', 'team', 'accessories', 'bundleItems.itemProduct', 'variations', 'priceTiers');

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
                'included_in_price' => $request->has("accessory_included.{$accessoryId}"),
            ];
        }
        $product->accessories()->sync($accessoriesData);

        // Handle base product client prices
        if ($request->has('client_prices')) {
            $clientPricesData = [];
            foreach ($request->input('client_prices') as $clientId => $clientPriceData) {
                // Only save if price is provided
                if (!empty($clientPriceData['price'])) {
                    $clientPricesData[] = [
                        'product_id' => $product->id,
                        'client_id' => $clientId,
                        'price' => $clientPriceData['price'],
                        'sku' => $clientPriceData['sku'] ?? null,
                        'mpn' => $clientPriceData['mpn'] ?? null,
                        'gtin' => $clientPriceData['gtin'] ?? null,
                        'upc' => $clientPriceData['upc'] ?? null,
                        'qb_1' => $clientPriceData['qb_1'] ?? null,
                        'qb_2' => $clientPriceData['qb_2'] ?? null,
                        'published' => isset($clientPriceData['published']) ? (int)$clientPriceData['published'] : 1,
                    ];
                }
            }

            // Delete existing and insert new client prices
            ClientPrice::where('product_id', $product->id)->delete();
            if (!empty($clientPricesData)) {
                ClientPrice::insert($clientPricesData);
            }
        }

        // Handle variation client prices
        if ($request->has('variation_client_prices')) {
            $variationClientPricesData = [];
            foreach ($request->input('variation_client_prices') as $clientId => $variations) {
                foreach ($variations as $variationId => $price) {
                    if (!empty($price)) {
                        $variationClientPricesData[] = [
                            'variation_id' => $variationId,
                            'client_id' => $clientId,
                            'price' => $price,
                        ];
                    }
                }
            }

            // Delete existing variation client prices for this product's variations
            $variationIds = $product->variations->pluck('id')->toArray();
            if (!empty($variationIds)) {
                VariationClientPrice::whereIn('variation_id', $variationIds)->delete();
            }
            if (!empty($variationClientPricesData)) {
                VariationClientPrice::insert($variationClientPricesData);
            }
        }

        //dd($request->all());

        // Handle bundle items for sets
        if ($product->product_type === 'set' && $request->has('bundle_groups')) {
            $this->syncBundleItems($product, $request->input('bundle_groups'));
        }

        // Handle price tiers
        $this->syncPriceTiers($product, $request->input('price_tiers', []));

        // Handle variations
        $this->syncVariations($product, $request->input('variations', []));

        $this->handlePhotoUpload($request, $product);
        $this->handleAdditionalPhotos($request, $product);
        $this->handleCKMedia($request, $product);

        // Check if we should redirect back to edit page or to index
        if ($request->input('redirect_back') == '1') {
            return redirect()->route('admin.products.edit', $product->id)->with('message', 'Product saved successfully.');
        }
        
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

    /**
     * Sync price tiers for a product
     */
    private function syncPriceTiers(Product $product, array $priceTiers)
    {
        // Delete existing price tiers
        $product->priceTiers()->delete();
        
        $sortOrder = 0;
        foreach ($priceTiers as $tier) {
            if (empty($tier['min_quantity']) || empty($tier['price'])) {
                continue;
            }
            
            ProductPriceTier::create([
                'product_id' => $product->id,
                'tier_group' => $tier['tier_group'] ?? null,
                'min_quantity' => $tier['min_quantity'],
                'max_quantity' => !empty($tier['max_quantity']) ? $tier['max_quantity'] : null,
                'price' => $tier['price'],
                'discount_percent' => !empty($tier['discount_percent']) ? $tier['discount_percent'] : null,
                'label' => $tier['label'] ?? null,
                'sort_order' => $sortOrder++,
            ]);
        }
    }

    /**
     * Sync product variations (sizes, etc.)
     */
    private function syncVariations(Product $product, array $variations)
    {
        $existingIds = [];
        $sortOrder = 0;
        $totalQuantity = 0;
        
        foreach ($variations as $variation) {
            if (empty($variation['name'])) {
                continue;
            }
            
            $qty = !empty($variation['quantity']) ? (int)$variation['quantity'] : 0;
            $totalQuantity += $qty;
            
            $data = [
                'product_id' => $product->id,
                'variation_category_id' => !empty($variation['variation_category_id']) ? $variation['variation_category_id'] : null,
                'name' => $variation['name'],
                'description' => $variation['description'] ?? null,
                'sku' => $variation['sku'] ?? null,
                'upc_code' => $variation['upc_code'] ?? null,
                'base_price' => !empty($variation['base_price']) ? $variation['base_price'] : null,
                'full_price' => !empty($variation['full_price']) ? $variation['full_price'] : null,
                'base_cost' => !empty($variation['base_cost']) ? $variation['base_cost'] : null,
                'quantity' => $qty,
                'show_quantity' => isset($variation['show_quantity']) ? (bool)$variation['show_quantity'] : false,
                'qb_1' => $variation['qb_1'] ?? null,
                'qb_2' => $variation['qb_2'] ?? null,
                'sort_order' => $sortOrder++,
                'active' => isset($variation['active']) ? (bool)$variation['active'] : true,
            ];
            
            if (!empty($variation['id'])) {
                // Update existing
                $productVariation = ProductVariation::find($variation['id']);
                if ($productVariation) {
                    $productVariation->update($data);
                    $existingIds[] = $productVariation->id;
                }
            } else {
                // Create new
                $productVariation = ProductVariation::create($data);
                $existingIds[] = $productVariation->id;
            }
        }
        
        // Delete variations that were removed
        $product->variations()->whereNotIn('id', $existingIds)->delete();
        
        // Update product total quantity from variations
        if (count($existingIds) > 0) {
            $product->update(['quantity' => $totalQuantity]);
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
