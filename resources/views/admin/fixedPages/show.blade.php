@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('dashboard.show')],
        ]" />
        <div class="card"><div class="card-body">
            <h5>{{ $model->getDisplayTranslation('name') }}</h5>
            <p><strong>{{ __('dashboard.slug') }}:</strong> {{ $model->slug }}</p>
            <p><x-admin.status-badge :status="$model->status" /></p>
            @foreach(languages() as $lang)
                <hr><h6>{{ getLanguageName($lang) }}</h6>
                <p><strong>{{ __('dashboard.sub_title') }}:</strong> {{ $model->getTranslation('sub_title', $lang) }}</p>
                <p><strong>{{ __('dashboard.description') }}:</strong> {{ $model->getTranslation('description', $lang) }}</p>
            @endforeach
            @if($model->image_url)
                <img src="{{ $model->image_url }}" class="img-fluid rounded mt-2" style="max-height:200px">
            @endif
            <div class="mt-3">
                <a href="{{ route($editRoute, $model->id) }}" class="btn btn-primary">{{ __('dashboard.edit') }}</a>
                <a href="{{ $route }}" class="btn btn-outline-secondary">{{ __('dashboard.back') }}</a>
            </div>
        </div></div>
    </div>
@endsection
