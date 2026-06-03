@props(['route', 'placeholder' => __('admin.search'), 'value' => request()->search])

<form action="{{ $route }}" method="GET" class="dash-search-form">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{ $placeholder }}" name="search"
            value="{{ $value }}" aria-label="{{ $placeholder }}">
        <button class="btn btn-primary" type="submit" title="{{ __('admin.search') }}"
            aria-label="{{ __('admin.search') }}">
            <i class="bx bx-search"></i>
        </button>
        <a href="{{ $route }}" class="btn btn-secondary" title="{{ __('admin.clear') }}"
            aria-label="{{ __('admin.clear') }}">
            <i class="bx bx-x"></i>
        </a>
    </div>
</form>
