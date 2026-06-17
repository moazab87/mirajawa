@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('dashboard.show')],
        ]" />
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <h5 class="mb-0">{{ $model->getDisplayTranslation('name') }}</h5>
                    @if($model->isSystemPage())
                        <span class="badge bg-label-primary">{{ __('dashboard.system_page') }}</span>
                    @endif
                </div>
                <p><strong>{{ __('dashboard.slug') }}:</strong> <code>{{ $model->slug }}</code></p>
                <p class="text-muted small mb-3">{{ __('dashboard.slug_readonly') }}</p>
                <p><x-admin.status-badge :status="$model->status" /></p>
                @foreach(languages() as $lang)
                    <hr>
                    <h6>{{ getLanguageName($lang) }}</h6>
                    <p><strong>{{ __('dashboard.sub_title') }}:</strong> {{ $model->getTranslation('sub_title', $lang) ?: '—' }}</p>
                    <p><strong>{{ __('dashboard.description') }}:</strong></p>
                    <div class="mj-admin-rich-content mb-3">{!! $model->getTranslation('description', $lang) ?: '—' !!}</div>
                @endforeach
                @if($model->image_url)
                    <img src="{{ $model->image_url }}" class="img-fluid rounded mt-2" style="max-height:200px" alt="">
                @endif
                <div class="mt-3">
                    <a href="{{ route($editRoute, $model->id) }}" class="btn btn-primary">{{ __('dashboard.edit') }}</a>
                    <a href="{{ $route }}" class="btn btn-outline-secondary">{{ __('dashboard.back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
