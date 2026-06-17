@extends('admin.layouts.app')
@section('title', $subTitle)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => $route, 'text' => $title],
        ['url' => '#', 'text' => __('dashboard.edit')],
    ]" />
    <div class="card"><div class="card-body">
        <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.layouts.partials.alerts')
            <div class="row">
                @include('admin.histories.partials.year-field', ['model' => $model ?? null])
                @include('admin.shared.language-tabs', ['fields' => [
                    'name' => ['type' => 'text', 'label' => 'dashboard.name', 'required' => true],
                    'description' => ['type' => 'textarea', 'label' => 'dashboard.description']
                ], 'model' => $model ?? null])
                @include('admin.shared.status-select', ['model' => $model ?? null])
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.edit') }}</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">{{ __('dashboard.back') }}</a>
            </div>
        </form>
    </div></div>
</div>
@endsection
