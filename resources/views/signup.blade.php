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
    <section class="bg-image align-content-center" style="min-height: 100vh">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="text-start">
                        <h1 class="mt-5 mb-3 fs-1 fw-medium me-4 custom-heading">Stunt<span class="text-primary">AID</span></h1>
                        <p class="fs-3 lh-base me-4 text-body-secondary">Welcome to StuntAID!<br>where we make a healthy future.</p>
                        <img src="/image/icon/icon1.svg" alt="Medical Report" width="550" class="img-fluid img-icon">
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5 ">
                    <div class="p-4">
                        <h2 class="mb-4 text-center fw-bold text-primary">Register</h2>
                        @if (session('status'))
                            <div class="alert alert-success mt-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="input-container">
                                <input type="text" id="full-name" placeholder=" " name="name" required>
                                <label for="full-name">Full Name</label>
                            </div>
                            <div class="input-container">
                                <input type="email" id="email" name="email" placeholder=" " required>
                                <label for="email">Email Address</label>
                            </div>
                            <div class="input-container">
                                <input type="text" id="birthplace" name="birthplace" placeholder=" " required>
                                <label for="birthplace">Place of Birth</label>
                            </div>
                            <div class="input-container">
                                <input type="date" id="dob" name="dob" required>
                                <label for="birthdate">Date of Birth</label>
                            </div>
                            <div class="input-container">
                                <input type="tel" id="telp" name="telp" placeholder=" " required>
                                <label for="phone">Telephone Number</label>
                            </div>
                            <div class="input-container">
                                <input type="password" id="password" name="password" placeholder=" " required>
                                <label for="password">Password</label>
                            </div>

                            <div class="input-container">
                                <input id="password_confirmation" type="password" name="password_confirmation" placeholder=" " required>
                                <label for="password_confirmation">Confirm Password</label>
                            </div>


                            <button type="submit" class="py-3 border-0 btn btn-primary w-100 fs-6 rounded-3">Sign Up</button>
                        </form>
                        <p class="mt-3">Already have an account? <a href="/login" class="text-primary">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
