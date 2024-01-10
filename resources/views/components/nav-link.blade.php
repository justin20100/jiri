@props(['active'])

@php
$classes = ($active ?? false)
            ? 'navigation__contentContainer__top__links__item navigation__contentContainer__top__links__item--active'
            : 'navigation__contentContainer__top__links__item';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
