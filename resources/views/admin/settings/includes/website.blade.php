<div class="row">
    <div class="divider"><div class="divider-text">{{ __('dashboard.settings.website') }}</div></div>
    <div class="col-12 col-md-4">
        <label class="form-label">{{ __('dashboard.phone') }}</label>
        {{ Form::text('phone', getSettingValue('phone'), ['class' => 'form-control']) }}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label">{{ __('dashboard.since_year') }}</label>
        {{ Form::number('since_year', getSettingValue('since_year'), ['class' => 'form-control', 'min' => 1900, 'max' => 2100]) }}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label">{{ __('dashboard.background_image') }}</label>
        <input type="file" name="background_image" class="form-control" accept="image/*">
        @if(getSettingValue('background_image'))
            <img src="{{ asset('uploads/settings/' . getSettingValue('background_image')) }}" class="img-thumbnail mt-2" style="max-height:100px">
        @endif
    </div>
</div>
