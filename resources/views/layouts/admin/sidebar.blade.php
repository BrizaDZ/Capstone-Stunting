<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a asp-controller="Home" asp-action="Index" class="app-brand-link">
            <span class="app-brand-logo overflow-visible demo">
                <img src="/image/logo.png" alt="" width="35">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">StuntAIDS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @if (Auth::user()->role_id == '1')
            <li class='menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}'>
                <a href="/admin/dashboard" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-home"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                </a>
            </li>
        @endif
        @if (Auth::user()->role_id == '3')
            <li class='menu-item {{ Request::is('puskesmas/dashboard') ? 'active' : '' }}'>
                <a href="/puskesmas/dashboard" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-home"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                </a>
            </li>
        @endif
        <li class='menu-item {{ Request::is('data*') ? 'active open' : '' }}'>
            <a href='javascript:void(0);' class='menu-link menu-toggle'>
                <i class="menu-icon tf-icons ti ti-table"></i>
                <div data-i18n='Data'>Data</div>
            </a>
            <ul class='menu-sub'>
                @if (Auth::user()->role_id == '1')
                    <li class='menu-item {{ Request::is('data/puskesmas') ? ' active' : '' }}'>
                        <a href='/data/puskesmas' class='menu-link'>
                            <div data-i18n='Puskesmas'>Puskesmas</div>
                        </a>
                    </li>
                    <li class='menu-item {{ Request::is('data/user') ? ' active' : '' }}'>
                        <a href='/data/user' class='menu-link'>
                            <div data-i18n='Role User'>Role User</div>
                        </a>
                    </li>
                    <li class='menu-item {{ Request::is('data/artikel') ? ' active' : '' }}'>
                        <a href='/data/artikel' class='menu-link'>
                            <div data-i18n='Artikel'>Artikel</div>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == '3')
                    <li class='menu-item {{ Request::is('data/janji-temu') ? 'active' : '' }}'>
                        <a href="/data/janji-temu" class="menu-link">
                            <div data-i18n='Janji Temu'>Janji Temu</div>
                        </a>
                    </li>
                    <li class='menu-item {{ Request::is('data/stunting') ? 'active' : '' }}'>
                        <a href="/data/stunting" class="menu-link">
                            <div data-i18n='Stunting'>Stunting</div>
                        </a>
                    </li>
                    <li class='menu-item {{ Request::is('data/pasien') ? 'active' : '' }}'>
                        <a href="/data/pasien" class="menu-link">
                            <div data-i18n='Pasien'>Pasien</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <li class='menu-item {{ Request::is('master*') ? 'active open' : '' }}'>
            <a href='javascript:void(0);' class='menu-link menu-toggle'>
                <i class="menu-icon tf-icons ti ti-list"></i>

                <div data-i18n='Master'>Master</div>
            </a>
            <ul class='menu-sub'>
                @if (Auth::user()->role_id == '1')
                    <li class='menu-item {{ Request::is('master/relationship') ? ' active' : '' }}'>
                        <a href='/master/relationship' class='menu-link'>
                            <div data-i18n='Hubungan Pasien'>Hubungan Pasien</div>
                        </a>
                    </li>

                @endif
                @if (Auth::user()->role_id == '3')
                    <li class='menu-item {{ Request::is('master/operationaltime') ? ' active' : '' }}'>
                        <a href='/master/operationaltime' class='menu-link'>
                            <div data-i18n='Jadwal Kerja'>Jadwal Kerja</div>
                        </a>
                    </li>
                    <li class='menu-item {{ Request::is('master/doctor') ? ' active' : '' }}'>
                        <a href='/master/doctor' class='menu-link'>
                            <div data-i18n='Dokter'>Dokter</div>
                        </a>
                    </li>
                    <li class='menu-item {{ Request::is('master/doctoroperationaltime') ? ' active' : '' }}'>
                        <a href='/master/doctoroperationaltime' class='menu-link'>
                            <div data-i18n='Jadwal Dokter'>Jadwal Dokter</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</aside>
