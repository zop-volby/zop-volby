@props(['active'])

<li class="nav-item">
    <a class="nav-link" {{ $attributes->merge() }}>
        {{ $slot }}
    </a>
</li>
