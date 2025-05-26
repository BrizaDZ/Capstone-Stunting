<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SURAT RUJUKAN PUSKESMAS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header, .footer {
            text-align: center;
        }
        .header img {
            height: 80px;
            float: left;
        }
        .header .logo-kanan {
            float: right;
            height: 80px;
        }
        .header .text {
            text-align: center;
            margin: 0 auto;
        }
        .clear {
            clear: both;
        }
        hr {
            border: 1px solid black;
            margin: 10px 0;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            margin: 6px 0;
        }
        .ttd {
            float: right;
            text-align: center;
            margin-top: 40px;
        }
        .keterangan {
            margin-top: 80px;
        }
    </style>
</head>
<body>

{{-- <div class="header">
    <img src="{{ asset('path/to/logo_kiri.png') }}" alt="Logo Kiri">
    <img src="{{ asset('path/to/logo_kanan.png') }}" class="logo-kanan" alt="Logo Kanan">
    <div class="text">
        <strong>PEMERINTAH KABUPATEN INDRAGIRI HULU<br>
        DINAS KESEHATAN<br>
        UPTD PUSKESMAS AIR MOLEK</strong><br>
        Jl. Jend. Sudirman - Air Molek II - Kec. Pasir Penyu, Telp. (0769) 41049<br>
        E-mail: puskesmas.airmolek2@gmail.com Kodepos : 29352
    </div>
</div> --}}


<h3 style="text-align: center;"><u>SURAT RUJUKAN PUSKESMAS</u></h3>
<p style="text-align: center;">NOMOR : ...........................</p>

<div class="content">
    <p>Kepada Yth : ..................................................</p>
    <p>di,-</p>
    <p>..................................................</p>

    <p>Dengan Hormat,</p>
    <p>Bersama ini kami kirimkan seorang penderita:</p>

    <p>Nama : {{ $data->name }}</p>
    <p>Umur : {{ $data->age }} tahun</p>
    <p>Alamat : {{ $data->alamat }}</p>
    <p>Diagnosa Sementara : Resiko Stunting dengan Z-score TB/U nya adalah {{$data->zscoreheightage}} ({{$data->heightage}})</p>

    <p>Mohon bantu Pemeriksaan, Pengobatan dan Perawatan selanjutnya.<br>
    Atas bantuannya kami ucapkan terima kasih.</p>
</div>

<div class="ttd">
    <p>Cikarang, {{ date('d-m-Y') }}</p>
    <p>Dokter Pemeriksa</p>
    <br><br><br>
    <p>__________________________</p>
    <p>NIP.</p>
</div>

<div class="clear"></div>


</body>
</html>
