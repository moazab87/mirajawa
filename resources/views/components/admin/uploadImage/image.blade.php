@props([
    'i' => null,
    'name' => 'image',
    'title' => null,
    'image' => null,
    'uploadedImage' => null,
    'multiple' => '',
    'required' => false,
])

@php
    $uid = $i ?? preg_replace('/[^a-zA-Z0-9_]/', '_', $name);
    $previewSrc = $image ?? $uploadedImage ?? asset('uploads/placeholder.png');
@endphp

<div class="col-6 my-2">
    <div id="uploadArea{{ $uid }}" class="upload-area">
        <div class="upload-area__header">
            <p class="upload-area__paragraph">
                <strong class="text-primary">
                    {{ $title ?? 'Upload Image' }}
                </strong>
            </p>
        </div>
        <div id="dropZoon{{ $uid }}" onclick="openFileInput('#fileInput{{ $uid }}')" class="upload-area__drop-zoon drop-zoon">
            <span class="drop-zoon__icon">
                <i class="bx bxs-file-image"></i>
            </span>
            <p class="drop-zoon__paragraph">
                @lang('admin.dropImage')
            </p>
            <span id="loadingText{{ $uid }}" class="drop-zoon__loading-text">
                @lang('admin.loading')
            </span>
            <img src="{{ $previewSrc }}"
                alt="{{ __('admin.preview') }}" id="previewImage{{ $uid }}" class="drop-zoon__preview-image" draggable="false" style="display: block;">
            <input type="file" id="fileInput{{ $uid }}" name="{{ $name }}"
                onchange="changeFileInput('dropZoon{{ $uid }}','loadingText{{ $uid }}','previewImage{{ $uid }}','uploaded-file__counter{{ $uid }}','uploadedFile{{ $uid }}','uploadedFileInfo{{ $uid }}','uploadArea{{ $uid }}','fileDetails{{ $uid }}','uploaded-file__name{{ $uid }}','uploaded-file__icon-text{{ $uid }}',event)"
                class="drop-zoon__file-input" accept="image/*" {{ $multiple }} @if($required) required @endif>
        </div>

        <div id="fileDetails{{ $uid }}" class="upload-area__file-details file-details">
            <h3 class="file-details__title">
                @lang('admin.fileDetails')
            </h3>
            <div id="uploadedFile{{ $uid }}" class="uploaded-file">
                <div class="uploaded-file__icon-container">
                    <i class="bx bxs-file-blank uploaded-file__icon"></i>
                    <span class="uploaded-file__icon-text{{ $uid }}"></span>
                </div>

                <div id="uploadedFileInfo{{ $uid }}" class="uploaded-file__info">
                    <span class="uploaded-file__name{{ $uid }}">{{ $name }}</span>
                    <span class="uploaded-file__counter{{ $uid }}">0%</span>
                </div>
            </div>
        </div>
    </div>
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
