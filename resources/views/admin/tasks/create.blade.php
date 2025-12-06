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
                    <h5 class="card-title">{{ __('admin.create') }} {{ __('admin.task') }}</h5>

                    <form action="{{ $storeRoute }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.layouts.partials.alerts')

                        <div class="row">
                            @foreach (languages() as $lang)
                                <div class="mb-3 col-md-12">
                                    <label for="title_{{ $lang }}" class="form-label">
                                        {{ __("admin.title_$lang") }}
                                    </label>
                                    <input type="text" class="form-control" id="title_{{ $lang }}"
                                        name="title[{{ $lang }}]" placeholder="{{ __("admin.title_$lang") }}"
                                        required autofocus value="{{ old("title.$lang") }}">
                                    @error("title.$lang")
                                        @foreach ($errors->get("title.$lang") as $error)
                                            <div class="text-danger">{{ $error }}</div>
                                        @endforeach
                                    @enderror
                                </div>
                            @endforeach

                            {{-- Client --}}
                            <div class="mb-3 col-md-6">
                                <label for="client_id" class="form-label">{{ __('admin.client') }}</label>
                                <select class="form-select" id="client_id" name="client_id">
                                    <option value="">{{ __('admin.select') }}</option>
                                    @foreach ($clients ?? [] as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('client_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Project --}}
                            <div class="mb-3 col-md-6">
                                <label for="project_id" class="form-label">{{ __('admin.project') }}</label>
                                <select class="form-select" id="project_id" name="project_id" required disabled>
                                    <option value="" disabled selected>{{ __('admin.select_client_first') }}</option>
                                </select>
                                @error('project_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Parent Task --}}
                            <div class="mb-3 col-md-6">
                                <label for="parent_id" class="form-label">{{ __('admin.parent_task') }}</label>
                                <select class="form-select" id="parent_id" name="parent_id">
                                    <option value="" {{ old('parent_id') ? '' : 'selected' }}>
                                        {{ __('admin.select') }}
                                    </option>
                                    @foreach ($tasks ?? [] as $id => $taskTitle)
                                        <option value="{{ $id }}"
                                            {{ old('parent_id') == $id ? 'selected' : '' }}>
                                            {{ $taskTitle }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Assignee --}}
                            <div class="mb-3 col-md-6">
                                <label for="assignee_id" class="form-label">{{ __('admin.assignee') }}</label>
                                <select class="form-select" id="assignee_id" name="assignee_id">
                                    <option value="" {{ old('assignee_id') ? '' : 'selected' }}>
                                        {{ __('admin.select') }}
                                    </option>
                                    @foreach ($leaders ?? [] as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('assignee_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('assignee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Reporter --}}
                            <div class="mb-3 col-md-6">
                                <label for="reporter_id" class="form-label">{{ __('admin.reporter') }}</label>
                                <select class="form-select" id="reporter_id" name="reporter_id">
                                    <option value="" {{ old('reporter_id') ? '' : 'selected' }}>
                                        {{ __('admin.select') }}
                                    </option>
                                    @foreach ($users ?? [] as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('reporter_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('reporter_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">{{ __('admin.status') }}</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>
                                        {{ __('admin.select') }}
                                    </option>
                                    @foreach (\App\Enums\TaskStatusTypeEnum::cases() as $status)
                                        <option value="{{ $status->value }}"
                                            {{ old('status') == $status->value ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Priority --}}
                            <div class="mb-3 col-md-6">
                                <label for="priority" class="form-label">{{ __('admin.priority') }}</label>
                                <select class="form-select" id="priority" name="priority" required>
                                    <option value="" disabled {{ old('priority') ? '' : 'selected' }}>
                                        {{ __('admin.select') }}
                                    </option>
                                    @foreach (\App\Enums\PriorityTypeEnum::cases() as $priority)
                                        <option value="{{ $priority->value }}"
                                            {{ old('priority') == $priority->value ? 'selected' : '' }}>
                                            {{ $priority->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('priority')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Start Date --}}
                            <div class="mb-3 col-md-6">
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
                            <div class="mb-3 col-md-6">
                                <label for="due_date" class="form-label">{{ __('admin.due_date') }}</label>
                                <input type="date" class="form-control" id="due_date" name="due_date"
                                    value="{{ old('due_date') }}">
                                @error('due_date')
                                    @foreach ($errors->get('due_date') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @enderror
                            </div>

                            {{-- Estimated Hours --}}
                            <div class="mb-3 col-md-6">
                                <label for="estimated_hours" class="form-label">{{ __('admin.estimated_hours') }}</label>
                                <input type="number" step="0.1" class="form-control" id="estimated_hours"
                                    name="estimated_hours" value="{{ old('estimated_hours') }}" placeholder="0.0">
                                @error('estimated_hours')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @foreach (languages() as $lang)
                                <div class="mb-3 col-md-12">
                                    <label for="description_{{ $lang }}" class="form-label">
                                        {{ __("admin.description_$lang") }}
                                    </label>
                                    <textarea class="form-control" id="description_{{ $lang }}" name="description[{{ $lang }}]"
                                        rows="4" placeholder="{{ __("admin.description_$lang") }}">{{ old("description.$lang") }}</textarea>
                                    @error("description.$lang")
                                        @foreach ($errors->get("description.$lang") as $error)
                                            <div class="text-danger">{{ $error }}</div>
                                        @endforeach
                                    @enderror
                                </div>
                            @endforeach
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
        $(document).ready(function() {
            $('#client_id').on('change', function() {
                var clientId      = $(this).val();
                var projectSelect = $('#project_id');

                projectSelect.empty().append('<option value="" disabled selected>{{ __("admin.select") }}</option>');

                if (clientId) {
                    projectSelect.prop('disabled', true);
                    projectSelect.append('<option value="" disabled>{{ __("admin.loading") }}...</option>');

                    // AJAX Request
                    $.ajax({
                        url: "{{ route('admin.clients.projects', ':id') }}".replace(':id', clientId),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            projectSelect.find('option:contains("{{ __("admin.loading") }}")').remove();

                            if (data.length > 0) {
                                projectSelect.prop('disabled', false);
                                console.log(data);
                                $.each(data, function(key, project) {

                                    projectSelect.append('<option value="' + project.id + '">' + project.name + '</option>');
                                });
                            } else {
                                projectSelect.append('<option value="" disabled>{{ __("admin.no_projects_found") }}</option>');
                            }
                        },
                        error: function() {
                            console.error('Error fetching projects');
                            projectSelect.prop('disabled', true);
                        }
                    });
                } else {
                    // If no client selected, disable project select
                    projectSelect.prop('disabled', true);
                    projectSelect.html('<option value="" disabled selected>{{ __("admin.select_client_first") }}</option>');
                }
            });

            var oldClientId = "{{ old('client_id') }}";
            var oldProjectId = "{{ old('project_id') }}";

            if (oldClientId) {
                $('#client_id').trigger('change');

                $(document).ajaxStop(function() {
                    if(oldProjectId) {
                        $('#project_id').val(oldProjectId);
                    }
                });
            }
        });

        const startDate = document.getElementById('start_date');
        const dueDate = document.getElementById('due_date');

        if (startDate && dueDate) {
            startDate.addEventListener('change', function() {
                if (startDate.value) {
                    dueDate.min = startDate.value;
                    if (dueDate.value && dueDate.value < startDate.value) {
                        dueDate.value = startDate.value;
                    }
                } else {
                    dueDate.removeAttribute('min');
                }
            });
        }
    </script>
@endsection
