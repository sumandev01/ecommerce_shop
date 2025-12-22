@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title d-flex justify-content-between align-items-center pt-4">
                <h4 class="">Create Product</h4>
                <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
                    <i data-lucide="arrow-left" class="mr-2" style="width: 20px; height: 20px;"></i>
                    Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                @csrf
                <div class="sectionCard">
                    <h4 class="sectionTitle">Product Information</h4>
                    <x-input label="Product Name" name="name" placeholder="Enter product name" :required="true" />
                    <x-textarea label="Short Description" name="shortDescription" placeholder="Enter product short description......" :required="true" />
                    <x-select class="selectTag" multiple="multiple" label="Tag" name="tag[]">
                        <option value="" >Select Tag</option>
                        @foreach ($tags ?? [] as $tag )
                            <option value="{{ $tag?->id }}">{{ $tag?->name }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="sectionCard">
                    <h4 class="sectionTitle">General Information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <x-select id="category_id" label="Category" name="category" :required="true">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories ?? [] as $category )
                                    <option value="{{ $category?->id }}">{{ $category?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-6">
                            <x-select id="subCategory_id" label="Sub Category" name="subCategory" :required="true">
                                <option value="">Select Sub-Category</option>
                            </x-select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product_sku" class="form-label">Product SKU <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="product_sku" id="product_sku" placeholder="Product SKU" required >
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="generate_sku" onclick="codeGenerate()">Generate SKU</button>
                                </div>
                            </div>
                            @error('product_sku')
                                <span class="text-danger d-block mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-select label="Brand" name="brand" :required="false">
                                <option value="" disabled selected>Select Brand</option>
                                @foreach ($brands ?? [] as $brand )
                                    <option value="{{ $brand?->id }}">{{ $brand?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-input type="number" label="Buy Price" name="buy_Price" placeholder="Buy Price" :required="false" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-input type="number" label="Selling Price" name="sell_Price" placeholder="Selling Price" :required="false" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-input type="number" label="Discount Price" name="discount_Price" placeholder="Discount Price" :required="false" />
                        </div>
                    </div>
                </div>
                <div class="sectionCard">
                    <h4 class="sectionTitle">Product Description</h4>
                    <x-textarea label="Description" name="description" class="description" placeholder="Enter product description......" />
                    <x-textarea label="Additional Information" name="additional_info" class="description" placeholder="Additional information......" />
                </div>
                <div class="sectionCard">
                    <h4 class="sectionTitle">Product Images</h4>
                    <div class="form-group">
                        <label for="thambnail" class="form-label cursor-pointer">
                            <p class="mb-2">Product Thumbnail <span class="text-danger">*</span></p>
                            <img src="{{ asset('upload.jpg') }}" alt="" class="img-thumbnail" style="width: 140px; height: 140px; display: block;" id="thambnailPreview">
                        </label>
                        <input type="file" id="thambnail" name="thambnail" class="form-control mb-3 d-none" onchange="validateImage(this)" required>
                        <span class="text-danger d-block" id="thambnailError"></span>
                        @error('thambnail')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="upload__box form-group">
                        <span>Product Gallery</span>
                        <div class="upload__img-wrap my-2">
                            <label for="product_gallery" class="cursor-pointer">
                                <img src="{{ asset('upload.jpg') }}" alt="" class="img-thumbnail" style="width: 140px; height: 140px; display: block;">
                                <input type="file" id="product_gallery" name="images[]" multiple data-max_length="10" class="upload__inputfile d-none">
                            </label>
                        </div>
                        <span class="text-danger d-block" id="galleryError"></span>
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center gap-4">
                    <button type="reset" class="btn btn-secondary"><i data-lucide="undo" class="mr-2" style="width: 20px; height: 20px;"></i>Reset</button>
                    <button type="submit" id="submit" class="btn btn-primary">Submit<i data-lucide="arrow-right" class="ms-2" style="width: 20px; height: 20px;"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.description').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['undo', ['undo', 'redo']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['color', ['forecolor', 'backcolor']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'table', 'picture']],
                    ['view', ['codeview']]
                ],

                styleTags: [
                    { className: 'styleTagsClass title-1', title: 'H1', value: 'h1' },
                    { className: 'styleTagsClass title-2', title: 'H2', value: 'h2' },
                    { className: 'styleTagsClass title-3', title: 'H3', value: 'h3' },
                    { className: 'styleTagsClass title-4', title: 'H4', value: 'h4' },
                    { className: 'styleTagsClass title-5', title: 'H5', value: 'h5' },
                    { className: 'styleTagsClass title-6', title: 'H6', value: 'h6' },
                    { className: 'styleTagsClass paragraph', title: 'paragraph', value: 'p' },
                ],
            });
        });
        $(document).ready(function () {
            setTimeout(function () {
                // Style dropdown button text change
                $('.note-style .dropdown-toggle')
                    .html('P <span class="caret"></span>');
            }, 300);
        });

        $('.description').on('summernote.change', function () {
            let selection = window.getSelection();
            if (!selection.rangeCount) return;

            let node = selection.anchorNode;
            if (!node) return;

            let tag = $(node).closest('h1,h2,h3,h4,h5,h6,p').prop('tagName');

            let label = 'P';
            if (tag) label = tag.toUpperCase();

            $('.note-style .dropdown-toggle').html(label + ' <span class="caret"></span>');
        });

        $(document).ready(function () {
            codeGenerate = () => {
                const code = Math.floor(100000 + Math.random() * 9000000);
                $('#product_sku').val(code);
            }
        });

        function validateImage(input) {
            const file = input.files[0];
            const errorMessage = document.getElementById('thambnailError');
            const imagePreview = document.getElementById('thambnailPreview');
            const submit = document.getElementById('submit');
            errorMessage.textContent = '';

            if (file){
                const imgSize = file.size / 1024; // size in MB
                if(imgSize > 2048){
                    errorMessage.textContent = 'Image size should be less than 2MB';
                    input.value = '';
                    imagePreview.src = '{{ asset('upload.jpg') }}';
                    submit.disabled = true;
                } else {
                    imagePreview.src = URL.createObjectURL(file);
                    submit.disabled = false;
                }
            }
        }

        $(document).ready(function () {
            // Listen for the change event on the file input
            $('#product_image').on('change', function (e) {
                // Get the selected file
                const file = e.target.files[0];

                // Create a FileReader object
                const reader = new FileReader();

                // Set up the FileReader to read the file as a data URL
                reader.onload = function (e) {
                    // Get the data URL of the image
                    const dataUrl = e.target.result;

                    // Set the src attribute of the img element to the data URL
                    $('#imagePreview').attr('src', dataUrl);
                };

                // Read the file as a data URL
                reader.readAsDataURL(file);
            });
        });

        // multiple image
        $(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').on('change', function (e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');
                var errorSelector = $('#galleryError');
                
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);

                errorSelector.text("");

                if (imgArray.length + filesArr.length > maxLength) {
                    errorSelector.text("You can only upload a maximum of " + maxLength + " images.");
                    return false;
                }

                filesArr.forEach(function (f) {
                    if (!f.type.match('image.*')) return;

                    imgArray.push(f);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var html = `
                            <div class='upload__img-box'>
                                <div style='background-image: url(${e.target.result})' data-file='${f.name}' class='img-bg'>
                                    <div class='upload__img-close'></div>
                                </div>
                            </div>`;
                        imgWrap.append(html);
                    }
                    reader.readAsDataURL(f);
                });
                
                updateInputFiles(this, imgArray);
            });

            $('body').on('click', ".upload__img-close", function (e) {
                var file = $(this).parent().data("file");
                var input = $('.upload__inputfile')[0];
                $('#galleryError').text("");
                
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
                updateInputFiles(input, imgArray);
            });

            function updateInputFiles(input, files) {
                const dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            }
        }

        // Select Tag
        $(document).ready(function () {
            $('.selectTag').select2({
                tags: true,
            });
        });
        // Select Category and Show this main Categories--> Sub Category
        $(document).ready(function () {
            $('#category_id').on('change', function () {
                let categoryId = $(this).val();
                let $subCategorySelect = $('#subCategory_id');

                $subCategorySelect.html('<option value="">Loading......</option>');

                if (categoryId) {
                    let url = "{{ route('product.subCategories', ':id') }}";
                    url = url.replace(':id', categoryId);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $subCategorySelect.empty();
                            $subCategorySelect.append('<option value="" disabled selected>Select sub-category</option>');
                            
                            $.each(data, function (key, value) {
                                $subCategorySelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                    });
                } else {
                    $subCategorySelect.empty().append('<option value="" disabled selected>Select sub-category</option>');
                    $subCategorySelect.trigger('change');
                }
            });
        });

    </script>
@endpush