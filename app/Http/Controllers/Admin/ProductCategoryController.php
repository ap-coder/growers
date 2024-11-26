<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductCategoryRequest;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategories = ProductCategory::with(['media'])->get();

        return view('admin.productCategories.index', compact('productCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productCategories.create');
    }

    public function store(StoreProductCategoryRequest $request)
    {
        // Check if the category already exists
        $existingCategory = ProductCategory::where('name', $request->input('name'))->first();

        if ($existingCategory) {
            return response()->json([
                'success' => false,
                'message' => 'This category already exists.',
                'category' => $existingCategory, // Return the existing category for selection
            ]);
        }

        try {
            // Create the product category
            $productCategory = ProductCategory::create($request->all());

            // Handle photo upload if provided
            if ($request->input('photo', false)) {
                $productCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }

            // Link CKEditor media if applicable
            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $productCategory->id]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Category added successfully.',
                'category' => $productCategory, // Return the new category details for UI
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to save category: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the category. Please try again.',
            ], 500);
        }
    }

//    public function store(StoreProductCategoryRequest $request)
//    {
//        // Check if the category already exists
//        $existingCategory = ProductCategory::where('name', $request->input('name'))->first();
//
//        if ($existingCategory) {
//            return response()->json([
//                'success' => false,
//                'message' => 'This category already exists.',
//                'category' => $existingCategory, // Return the existing category for UI to update
//            ]);
//        }
//
//        // Create a new category
//        $productCategory = ProductCategory::create($request->all());
//
//        if ($request->input('photo', false)) {
//            $productCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
//        }
//
//        if ($media = $request->input('ck-media', false)) {
//            Media::whereIn('id', $media)->update(['model_id' => $productCategory->id]);
//        }
//
//        // Return JSON for dynamic updates
//        if ($request->ajax()) {
//            return response()->json([
//                'success' => true,
//                'message' => 'Category added successfully.',
//                'category' => $productCategory, // Return the new category details
//            ]);
//        }
//
//        // Fallback for non-AJAX requests
//        return redirect()->route('admin.product-categories.index');
//    }


    public function edit(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productCategories.edit', compact('productCategory'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (! $productCategory->photo || $request->input('photo') !== $productCategory->photo->file_name) {
                if ($productCategory->photo) {
                    $productCategory->photo->delete();
                }
                $productCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($productCategory->photo) {
            $productCategory->photo->delete();
        }

        return redirect()->route('admin.product-categories.index');
    }

    public function show(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.productCategories.show', compact('productCategory'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductCategoryRequest $request)
    {
        $productCategories = ProductCategory::find(request('ids'));

        foreach ($productCategories as $productCategory) {
            $productCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_category_create') && Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
