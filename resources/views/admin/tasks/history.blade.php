@php
    use App\Enums\ChangeTypeEnum;
@endphp

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">{{ __('admin.stock_history') }}</h5>
        @if ($model->histories->count())
            <span class="text-muted small">
                {{ __('admin.total_rows') }}: {{ $model->histories->count() }}
            </span>
        @endif
    </div>
    <div class="card-body p-0">
        @forelse($model->histories->sortByDesc('created_at') as $history)
            @php
                $diff = (int) $history->new_stock - (int) $history->last_stock;
                $isUp = $diff > 0;
                $isDown = $diff < 0;
            @endphp

            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <div class="d-flex align-items-center gap-2">
                                <span
                                    class="badge rounded-pill {{ $isUp ? 'bg-success' : ($isDown ? 'bg-danger' : 'bg-secondary') }}">
                                    @if ($isUp)
                                        <i class="bx bx-up-arrow-alt"></i>
                                    @elseif($isDown)
                                        <i class="bx bx-down-arrow-alt"></i>
                                    @else
                                        <i class="bx bx-minus"></i>
                                    @endif
                                    {{ $diff }}
                                </span>
                                <div class="text-muted small">
                                    {{ $history->created_at?->format('Y-m-d H:i') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <strong>{{ __('admin.last_stock') }}:</strong>
                                    <span class="font-monospace">{{ $history->last_stock }}</span>
                                </div>
                                <div>
                                    <strong>{{ __('admin.new_stock') }}:</strong>
                                    <span class="font-monospace">{{ $history->new_stock }}</span>
                                </div>
                                <div>
                                    <strong>{{ __('admin.change') }}:</strong>
                                    <span class="font-monospace">
                                        {{ $isUp ? '+' : '' }}{{ $diff }}
                                    </span>
                                </div>

                                <div>
                                    <strong>{{ __('admin.change_type') }}:</strong>
                                    <span class="font-monospace">
                                        @if($history->change_type)
                                            {{ ChangeTypeEnum::getText($history->change_type) }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 text-md-end">
                            <span class="text-muted small">
                                <i class="bx bx-user-circle me-1"></i>
                                {{ optional($history->changer)->name ?? __('admin.system') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-muted">
                <i class="bx bx-time-five d-block mb-2" style="font-size: 2rem;"></i>
                {{ __('admin.no_history_found') }}
            </div>
        @endforelse
    </div>
</div>
