<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Puskesmas Cibatu</title>

    <link href="/css/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">

    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<section style="min-height: 100vh" class="bg-image d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-body pb-0 p-4">
                        <h2 class="mb-4 text-center text-primary fw-bold">Verifikasi Email</h2>

                    <p class="text-muted mb-4" style="text-align: justify;">
                        Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi email kamu dengan mengklik link yang telah kami kirimkan ke email kamu.
                        Jika kamu belum menerima emailnya, kami akan dengan senang hati mengirim ulang.
                    </p>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success">
                            Link verifikasi baru telah dikirim ke email yang kamu daftarkan.
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mt-5 mb-4">
                        <form method="POST" action="{{ route('verification.send') }}" id="resend-form">
                            @csrf
                            <button type="submit" class="btn btn-primary" id="resend-btn">
                                Kirim Ulang Email Verifikasi
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                Keluar
                            </button>
                        </form>
                    </div>

                    <div class="text-center mt-3 mb-3">
                        <small class="text-muted mb-0">Pastikan email kamu benar dan aktif.</small>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@if (session('status') == 'verification-link-sent')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const resendBtn = document.getElementById('resend-btn');
        let seconds = 60;
        const originalText = 'Kirim Ulang Email Verifikasi';

        resendBtn.disabled = true;

        const countdown = setInterval(() => {
            resendBtn.innerText = `Tunggu ${seconds--} detik, kirim ulang email verifikasi`;
            if (seconds < 0) {
                clearInterval(countdown);
                resendBtn.innerText = originalText;
                resendBtn.disabled = false;
            }
        }, 1000);
    });
</script>
@endif


</body>
</html>
