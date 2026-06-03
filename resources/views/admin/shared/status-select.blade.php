@php
    use App\Enums\GeneralStatusEnum;
@endphp
<div class="mb-3 col-md-6">
    <label class="form-label" for="status">{{ __('dashboard.status') }}</label>
    <select name="status" id="status" class="form-select" required>
        @foreach (GeneralStatusEnum::cases() as $statusCase)
            <option value="{{ $statusCase->value }}"
                {{ (string) old('status', isset($model) && $model->status ? $model->status->value : GeneralStatusEnum::ACTIVE->value) === (string) $statusCase->value ? 'selected' : '' }}>
                {{ $statusCase->label() }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
