<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kartu Antrean</title>
    <style>
        body { font-family: sans-serif; }
        .card { border: 1px solid #000; padding: 20px; width: 300px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Kartu Antrean</h2>
        <p><strong>Nama Pasien:</strong> {{ $appointment->patient_name }}</p>
        <p><strong>Dokter:</strong> {{ $appointment->doctor_name }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</p>
        <p><strong>Jadwal:</strong> {{ $appointment->doctorOperationalTime->day ?? '-' }}</p>
        <p><strong>Puskesmas:</strong> {{ $appointment->puskesmas->nama ?? '-' }}</p>
        <p><strong>No. Antrean:</strong> {{ $queue_number }}</p>

    </div>
</body>
<script>
    $.post('/appointment/store', formData, function(res) {
    if (res.success) {
        alert('Appointment berhasil!');
        window.open('/appointment/print/' + res.appointment_id, '_blank'); // buka halaman cetak
    } else {
        alert(res.message);
    }
});

</script>
</html>
