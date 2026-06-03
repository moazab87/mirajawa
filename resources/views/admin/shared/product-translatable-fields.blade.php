@php
    $productFields = [
        'name' => ['type' => 'text', 'label' => 'dashboard.name', 'required' => true],
        'description' => ['type' => 'textarea', 'label' => 'dashboard.description'],
        'packaging' => ['type' => 'textarea', 'label' => 'dashboard.packaging', 'rows' => 2],
        'country_of_origin' => ['type' => 'text', 'label' => 'dashboard.country_of_origin'],
        'how_to_use' => ['type' => 'textarea', 'label' => 'dashboard.how_to_use', 'rows' => 2],
        'storage_conditions' => ['type' => 'textarea', 'label' => 'dashboard.storage_conditions', 'rows' => 2],
        'expiry_date_text' => ['type' => 'text', 'label' => 'dashboard.expiry_date_text'],
        'harvest_season' => ['type' => 'text', 'label' => 'dashboard.harvest_season'],
        'notes' => ['type' => 'textarea', 'label' => 'dashboard.notes', 'rows' => 2],
    ];
@endphp
@include('admin.shared.language-tabs', ['fields' => $productFields, 'model' => $model ?? null])
