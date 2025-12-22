@extends('admin.layouts.app')
@section('content')
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title d-flex justify-content-between align-items-center pt-4">
                            <h4 class="">Edit Color</h4>
                            <a href="{{ route('color.index') }}" class="btn btn-primary btn-sm">
                                <i data-lucide="arrow-left" class="mr-2" style="width: 20px; height: 20px;"></i>
                                Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('color.update', $color?->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="colorName" class="form-label">Color Name</label>
                                    <input type="text" id="colorName" name="name" class="form-control mb-3" value="{{ old('name', $color?->name) }}" placeholder="Color Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror                                    
                                </div>
                                <div class="mb">
                                    <label for="colorCodeInput" class="form-label">Select Color</label>
                                    <input type="hidden" id="colorCodeInput" name="hex_code" class="form-control mb-3" placeholder="Color Code" value="{{ $color?->hex_code }}">
                                    <input type="color" id="colorPicker" class="form-control mb-3" style="width: 50px; height: 50px; padding: 2px;" placeholder="Color Picker" value="{{ $color?->hex_code }}">
                                    @error('hex_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update Color</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('script')
    <script>
        // Get references to the DOM elements
        const colorCodeInput = document.getElementById('colorCodeInput');
        const colorPicker = document.getElementById('colorPicker');
        // Function to validate a hex color code
        // Checks for the format #RRGGBB or #RGB
        function isValidHex(hex) {
            // Regular expression for #RRGGBB or #RGB format
            return /^#([0-9A-F]{3}){1,2}$/i.test(hex);
        }
        // ----------------------------------------------------
        // 1. Color Picker to Text Input Synchronization
        //    (When user uses the color chooser pop-up)
        // ----------------------------------------------------
        colorPicker.addEventListener('input', () => {
            // Get the color value from the picker
            const newColor = colorPicker.value;
            // 1a. Update the text input with the new color code
            colorCodeInput.value = newColor;
        });
        // ----------------------------------------------------
        // 2. Text Input to Color Picker Synchronization
        //    (When user types a hex code into the text field)
        // ----------------------------------------------------
        colorCodeInput.addEventListener('input', () => {
            let newColorCode = colorCodeInput.value.trim();
            // 2a. Convert to uppercase for consistent validation
            newColorCode = newColorCode.toUpperCase();
            // 2b. Add '#' prefix if missing and it looks like a hex code (e.g., FF00AA -> #FF00AA)
            if (newColorCode.length === 6 && !newColorCode.startsWith('#')) {
                newColorCode = '#' + newColorCode;
            }
            // Also handle 3-digit hex codes (e.g., F00 -> #F00)
            else if (newColorCode.length === 3 && !newColorCode.startsWith('#')) {
                newColorCode = '#' + newColorCode;
            }
            // 2c. Validate the hex code format
            if (isValidHex(newColorCode)) {
                // Update the color picker value
                colorPicker.value = newColorCode;
            }
        });
    </script>
@endpush