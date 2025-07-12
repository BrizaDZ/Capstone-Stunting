@extends('layouts.web.layout')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


@endpush

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Detail Artikel (Kiri) -->
        <div class="col-md-8">
            <div class="card mb-3 shadow border-0">
                <img src="{{ asset('images/article/' . $data->photo) }}" class="card-img-top" alt="{{ $data->title }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $data->title }}</h3>
                    <p class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days-icon lucide-calendar-days me-2"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg> {{ \Carbon\Carbon::parse($data->date)->locale('id')->translatedFormat('l, d F Y') }} | <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye me-2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg> {{ $data->counterview }} Views</p>
                    <p class="card-text">{!! $data->description !!}</p>
                </div>
            </div>
            <div class="card mb-3 shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap ">

                        <div class="d-flex align-items-center gap-2 mt-2 ms-auto">
                            <span class="me-1">Bagikan:</span>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::url()) }}" target="_blank" class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" rel="noopener noreferrer">
                                <i class="bi bi-linkedin text-white"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($data->title . ' ' . Request::url()) }}" target="_blank" class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" rel="noopener noreferrer">
                                <i class="bi bi-whatsapp text-white"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" rel="noopener noreferrer">
                                <i class="bi bi-facebook text-white"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($data->title) }}" target="_blank" class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" rel="noopener noreferrer">
                                <i class="bi bi-twitter text-white"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Artikel Terpopuler (Kanan) -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <strong>Artikel Terpopuler</strong>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($populars as $article)
                        <li class="list-group-item d-flex">
                            <img src="{{ asset('images/article/' . $article->photo) }}" alt="{{ $article->title }}"
                                class="me-2" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            <div>
                                <a href="/detail/article/{{ $article->slug }}" class="text-decoration-none fw-semibold">
                                    {{ \Illuminate\Support\Str::limit($article->title, 50) }}
                                </a>
                                <div class="small text-muted">{{ $article->counterview }} views</div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">Belum ada artikel lain.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')


@endpush
