@props(['items' => []])

@if(!empty($items))
    <nav class="mj-breadcrumb" aria-label="{{ __('website.breadcrumb_label') }}">
        <ol class="mj-breadcrumb__list">
            @foreach($items as $label => $url)
                @if(!$loop->first)
                    <li class="mj-breadcrumb__sep" aria-hidden="true">/</li>
                @endif
                <li @class(['mj-breadcrumb__item', 'is-current' => $loop->last])>
                    @if($loop->last)
                        <span aria-current="page">{{ $label }}</span>
                    @else
                        <a href="{{ $url }}">{{ $label }}</a>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
