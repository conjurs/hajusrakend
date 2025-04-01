@extends('layouts.app')

@section('title', 'Maps - Hajusrakendused')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<style>
    #map {
        height: 500px;
        width: 100%;
        border-radius: 8px;
        border: 2px solid var(--primary-color);
    }
    .marker-form {
        display: none;
        position: absolute;
        background: var(--secondary-bg);
        color: var(--text-color);
        padding: 15px;
        border-radius: 8px;
        border: 1px solid var(--primary-color);
        box-shadow: 0 0 10px rgba(0, 200, 227, 0.2);
        z-index: 1000;
        width: 300px;
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Map</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('markers.create') }}" class="btn btn-cyan">
            <i class="bi bi-plus-lg"></i> Add New Marker
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12 position-relative">
        <div id="map"></div>
        
        <div id="markerForm" class="marker-form">
            <h4 class="text-cyan">Add New Marker</h4>
            <form id="newMarkerForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control bg-custom-dark text-white border-secondary" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control bg-custom-dark text-white border-secondary" id="description" name="description" rows="3"></textarea>
                </div>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-cyan">Save Marker</button>
                    <button type="button" class="btn btn-outline-cyan" id="cancelMarker">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <h2>Markers</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Description</th>
                        <th>Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($markers as $marker)
                    <tr>
                        <td>{{ $marker->name }}</td>
                        <td>{{ $marker->latitude }}, {{ $marker->longitude }}</td>
                        <td>{{ $marker->description }}</td>
                        <td>{{ $marker->added }}</td>
                        <td>
                            <a href="{{ route('markers.show', $marker) }}" class="btn btn-sm btn-cyan">View</a>
                            <a href="{{ route('markers.edit', $marker) }}" class="btn btn-sm btn-outline-cyan">Edit</a>
                            <form action="{{ route('markers.destroy', $marker) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const kuressaareLat = 58.2478;
        const kuressaareLng = 22.5087;
        const defaultZoom = 8;
        

        const map = L.map('map').setView([kuressaareLat, kuressaareLng], defaultZoom);
        

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        

        const markers = @json($markers);
        markers.forEach(marker => {
            L.marker([marker.latitude, marker.longitude])
                .addTo(map)
                .bindPopup(`<b>${marker.name}</b><br>${marker.description || ''}`)
                .on('click', function() {
                    this.openPopup();
                });
        });
        

        map.on('click', function(e) {
            const markerForm = document.getElementById('markerForm');
            markerForm.style.display = 'block';
            markerForm.style.left = (e.containerPoint.x + 20) + 'px';
            markerForm.style.top = (e.containerPoint.y - 100) + 'px';
            
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });
        
        document.getElementById('cancelMarker').addEventListener('click', function() {
            document.getElementById('markerForm').style.display = 'none';
            document.getElementById('newMarkerForm').reset();
        });

        document.getElementById('newMarkerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            fetch('{{ route("markers.storeFromMap") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {

                    L.marker([data.marker.latitude, data.marker.longitude])
                        .addTo(map)
                        .bindPopup(`<b>${data.marker.name}</b><br>${data.marker.description || ''}`)
                        .openPopup();
                        
                    document.getElementById('markerForm').style.display = 'none';
                    document.getElementById('newMarkerForm').reset();

                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while saving the marker');
            });
        });
    });
</script>
@endsection 