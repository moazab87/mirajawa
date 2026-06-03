@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('dashboard.show')],
        ]" />
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('dashboard.sliders.show') }}</h5>
                <div>
                    <a href="{{ route('admin.sliders.edit', $model->id) }}" class="btn btn-sm btn-primary">
                        <i class="bx bx-edit"></i> {{ __('dashboard.edit') }}
                    </a>
                    <a href="{{ $route }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back"></i> {{ __('dashboard.back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <strong>{{ __('dashboard.title') }}:</strong>
                        <p>{{ $model->getDisplayTranslation('title') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>{{ __('dashboard.status') }}:</strong>
                        <p><x-admin.status-badge :status="$model->status" /></p>
                    </div>
                    @php $media = $model->attachments->first(); @endphp
                    @if($media)
                        <div class="col-md-12 mb-3">
                            <strong>{{ __('dashboard.media') }}:</strong>
                            <div class="mt-2">
                                @if(str_starts_with($media->mime, 'image/'))
                                    <img src="{{ asset('storage/attachments/sliders/' . $media->file_name) }}"
                                        alt="{{ $media->original_name }}" class="img-fluid rounded" style="max-height: 400px;">
                                @else
                                    <video class="w-100 rounded" controls style="max-height: 400px;">
                                        <source src="{{ asset('storage/attachments/sliders/' . $media->file_name) }}" type="{{ $media->mime }}">
                                        {{ __('dashboard.video_not_supported') }}
                                    </video>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
