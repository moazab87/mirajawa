@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
        ]" />
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('admin.Information_' . $singleName) }}</h5>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3 d-flex flex-column align-items-center">
                                <div class="d-flex align-items-center mt-2">
                                    <img src="{{ $model->image }}" alt="{{ $model->name }}"
                                        style="max-width: 250px; border-radius: 10px;">
                                </div>
                                <label for="image" class="form-label">{{ __('admin.image') }}</label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    {{ __('admin.name') }}
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('admin.name') }}" value="{{ $model->name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    {{ __('admin.email') }}
                                </label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ __('admin.email') }}" value="{{ $model->email }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    {{ __('admin.phone') }}
                                </label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="{{ __('admin.phone') }}" value="{{ $model->phone }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">
                                    {{ __('admin.status') }}
                                </label>
                                <input type="text" class="form-control" id="is_blocked" name="is_blocked"
                                    placeholder="{{ __('admin.status') }}"
                                    value="{{ $model->is_blocked ? __('admin.blocked') : __('admin.un_blocked') }}">
                            </div>

                        </div>

                        {{-- create div to make button in center --}}
                        <div class="d-flex justify-content-center">
                            <a href="{{ url()->previous() }}" type="reset"
                                class="btn btn-outline-warning mr-1">{{ __('admin.back') }}</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- add script to disble input --}}
@section('script')
    <script>
        $(document).ready(function() {
            $('input').attr('disabled', true);
            $('select').attr('disabled', true);

        });
    </script>
@endsection
