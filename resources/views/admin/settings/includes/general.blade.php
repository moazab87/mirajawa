<!-- form -->
<div class="row">
    <div class="divider">
        <div class="divider-text">{{ __('dashboard.settings.site_main_seo') }}</div>
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="siteTitle_ja">{{ __('dashboard.settings.site_title_ja') }}</label>
        {{ Form::text('siteTitle_ja', getSettingValue('siteTitle_ja'), ['id' => 'siteTitle_ja', 'class' => 'form-control']) }}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="siteTitle_en">{{ __('dashboard.settings.site_title_en') }}</label>
        {{ Form::text('siteTitle_en', getSettingValue('siteTitle_en'), ['id' => 'siteTitle_en', 'class' => 'form-control']) }}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="siteTitle_ar">{{ __('dashboard.settings.site_title_ar') }}</label>
        {{ Form::text('siteTitle_ar', getSettingValue('siteTitle_ar'), ['id' => 'siteTitle_ar', 'class' => 'form-control']) }}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteDescription_ja">{{ __('dashboard.settings.site_description_ja') }}</label>
        {{ Form::textarea('siteDescription_ja', getSettingValue('siteDescription_ja'), ['rows' => '3', 'id' => 'siteDescription_ja', 'class' => 'form-control']) }}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteDescription_en">{{ __('dashboard.settings.site_description_en') }}</label>
        {{ Form::textarea('siteDescription_en', getSettingValue('siteDescription_en'), ['rows' => '3', 'id' => 'siteDescription_en', 'class' => 'form-control']) }}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteDescription_ar">{{ __('dashboard.settings.site_description_ar') }}</label>
        {{ Form::textarea('siteDescription_ar', getSettingValue('siteDescription_ar'), ['rows' => '3', 'id' => 'siteDescription_ar', 'class' => 'form-control']) }}
    </div>
</div>
