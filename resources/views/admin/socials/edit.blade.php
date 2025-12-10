@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.edit')],
        ]" />
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $updateRoute }}" method="POST">
                        @method('PUT')
                        @csrf
                        @include('admin.layouts.partials.alerts')
                        <div class="row">
                            {{-- Name Field --}}
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">{{ __('admin.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('admin.name') }}" required autofocus
                                    value="{{ old('name', $model->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            {{-- URL Field --}}
                            <div class="mb-3 col-md-6">
                                <label for="url" class="form-label">{{ __('admin.url') }}</label>
                                <input type="url" class="form-control" id="url" name="url"
                                    placeholder="https://example.com" required
                                    value="{{ old('url', $model->url) }}">
                                @error('url')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            {{-- Icon Field --}}
                            <div class="mb-3 col-md-6">
                                <label for="icon" class="form-label">{{ __('admin.icon') }}</label>
                                <input type="text" class="form-control" id="icon" name="icon"
                                    placeholder="bx bxl-facebook or fab fa-facebook" 
                                    value="{{ old('icon', $model->icon) }}">
                                <small class="text-muted">{{ __('admin.icon_hint') ?? 'Use icon class (e.g., bx bxl-facebook, fab fa-facebook)' }}</small>
                                @error('icon')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            {{-- Is Active Field --}}
                            <div class="mb-3 col-md-6">
                                <label for="is_active" class="form-label">{{ __('admin.status') }}</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', $model->is_active) ? 'selected' : '' }}>
                                        {{ __('admin.active') }}
                                    </option>
                                    <option value="0" {{ old('is_active', $model->is_active) === false ? 'selected' : '' }}>
                                        {{ __('admin.inactive') }}
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
                            <a href="{{ url()->previous() }}" type="reset"
                                class="btn btn-outline-warning mx-1">{{ __('admin.back') }}</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

