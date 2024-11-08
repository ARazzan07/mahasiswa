@extends('layout.menu')
@section('konten')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Marker Map with Leaflet</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <style>
        /* CSS untuk ukuran peta */
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>

    <h2>Map Mahasiswa</h2>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary" title="Buka Map"><i class="far fa-plus-square"></i> &nbsp;Tutup Map Mahasiswa</a>
    <br><br>
    <div id="map"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine JS -->
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <script>
        // Inisialisasi Peta
        const map = L.map('map').setView([-3.4420, 114.8340], 13); // Koordinat pusat peta (Banjarbaru)
        let currentRoute = null;  // Untuk menyimpan referensi rute yang sedang ditampilkan
        let userMarker = null;  // Untuk menyimpan marker lokasi pengguna

        // Tambahkan Tile Layer dari OpenStreetMap
        L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a> contributors'
        }).addTo(map);

        // Data untuk MultiMarker (dari Laravel backend)
        const locations = @json($locations);

        // Loop untuk Menambahkan Marker
        locations.forEach(location => {
            if (location.lat != null && location.long != null) {
                const marker = L.marker([location.lat, location.long]).addTo(map);
                marker.bindPopup(`
                    <div class="popup-content">
                        <p>${location.content}</p>
                        <button onclick="showRouteToMarker([${location.lat}, ${location.long}])">Tambah Rute</button>
                        <button onclick="clearRoute()">Hapus Rute</button>
                    </div>
                `);
            } else {
                console.error("Invalid location data:", location);
            }
        });

        // Fungsi untuk mendapatkan lokasi pengguna
        function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            console.log("User Location:", userLat, userLng); // Debugging log

            // Menampilkan lokasi pengguna
            if (userMarker) {
                userMarker.setLatLng([userLat, userLng]); // Update lokasi marker jika sudah ada
            } else {
                userMarker = L.marker([userLat, userLng]).addTo(map); // Tambahkan marker baru jika belum ada
            }

            userMarker.bindPopup("<b>Your Location</b>").openPopup();

            // Mengubah tampilan peta ke lokasi pengguna
            map.setView([userLat, userLng], 13);
        }, function(error) {
            console.error("Geolocation error:", error);
            // Menampilkan pesan kesalahan pada UI jika terjadi masalah
            alert("Terjadi masalah saat mendapatkan lokasi Anda: " + error.message);
        }, {
            enableHighAccuracy: true,   // Mengaktifkan akurasi tinggi
            timeout: 5000,              // Batas waktu untuk mendapatkan lokasi (5 detik)
            maximumAge: 0               // Tidak menggunakan lokasi lama
        });
    } else {
        console.error("Geolocation is not supported by this browser.");
        alert("Browser Anda tidak mendukung geolocation.");
    }
}

// Panggil fungsi untuk mendapatkan lokasi pengguna
getUserLocation();

        // Fungsi untuk menampilkan rute dari lokasi pengguna ke marker yang dipilih
        function showRouteToMarker(destination) {
            // Ambil lokasi pengguna jika tersedia
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;

                    console.log("Calculating route from:", userLat, userLng, "to:", destination); // Debugging log

                    // Menghapus rute lama jika ada
                    clearRoute();

                    // Menambahkan rute menggunakan OpenRouteService
                    const routeUrl = `https://api.openrouteservice.org/v2/directions/driving-car?api_key=5b3ce3597851110001cf62485894554d810847529a258b5b93853906&start=${userLng},${userLat}&end=${destination[1]},${destination[0]}`;

                    fetch(routeUrl)
                        .then(response => response.json())
                        .then(data => {
                            const routeCoordinates = data.features[0].geometry.coordinates.map(coord => [coord[1], coord[0]]);

                            console.log("Route coordinates:", routeCoordinates); // Debugging log

                            // Tambahkan rute ke peta
                            currentRoute = L.polyline(routeCoordinates, { color: 'blue', weight: 4 }).addTo(map);
                        })
                        .catch(error => console.error('Error fetching route:', error));
                }, function(error) {
                    console.error("Geolocation error:", error);
                }, { enableHighAccuracy: true });
            } else {
                console.error("Geolocation is not supported by this browser.");
            }
        }

        // Fungsi untuk menghapus rute yang sudah digambar
        function clearRoute() {
            if (currentRoute) {
                map.removeLayer(currentRoute);  // Menghapus polyline rute yang sudah ada
                currentRoute = null;  // Reset referensi rute
            }
        }

    </script>

</body>
</html>

@endsection
