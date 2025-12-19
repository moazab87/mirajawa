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

                            <!-- Translatable Description Fields -->
                            @foreach (languages() as $lang)
                                <div class="mb-3 col-md-12">
                                    <label for="description_{{ $lang }}" class="form-label">
                                        {{ __("admin.description_$lang") }}
                                    </label>
                                    <textarea class="form-control" id="description_{{ $lang }}" name="description[{{ $lang }}]"
                                        placeholder="{{ __("admin.description_$lang") }}" rows="3">{{ old("description.$lang") }}</textarea>
                                    @error("description.$lang")
                                        @foreach ($errors->get("description.$lang") as $error)
                                            <div class="text-danger">{{ $error }}</div>
                                        @endforeach
                                    @enderror
                                </div>
                            @endforeach

                            <!-- Link Field -->
                            <div class="mb-3 col-md-12">
                                <label for="link" class="form-label">{{ __('admin.link') }}</label>
                                <input type="url" class="form-control" id="link" name="link"
                                    placeholder="{{ __('admin.link') }}" value="{{ old('link') }}">
                                @error('link')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            <!-- Category Field -->
                            <div class="mb-3 col-md-12">
                                <label for="category_id" class="form-label">{{ __('admin.category') }}</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">{{ __('admin.select_category') }}</option>
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            <!-- Images Field -->
                            <div class="mb-3 col-md-12">
                                <label for="images" class="form-label">{{ __('admin.images') }}</label>
                                <input type="file" class="form-control" id="images" name="images[]"
                                    multiple accept="image/*">
                                <small class="text-muted">{{ __('admin.images_hint') }}</small>
                                @error('images.*')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            <!-- Videos Field -->
                            {{-- <div class="mb-3 col-md-12">
                                <label for="videos" class="form-label">{{ __('admin.videos') }}</label>
                                <input type="file" class="form-control" id="videos" name="videos[]"
                                    multiple accept="video/*">
                                <small class="text-muted">{{ __('admin.videos_hint') }}</small>
                                @error('videos.*')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div> --}}
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

