@extends('admin.layouts.app')
@section('content')
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title d-flex justify-content-between align-items-center pt-4">
                            <h4 class="">Edit Category</h4>
                            <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm">
                                <i data-lucide="arrow-left" class="mr-2" style="width: 20px; height: 20px;"></i>
                                Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category.update', $category?->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input type="text" id="categoryName" name="name" class="form-control mb-3" value="{{ old('name', $category?->name) }}" placeholder="Category Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror                                    
                                </div>
                                <div class="mb-4">
                                    <label for="categorySlug" class="form-label">Category Slug</label>
                                    <input type="text" id="categorySlug" name="slug" class="form-control mb-3" value="{{ old('slug', $category?->slug) }}" placeholder="Category Slug">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="categoryImage" class="form-label">Category Image</label>
                                    <img src="{{ $category->thumbnail }}" alt="" class="mb-2" style="width: 150px; height: 100px; display: block;" id="imagePreview">
                                    <input type="file" id="categoryImage" name="image" class="form-control mb-3" onchange="validateImage(this)">
                                    <span class="text-danger" id="imageError"></span>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('script')
    <script>
        function validateImage(input) {
            const file = input.files[0];
            const errorMessage = document.getElementById('imageError');
            const imagePreview = document.getElementById('imagePreview');
            errorMessage.textContent = '';

            if (file){
                const imgSize = file.size / 1024; // size in MB
                if(imgSize > 2048){
                    errorMessage.textContent = 'Image size should be less than 2MB';
                    input.value = '';
                    // imagePreview.src = '{{ asset('default.webp') }}';
                } else {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>