@php
    $user = Auth::user();
@endphp

<div class="main-menu menu-fixed menu-dark menu-bg-default rounded menu-accordion menu-shadow" style="width:200px;">
    <div class="main-menu-content">
        <a class="navigation-brand d-none d-md-block d-lg-block d-xl-block" href="{{ route('home') }}">
            <img class="brand-logo" style="width:150px; height:120px;" src="{{ url('/images/laravel.png') }}" />
        </a>

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if($user->roles_id === 2)
                <li class="nav-item">
                    <a href="{{ route('taskxUser') }}">
                        <span class="menu-title">MIS TAREAS</span>
                    </a>
                </li>
            @elseif($user->roles_id === 1)
                <li>
                    <a class="nav-item" href="{{ route('tareas') }}">TAREAS</a>
                </li>
            @endif
            @if($user->roles_id === 1)
                <li class="nav-item">
                    <a href="{{ route('user') }}">
                        <span class="menu-title">USUARIOS</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>


<style>
    .main-menu .menu-title {
        display: inline !important;
        opacity: 1 !important;
        visibility: visible !important;
        color: #fff !important;
        font-size: 20px !important;
    }

    .main-menu .nav-item {
        overflow: visible !important;
        color: #fff !important;
        font-size: 20px !important;
    }
</style>