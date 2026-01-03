<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VariationCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VariationCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('variation_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VariationCategory::query();
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'variation_category_show';
                $editGate = 'variation_category_edit';
                $deleteGate = 'variation_category_delete';
                $crudRoutePart = 'variation-categories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', fn($row) => $row->id ?? '');
            $table->editColumn('name', fn($row) => $row->name ?? '');
            $table->editColumn('description', fn($row) => $row->description ?? '');
            $table->editColumn('sort_order', fn($row) => $row->sort_order ?? '');
            $table->editColumn('published', fn($row) => $row->published ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>');
            $table->editColumn('variations_count', fn($row) => $row->variations()->count());

            $table->rawColumns(['actions', 'placeholder', 'published']);

            return $table->make(true);
        }

        return view('admin.variation-categories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('variation_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.variation-categories.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('variation_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = VariationCategory::create($request->all());

        return redirect()->route('admin.variation-categories.index')
            ->with('message', 'Variation Category created successfully.');
    }

    public function show(VariationCategory $variationCategory)
    {
        abort_if(Gate::denies('variation_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variationCategory->load('variations');

        return view('admin.variation-categories.show', compact('variationCategory'));
    }

    public function edit(VariationCategory $variationCategory)
    {
        abort_if(Gate::denies('variation_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.variation-categories.edit', compact('variationCategory'));
    }

    public function update(Request $request, VariationCategory $variationCategory)
    {
        abort_if(Gate::denies('variation_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $variationCategory->update($request->all());

        return redirect()->route('admin.variation-categories.index')
            ->with('message', 'Variation Category updated successfully.');
    }

    public function destroy(VariationCategory $variationCategory)
    {
        abort_if(Gate::denies('variation_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variationCategory->delete();

        return back()->with('message', 'Variation Category deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('variation_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        VariationCategory::whereIn('id', $request->input('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
