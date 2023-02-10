<li class="list-group-item"><a href="{{ route($route) }}"
        class="text-secondary {{ Route::currentRouteName() === $route ? 'font-weight-bold' : null }}">{{ $slot }}
    </a>
</li>
