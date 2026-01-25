<div class="form-group mb-3">
    @if (isset($label))
        <label for="{{ $name }}" class="form-label fw-bold text-muted small">{{ $label }} @if (!empty($required)) <span class="text-danger">*</span> @endif </label>
    @endif

    <select name="{{ $name }}"
        id="{{ $id ?? $name }}" 
        class="form-select {{ $class ?? '' }}" 
        @if (!empty($required)) required="{{ $required ? 'required' : false }}" @endif
        @if (!empty($disabled)) disabled="{{ $disabled ? 'disabled' : false }}" @endif
        @if (!empty($multiple)) multiple="{{ $multiple ? 'multiple' : false }}" @endif>
            @if (!empty($placeholder))
                <option value="" disabled selected>{{ $placeholder }}</option>
            @endif
            {{ $slot }}
    </select>

    @error ($name)
        <span class="text-danger mt-2 d-block">{{ $errors->first($name) }}</span>
    @enderror
</div>