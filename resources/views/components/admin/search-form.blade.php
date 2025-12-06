@props(['route', 'placeholder' => __('admin.search'), 'value' => request()->search])

<form action="{{ $route }}" method="GET" class="me-2">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{ $placeholder }}" name="search"
            value="{{ $value }}">
        <button class="btn btn-outline-secondary mx-2" type="submit" title="{{ __('admin.search') }}"
            aria-label="{{ __('admin.search') }}">
            <i class="bx bx-search"></i>
        </button>
        <a href="{{ $route }}" class="btn btn-outline-danger" title="{{ __('admin.clear') }}"
            aria-label="{{ __('admin.clear') }}">
            <i class="bx bx-x"></i>
        </a>
    </div>
</form>
