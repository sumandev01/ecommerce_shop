<div class="form-group mb-3">
    @if (isset($label))
        <label for="{{ $name }}" class="form-label">{{ $label }} @if (!empty($required)) <span class="text-danger">*</span> @endif </label>
    @endif

    <textarea name="{{ $name }}"
        id="{{ $id ?? $name }}" 
        class="form-control {{ $class ?? '' }}" 
        placeholder="{{ $placeholder ?? '' }}"
        @if (!empty($required)) required="{{ $required ? 'required' : false }}" @endif
        @if (!empty($disabled)) disabled="{{ $disabled ? 'disabled' : false }}" @endif
        @if (!empty($multiple)) multiple="{{ $multiple ? 'multiple' : false }}" @endif
        cols="30" rows="10">{{ old($name, $value) }}</textarea>

    @error ($name)
        <span class="text-danger mt-2 d-block">{{ $errors->first($name) }}</span>
    @enderror
</div>