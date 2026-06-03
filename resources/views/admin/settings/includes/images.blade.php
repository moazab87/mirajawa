<!-- form -->
<div class="row">
    <div class="col-12 col-md-6">
        <x-admin.uploadImage.image :name="'logo_ja'" :uploadedImage="getSettingImageLink('logo', false, 'ja')" :required="false"
            title="{{ __('dashboard.settings.logo_ja') }}" />
    </div>
    <div class="col-12 col-md-6">
        <x-admin.uploadImage.image :name="'logo_en'" :uploadedImage="getSettingImageLink('logo', false, 'en')" :required="false"
            title="{{ __('dashboard.settings.logo_en') }}" />
    </div>
    <div class="col-12 col-md-6">
        <x-admin.uploadImage.image :name="'logo_ar'" :uploadedImage="getSettingImageLink('logo', false, 'ar')" :required="false"
            title="{{ __('dashboard.settings.logo_ar') }}" />
    </div>
    <div class="col-12 col-md-6">
        <x-admin.uploadImage.image :name="'logo_favicon'" :uploadedImage="getSettingImageLink('logo_favicon')" :required="false"
            title="{{ __('dashboard.settings.logo_favicon') }}" />
    </div>
</div>
