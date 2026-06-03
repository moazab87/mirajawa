<div class="row">
    <div class="divider">
        <div class="divider-text"><b>{{ __('dashboard.settings.aboutus') }}</b></div>
    </div>
   <div class="col-12 col-md-6">
      <label class="form-label" for="aboutusTitle_ja">{{ __('dashboard.settings.aboutus_title_ja') }}</label>
      {{Form::text('aboutusTitle_ja',getSettingValue('aboutusTitle_ja'),['id'=>'aboutusTitle_ja','class'=>'form-control'])}}
    </div>
    <div class="col-12  col-md-6">
      <label class="form-label" for="aboutusTitle_en">{{ __('dashboard.settings.aboutus_title_en') }}</label>
      {{Form::text('aboutusTitle_en',getSettingValue('aboutusTitle_en'),['id'=>'aboutusTitle_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
      <label class="form-label" for="aboutusTitle_ar">{{ __('dashboard.settings.aboutus_title_ar') }}</label>
      {{Form::text('aboutusTitle_ar',getSettingValue('aboutusTitle_ar'),['id'=>'aboutusTitle_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12">
      <label class="form-label" for="aboutusDes_ja">{{ __('dashboard.settings.aboutus_des_ja') }}</label>
      {{Form::textarea('aboutusDes_ja',getSettingValue('aboutusDes_ja'),['rows'=>'3','id'=>'aboutusDes_ja','class'=>'form-control'])}}
    </div>
    <div class="col-12">
      <label class="form-label" for="aboutusDes_en">{{ __('dashboard.settings.aboutus_des_en') }}</label>
      {{Form::textarea('aboutusDes_en',getSettingValue('aboutusDes_en'),['rows'=>'3','id'=>'aboutusDes_en','class'=>'form-control'])}}
    </div>
    <div class="col-12">
      <label class="form-label" for="aboutusDes_ar">{{ __('dashboard.settings.aboutus_des_ar') }}</label>
      {{Form::textarea('aboutusDes_ar',getSettingValue('aboutusDes_ar'),['rows'=>'3','id'=>'aboutusDes_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
      <label class="form-label" for="aboutusImage">{{ __('dashboard.settings.aboutus_image') }}</label>
      {{Form::file('aboutusImage',['id'=>'aboutusImage','class'=>'form-control'])}}
    </div>
</div>
