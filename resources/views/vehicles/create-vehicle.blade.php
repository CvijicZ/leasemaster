@extends('layouts.admin')

@section('admin-content')
    <div class="container col-6">
        <h2 class="text-custom-primary mb-4 text-center">Add New Vehicle</h2>

        <!-- Display General Errors (if any) -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Vehicle Creation Form -->
        <div class="bg-custom-secondary p-4 rounded shadow-sm">
            <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="make">Make</label>
                    <input type="text" class="form-control @error('make') is-invalid @enderror" id="make" name="make" value="{{ old('make') }}" required>
                    @error('make')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}" required>
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="engine">Engine</label>
                    <input type="text" class="form-control @error('engine') is-invalid @enderror" id="engine" name="engine" value="{{ old('engine') }}" required>
                    @error('engine')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="miles">Miles</label>
                    <input type="number" class="form-control @error('miles') is-invalid @enderror" id="miles" name="miles" value="{{ old('miles') }}" required>
                    @error('miles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color') }}" required>
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="seats">Seats</label>
                    <input type="number" class="form-control @error('seats') is-invalid @enderror" id="seats" name="seats" value="{{ old('seats') }}" required>
                    @error('seats')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="transmission">Transmission</label>
                    <input type="text" class="form-control @error('transmission') is-invalid @enderror" id="transmission" name="transmission" value="{{ old('transmission') }}" required>
                    @error('transmission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}" required>
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fuel_consumption">Fuel Consumption (L/100km)</label>
                    <input type="number" class="form-control @error('fuel_consumption') is-invalid @enderror" id="fuel_consumption" name="fuel_consumption" value="{{ old('fuel_consumption') }}" step="0.1" required>
                    @error('fuel_consumption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value') }}" step="0.01" required>
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Upload Field -->
                <div class="form-group">
                    <label for="images">Vehicle Images</label>
                    <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" multiple accept="image/*">
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="image-preview" class="mt-2">
                        <!-- Preview container, images will appear here -->
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Save Vehicle</button>
            </form>
        </div>
    </div>
    <script>
        // Image preview functionality
        document.getElementById('images').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('image-preview');
            
            console.log('Files selected:', files); 
            

            previewContainer.innerHTML = ''; 
            

            if (files.length > 0) {

                Array.from(files).forEach(file => {

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
    
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '100px';
                            img.style.marginRight = '10px'; 
                            img.style.marginBottom = '10px';
                            previewContainer.appendChild(img);
                        };
    
                        reader.readAsDataURL(file);
                    } else {
                        console.error('Selected file is not an image:', file); 
                    }
                });
            } else {
                previewContainer.innerHTML = 'No images selected';
            }
        });
    </script>
@endsection




