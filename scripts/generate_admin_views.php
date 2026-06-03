<?php

$modules = [
    'productGroups' => ['titleField' => 'name', 'fields' => ['name', 'description'], 'category' => true],
    'addresses'     => ['titleField' => 'name', 'fields' => ['name', 'description', 'map_desc'], 'address' => true],
    'faqs'          => ['titleField' => 'question', 'fields' => ['question', 'answer']],
    'profiles'      => ['titleField' => 'name', 'fields' => ['name', 'description']],
    'histories'     => ['titleField' => 'name', 'fields' => ['name', 'description']],
    'informationBlocks' => ['titleField' => 'name', 'fields' => ['name', 'description']],
    'contactInformation' => ['titleField' => 'name', 'fields' => ['name', 'description'], 'contact' => true],
    'branches'      => ['titleField' => 'name', 'fields' => ['name', 'description'], 'images' => true],
];

$base = dirname(__DIR__) . '/resources/views/admin';

foreach ($modules as $folder => $config) {
    $dir = "$base/$folder";
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $titleField = $config['titleField'];
    $listLabel = $titleField;

    $fieldsArray = [];
    foreach ($config['fields'] as $field) {
        $type = in_array($field, ['description', 'answer', 'map_desc']) ? 'textarea' : 'text';
        $req = ($field === 'name' || $field === 'question') ? ", 'required' => true" : '';
        $fieldsArray[] = "'{$field}' => ['type' => '{$type}', 'label' => 'admin.{$field}'{$req}]";
    }
    $fieldsPhp = implode(",\n                    ", $fieldsArray);

    $index = "@extends('admin.layouts.app')\n@section('title', \$title)\n@section('content')\n<div class=\"container-xxl flex-grow-1 container-p-y\">\n    <x-admin.breadcrumb :links=\"[\n        ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],\n        ['url' => '#', 'text' => \$title],\n    ]\" />\n    <x-admin.table :headers=\"['#', __('admin.{$listLabel}'), __('admin.status'), __('admin.actions')]\" :createRoute=\"\$createRoute\" :title=\"\$title\" :buttonText=\"__('admin.add')\" :search=\"true\" :indexRoute=\"\$route\">\n        @forelse(\$models as \$model)\n            <tr>\n                <td>{{ \$loop->iteration }}</td>\n                <td>{{ \$model->getDisplayTranslation('{$titleField}') }}</td>\n                <td><x-admin.status-badge :status=\"\$model->status\" /></td>\n                <td><x-admin.buttons :editRoute=\"route(\$editRoute, \$model->id)\" :deleteRoute=\"route(\$deleteRoute, \$model->id)\" :showRoute=\"route(\$showRoute, \$model->id)\" /></td>\n            </tr>\n        @empty\n            <tr><td colspan=\"4\" class=\"text-center py-4\">{{ __('admin.no_data_available') }}</td></tr>\n        @endforelse\n    </x-admin.table>\n</div>\n@if (\$models->count() > 0)\n<div class=\"d-flex justify-content-center my-2\">{{ \$models->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}</div>\n@endif\n@endsection\n";

    file_put_contents("$dir/index.blade.php", $index);

    $extras = '';
    if (!empty($config['category'])) {
        $extras .= "\n                <div class=\"mb-3 col-md-6\">\n                    <label class=\"form-label\">{{ __('admin.category') }}</label>\n                    <select name=\"category_id\" class=\"form-select\" required>\n                        <option value=\"\">{{ __('admin.select') }}</option>\n                        @foreach(\$categories ?? [] as \$id => \$label)\n                            <option value=\"{{ \$id }}\" {{ old('category_id', \$model->category_id ?? '') == \$id ? 'selected' : '' }}>{{ \$label }}</option>\n                        @endforeach\n                    </select>\n                </div>";
    }
    if (!empty($config['address'])) {
        $extras .= "\n                @include('admin.addresses.partials.map-fields', ['model' => \$model ?? null])";
    }
    if (!empty($config['contact'])) {
        $extras .= "\n                <div class=\"mb-3 col-md-6\"><label class=\"form-label\">{{ __('admin.phone') }}</label><input type=\"text\" name=\"phone\" class=\"form-control\" value=\"{{ old('phone', \$model->phone ?? '') }}\"></div>\n                <div class=\"mb-3 col-md-6\"><label class=\"form-label\">{{ __('admin.image') }}</label><input type=\"file\" name=\"image\" class=\"form-control\" accept=\"image/*\"></div>\n                @isset(\$model) @if(\$model->image)<img src=\"{{ \$model->image_url }}\" class=\"img-thumbnail mt-2\" style=\"max-height:120px\">@endif @endisset";
    }
    if (!empty($config['images'])) {
        $extras .= "\n                <div class=\"mb-3 col-md-12\"><label class=\"form-label\">{{ __('admin.images') }}</label><input type=\"file\" name=\"images[]\" class=\"form-control\" multiple accept=\"image/*\"></div>\n                @isset(\$model)\n                    <div class=\"row\">@foreach(\$model->images as \$img)<div class=\"col-md-3 mb-2\"><img src=\"{{ \$img->image_url }}\" class=\"img-fluid rounded\"><a href=\"{{ route('admin.branches.images.destroy', [\$model, \$img]) }}\" class=\"btn btn-sm btn-danger mt-1\" onclick=\"return confirm('{{ __('admin.confirm_delete') }}')\">{{ __('admin.delete') }}</a></div>@endforeach</div>\n                @endisset";
    }

    $formBody = "@include('admin.shared.language-tabs', ['fields' => [\n                    {$fieldsPhp}\n                ], 'model' => \$model ?? null])\n                @include('admin.shared.status-select', ['model' => \$model ?? null]){$extras}";

    $formTemplate = function ($isEdit) use ($formBody) {
        $method = $isEdit ? "@method('PUT')" : '';
        $action = $isEdit ? '{{ $updateRoute }}' : '{{ $storeRoute }}';
        $breadcrumbEdit = $isEdit ? "__('admin.edit')" : "__('admin.create')";
        $btn = $isEdit ? "__('admin.edit')" : "__('admin.create')";

        return "@extends('admin.layouts.app')\n@section('title', \$subTitle)\n@section('content')\n<div class=\"container-xxl flex-grow-1 container-p-y\">\n    <x-admin.breadcrumb :links=\"[\n        ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],\n        ['url' => \$route, 'text' => \$title],\n        ['url' => '#', 'text' => {$breadcrumbEdit}],\n    ]\" />\n    <div class=\"card\"><div class=\"card-body\">\n        <form action=\"{$action}\" method=\"POST\" enctype=\"multipart/form-data\">\n            @csrf\n            {$method}\n            @include('admin.layouts.partials.alerts')\n            <div class=\"row\">\n                {$formBody}\n            </div>\n            <div class=\"d-flex justify-content-center mt-3\">\n                <button type=\"submit\" class=\"btn btn-primary\">{{ {$btn} }}</button>\n                <a href=\"{{ url()->previous() }}\" class=\"btn btn-outline-warning mx-1\">{{ __('admin.back') }}</a>\n            </div>\n        </form>\n    </div></div>\n</div>\n@endsection\n";
    };

    file_put_contents("$dir/create.blade.php", $formTemplate(false));
    file_put_contents("$dir/edit.blade.php", $formTemplate(true));

    $show = "@extends('admin.layouts.app')\n@section('title', \$subTitle)\n@section('content')\n<div class=\"container-xxl flex-grow-1 container-p-y\">\n    <x-admin.breadcrumb :links=\"[\n        ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],\n        ['url' => \$route, 'text' => \$title],\n        ['url' => '#', 'text' => __('admin.show')],\n    ]\" />\n    <div class=\"card\"><div class=\"card-body\">\n        <h5>{{ \$model->getDisplayTranslation('{$titleField}') }}</h5>\n        <p><x-admin.status-badge :status=\"\$model->status\" /></p>\n        @foreach(languages() as \$lang)\n            <hr><h6>{{ getLanguageName(\$lang) }}</h6>\n            @foreach(['" . implode("','", $config['fields']) . "'] as \$field)\n                <p><strong>{{ __('admin.'.\$field) }}:</strong> {{ \$model->getTranslation(\$field, \$lang) }}</p>\n            @endforeach\n        @endforeach\n        <a href=\"{{ route(\$editRoute, \$model->id) }}\" class=\"btn btn-primary\">{{ __('admin.edit') }}</a>\n        <a href=\"{{ \$route }}\" class=\"btn btn-outline-secondary\">{{ __('admin.back') }}</a>\n    </div></div>\n</div>\n@endsection\n";
    file_put_contents("$dir/show.blade.php", $show);
}

echo "Regenerated views\n";
