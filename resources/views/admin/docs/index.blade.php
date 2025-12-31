@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="mb-0"><i class="fas fa-book mr-2"></i> Documentation</h4>
    </div>
    <div class="card-body">
        <div class="docs-content">
            {!! \Illuminate\Support\Str::markdown($content) !!}
        </div>
    </div>
</div>

<style>
.docs-content {
    font-size: 14px;
    line-height: 1.6;
}
.docs-content h1 {
    font-size: 2em;
    border-bottom: 2px solid #dee2e6;
    padding-bottom: 0.5em;
    margin-bottom: 1em;
}
.docs-content h2 {
    font-size: 1.5em;
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 0.3em;
    margin-top: 1.5em;
    margin-bottom: 0.75em;
}
.docs-content h3 {
    font-size: 1.25em;
    margin-top: 1.25em;
}
.docs-content table {
    width: 100%;
    margin-bottom: 1em;
    border-collapse: collapse;
}
.docs-content table th,
.docs-content table td {
    border: 1px solid #dee2e6;
    padding: 8px 12px;
}
.docs-content table th {
    background: #f8f9fa;
    font-weight: 600;
}
.docs-content code {
    background: #f4f4f4;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 0.9em;
}
.docs-content pre {
    background: #2d2d2d;
    color: #f8f8f2;
    padding: 15px;
    border-radius: 5px;
    overflow-x: auto;
}
.docs-content pre code {
    background: none;
    padding: 0;
    color: inherit;
}
.docs-content ul, .docs-content ol {
    margin-bottom: 1em;
    padding-left: 2em;
}
.docs-content li {
    margin-bottom: 0.25em;
}
.docs-content hr {
    margin: 2em 0;
    border: none;
    border-top: 1px solid #dee2e6;
}
.docs-content blockquote {
    border-left: 4px solid #007bff;
    padding-left: 1em;
    margin-left: 0;
    color: #666;
}
</style>

@endsection
