@extends('pages.layout')

@section('doc_description', $pageTitle . ' — Law Students.')

@section('doc')
<article class="doc-card">
    {!! $page->content !!}
</article>
@endsection
