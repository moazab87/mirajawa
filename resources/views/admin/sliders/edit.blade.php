@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('dashboard.edit')],
        ]" />
        <div class="card"><div class="card-body">
            <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin.layouts.partials.alerts')
                <div class="row">
                    @include('admin.shared.language-tabs', [
                        'fields' => [
                            'title' => ['type' => 'text', 'label' => 'dashboard.title', 'required' => true],
                            'description' => ['type' => 'textarea', 'label' => 'dashboard.description'],
                        ],
                        'model' => $model,
                    ])
                    @include('admin.shared.status-select', ['model' => $model])
                    @if($model->attachments->count())
                        <div class="mb-3 col-md-12">
                            <label class="form-label">{{ __('dashboard.existing_media') }}</label>
                            @foreach($model->attachments as $attachment)
                                @if(str_contains($attachment->mime, 'image'))
                                    <img src="{{ asset('storage/attachments/sliders/' . $attachment->file_name) }}" class="img-fluid rounded mb-2" style="max-height:200px">
                                @else
                                    <video controls class="w-100 mb-2" style="max-height:200px">
                                        <source src="{{ asset('storage/attachments/sliders/' . $attachment->file_name) }}" type="{{ $attachment->mime }}">
                                    </video>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="mb-3 col-md-12">
                        <label for="media" class="form-label">{{ __('dashboard.media') }}</label>
                        <input type="file" class="form-control" id="media" name="media" accept="image/*,video/*">
                        <small class="text-muted">{{ __('dashboard.slider_media_hint') }}</small>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('dashboard.update') }}</button>
                    <a href="{{ $route }}" class="btn btn-outline-secondary mx-1">{{ __('dashboard.back') }}</a>
                </div>
            </form>
        </div></div>
    </div>
@endsection
