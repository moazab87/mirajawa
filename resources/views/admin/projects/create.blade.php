@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.add')],
        ]" />

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __("admin.Information_$singleName") }}</h5>

                    <form action="{{ $storeRoute }}" method="POST">
                        @csrf
                        @include('admin.layouts.partials.alerts')

                        <div class="row">

                            {{-- Name --}}
                            <div class="mb-3 col-md-4">
                                <label for="name" class="form-label">{{ __('admin.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('admin.name') }}" required value="{{ old('name') }}">
                                @error('name')
                                    @foreach ($errors->get('name') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            {{-- Team --}}
                            <div class="mb-3 col-md-4">
                                <label for="team_id" class="form-label">{{ __('admin.team') }}</label>
                                <select class="form-select" id="team_id" name="team_id" required>
                                    <option value="" disabled {{ old('team_id') ? '' : 'selected' }}>
                                        {{ __('admin.select') }}
                                    </option>
                                    @foreach ($teams ?? [] as $key => $team)
                                        <option value="{{ $key}}"
                                            {{ old('team_id') == $key? 'selected' : '' }}>
                                            {{ $team}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('team_id')
                                    @foreach ($errors->get('team_id') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>
                            {{-- clients --}}
                            <div class="mb-3 col-md-4">
                                <label for="client_id" class="form-label">{{ __('admin.client') }}</label>
                                <select class="form-select" id="client_id" name="client_id" required>
                                    <option value="" disabled {{ old('client_id') ? '' : 'selected' }}>
                                        {{ __('admin.select') }}
                                    </option>
                                    @foreach ($clients ?? [] as $key => $client)
                                        <option value="{{ $key}}"
                                            {{ old('client_id') == $key? 'selected' : '' }}>
                                            {{ $client}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    @foreach ($errors->get('client_id') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">{{ __('admin.status') }}</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>
                                        {{ __('admin.select') }}
                                    </option>
                                    @foreach (\App\Enums\StatusModelsEnum::cases() as $status)
                                        <option value="{{ $status->value }}"
                                            {{ old('status') == $status->value ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    @foreach ($errors->get('status') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            {{-- Start Date --}}
                            <div class="mb-3 col-md-3">
                                <label for="start_date" class="form-label">{{ __('admin.start_date') }}</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    @foreach ($errors->get('start_date') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            {{-- End Date --}}
                            <div class="mb-3 col-md-3">
                                <label for="end_date" class="form-label">{{ __('admin.end_date') }}</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ old('end_date') }}">
                                @error('end_date')
                                    @foreach ($errors->get('end_date') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">{{ __('admin.description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="{{ __('admin.description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    @foreach ($errors->get('description') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('admin.add') }}</button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">
                                {{ __('admin.back') }}
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // اجعل تاريخ النهاية لا يقل عن تاريخ البداية
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        if (startDate && endDate) {
            startDate.addEventListener('change', function() {
                if (startDate.value) {
                    endDate.min = startDate.value;
                    if (endDate.value && endDate.value < startDate.value) {
                        endDate.value = startDate.value;
                    }
                } else {
                    endDate.removeAttribute('min');
                }
            });
        }
    </script>
@endsection
