<div class="form-group mb-3">
    @if (isset($label))
        <label for="{{ $name }}" class="form-label">{{ $label }} @if (!empty($required)) <span class="text-danger">*</span> @endif </label>
    @endif

    <input type="file" 
    name="{{ $name }}" 
    class="form-control {{ $class ?? '' }}"
    id="{{ $id ?? $name }}"
    placeholder="{{ $placeholder}}"
    onchange="previewFile(event, `{{ $preview }}`)"
    @if (!empty($value)) value="{{ $value }}" @endif
    @if (!empty($required)) required="{{ $required ? 'required' : false }}" @endif
    />

    @error ($name)
        <span class="text-danger mt-2 d-block">{{ $errors->first($name) }}</span>
    @enderror
</div>
@push('script')
    <script>
        function previewFile(event, previewElementId) {
            var file = event.target.files[0]; 
            var preview = document.getElementById(previewElementId); 

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                if (preview) {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            }
        }
    </script>
@endpush