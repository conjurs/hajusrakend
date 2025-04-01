@extends('layouts.app')

@section('title', 'Edit Marker - Hajusrakendused')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<style>
    #map {
        height: 400px;
        width: 100%;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 2px solid var(--primary-color);
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Edit Marker</h1>
        <p>Update the marker information. You can also click on the map to set new coordinates.</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('markers.show', $marker->id) }}" class="btn btn-outline-cyan me-2">
            <i class="bi bi-eye"></i> View
        </a>
        <a href="{{ route('markers.index') }}" class="btn btn-outline-cyan">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="map"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('markers.update', $marker->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control bg-custom-dark text-white border-secondary @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $marker->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control bg-custom-dark text-white border-secondary @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude', $marker->latitude) }}" required>
                            @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control bg-custom-dark text-white border-secondary @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude', $marker->longitude) }}" required>
                            @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control bg-custom-dark text-white border-secondary @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $marker->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-cyan">Update Marker</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const latField = document.getElementById('latitude');
        const lngField = document.getElementById('longitude');
        

        const markerLat = parseFloat(latField.value);
        const markerLng = parseFloat(lngField.value);

        const map = L.map('map').setView([markerLat, markerLng], 15);
        

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        

        let marker = L.marker([markerLat, markerLng]).addTo(map);

        map.on('click', function(e) {

            latField.value = e.latlng.lat.toFixed(8);
            lngField.value = e.latlng.lng.toFixed(8);
            

            marker.setLatLng(e.latlng);
        });
    });
</script>
@endsection 