<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskesmas Cibatu - Login</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/login.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:wght@500&display=swap" rel="stylesheet">

    <style>
        .container{
            min-width: 1600px !important;
        }
    </style>
</head>
<body>
    <section style="min-height: 100vh" class="bg-image">
        <div class="container">
            <div class="row align-items-center vh-100">
                <div class="col-md-5">
                    <div class="p-4 w-100 ms-3">
                        <h2 class="mb-4 text-center fw-bold text-primary">Login</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-container">
                                <input type="email" id="email" placeholder=" " name="email" required>
                                <label for="email">Email Address</label>
                                <span :messages="$errors->get('email')" class="mt-2"></span>
                            </div>
                            <div class="input-container">
                                <input type="password" id="password" placeholder=" " name="password" required>
                                <label for="password">Password</label>
                                <span :messages="$errors->get('password')" class="mt-2"> </span>
                            </div>
                            <button type="submit" class="py-3 border-0 btn btn-primary w-100 fs-6 rounded-3" href="../homepage/homepage.html">Sign In</button>
                        </form>
                        <p class="mt-3 black">Don't have an account? <a href="../SignUp/signup.html" class="bs-primary text-decoration-none">Sign Up</a></p>
                    </div>
                </div>
                <div class="col-md-1"></div>

                <!-- Icon and StuntAID Title on the Right -->
                <div class="col-md-6 d-flex justify-content-end align-items-right">
                    <div class="text-center">
                        <h1 class="mt-5 mb-3 fs-1 fw-medium text-end me-4 custom-heading">Stunt<span class="text-primary">AID</span></h1>
                        <p class="fs-3 lh-base text-end me-4 text-body-secondary">Welcome to StuntAID!<br>where we make a healthy future.</p>
                        <img src="/image/icon/icon2.svg" alt="Medical Report" width="550" class="mx-auto mt-3 img-fluid w-90">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
