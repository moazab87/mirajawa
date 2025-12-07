@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.create')],
        ]" />
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $storeRoute }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.layouts.partials.alerts')
                        <div class="row">
                            <!-- Translatable Name Fields -->
                            @foreach (languages() as $lang)
                                <div class="mb-3 col-md-6">
                                    <label for="name_{{ $lang }}" class="form-label">
                                        {{ __("admin.name_$lang") }}
                                    </label>
                                    <input type="text" class="form-control" id="name_{{ $lang }}"
                                        name="name[{{ $lang }}]" placeholder="{{ __("admin.name_$lang") }}" required
                                        autofocus value="{{ old("name.$lang") }}">
                                    @error("name.$lang")
                                        @foreach ($errors->get("name.$lang") as $error)
                                            <div class="text-danger">{{ $error }}</div>
                                        @endforeach
                                    @enderror
                                </div>
                            @endforeach
                              @foreach (languages() as $lang)
                                <div class="mb-3 col-md-12">
                                    <label for="content_{{ $lang }}" class="form-label">
                                        {{ __("admin.content_$lang") }}
                                    </label>
                                    <textarea class="form-control" id="content_{{ $lang }}" name="content[{{ $lang }}]"
                                        placeholder="{{ __("admin.content_$lang") }}" rows="3">{{ old("content.$lang") }}</textarea>
                                    @error("content.$lang")
                                        @foreach ($errors->get("content.$lang") as $error)
                                            <div class="text-danger">{{ $error }}</div>
                                        @endforeach
                                    @enderror
                                </div>
                            @endforeach


                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('admin.create') }}</button>
                            <a href="{{ url()->previous() }}" type="reset"
                                class="btn btn-outline-warning mx-1">{{ __('admin.back') }}</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
