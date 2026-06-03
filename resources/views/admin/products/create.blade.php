@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('dashboard.create')],
        ]" />
        <div class="card"><div class="card-body">
            <form action="{{ $storeRoute }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.layouts.partials.alerts')
                <div class="row">
                    @include('admin.shared.product-translatable-fields')
                    <div class="mb-3 col-md-6">
                        <label for="link" class="form-label">{{ __('dashboard.link') }}</label>
                        <input type="url" class="form-control" id="link" name="link" placeholder="{{ __('dashboard.link') }}" value="{{ old('link') }}">
                        @error('link')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="category_id" class="form-label">{{ __('dashboard.category') }}</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">{{ __('dashboard.select_category') }}</option>
                            @foreach ($categories ?? [] as $id => $label)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="product_group_id" class="form-label">{{ __('dashboard.product_group') }}</label>
                        <select class="form-select" id="product_group_id" name="product_group_id">
                            <option value="">{{ __('dashboard.select') }}</option>
                            @foreach ($productGroups ?? [] as $id => $label)
                                <option value="{{ $id }}" {{ old('product_group_id') == $id ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('product_group_id')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    @include('admin.shared.status-select')
                    <div class="mb-3 col-md-12">
                        <label for="images" class="form-label">{{ __('dashboard.images') }}</label>
                        <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
                        <small class="text-muted">{{ __('dashboard.images_hint') }}</small>
                        @error('images.*')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="videos" class="form-label">{{ __('dashboard.videos') }}</label>
                        <input type="file" class="form-control" id="videos" name="videos[]" accept="video/*" multiple>
                        <small class="text-muted">{{ __('dashboard.videos_hint') }}</small>
                        @error('videos.*')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('dashboard.create') }}</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">{{ __('dashboard.back') }}</a>
                </div>
            </form>
        </div></div>
    </div>
@endsection
