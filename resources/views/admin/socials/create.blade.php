@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('dashboard.create')],
        ]" />
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $storeRoute }}" method="POST">
                        @csrf
                        @include('admin.layouts.partials.alerts')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">{{ __('dashboard.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('dashboard.name') }}" required autofocus
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="url" class="form-label">{{ __('dashboard.url') }}</label>
                                <input type="url" class="form-control" id="url" name="url"
                                    placeholder="https://example.com" required
                                    value="{{ old('url') }}">
                                @error('url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="icon" class="form-label">{{ __('dashboard.icon') }}</label>
                                <input type="text" class="form-control" id="icon" name="icon"
                                    placeholder="{{ __('dashboard.icon_placeholder') }}"
                                    value="{{ old('icon') }}">
                                <small class="text-muted">{{ __('dashboard.icon_hint') }}</small>
                                @if(old('icon'))
                                    <div class="mt-2">
                                        <i class="{{ old('icon') }}" style="font-size: 1.375rem;"></i>
                                    </div>
                                @endif
                                @error('icon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="is_active" class="form-label">{{ __('dashboard.status') }}</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', true) ? 'selected' : '' }}>
                                        {{ __('dashboard.statuses.active') }}
                                    </option>
                                    <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>
                                        {{ __('dashboard.statuses.inactive') }}
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('dashboard.create') }}</button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">{{ __('dashboard.back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
