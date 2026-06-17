<div class="col-md-4 mb-3">
    <label class="form-label" for="year">{{ __('dashboard.year') }} <span class="text-danger">*</span></label>
    <input type="number"
           name="year"
           id="year"
           class="form-control @error('year') is-invalid @enderror"
           value="{{ old('year', $model->year ?? '') }}"
           min="1900"
           max="2100"
           required>
    @error('year')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
