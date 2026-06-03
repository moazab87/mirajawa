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
        <p><x-admin.status-badge :status="$model->status" /></p>
        @foreach(languages() as $lang)
            <hr><h6>{{ getLanguageName($lang) }}</h6>
            @foreach(['name','description','map_desc'] as $field)
                <p><strong>{{ __('dashboard.'.$field) }}:</strong> {{ $model->getTranslation($field, $lang) }}</p>
            @endforeach
        @endforeach
        <a href="{{ route($editRoute, $model->id) }}" class="btn btn-primary">{{ __('dashboard.edit') }}</a>
        <a href="{{ $route }}" class="btn btn-outline-secondary">{{ __('dashboard.back') }}</a>
    </div></div>
</div>
@endsection
