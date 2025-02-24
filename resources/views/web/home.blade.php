@extends('layouts.web.layout')
@push('style')

@endpush

@section('content')
<section class="full-screen" style="background-image: url(image/bg-home.png); background-position: center; background-size: cover;">
    <div class="container-xl align-content-center">
        <div class="row">
            <div class="col-md-5">
                <h3 class="text-secondary">
                    Support Every Step of Growth with
                </h3>
                <h1 class="fw-bold">Stunt<span class="text-primary">AIDS</span></h1>
                <p class="mt-4">Connect instantly with a 24x7 specialist or choose to video visit a particular doctor.</p>
                <a href="" class="mt-4 border-0 btn btn-primary fw-bold">Consult Now</a>
            </div>
            <div class="col-md-7"></div>
        </div>
    </div>
</section>
<section class="" style="margin-top: -9em; min-height: 30vh;">
    <div class="container-xl align-content-center">
        <div class="border-0 shadow card rounded-3">
            <div class="card-body">
                <h4 class="mt-4 mb-3 text-center text-secondary fw-bold">You may be looking for</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center border-0 card">
                            <div class="mt-3 mb-4 card-body">
                                <img src="/image/icon/Doctor.png" width="70">
                                <div class="mt-3 mb-0 card-title fs-5 text-muted">Doctors</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center border-0 card">
                            <div class="mt-3 card-body">
                                <img src="/image/icon/chat.png" width="70">
                                <div class="mt-3 mb-0 card-title fs-5 text-muted">Chatbot</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center border-0 card">
                            <div class="mt-3 card-body">
                                <img src="/image/icon/Hospital.png" width="70">
                                <div class="mt-3 mb-0 card-title fs-5 text-muted">Stunting Detector</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center border-0 card">
                            <div class="mt-3 card-body">
                                <img src="/image/icon/Capsule.png" width="70">
                                <h5 class="mt-3 mb-0 card-title fs-5 text-muted">Nutrition Calculator</h5>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="full-screen">
    <div class="container-xl">
        <p class="text-center text-primary fs-5 fw-bold">Blog & News</p>
        <h1 class="text-center text-secondary fw-bold">Stunting News</h1>
        <div class="mt-5 card-group " style="gap: 3em">
            <div class="card rounded-3">
              <img src="/image/card-img.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Stunting</h5>
                <p class="card-text">6 Tips To Protect Your Mental Health When You’re Sick</p>
                <p class="card-text"><small class="text-muted">Puskesmas Cikarang</small></p>
              </div>
            </div>
            <div class="card rounded-3">
              <img src="/image/card-img.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Stunting</h5>
                <p class="card-text">6 Tips To Protect Your Mental Health When You’re Sick</p>
                <p class="card-text"><small class="text-muted">Puskesmas Cikarang</small></p>
              </div>
            </div>
            <div class="card rounded-3">
              <img src="/image/card-img.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Stunting</h5>
                <p class="card-text">6 Tips To Protect Your Mental Health When You’re Sick</p>
                <p class="card-text"><small class="text-muted">Puskesmas Cikarang</small></p>
              </div>
            </div>
          </div>

    </div>

</section>

<div class="container-xl" style="background-color: #E8F1FF;">
    <div class="container py-5">
        <!-- StuntAIDS Section -->
        <div class="row justify-content-center align-items-center" style="min-height: 400px;">
            <!-- Left: Images -->
            <div class="col-md-5 d-flex justify-content-center">
                <div class="position-relative">
                    <!-- Main Image (Top Layer) -->
                    <img src="https://i.pinimg.com/736x/79/59/a4/7959a41bd0ab57637b3f4f6a03f9825d.jpg"
                         class="border border-white rounded shadow-lg border-5 position-relative d-block img-fluid"
                         style="width: 60%; bottom: 90px; left: 200px; z-index: 1;"
                         alt="Doctor 1">

                    <!-- Secondary Image (Bottom Layer, Shifted Left) -->
                    <img src="https://i.pinimg.com/736x/b6/3e/66/b63e663bc277a3b62c4d7d576af65ec8.jpg"
                         class="border border-white rounded shadow-lg border-5 position-absolute d-block img-fluid"
                         style="width: 60%; top: 80px; left: 80px; z-index: 2;"
                         alt="Doctor 2">

                    <!-- Consultation Badge (Bottom Left) -->
                    <a href="#link_nomor_WhatsApp">
                        <div class="bottom-0 gap-3 p-3 bg-white rounded shadow-sm position-absolute start-0 d-flex align-items-center"
                             style="z-index: 3; transform: translate(-30px, 70px);">
                            <i class="bi bi-chat-left-text text-primary fs-5"></i>
                            <div>
                                <strong class="text-dark">Free Consultation</strong><br>
                                <small class="text-muted">Consultation with the best</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Right: Text Content -->
            <div class="px-5 text-center col-md-6 ms-md-5 text-md-start">
                <p class="mb-3 text-uppercase text-primary fw-bold small">Helping Stunting Patients from Around the Globe!!</p>
                <h2 class="mb-4 fw-bold">Stunt<span class="text-primary">AIDS</span></h2>
                <p class="mb-3 text-muted lh-lg">
                    We strive to combat stunted growth by providing families and
                    healthcare professionals with essential resources, expert guidance,
                    and innovative tools to support healthier futures for children.
                </p>
                <ul class="gap-3 list-unstyled">
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-primary fs-5 me-2"></i>
                        <span>Stay Updated About Your Health</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-primary fs-5 me-2"></i>
                        <span>Check Your Results Online</span>
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-primary fs-5 me-2"></i>
                        <span>Manage Your Appointments</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Our Medical Specialist Section -->
