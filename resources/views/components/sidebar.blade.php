<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">Sipasti</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Belanja Modal</li>
            <li class="{{ str_contains(Route::currentRouteName(), 'modal') ? 'active' : '' }}">
                <a href="{{ route('modal.index') }}"><i class="fa-solid fa-money-bill-transfer"></i>
                    <span>GU</span></a>
            </li>
            <li class="{{ str_contains(Route::currentRouteName(), 'ls') ? 'active' : '' }}">
                <a href="{{ route('ls.index') }}"><i class="fa-solid fa-truck-fast"></i>
                    <span>LS</span></a>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="{{ str_contains(Route::currentRouteName(), 'kib') ? 'active' : '' }}">
                <a href="{{ route('kib.index') }}"><i class="fa-solid fa-screwdriver-wrench"></i>
                    <span>KIB</span></a>
            </li>
        </ul>

    </aside>
</div>
