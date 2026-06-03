@extends('admin.layouts.app')
@section('title', $subTitle)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => $route, 'text' => $title],
        ['url' => '#', 'text' => __('dashboard.show')],
    ]" />
    <x-admin.translatable-show
        :model="$model"
        :fields="['name', 'description']"
        :edit-route="route($editRoute, $model->id)"
        :back-route="$route"
        icon="bx-layer"
    />
</div>
@endsection
