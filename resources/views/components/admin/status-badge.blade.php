@props(['status'])

@if ($status instanceof \App\Enums\GeneralStatusEnum || $status instanceof \App\Enums\MessageStatusEnum)
    <span class="badge bg-label-{{ $status->color() }} dash-status-badge">{{ $status->label() }}</span>
@endif
