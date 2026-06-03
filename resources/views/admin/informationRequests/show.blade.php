@extends('admin.layouts.app')
@section('title', $subTitle)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card"><div class="card-body">
        <p><strong>{{ __('dashboard.name') }}:</strong> {{ $model->name }}</p>
        <p><strong>{{ __('dashboard.email') }}:</strong> {{ $model->email }}</p>
        <p><strong>{{ __('dashboard.company_name') }}:</strong> {{ $model->company_name }}</p>
        <p><strong>{{ __('dashboard.phone') }}:</strong> {{ $model->phone }}</p>
        <p><strong>{{ __('dashboard.address') }}:</strong> {{ $model->address }}</p>
        <p><strong>{{ __('dashboard.postal_code') }}:</strong> {{ $model->postal_code }}</p>
        <p><strong>{{ __('dashboard.message') }}:</strong> {{ $model->message }}</p>
        <p><x-admin.status-badge :status="$model->status" /></p>
        @if($model->status->value === 0)
            <form action="{{ route('admin.informationRequests.markReplied', $model->id) }}" method="POST" class="d-inline">@csrf
                <button class="btn btn-success">{{ __('dashboard.mark_replied') }}</button>
            </form>
        @endif
        <a href="{{ $route }}" class="btn btn-outline-secondary">{{ __('dashboard.back') }}</a>
    </div></div>
</div>
@endsection
