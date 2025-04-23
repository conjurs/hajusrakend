@extends('layouts.app')

@section('title', 'API Viewer')

@section('styles')
<style>
    #api-url {
        background-color: var(--secondary-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
    }
    #api-url:focus {
        background-color: var(--secondary-bg);
        color: var(--text-color);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(0, 200, 227, 0.25);
    }
    #response-container {
        background-color: var(--secondary-bg);
        border: 1px solid var(--border-color);
        border-radius: 5px;
        padding: 1rem;
        margin-top: 1rem;
        max-height: 60vh; 
        overflow-y: auto;
        white-space: pre-wrap; 
        word-wrap: break-word;
        font-family: monospace;
        color: #ccc;
    }
    .loading-text {
        color: var(--primary-color);
        font-size: 0.9rem;
        font-style: italic;
    }
    .error-message {
        color: #dc3545; 
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">API Viewer</h1>

    <div class="input-group mb-3">
        <input type="url" id="api-url" class="form-control form-control-lg" placeholder="Enter API URL (e.g., /api/monsters)" aria-label="API URL">
        <button class="btn btn-cyan" type="button" id="fetch-api-btn">
            Fetch Data
        </button>
    </div>

    <div class="input-group mb-3">
        <input type="text" id="api-token" class="form-control" placeholder="Auth Token" aria-label="API Token">
    </div>

    <div id="loading-indicator" class="text-center mt-2 d-none">
        <span class="loading-text">Fetching data...</span>
    </div>

    <div id="response-container" class="d-none"></div>
    <div id="error-container" class="mt-2 text-center error-message"></div>

</div>
@endsection

@section('scripts')
<script>
    document.getElementById('fetch-api-btn').addEventListener('click', function() {
        const apiUrlInput = document.getElementById('api-url');
        const apiTokenInput = document.getElementById('api-token');
        const responseContainer = document.getElementById('response-container');
        const errorContainer = document.getElementById('error-container');
        const loadingIndicator = document.getElementById('loading-indicator');
        const fetchButton = this;

        let apiUrl = apiUrlInput.value.trim();
        const token = apiTokenInput.value.trim();
        responseContainer.classList.add('d-none');
        responseContainer.textContent = '';
        errorContainer.textContent = '';

        if (!apiUrl) {
            errorContainer.textContent = 'Please enter an API URL.';
            return;
        }

        if (apiUrl.startsWith('/')) {
            apiUrl = window.location.origin + apiUrl;
        }

        loadingIndicator.classList.remove('d-none');
        fetchButton.disabled = true;

        const headers = {
            'Content-Type': 'application/json'
        };

        if (token) {
            headers['Authorization'] = `Bearer ${token}`;
        }

        fetch(apiUrl, {
            headers: headers
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status} ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                responseContainer.textContent = JSON.stringify(data, null, 2);
                responseContainer.classList.remove('d-none');
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                errorContainer.textContent = `Error fetching API: ${error.message}. Check the console for details. Make sure the URL is correct and the API allows requests from this origin (CORS).`;
            })
            .finally(() => {
                loadingIndicator.classList.add('d-none');
                fetchButton.disabled = false;
            });
    });
</script>
@endsection 