<div class="row">
    <div class="divider">
        <div class="divider-text"><b>{{ __('admin.aboutus') }}</b></div>
    </div>
   <div class="col-12 col-md-6">
      <label class="form-label" for="aboutusTitle_ja">{{ __('admin.aboutusTitle_ja') }}</label>
      {{Form::text('aboutusTitle_ja',getSettingValue('aboutusTitle_ja'),['id'=>'aboutusTitle_ja','class'=>'form-control'])}}
    </div>
    <div class="col-12  col-md-6">
      <label class="form-label" for="aboutusTitle_en">{{ __('admin.aboutusTitle_en') }}</label>
      {{Form::text('aboutusTitle_ja',getSettingValue('aboutusTitle_en'),['id'=>'aboutusTitle_en','class'=>'form-control'])}}
    </div>
    <div class="col-12">
      <label class="form-label" for="aboutusDes_ja">{{ __('admin.aboutusDes_ja') }}</label>
      {{Form::textarea('aboutusDes_ar',getSettingValue('aboutusDes_ar'),['rows'=>'3','id'=>'aboutusDes_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12">
      <label class="form-label" for="aboutusDes_en">{{ __('admin.aboutusDes_en') }}</label>
      {{Form::textarea('aboutusDes_en',getSettingValue('aboutusDes_en'),['rows'=>'3','id'=>'aboutusDes_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
      <label class="form-label" for="aboutusImage">{{ __('admin.aboutusImage') }}</label>
      {{Form::file('aboutusImage',['id'=>'aboutusImage','class'=>'form-control'])}}
    </div>
</div>
