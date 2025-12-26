<!-- form -->
<div class="row">
    <div class="divider">
        <div class="divider-text">{{trans('admin.siteMainSEO')}}</div>
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="siteTitle_ja">{{trans('admin.siteTitle_ja')}}</label>
        {{Form::text('siteTitle_ja',getSettingValue('siteTitle_ja'),['id'=>'siteTitle_ja','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="siteTitle_en">{{trans('admin.siteTitle_en')}}</label>
        {{Form::text('siteTitle_en',getSettingValue('siteTitle_en'),['id'=>'siteTitle_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="siteTitle_ar">{{trans('admin.siteTitle_ar')}}</label>
        {{Form::text('siteTitle_ar',getSettingValue('siteTitle_ar'),['id'=>'siteTitle_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteDescription_ja">{{trans('admin.siteDescription_ja')}}</label>
        {{Form::textarea('siteDescription_ja',getSettingValue('siteDescription_ja'),['rows'=>'3','id'=>'siteDescription_ja','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteDescription_en">{{trans('admin.siteDescription_en')}}</label>
        {{Form::textarea('siteDescription_en',getSettingValue('siteDescription_en'),['rows'=>'3','id'=>'siteDescription_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteDescription_ar">{{trans('admin.siteDescription_ar')}}</label>
        {{Form::textarea('siteDescription_ar',getSettingValue('siteDescription_ar'),['rows'=>'3','id'=>'siteDescription_ar','class'=>'form-control'])}}
    </div>

</div>
<!--/ form -->
