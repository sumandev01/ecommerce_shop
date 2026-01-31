@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Edit Product</h4>
                            <a href="{{ route('product.index') }}" class="btn btn-secondary">
                                <i data-lucide="arrow-left" class="me-1" style="width: 18px;"></i> Back to Products
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">
                           <strong>Note:</strong> Please fill in the basic product details and **Update** the product. You will be able to add sizes, colors, or other **Variants** once the product is successfully created or updated.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('product.update', $product?->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <!-- Main Card -->
                    <div class="card mb-4">
                        <div class="card-header py-4 bg-light">
                            <h4 class="card-title mb-0">Product Information</h4>
                        </div>
                        <div class="card-body">
                            <x-input label="Product Name" name="name" placeholder="Enter product name"
                                :required="true" :value="$product?->name" />

                            <x-input label="Slug" name="slug" placeholder="Enter product slug" :required="true"
                                :value="$product?->slug" />
                            
                            <x-textarea label="Short Description" name="shortDescription"
                                placeholder="Enter product short description......" :required="true" :max="500"
                                :rows="10" :editor="false" :value="$product?->details?->short_description" />

                            <x-select class="selectTag w-100" multiple="multiple" label="Tags" name="tag[]">
                                @foreach ($tags ?? [] as $tag)
                                    <option value="{{ $tag?->id }}" {{ in_array($tag?->id, $product?->tags?->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header py-4 bg-light">
                            <h4 class="card-title mb-0">Product Detailed Description</h4>
                        </div>
                        <div class="card-body">
                            <x-textarea name="description" label="Full Description" :editor="true" :rows="10"
                                :max="1500" :value="$product?->details?->long_description" />
                            <x-textarea name="additional_info" label="Additional Information" :editor="true"
                                :rows="10" :max="1500" :value="$product?->details?->additional_info" />
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header py-4 bg-light">
                            <h4 class="card-title mb-0">Product Gallery</h4>
                        </div>
                        <div class="card-body">
                            <x-media-picker type="gallery" name="product_images" :limit="8" :existingData="$product?->galleries" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-4 bg-light">
                            <h4 class="card-title mb-0">Pricing & Inventory</h4>
                        </div>
                        <div class="card-body">
                            <x-input label="Buy Price" name="buy_price" type="number" placeholder="Enter buy price"
                                :required="false" :max="5" :value="$product?->buy_price" />
                            <x-input label="Selling Price" name="price" type="number" placeholder="Enter product price"
                                :required="false" :max="5" :value="$product?->price" />
                            <x-input label="Discounted Price" name="discounted_price" type="number"
                                placeholder="Enter discounted price" :max="5" :value="$product?->discount_price" />
                            <x-input label="SKU" name="sku" id="product_sku" placeholder="Product SKU"
                                :required="false" :counter="false" :value="$product?->sku_code"
                                append='<button class="btn btn-secondary" type="button" onclick="codeGenerate()">Generate</button>' />
                            <x-input label="Stock Quantity" name="stock_quantity" type="number"
                                placeholder="Enter stock quantity" :required="false" :max="5" :value="$product?->stock" />
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header py-4 bg-light">
                            <h4 class="card-title mb-0">Organization</h4>
                        </div>
                        <div class="card-body">
                            <x-select label="Category" name="category" id="category_id" :required="false">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category?->id }}" 
                                        {{ ($product?->details?->category_id ?? old('category')) == $category?->id ? 'selected' : '' }}>
                                        {{ $category?->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-select label="Sub Category" id="subCategory_id" name="subCategory" :required="false" data-selected="{{ $product->details?->sub_category_id ?? old('subCategory') }}">
                                <option value="">Select Sub-Category</option>
                            </x-select>
                            <x-select label="Brand" name="brand">
                                <option value="" disabled selected>Select Brand</option>
                                @foreach ($brands ?? [] as $brand)
                                    <option value="{{ $brand?->id }}" {{ ($product?->details?->brand_id ?? old('brand')) == $brand?->id ? 'selected' : '' }}>{{ $brand?->name }}</option>
                                @endforeach
                            </x-select>
                            <x-select label="Status" name="status">
                                <option value="1" {{ ($product?->status ?? old('status')) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($product?->status ?? old('status')) == 0 ? 'selected' : '' }}>Inactive</option>
                            </x-select>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header py-4 bg-light">
                            <h4 class="card-title mb-0">Thumbnail</h4>
                        </div>
                        <div class="card-body">
                            <x-media-picker type="thumbnail" name="thumbnail" :limit="1" :existingData="$product?->thumbnail" />
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <button type="submit" id="submit" class="btn btn-primary px-5">
                                Submit Product
                                <i data-lucide="arrow-right" class="ms-1" style="width: 18px;"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
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

            if (file) {
                const imgSize = file.size / 1024;
                if (imgSize > 2048) {
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

        $(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').on('change', function(e) {
                imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                var maxLength = $(this).attr('data-max_length');
                var errorSelector = $('#galleryError');
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                errorSelector.text("");

                if (imgArray.length + filesArr.length > maxLength) {
                    errorSelector.text("Maximum " + maxLength + " images allowed.");
                    return false;
                }

                filesArr.forEach(function(f) {
                    if (!f.type.match('image.*')) return;
                    imgArray.push(f);
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // Using inline styles for the gallery preview items as per standard behavior
                        var html = `
                            <div class='position-relative' style='width: 100px; height: 100px;'>
                                <div style='background-image: url(${e.target.result}); width: 100%; height: 100%; background-size: cover; background-position: center;' class='border rounded' data-file='${f.name}'>
                                    <button type='button' class='btn btn-danger btn-sm position-absolute upload__img-close' style='top: -5px; right: -5px; width: 20px; height: 20px; padding: 0; font-size: 10px; border-radius: 50%;'></button>
                                </div>
                            </div>`;
                        imgWrap.append(html);
                    }
                    reader.readAsDataURL(f);
                });
                updateInputFiles(this, imgArray);
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                var input = $('.upload__inputfile')[0];
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).closest('.position-relative').remove();
                updateInputFiles(input, imgArray);
            });

            function updateInputFiles(input, files) {
                const dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                input.files = dataTransfer.files;
            }
        }

    $(document).ready(function () {
        $('.selectTag').select2({
            tags: true,
            placeholder: "Add tags..."
        });

        const alreadySelectedSubCat = "{{ $product->details?->sub_category_id ?? '' }}";
        const initialCategoryId = $('#category_id').val();

        function fetchSubCategories(categoryId, selectedId = null) {
            let $subCategorySelect = $('#subCategory_id');
            if (categoryId) {
                let url = "{{ route('product.subCategories', ':id') }}";
                url = url.replace(':id', categoryId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () { $subCategorySelect.html('<option value="">Loading...</option>'); },
                    success: function (data) {
                        $subCategorySelect.empty().append('<option value="">Select sub-category</option>');
                        $.each(data, function (key, value) {
                            let isSelected = (String(selectedId) === String(value.id)) ? 'selected' : '';
                            $subCategorySelect.append('<option value="' + value.id + '" ' + isSelected + '>' + value.name + '</option>');
                        });
                    }
                });
            }
        }

        if (initialCategoryId) fetchSubCategories(initialCategoryId, alreadySelectedSubCat);
        $('#category_id').on('change', function () { fetchSubCategories($(this).val()); });
    });
    </script>
@endpush