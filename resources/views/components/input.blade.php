<div class="form-group mb-3">
    {{-- Display Label --}}
    @if ($label)
        <label for="{{ $id }}" class="form-label fw-bold text-muted small">
            {{ $label }} @if ($required) <span class="text-danger">*</span> @endif 
        </label>
    @endif

    <div class="input-group">
        <input 
            type="{{ $type ?? 'text' }}" 
            name="{{ $name }}" 
            class="form-control {{ $class ?? '' }}"
            id="{{ $id }}"
            placeholder="{{ $placeholder ?? '' }}" 
            value="{{ old($name, $value ?? '') }}"
            {{-- Standard maxlength for text inputs --}}
            maxlength="{{ $max }}" 
            {{-- Custom JS to force limit on number inputs and others --}}
            oninput="handleInputLimit(this, '{{ $id }}', {{ $max }}, {{ $counter ? 'true' : 'false' }})"
            @if ($required) required @endif
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
        />
        
        {{-- Display appended content --}}
        @if($append)
            {!! $append !!}
        @endif
    </div>
    
    <div class="d-flex justify-content-between mt-1">
        <div>
            @error ($name)
                <span class="text-danger">{{ $errors->first($name) }}</span>
            @enderror
        </div>
        
        {{-- Character Counter --}}
        @if($counter)
            <small class="text-muted" style="font-size: 0.75rem;">
                <span id="count-{{ $id }}">0</span> / {{ $max }}
            </small>
        @endif
    </div>
</div>

<script>
    {{-- Run on page load --}}
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('{{ $id }}');
        if(input && {{ $counter ? 'true' : 'false' }}) {
            updateInputCount('{{ $id }}', input.value, {{ $max }});
        }
    });

    {{-- Universal input handler to enforce max limit --}}
    if (typeof handleInputLimit !== 'function') {
        window.handleInputLimit = function(el, id, max, isCounterEnabled) {
            // Forcefully cut the value if it exceeds max length
            // This is needed especially for type="number" where maxlength doesn't work
            if (el.value.length > max) {
                el.value = el.value.slice(0, max);
            }

            if (isCounterEnabled) {
                updateInputCount(id, el.value, max);
            }
        };
    }

    {{-- Function to update counter UI --}}
    if (typeof updateInputCount !== 'function') {
        window.updateInputCount = function(id, value, max) {
            const countElement = document.getElementById('count-' + id);
            if (countElement) {
                countElement.innerText = value.length;
                
                if (value.length >= max) {
                    countElement.classList.add('text-danger');
                } else {
                    countElement.classList.remove('text-danger');
                }
            }
        };
    }
</script>