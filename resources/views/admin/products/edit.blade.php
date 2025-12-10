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
                            {{-- Translatable Name Fields --}}
                            @foreach (languages() as $lang)
                                <div class="mb-3 col-md-6">
                                    <label for="name_{{ $lang }}" class="form-label">
                                        {{ __("admin.name_$lang") }}
                                    </label>
                                    <input type="text" class="form-control" id="name_{{ $lang }}"
                                        name="name[{{ $lang }}]" placeholder="{{ __("admin.name_$lang") }}" required
                                        @if ($loop->first) autofocus @endif
                                        value="{{ old("name.$lang", $model->getTranslation('name', $lang)) }}">
                                    @error("name.$lang")
                                        @foreach ($errors->get("name.$lang") as $error)
                                            <div class="text-danger">{{ $error }}</div>
                                        @endforeach
                                    @enderror
                                </div>
                            @endforeach

                            {{-- Translatable Description Fields --}}
                            @foreach (languages() as $lang)
                                <div class="mb-3 col-md-12">
                                    <label for="description_{{ $lang }}" class="form-label">
                                        {{ __("admin.description_$lang") }}
                                    </label>
                                    <textarea class="form-control" id="description_{{ $lang }}" name="description[{{ $lang }}]"
                                        placeholder="{{ __("admin.description_$lang") }}" rows="3">{{ old("description.$lang", $model->getTranslation('description', $lang)) }}</textarea>
                                    @error("description.$lang")
                                        @foreach ($errors->get("description.$lang") as $error)
                                            <div class="text-danger">{{ $error }}</div>
                                        @endforeach
                                    @enderror
                                </div>
                            @endforeach

                            {{-- Link Field --}}
                            <div class="mb-3 col-md-12">
                                <label for="link" class="form-label">{{ __('admin.link') }}</label>
                                <input type="url" class="form-control" id="link" name="link"
                                    placeholder="{{ __('admin.link') }}"
                                    value="{{ old('link', $model->link) }}">
                                @error('link')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            {{-- Category Field --}}
                            <div class="mb-3 col-md-12">
                                <label for="category_id" class="form-label">{{ __('admin.category') }}</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">{{ __('admin.select_category') }}</option>
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('category_id', $model->category_id) == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            {{-- Existing Images --}}
                            @php
                                $existingImages = $model->attachments->filter(function($attachment) {
                                    return str_starts_with($attachment->mime, 'image/');
                                });
                                $existingVideos = $model->attachments->filter(function($attachment) {
                                    return str_starts_with($attachment->mime, 'video/');
                                });
                            @endphp

                            @if ($existingImages->count() > 0)
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">{{ __('admin.existing_images') }}</label>
                                    <div class="row">
                                        @foreach ($existingImages as $attachment)
                                            <div class="col-md-3 mb-2 attachment-item" data-attachment-id="{{ $attachment->id }}">
                                                <div class="card position-relative">
                                                    <div class="card-body p-2 position-relative">
                                                        <button type="button" 
                                                            class="btn btn-sm btn-icon btn-label-danger position-absolute top-0 end-0 m-1 delete-attachment" 
                                                            data-url="{{ route('admin.products.attachments.destroy', ['product' => $model->id, 'attachment' => $attachment->id]) }}"
                                                            style="z-index: 100;"
                                                            title="{{ __('admin.delete') }}">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                        <a href="{{ asset('storage/attachments/products/' . $attachment->file_name) }}"
                                                            data-fancybox="product-images-gallery"
                                                            data-caption="{{ $attachment->original_name }}"
                                                            class="d-block">
                                                            <img src="{{ asset('storage/attachments/products/' . $attachment->file_name) }}"
                                                                alt="{{ $attachment->original_name }}"
                                                                class="img-fluid rounded cursor-pointer" 
                                                                style="max-height: 100px; width: 100%; object-fit: cover;">
                                                        </a>
                                                        <small class="text-muted d-block mt-1">{{ $attachment->original_name }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Existing Videos --}}
                            @if ($existingVideos->count() > 0)
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">{{ __('admin.existing_videos') }}</label>
                                    <div class="row">
                                        @foreach ($existingVideos as $attachment)
                                            <div class="col-md-3 mb-2 attachment-item" data-attachment-id="{{ $attachment->id }}">
                                                <div class="card position-relative">
                                                    <div class="card-body p-2 position-relative">
                                                        <button type="button" 
                                                            class="btn btn-sm btn-icon btn-label-danger position-absolute top-0 end-0 m-1 delete-attachment" 
                                                            data-url="{{ route('admin.products.attachments.destroy', ['product' => $model->id, 'attachment' => $attachment->id]) }}"
                                                            style="z-index: 100;"
                                                            title="{{ __('admin.delete') }}">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                        <a href="#video-{{ $attachment->id }}"
                                                            data-fancybox="product-videos-gallery"
                                                            data-caption="{{ $attachment->original_name }}"
                                                            data-type="html"
                                                            class="d-block">
                                                            <video class="w-100 rounded cursor-pointer" style="max-height: 100px; object-fit: cover;" muted>
                                                                <source src="{{ asset('storage/attachments/products/' . $attachment->file_name) }}" type="{{ $attachment->mime }}">
                                                            </video>
                                                            <div class="text-center mt-2">
                                                                <i class="bx bx-play-circle text-primary" style="font-size: 1.5rem;"></i>
                                                                <p class="small mb-0">{{ $attachment->original_name }}</p>
                                                            </div>
                                                        </a>
                                                        <div id="video-{{ $attachment->id }}" style="display: none;">
                                                            <video class="w-100" controls style="max-width: 100%;">
                                                                <source src="{{ asset('storage/attachments/products/' . $attachment->file_name) }}" type="{{ $attachment->mime }}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                        <small class="text-muted d-block mt-1">{{ $attachment->original_name }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- New Images Field --}}
                            <div class="mb-3 col-md-12">
                                <label for="images" class="form-label">{{ __('admin.add_images') }}</label>
                                <input type="file" class="form-control" id="images" name="images[]"
                                    multiple accept="image/*">
                                <small class="text-muted">{{ __('admin.images_hint') }}</small>
                                @error('images.*')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            {{-- New Videos Field --}}
                            <div class="mb-3 col-md-12">
                                <label for="videos" class="form-label">{{ __('admin.add_videos') }}</label>
                                <input type="file" class="form-control" id="videos" name="videos[]"
                                    multiple accept="video/*">
                                <small class="text-muted">{{ __('admin.videos_hint') }}</small>
                                @error('videos.*')
                                    <div class="text-danger">{{ $error }}</div>
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

