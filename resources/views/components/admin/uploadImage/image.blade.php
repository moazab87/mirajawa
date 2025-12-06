<div class="col-6 my-2">
    <div id="{{'uploadArea'.$i}}" class="upload-area ">
        <div class="upload-area__header">
            <p class="upload-area__paragraph">
                <strong class="text-primary">
                    {{ $title ?? 'Upload Image' }}
                </strong>
            </p>
        </div>
        <div id="{{'dropZoon'.$i}}" onclick="openFileInput('#fileInput{{$i}}')" class="upload-area__drop-zoon drop-zoon">
            <span class="drop-zoon__icon">
              <i class='bx bxs-file-image'></i>
            </span>
            <p class="drop-zoon__paragraph">
                @lang('admin.dropImage')
            </p>
            <span id="loadingText{{$i}}" class="drop-zoon__loading-text">
                @lang('admin.loading')
            </span>
            <img src="{{ $image ?? asset('uploads/placeholder.png') }}"
            alt="{{__('admin.preview')}}" id="previewImage{{$i}}" class="drop-zoon__preview-image" draggable="false" style="display: block;">
            <input type="file" id="fileInput{{$i}}" name="{{$name}}"
            onchange="changeFileInput('dropZoon{{$i}}','loadingText{{$i}}','previewImage{{$i}}','uploaded-file__counter{{$i}}','uploadedFile{{$i}}','uploadedFileInfo{{$i}}','uploadArea{{$i}}','fileDetails{{$i}}','uploaded-file__name{{$i}}','uploaded-file__icon-text{{$i}}',event)"
            class="drop-zoon__file-input" accept="image/*" {{ $multiple }}>
        </div>
        <!-- End Drop Zoon -->

        <!-- File Details -->
        <div id="fileDetails{{$i}}" class="upload-area__file-details file-details">
            <h3 class="file-details__title">
                @lang('admin.fileDetails')
            </h3>
            <div id="uploadedFile{{$i}}" class="uploaded-file">
                <div class="uploaded-file__icon-container">
                    <i class='bx bxs-file-blank uploaded-file__icon'></i>
                    <span class="uploaded-file__icon-text{{$i}}"></span> <!-- Data Will be Comes From Js -->
                </div>

                <div id="uploadedFileInfo{{$i}}" class="uploaded-file__info">
                    <span class="uploaded-file__name{{$i}}">Slider-{{$i}}</span>
                    <span class="uploaded-file__counter{{$i}}">0%</span>
                </div>
            </div>
        </div>
        <!-- End File Details -->
    </div>
    @error($name)
    <span class="text-danger">{{$message}}</span>
    @enderror
    <!-- End Upload Area -->
</div>

