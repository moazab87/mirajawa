@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => '#', 'text' => $title],
        ]" />

        <x-admin.table :headers="['#', __('admin.media'), __('admin.status'), __('admin.actions')]" :createRoute="$createRoute" :title="$title" :buttonText="__('admin.add')"
            :search="true" :indexRoute="$route">

            @forelse($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @php
                            $image = $model->attachments->filter(function($att) {
                                return str_starts_with($att->mime, 'image/');
                            })->first();
                            $video = $model->attachments->filter(function($att) {
                                return str_starts_with($att->mime, 'video/');
                            })->first();
                        @endphp
                        @if($image)
                            <img src="{{ asset('storage/attachments/sliders/' . $image->file_name) }}" 
                                 alt="Slider" 
                                 class="img-thumbnail" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        @elseif($video)
                            <div class="text-center">
                                <i class="bx bx-video text-primary" style="font-size: 2rem;"></i>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $model->is_active ? 'success' : 'secondary' }}">
                            {{ $model->is_active ? __('admin.active') : __('admin.inactive') }}
                        </span>
                    </td>
                    <td>
                        <x-admin.buttons :editRoute="route($editRoute, $model->id)" :deleteRoute="route($deleteRoute, $model->id)" :showRoute="route($showRoute, $model->id)" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-folder-open text-secondary mb-2" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">{{ __('admin.no_data_available') ?? 'No data available' }}</h5>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-admin.table>
    </div>
    @if ($models->count() > 0 && $models instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="d-flex justify-content-center my-2">
            {{ $models->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
@endsection

@section('script')

@endsection

