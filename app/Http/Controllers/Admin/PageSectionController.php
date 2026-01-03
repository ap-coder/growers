<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PageSectionController extends Controller
{
    public function store(Request $request)
    {
        abort_if(Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'content_page_id' => 'required|exists:content_pages,id',
            'section_type' => 'required|string',
        ]);

        $maxOrder = PageSection::where('content_page_id', $request->content_page_id)->max('sort_order') ?? -1;

        $section = PageSection::create([
            'content_page_id' => $request->content_page_id,
            'section_type' => $request->section_type,
            'sort_order' => $maxOrder + 1,
        ]);

        $html = view('admin.contentPages.partials.section-item', ['section' => $section])->render();

        return response()->json([
            'success' => true,
            'section' => $section,
            'html' => $html,
        ]);
    }

    public function update(Request $request, PageSection $pageSection)
    {
        abort_if(Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageSection->update($request->only([
            'title',
            'subtitle',
            'content',
            'button_text',
            'button_url',
            'button_style',
            'background_color',
            'background_image',
            'text_color',
            'alignment',
            'container_width',
            'padding',
            'published',
        ]));

        return response()->json([
            'success' => true,
            'title' => $pageSection->title,
            'section' => $pageSection,
        ]);
    }

    public function destroy(PageSection $pageSection)
    {
        abort_if(Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageSection->delete();

        return response()->json(['success' => true]);
    }

    public function reorder(Request $request)
    {
        abort_if(Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order = $request->input('order', []);

        foreach ($order as $item) {
            PageSection::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['success' => true]);
    }
}
