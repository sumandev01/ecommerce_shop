@props([
    'type' => 'thumbnail',
    'name' => 'media',
    'limit' => 5,
    'existingData' => [],
])

@php
    $uniqueId = $name . '_' . uniqid();
    // existingData string or array of strings or null
    $existingCount = is_iterable($existingData) ? count($existingData) : ($existingData ? 1 : 0);
@endphp

<div class="media-picker-wrapper mb-4" id="wrapper-{{ $uniqueId }}" data-limit="{{ $limit }}"
    data-current-count="{{ $existingCount }}">

    <div class="row g-2 align-items-start">
        @if ($type == 'gallery')
            {{-- Gallery Mode --}}
            <div class="col-4 col-md-3 col-lg-2">
                <div onclick="document.getElementById('file-selector-{{ $uniqueId }}').click()"
                    class="border rounded bg-white d-flex align-items-center justify-content-center"
                    style="aspect-ratio: 1/1; border-style: dashed !important; width: 100%; height: 100%; cursor: pointer; border-width: 2px !important; border-color: #dee2e6 !important;">
                    <div class="text-center text-muted">
                        <i data-lucide="plus" style="width: 20px;"></i>
                        <p class="small mb-0 d-block">Gallery</p>
                    </div>
                </div>
                {{-- Hidden input for selecting files --}}
                <input type="file" id="file-selector-{{ $uniqueId }}" class="d-none" multiple accept="image/*"
                    onchange="handleGalleryFiles(this, '{{ $uniqueId }}')">

                {{-- Real hidden input that will be submitted --}}
                <input type="file" name="{{ $name }}[]" id="real-input-{{ $uniqueId }}" class="d-none"
                    multiple>
            </div>

            <div class="col-8 col-md-9 col-lg-10">
                <div class="row g-2" id="preview-row-{{ $uniqueId }}">
                    @if (is_iterable($existingData))
                        @foreach ($existingData as $image)
                            <div class="col-6 col-md-4 col-lg-3" id="db-img-{{ $image->id }}">
                                <div class="border rounded position-relative shadow-sm"
                                    style="aspect-ratio: 1/1; overflow: hidden; background: #f8f9fa;">
                                    <img src="{{ Storage::url($image->src) }}"
                                        style="width: 100%; height: 100%; object-fit: contain;">
                                    <button type="button"
                                        onclick="removeStoredMedia('{{ $image->id }}', '{{ $uniqueId }}')"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                        style="padding: 0px 6px;">&times;</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @else
            {{-- Thumbnail Mode --}}
            <div class="col-12">
                <div id="thumb-box-{{ $uniqueId }}"
                    onclick="document.getElementById('input-{{ $uniqueId }}').click()"
                    class="border rounded bg-white d-flex align-items-center justify-content-center position-relative shadow-sm"
                    style="width: 100%; aspect-ratio: 16/9; border-style: dashed !important; cursor: pointer; overflow: hidden; border-width: 2px !important;">

                    @if ($existingData && !is_iterable($existingData))
                        <img src="{{ $existingData }}" style="width: 100%; height: 100%; object-fit: contain;">
                    @else
                        <div class="text-center text-muted">
                            <p class="mb-0">Select Thumbnail</p>
                        </div>
                    @endif
                </div>
                <input type="file" id="input-{{ $uniqueId }}" name="{{ $name }}" class="d-none"
                    accept="image/*" onchange="handleThumbUpdate(this, '{{ $uniqueId }}')">
            </div>
        @endif
    </div>

    {{-- Hidden field for deleted IDs --}}
    <input type="hidden" name="removed_{{ $name }}" id="removed-{{ $uniqueId }}" value="[]">
    
    {{-- Error message container --}}
    <p id="error-{{ $uniqueId }}" class="text-danger small mt-2" style="display: none;"></p>
    
    {{-- Laravel Validation Error --}}
    @error($name)
        <span class="text-danger small mt-2 d-block">{{ $message }}</span>
    @enderror
    
    {{-- Gallery mode validation errors (for arrays) --}}
    @error($name.'.*')
        <span class="text-danger small mt-2 d-block">{{ $message }}</span>
    @enderror
</div>

