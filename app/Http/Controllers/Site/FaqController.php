<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;

class FaqController extends Controller
{
    /**
     * FAQ Index - shows all categories with preview (faqs-1.html style)
     */
    public function index()
    {
        $categories = FaqCategory::with(['questions' => function($query) {
            $query->orderBy('id');
        }])->orderBy('category')->get();
        
        return view('site.faqs.index', compact('categories'));
    }
    
    /**
     * FAQ Category Detail - shows all questions in accordion (faqs-2.html style)
     */
    public function show($id)
    {
        $category = FaqCategory::findOrFail($id);
        
        $questions = FaqQuestion::where('category_id', $category->id)
            ->orderBy('id')
            ->get();
        
        $categories = FaqCategory::orderBy('category')->get();
        
        return view('site.faqs.show', compact('category', 'questions', 'categories'));
    }
}
