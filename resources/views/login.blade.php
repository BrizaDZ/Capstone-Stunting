<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | StuntAIDS</title>

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" type="/image/png" sizes="32x32" href="/image/logo.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:wght@500&display=swap" rel="stylesheet">

</head>
<body>
    <section class="bg-image" style="min-height: 100vh;">
    <div class="px-5">
        <div class="row align-items-center vh-100">
            <div class="col-12 col-md-6 order-2 order-md-1 d-flex justify-content-center align-items-center">
                <div class="w-100" style="max-width: 500px;">
                    <h2 class="mb-4 text-center fw-bold text-primary">Login</h2>

                    @if (session('status'))
                        <div class="alert alert-success mt-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            @foreach ($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-container mb-3">
                            <input type="email" id="email" placeholder=" " name="email" required class="form-control">
                            <label for="email">Email Address</label>
                        </div>
                        <div class="input-container mb-3">
                            <input type="password" id="password" placeholder=" " name="password" required class="form-control">
                            <label for="password">Password</label>
                        </div>
                        <button type="submit" class="py-3 border-0 btn btn-primary w-100 fs-6 rounded-3">Sign In</button>

                        <div class="text-center mt-3">
                            <a class="text-decoration-none" href="/forgot-password">Lupa Password?</a>
                        </div>
                    </form>

                    <p class="mt-3 text-center">Belum punya akun?
                        <a href="/register" class="text-primary text-decoration-none">Sign Up</a>
                    </p>
                </div>
            </div>

            <!-- Icon & Title -->
            <div class="col-12 col-md-6 order-1 order-md-2 text-center text-md-end mb-0  mb-md-0">
                <h1 class="mt-4 mb-3 fs-1 fw-medium me-md-4">Stunt<span class="text-primary">AIDS</span></h1>
                <p class="fs-5 lh-base me-md-4 text-body-secondary">
                    Welcome to StuntAIDS!<br>
                    where we make a healthy future.
                </p>
                <img src="/image/icon/icon2.svg" alt="Medical Report" class="img-fluid w-75 mt-3">
            </div>
        </div>
    </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
