<!-- show.blade.php -->
@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'),             'text' => __('admin.AdminPanel')],
            ['url' => $route,                           'text' => $title]
        ]" />

        <div class="row gy-4">
            <div class="col-md-6 col-12">
                <!-- User Card -->
                @include('admin.users.partials.user_card')
            </div>
            <div class="col-md-6 col-12">
                @include('admin.users.partials.user_tabs')
            </div>
        </div>
        <!--/ Edit User Modal -->
    </div>
@endsection
