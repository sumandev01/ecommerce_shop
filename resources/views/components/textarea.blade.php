@php
    $uniqueId = $id . '_' . uniqid();
    $calculatedHeight = ($rows * 25) + 50 . 'px';
@endphp

<div class="form-group textarea-container mb-3" id="container-{{ $uniqueId }}" data-max="{{ $max }}">
    @if($label)
        <label for="{{ $id }}" class="form-label fw-bold text-muted small">
            {{ $label }} @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif

    @if($editor)
        <div class="bg-white border rounded shadow-sm">
            <div id="editor-{{ $uniqueId }}" style="height: {{ $calculatedHeight }}; border: none;">
                {!! $value !!}
            </div>
        </div>
        <input type="hidden" name="{{ $name }}" id="input-{{ $uniqueId }}" value="{{ $value }}" {{ $required ? 'required' : '' }}>
    @else
        <textarea 
            name="{{ $name }}" 
            id="textarea-{{ $uniqueId }}" 
            rows="{{ $rows }}" 
            placeholder="{{ $placeholder }}"
            class="form-control {{ $class }}"
            {{ $required ? 'required' : '' }}
            {{-- Standard maxlength for character limit --}}
            maxlength="{{ $max }}"
            oninput="updateCharCount('{{ $uniqueId }}', this.value)"
            style="resize: none;"
        >{{ $value }}</textarea>
    @endif

    <div class="d-flex justify-content-between mt-1">
        <span id="error-{{ $uniqueId }}" class="text-danger small" style="display: none;">Character limit reached!</span>
        <div class="ms-auto text-muted small">
            Characters: <span id="count-{{ $uniqueId }}">0</span> / {{ $max }}
        </div>
    </div>
</div>

@if($editor)
    @once
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    @endonce

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const quill = new Quill('#editor-{{ $uniqueId }}', {
            theme: 'snow',
            modules: { toolbar: [[{ 'header': [1, 2, 3, false] }], ['bold', 'italic', 'underline'], [{ 'list': 'ordered'}, { 'list': 'bullet' }], ['clean']] },
            placeholder: '{{ $placeholder }}'
        });

        // Update count for existing data
        updateCharCount('{{ $uniqueId }}', quill.getText().trim());

        // Handle typing and pasting in Editor (Character based)
        quill.on('text-change', function(delta, oldDelta, source) {
            let text = quill.getText().trim();
            
            if (text.length > {{ $max }}) {
                // Cut text to exact character limit if pasted or typed
                const limitedText = text.substring(0, {{ $max }});
                quill.setText(limitedText, 'silent');
                document.getElementById('error-{{ $uniqueId }}').style.display = 'block';
            } else {
                document.getElementById('error-{{ $uniqueId }}').style.display = 'none';
            }

            document.getElementById('input-{{ $uniqueId }}').value = quill.root.innerHTML;
            updateCharCount('{{ $uniqueId }}', quill.getText().trim());
        });
    });
    </script>
@else
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('textarea-{{ $uniqueId }}');
            if(el) updateCharCount('{{ $uniqueId }}', el.value);
        });
    </script>
@endif

<script>
    // Universal function for Character counting
    if (typeof updateCharCount !== 'function') {
        window.updateCharCount = function(uid, text) {
            const container = document.getElementById('container-' + uid);
            if(!container) return;
            const max = parseInt(container.getAttribute('data-max'));
            const countSpan = document.getElementById('count-' + uid);
            const errorSpan = document.getElementById('error-' + uid);
            
            const length = text.length;
            countSpan.innerText = length;
            
            if (length >= max) {
                countSpan.classList.add('text-danger');
                if(errorSpan) errorSpan.style.display = 'block';
            } else {
                countSpan.classList.remove('text-danger');
                if(errorSpan) errorSpan.style.display = 'none';
            }
        }
    }
</script>

<style>
    .ql-toolbar.ql-snow { border-top-left-radius: 8px; border-top-right-radius: 8px; border: 1px solid #dee2e6; background: #f8f9fa; }
    .ql-container.ql-snow { border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; border: 1px solid #dee2e6 !important; }
</style>