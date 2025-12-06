@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.add')],
        ]" />
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __("admin.Information_$singleName") }}</h5>
                    <form action="{{ $storeRoute }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.layouts.partials.alerts')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">
                                    {{ __('admin.name') }}
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('admin.name') }}" required autofocus value="{{ old('name') }}">
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
                                    placeholder="{{ __('admin.phone') }}" value="{{ old('phone') }}">
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
                                    placeholder="{{ __('admin.email') }}" value="{{ old('email') }}">
                                @error('email')
                                    @foreach ($errors->get('email') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="account_manager_id" class="form-label">
                                    {{ __('admin.account_manager') }}
                                </label>
                                <select class="form-control" id="account_manager_id" name="account_manager_id">
                                    <option value="">{{ __('admin.select_account_manager') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('account_manager_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('account_manager_id')
                                    @foreach ($errors->get('account_manager_id') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="drive_link" class="form-label">
                                    {{ __('admin.drive_link') }}
                                </label>
                                <input type="url" class="form-control" id="drive_link" name="drive_link"
                                    placeholder="{{ __('admin.drive_link') }}" value="{{ old('drive_link') }}">
                                @error('drive_link')
                                    @foreach ($errors->get('drive_link') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="brief" class="form-label">
                                    {{ __('admin.brief') }}
                                </label>
                                <textarea class="form-control" id="brief" name="brief" rows="3"
                                    placeholder="{{ __('admin.brief') }}">{{ old('brief') }}</textarea>
                                @error('brief')
                                    @foreach ($errors->get('brief') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('admin.add') }}</button>
                            <a href="{{ url()->previous() }}" type="reset"
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