<script>
    if (typeof allGalleryFiles === 'undefined') {
        window.allGalleryFiles = {};
    }

    function handleGalleryFiles(input, uid) {
        const wrapper = document.getElementById('wrapper-' + uid);
        const limit = parseInt(wrapper.getAttribute('data-limit'));
        const previewRow = document.getElementById('preview-row-' + uid);
        const realInput = document.getElementById('real-input-' + uid);
        const errorMsg = document.getElementById('error-' + uid);

        if (!window.allGalleryFiles[uid]) {
            window.allGalleryFiles[uid] = new DataTransfer();
        }

        // Reset display
        errorMsg.style.display = 'none';
        errorMsg.innerText = '';

        let dbItems = previewRow.querySelectorAll('[id^="db-img-"]').length;
        let newItems = previewRow.querySelectorAll('.new-img-item').length;
        let currentTotal = dbItems + newItems;

        Array.from(input.files).forEach(file => {
            if (currentTotal >= limit) {
                showError(uid, `Limit reached! Max ${limit} images allowed.`);
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                showError(uid, `File "${file.name}" is too large! (Max 2MB)`);
                return;
            }

            window.allGalleryFiles[uid].items.add(file);
            const fileIndex = window.allGalleryFiles[uid].items.length - 1;

            const reader = new FileReader();
            reader.onload = (e) => {
                const html = `
                <div class="col-6 col-md-4 col-lg-3 new-img-item" id="new-img-${uid}-${fileIndex}">
                    <div class="border rounded position-relative shadow-sm" style="aspect-ratio: 1/1; overflow: hidden; background: #f8f9fa;">
                        <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: contain;">
                        <button type="button" onclick="removeNewGalleryImage('${uid}', ${fileIndex})" 
                                class="btn btn-warning btn-sm position-absolute top-0 end-0 m-1" style="padding: 0px 6px;">&times;</button>
                    </div>
                </div>`;
                previewRow.insertAdjacentHTML('beforeend', html);
                realInput.files = window.allGalleryFiles[uid].files;
            };
            reader.readAsDataURL(file);
            currentTotal++;
        });

        wrapper.setAttribute('data-current-count', currentTotal);
        input.value = '';
    }

    function removeNewGalleryImage(uid, index) {
        const wrapper = document.getElementById('wrapper-' + uid);
        const realInput = document.getElementById('real-input-' + uid);
        let currentCount = parseInt(wrapper.getAttribute('data-current-count'));

        const dt = new DataTransfer();
        const files = window.allGalleryFiles[uid].files;
        for (let i = 0; i < files.length; i++) {
            if (i !== index) dt.items.add(files[i]);
        }
        window.allGalleryFiles[uid] = dt;
        realInput.files = dt.files;

        const item = document.getElementById(`new-img-${uid}-${index}`);
        if (item) item.remove();
        wrapper.setAttribute('data-current-count', currentCount - 1);
    }

    function handleThumbUpdate(input, uid) {
        const file = input.files[0];
        const errorMsg = document.getElementById('error-' + uid);
        const thumbBox = document.getElementById('thumb-box-' + uid);

        if (errorMsg) {
            errorMsg.style.display = 'none';
            errorMsg.innerText = '';
        }

        if (file) {
            if (file.size <= 2 * 1024 * 1024) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    thumbBox.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: contain;">`;
                };
                reader.readAsDataURL(file);
            } else {
                showError(uid, "Thumbnail must be under 2MB");
                input.value = '';
                thumbBox.innerHTML = '<div class="text-center text-muted"><p class="mb-0">Select Thumbnail</p></div>';
            }
        }
    }

    function removeStoredMedia(id, uid) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Delete image?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    processRemoval(id, uid);
                }
            });
        } else {
            if (confirm('Are you sure you want to delete this image?')) {
                processRemoval(id, uid);
            }
        }
    }

    function processRemoval(id, uid) {
        const wrapper = document.getElementById('wrapper-' + uid);
        let currentCount = parseInt(wrapper.getAttribute('data-current-count'));
        let removedInput = document.getElementById('removed-' + uid);
        let removedIds = JSON.parse(removedInput.value);
        removedIds.push(id);
        removedInput.value = JSON.stringify(removedIds);
        document.getElementById('db-img-' + id).remove();
        wrapper.setAttribute('data-current-count', currentCount - 1);
    }

    function showError(uid, msg) {
        const errorMsg = document.getElementById('error-' + uid);
        if (errorMsg) {
            errorMsg.innerText = msg;
            errorMsg.style.display = 'block';
        }
    }
</script>