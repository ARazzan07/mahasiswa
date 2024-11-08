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

    <style>

        /* CSS untuk ukuran peta */
        #map {
            height: 500px;
            width: 100%;
        }

        /* Menambahkan style agar popup lebih rapi */
        .popup-content {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

    <h2>Map Mahasiswa</h2>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary" title="Buka Map"><i class="far fa-plus-square"></i> &nbsp;Tutup Map Mahasiswa</a>
    <br>
    <br>
    <div id="map"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Inisialisasi Peta
        const map = L.map('map').setView([-3.4420, 114.8340], 13); // Koordinat pusat peta (Banjarbaru)
        // Koordinat pusat peta (Jakarta)

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
            // Pastikan lat dan long valid
            if (location.lat != null && location.long != null) {
                const marker = L.marker([location.lat, location.long]).addTo(map);
                marker.bindPopup(`<div class="popup-content">${location.content}</div>`);
            } else {
                console.error("Invalid location data:", location);
            }
        });
    </script>

</body>
</html>

@endsection
