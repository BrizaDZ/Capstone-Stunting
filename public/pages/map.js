const iframe = document.getElementById("map-iframe");
    const status = document.getElementById("status");

    function showPuskesmasOnly(lat, lng) {
      // Gunakan query khusus: puskesmas di sekitar lokasi
      const query = `https://www.google.com/maps?q=puskesmas+near+${lat},${lng}&output=embed`;
      iframe.src = query;
      status.textContent = "Menampilkan puskesmas terdekat.";
    }

    function showError(message) {
      status.textContent = message;
      iframe.src = "https://www.google.com/maps?q=puskesmas&output=embed";
    }

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (pos) => {
          const lat = pos.coords.latitude;
          const lng = pos.coords.longitude;
          showPuskesmasOnly(lat, lng);
        },
        () => {
          showError("Gagal mendapatkan lokasi. Menampilkan peta umum.");
        }
      );
    } else {
      showError("Browser Anda tidak mendukung fitur lokasi.");
    }
