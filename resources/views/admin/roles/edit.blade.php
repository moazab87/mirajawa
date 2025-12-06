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
                    <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @include('admin.layouts.partials.alerts')

                        <div class="row">
                            {{-- name --}}
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">{{ __('admin.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('admin.name') }}" required
                                    value="{{ old('name', $model->name) }}">
                                @error('name')
                                    @foreach ($errors->get('name') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label" for="permissions">{{ __('admin.permissions') }}</label>
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">{{ __('admin.select_permissions') }}</h6>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                onclick="selectAll()">{{ __('admin.select_all') }}</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                onclick="deselectAll()">{{ __('admin.deselect_all') }}</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if ($permissions && count($permissions) > 0)
                                            <div class="row">
                                                @foreach ($permissions as $key => $name)
                                                    <div class="col-md-4 col-sm-6 mb-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-checkbox"
                                                                type="checkbox" name="permissions[]"
                                                                value="{{ $name }}" id="permission_{{ $key }}"
                                                                {{ $model->hasPermissionTo($name) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="permission_{{ $key }}">
                                                                @lang('permissions.' . $name)
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">{{ __('admin.no_permissions_available') }}</p>
                                        @endif
                                    </div>
                                </div>
                                @error('permissions')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">
                                {{ __('admin.back') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function selectAll() {
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                checkbox.checked = true;
            });
        }

        function deselectAll() {
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    </script>
@endsection
