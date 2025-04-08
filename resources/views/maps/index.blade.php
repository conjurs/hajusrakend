@extends('layouts.app')

@section('title', 'Maps - Hajusrakendused')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<style>
    #map {
        height: 500px;
        width: 100%;
        border-radius: 12px;
        border: 2px solid var(--primary-color);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .marker-form {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: var(--secondary-bg);
        color: var(--text-color);
        padding: 24px;
        border-radius: 16px;
        border: 1px solid var(--primary-color);
        box-shadow: 0 8px 32px rgba(0, 200, 227, 0.2);
        z-index: 1000;
        width: 400px;
        max-width: 90%;
        backdrop-filter: blur(10px);
    }

    .marker-form h4 {
        color: var(--primary-color);
        margin-bottom: 20px;
        font-weight: 600;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-color);
        padding: 12px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(0, 200, 227, 0.2);
    }

    .form-label {
        color: var(--text-color);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .btn-cyan {
        background: var(--primary-color);
        color: #000;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-cyan:hover {
        background: #00b8d4;
        transform: translateY(-1px);
    }

    .btn-outline-cyan {
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        background: transparent;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-cyan:hover {
        background: rgba(0, 200, 227, 0.1);
    }

    .location-preview {
        margin-top: 16px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        font-size: 0.9rem;
        color: var(--text-color);
    }

    .location-preview span {
        color: var(--primary-color);
        font-weight: 500;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .form-actions button {
        flex: 1;
    }

    @media (max-width: 768px) {
        .marker-form {
            width: 90%;
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Map</h1>
    </div>
    <div class="col-md-4 text-end">
        <button id="addMarkerBtn" class="btn btn-cyan">
            <i class="bi bi-plus-lg"></i> Add New Marker
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-12 position-relative">
        <div id="map"></div>
        
        <div id="markerForm" class="marker-form">
            <h4>Add New Marker</h4>
            <form id="newMarkerForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter marker name">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter marker description"></textarea>
                </div>
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <div class="location-preview">
                    Selected location: <span id="locationPreview">Click on the map to select a location</span>
                </div>
                <div class="form-actions">
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

        let selectedMarker = null;
        
        document.getElementById('addMarkerBtn').addEventListener('click', function() {
            document.getElementById('markerForm').style.display = 'block';
            document.getElementById('locationPreview').textContent = 'Click on the map to select a location';
        });

        map.on('click', function(e) {
            const markerForm = document.getElementById('markerForm');
            markerForm.style.display = 'block';
            
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
            
            document.getElementById('locationPreview').textContent = 
                `${e.latlng.lat.toFixed(4)}, ${e.latlng.lng.toFixed(4)}`;
            
            if (selectedMarker) {
                map.removeLayer(selectedMarker);
            }
            
            selectedMarker = L.marker(e.latlng, {
                icon: L.divIcon({
                    className: 'selected-marker',
                    html: '<div style="background: var(--primary-color); width: 20px; height: 20px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 10px rgba(0, 200, 227, 0.5);"></div>'
                })
            }).addTo(map);
        });
        
        document.getElementById('cancelMarker').addEventListener('click', function() {
            document.getElementById('markerForm').style.display = 'none';
            document.getElementById('newMarkerForm').reset();
            document.getElementById('locationPreview').textContent = 'Click on the map to select a location';
            
            if (selectedMarker) {
                map.removeLayer(selectedMarker);
                selectedMarker = null;
            }
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
                    document.getElementById('locationPreview').textContent = 'Click on the map to select a location';
                    
                    if (selectedMarker) {
                        map.removeLayer(selectedMarker);
                        selectedMarker = null;
                    }

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