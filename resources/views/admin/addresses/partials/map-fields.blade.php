<div class="mb-3 col-md-12">
    <label class="form-label">{{ __('dashboard.address') }}</label>
    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $model->address ?? '') }}">
</div>
{{-- <div class="mb-3 col-md-6">
    <label class="form-label">{{ __('dashboard.latitude') }}</label>
    <input type="text" name="lat" id="latitude" class="form-control" value="{{ old('lat', $model->lat ?? '') }}">
</div>
<div class="mb-3 col-md-6">
    <label class="form-label">{{ __('dashboard.longitude') }}</label>
    <input type="text" name="lng" id="longitude" class="form-control" value="{{ old('lng', $model->lng ?? '') }}">
</div> --}}
@if (config('services.google_maps.key'))
    @include('admin.shared.location')
@endif
