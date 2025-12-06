<!-- form -->
<div class="row">
    <div class="col-12 col-md-6">
        <label class="form-label" for="facebook">facebook</label>
        {{Form::text('facebook',getSettingValue('facebook'),['id'=>'facebook','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="twitter">twitter</label>
        {{Form::text('twitter',getSettingValue('twitter'),['id'=>'twitter','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="instagram">instagram</label>
        {{Form::text('instagram',getSettingValue('instagram'),['id'=>'instagram','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="whatsapp">Whatsapp</label>
        {{Form::text('whatsapp',getSettingValue('whatsapp'),['id'=>'whatsapp','class'=>'form-control'])}}
    </div>
   
</div>
