@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h5>All Colors</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-bordered table-hover table-striped" id="colorTable">
                        <thead>
                            <tr>
                                <th class="text-start">Sl</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th class="text-center">Color</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $colors ?? [] as $key => $color )
                                <tr>
                                    <td class="text-start">{{ $key + 1 }}</td>
                                    <td> {{ $color?->name }} </td>
                                    <td> {{ $color?->hex_code }} </td>
                                    <td class="text-center">
                                        <div style="width: 30px; height: 30px; background-color: {{ $color->hex_code }}; border-radius: 50%; margin: 0 auto; border: 1px solid #000"></div>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('color.edit', $color?->id) }}" class="btn btn-info btn-icon btn-md"><i data-lucide="edit"></i></a>
                                        <a href="{{ route('color.destroy', $color?->id) }}" class="btn btn-danger btn-icon btn-md deleteConfirm"><i data-lucide="trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Colors Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Color</h4>
                </div>
                <div class="card-footer">
                    <form action="{{ route('color.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input type="text" label="Color Name" name="name" id="colorName" placeholder="Color Name" :required="true"/>
                        </div>
                        <div class="mb">
                            <x-input type="text" label="Color Code" name="hex_code" id="colorCodeInput" placeholder="Color Code" :required="true" value="#000000"/>
                            <input type="color" id="colorPicker" class="form-control mb-3" style="width: 50px; height: 50px; padding: 2px;" placeholder="Color Picker" value="#000000">
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Add Color</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready( function () {
            $('#colorTable').DataTable();
        });
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
            // 1b. Update the background of the color preview display
            colorDisplay.style.backgroundColor = newColor;
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
                // Update the background of the color preview display
                colorDisplay.style.backgroundColor = newColorCode;
            }
        });
    </script>
@endpush