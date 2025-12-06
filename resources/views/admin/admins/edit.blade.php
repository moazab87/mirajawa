@extends('admin.layouts.app')

@section('title', $title)

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
                    <h5 class="card-title">{{ __("admin.Information_$singleName") }}</h5>
                    <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.layouts.partials.alerts')
                        <div class="row">
                            <div class="mb-3 d-flex flex-column align-items-center">
                                <div class="d-flex align-items-center mt-2">
                                    <img src="{{ $model->image }}" alt="{{ $model->name }}"
                                        style="max-width: 150px; border-radius: 50%; margin-right: 20px;">
                                </div>
                                <label for="image" class="form-label">{{ __('admin.image') }}</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @error('image')
                                    @foreach ($errors->get('image') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">
                                    {{ __('admin.name') }}
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('admin.name') }}" required autofocus value="{{ $model->name }}">
                                @error('name')
                                    @foreach ($errors->get('name') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">
                                    {{ __('admin.phone') }}
                                </label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                    placeholder="{{ __('admin.phone') }}" value="{{ $model->phone }}">
                                @error('phone')
                                    @foreach ($errors->get('phone') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">
                                    {{ __('admin.email') }}
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="{{ __('admin.email') }}" value="{{ $model->email }}">
                                @error('email')
                                    @foreach ($errors->get('email') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">
                                    {{ __('admin.password') }}
                                </label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="{{ __('admin.password') }}">
                                @error('password')
                                    @foreach ($errors->get('password') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            {{-- Roles --}}
                            <div class="mb-3 col-md-6">
                                <label for="role_id" class="form-label">{{ __('admin.role') }}</label>
                                <select class="form-select" id="role_id" name="role" required>
                                    <option value="">{{ __('admin.select_role') }}</option>
                                    @foreach ($roles as $id => $name)
                                        <option value="{{ $name }}"
                                            {{ in_array($name, $model->roles->pluck('name')->toArray()) ? 'selected' : '' }}>
                                            {{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    @foreach ($errors->get('role_id') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-info">{{ __('admin.edit') }}</button>
                            <a href="{{ $route }}" type="reset"
                                class="btn btn-outline-warning mx-1">{{ __('admin.back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