@section('css')
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
        .cursor-pointer:hover {
            opacity: 0.8;
        }
        .attachment-item {
            position: relative;
        }
        .delete-attachment {
            opacity: 0.8;
            transition: opacity 0.3s;
            pointer-events: auto !important;
        }
        .attachment-item:hover .delete-attachment {
            opacity: 1;
        }
    </style>
@endsection

@section('script')
    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Fancybox for images gallery
            if (document.querySelector("[data-fancybox='product-images-gallery']")) {
                Fancybox.bind("[data-fancybox='product-images-gallery']", {
                    Toolbar: {
                        display: {
                            left: ["infobar"],
                            middle: [],
                            right: ["slideshow", "download", "thumbs", "close"],
                        },
                    },
                    Thumbs: {
                        autoStart: false,
                    },
                });
            }

            // Initialize Fancybox for videos gallery
            if (document.querySelector("[data-fancybox='product-videos-gallery']")) {
                Fancybox.bind("[data-fancybox='product-videos-gallery']", {
                    Toolbar: {
                        display: {
                            left: ["infobar"],
                            middle: [],
                            right: ["slideshow", "download", "thumbs", "close"],
                        },
                    },
                    Thumbs: {
                        autoStart: false,
                    },
                });
            }

            // Handle attachment deletion
            $(document).on('click', '.delete-attachment', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                
                // Prevent Fancybox from opening
                const $button = $(this);
                const $fancyboxLink = $button.closest('.attachment-item').find('a[data-fancybox]');
                $fancyboxLink.off('click.fancybox');
                
                const url = $button.data('url');
                const $attachmentItem = $button.closest('.attachment-item');

                Swal.fire({
                    title: "{{ __('admin.confirm') }}",
                    text: "{{ __('admin.delete_confirmation') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __('admin.confirm') }}',
                    cancelButtonText: '{{ __('admin.cancel') }}',
                    buttonsStyling: false,
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            dataType: "json",
                            success: (response) => {
                                toastr.success("{{ __('admin.deleted_successfully') }}");
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: '{{ __('admin.the_selected_has_been_successfully_deleted') }}',
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                $attachmentItem.fadeOut(300, function() {
                                    $(this).remove();
                                });
                            },
                            error: (error) => {
                                toastr.error("{{ __('admin.error_occurred') }}");
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: '{{ __('admin.error_occurred') }}',
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection

