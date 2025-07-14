<nav class="container-xl p-3 bg-transparent navbar sticky-top navbar-expand-lg fs-5 mt-3 rounded-3">
    <div class="container-fluid">
        <a class="navbar-brand text-dark fw-bold" href="#"><img src="/image/logo.png" alt="Logo" width="38" height="38" class="me-3">Stunt<span class="fw-bold text-primary">AIDS</span> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="py-3w collapse navbar-collapse" style="justify-content: right" id="navbarNavDropdown">
            <ul class="navbar-nav" style="gap: 3em">
            <li class="nav-item">
                <a class="nav-link active font-shadow fs-6 text-secondary" aria-current="page" href="/">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-shadow fs-6 text-secondary" href="/#puskesmas">Puskesmas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link font-shadow fs-6 text-secondary" href="/janji-temu">Janji Temu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-shadow fs-6 text-secondary" href="/profile/patient">Profile</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="px-3 border-0 nav-link btn btn-primary bg-primary text-light" href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">Logout</a>
                </form>

            </li>
            </ul>
        </div>
    </div>
</nav>

<div class="mobile-nav border-0">
    <a href="/" class="active">
        <i class="bi bi-house-fill fs-4"></i>
        <span>Beranda</span>
    </a>
    <a href="/#puskesmas">
        <i class="bi bi-hospital fs-4"></i>
        <span>Puskesmas</span>
    </a>
    <a href="/janji-temu">
        <i class="bi bi-calendar-check fs-4"></i>
        <span>Janji</span>
    </a>
    <a href="/profile/patient">
        <i class="bi bi-person-circle fs-4"></i>
        <span>Profile</span>
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="bi bi-box-arrow-right fs-4"></i>
            <span>Logout</span>
        </a>
    </form>
</div>





