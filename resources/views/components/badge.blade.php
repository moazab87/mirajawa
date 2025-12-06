@props(['color' => 'primary'])

<span {{ $attributes->class("badge bg-label-$color") }}>
    {{ $slot }}
</span>
