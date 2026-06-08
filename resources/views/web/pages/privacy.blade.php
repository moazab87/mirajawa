@extends('web.layouts.app')

@section('title', ($page?->name ?? __('website.privacy_policy')) . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($page?->description ?? ''), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $page?->name ?? __('website.privacy_policy'),
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.privacy_policy') => route('web.privacy'),
        ],
    ])

    <section class="mj-section mj-section--white">
        <div class="mj-container">
            @if($page && $page?->description)
                <div class="mj-content mx-auto" style="max-width:900px;">{!! $page?->description !!}</div>
            @endif
        </div>
    </section>
@endsection
