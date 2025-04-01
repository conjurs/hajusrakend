@extends('layouts.app')

@section('title', $marker->name . ' - Markers - Hajusrakendused')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<style>
    #map {
        height: 400px;
        width: 100%;
        border-radius: 8px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>{{ $marker->name }}</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('markers.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        <a href="{{ route('markers.edit', $marker) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <form action="{{ route('markers.destroy', $marker) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash"></i> Delete
            </button>
        </form>
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
                <h5 class="card-title">Details</h5>
                
                <div class="mb-3">
                    <strong>Coordinates:</strong>
                    <p>{{ $marker->latitude }}, {{ $marker->longitude }}</p>
                </div>
                
                <div class="mb-3">
                    <strong>Description:</strong>
                    <p>{{ $marker->description ?: 'No description provided.' }}</p>
                </div>
                
                <div class="mb-3">
                    <strong>Added:</strong>
                    <p>{{ $marker->added }}</p>
                </div>
                
                @if($marker->edited)
                <div class="mb-3">
                    <strong>Last Edited:</strong>
                    <p>{{ $marker->edited }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const lat = {{ $marker->latitude }};
        const lng = {{ $marker->longitude }};
        

        const map = L.map('map').setView([lat, lng], 15);
        

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        

        L.marker([lat, lng])
            .addTo(map)
            .bindPopup('<b>{{ $marker->name }}</b><br>{{ $marker->description ?: "" }}')
            .openPopup();
    });
</script>
@endsection 