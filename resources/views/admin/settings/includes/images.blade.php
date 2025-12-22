<div class="row justify-content-center">

    <x-admin.uploadImage.image i="1" name="logo_ja" multiple="" image="{{ getSettingImageLink('logo_ja') }}"
        title="{{ __('admin.logo_ja') }}" />


    <x-admin.uploadImage.image i="2" name="logo_en" multiple="" image="{{ getSettingImageLink('logo_en') }}"
        title="{{ __('admin.logo_en') }}" />

    <x-admin.uploadImage.image i="3" name="logo_favicon" multiple="" image="{{ getSettingImageLink('logo_favicon') }}"
        title="{{ __('admin.logo_favicon') }}" />

</div>
