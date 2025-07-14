<script src="/js/vendors.bundle.js"></script>
<script src="/js/app.bundle.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
<script>
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
        const currentPath = window.location.pathname;
        const currentHash = window.location.hash;

        const navLinks = document.querySelectorAll(".mobile-nav a");

        navLinks.forEach(link => link.classList.remove("active"));

        let foundActive = false;
        navLinks.forEach(link => {
            const url = new URL(link.href);
            const linkPath = url.pathname;
            const linkHash = url.hash;

            if (currentHash && currentHash === linkHash && currentPath === linkPath) {
                link.classList.add("active");
                foundActive = true;
            }
        });

        if (!foundActive) {
            navLinks.forEach(link => {
                const url = new URL(link.href);
                if (!url.hash && url.pathname === currentPath) {
                    link.classList.add("active");
                }
            });
        }
    });

</script>

@stack('script')
