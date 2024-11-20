<x-filament::widget>
    <x-filament::card>
        <div id="map" style="height: 500px;"></div>
    </x-filament::card>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Center the map on Kediri, East Java, Indonesia
            var map = L.map('map').setView([-7.848, 112.017], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 14,
            }).addTo(map);

            var addresses = @json($addresses);

            addresses.forEach(function (address) {
                // Geocode the address to get latitude and longitude
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address.alamat)}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Geocoding result for address:', address.alamat, data); // Add this line for debugging
                        if (data.length > 0) {
                            var lat = data[0].lat;
                            var lon = data[0].lon;
                            L.marker([lat, lon])
                                .addTo(map)
                                .bindPopup(address.alamat);
                        }
                    })
                    .catch(error => {
                        console.error('Geocoding error for address:', address.alamat, error); // Add this line for error handling
                    });
            });
        });
        async function geocodeAddress(address) {
            try {
                const response = await fetch(`https://api.example.com/geocode?address=${encodeURIComponent(address)}`);
                const data = await response.json();
                console.log('Geocoding response:', data);

                if (data && data.results && data.results.length > 0) {
                    const location = data.results[0].geometry.location;
                    // Add marker to the map
                    L.marker([location.lat, location.lng]).addTo(map);
                } else {
                    console.error('No results found for address:', address);
                }
            } catch (error) {
                console.error('Geocoding error:', error);
            }
        }

        // Example usage
        geocodeAddress('JL TAWANG SARI 177');
    </script>
</x-filament::widget>
