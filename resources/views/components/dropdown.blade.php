@props(['link' => '#', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700'])

<li class="dropdown dropdown-user nav-item">
    <a class="dropdown-toggle nav-link dropdown-user-link" href="{{ $link }}" data-toggle="dropdown">
        <span class="avatar avatar-online">
            <img src="{{ url('/images/user.png') }}">
        </span>
        <span class="mr-1">
            <span class="user-name text-bold-700"></span>
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        {{ $slot }}
    </div>
</li>