<div class="container-xl py-5 text-center">
    <h3 class="fw-bold">Our Medical Specialist</h3>

    <div id="specialistCarousel" class="mt-4 carousel slide" data-bs-ride="carousel" data-bs-wrap="true">
        <div class="mb-0 carousel-indicators">
            <button type="button" data-bs-target="#specialistCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" style="background-color: #333;"></button>
            <button type="button" data-bs-target="#specialistCarousel" data-bs-slide-to="1" aria-label="Slide 2" style="background-color: #333;"></button>
        </div>
        <!-- Carousel Wrapper -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="https://i.pinimg.com/736x/4a/b0/ce/4ab0ceaad47b4219304029437f4424f2.jpg"
                                class="p-2 border rounded-circle bg-light img-fluid"
                                style="width: 250px; height: 325px; object-fit: cover;"
                                alt="Doctor 1">
                            <h5 class="mt-2">Dr. Zayne</h5>
                            <p class="text-primary">Neurologist</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="https://i.pinimg.com/736x/c9/e0/b5/c9e0b5e45aad1de8e27b25ec6ce3cd27.jpg"
                                class="p-2 border rounded-circle bg-light img-fluid"
                                style="width: 250px; height: 325px; object-fit: cover;"
                                alt="Doctor 2">
                            <h5 class="mt-2">Dr. Katherine</h5>
                            <p class="text-primary">Orthopedics</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="https://i.pinimg.com/736x/7d/6c/37/7d6c37451113490accea2dca24dc442d.jpg"
                                class="p-2 border rounded-circle bg-light img-fluid"
                                style="width: 250px; height: 325px; object-fit: cover;"
                                alt="Doctor 3">
                            <h5 class="mt-2">Dr. Paul</h5>
                            <p class="text-primary">Medicine</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="https://i.pinimg.com/736x/c8/c9/c6/c8c9c608585eee53dfcbbbb468dea896.jpg"
                                class="p-2 border rounded-circle bg-light img-fluid"
                                style="width: 250px; height: 325px; object-fit: cover;"
                                alt="Doctor 4">
                            <h5 class="mt-2">Dr. Savitree</h5>
                            <p class="text-primary">Cardiologist</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="https://i.pinimg.com/736x/11/19/b9/1119b9f8c78e2c8a90a2ad9d389804b8.jpg"
                                class="p-2 border rounded-circle bg-light img-fluid"
                                style="width: 250px; height: 325px; object-fit: cover;"
                                alt="Doctor 5">
                            <h5 class="mt-2">Dr. Saint</h5>
                            <p class="text-primary">Pediatrics</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <img src="https://i.pinimg.com/736x/f5/cf/89/f5cf89ffc4ef31f7cedba3fcdc9f79c1.jpg"
                                class="p-2 border rounded-circle bg-light img-fluid"
                                style="width: 250px; height: 325px; object-fit: cover;"
                                alt="Doctor 6">
                            <h5 class="mt-2">Dr. Luna</h5>
                            <p class="text-primary">Dermatologist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#specialistCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#specialistCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
        </button>
    </div>
</div>

<!-- JavaScript for Auto-scroll -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let carousel = document.querySelector("#specialistCarousel");
        new bootstrap.Carousel(carousel, {
            interval: 2000, // Auto-slide every 2 seconds
            wrap: true // Infinite loop
        });
    });
</script>


<!-- Nearest Puskesmas Section -->
<div class="container-fluid" style="background-color: #E8F1FF;">
    <div class="container py-5 text-center">
        <h3 class="fw-bold">Nearest Puskesmas</h3>
        <p class="text-end">
            <a href="https://www.google.com/maps/search/puskesmas+terdekat" target="_blank"
                class="text-decoration-none fw-semibold text-muted link-hover">
                Show on Map >>
            </a>
        </p>
        <div class="d-flex justify-content-center">
            <div class="shadow-lg ratio ratio-16x9 w-100 rounded-4" style="max-width: 800px; overflow: hidden;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d192608.48322124098!2d106.76278553078265!3d-6.220944818130442!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1spuskesmas%20jabodetabek!5e0!3m2!1sen!2sid!4v1738695799224!5m2!1sen!2sid"
                    class="rounded-3"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

@endpush
