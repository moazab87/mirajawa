@php
    $filters = [
        'one'   => 1,
        'two'   => 2,
        'three' => 3,
        'four'  => 4,
        'five'  => 5,
    ];
@endphp

@foreach ($filters as $id => $stars)
    <div class="form-check collection-filter-checkbox">
        <input type="checkbox" class="form-check-input" id="{{ $id }}" value="{{ $stars }}" />
        <label class="form-check-label" for="{{ $id }}">
            @for ($i = 0; $i < $stars; $i++)
                <i class="fa fa-star" style="color: #ff9944; font-size: 1.3rem"></i>
            @endfor
        </label>
    </div>
@endforeach
