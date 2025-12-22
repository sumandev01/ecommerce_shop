@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>All Sub Categories</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display" id="subCategoryTable">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Sl</th>
                                <th>Category Name</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th style="text-align: center;">Image</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $subCategories ?? [] as $key => $subCategory )
                                <tr>
                                    <td style="text-align: left;">{{ $key + 1 }}</td>
                                    <td> {{ $subCategory->category->name }} </td>
                                    <td> {{ $subCategory->name }} </td>
                                    <td> {{ $subCategory->slug }} </td>
                                    <td style="text-align: center;"><img src="{{ $subCategory->thumbnail }}" alt="{{ $subCategory->alt }}"></td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('subcategory.edit', $subCategory?->id) }}" class="btn btn-info btn-icon btn-md"><i data-lucide="edit"></i></a>
                                        <a href="{{ route('subcategory.destroy', $subCategory?->id) }}" class="btn btn-danger btn-icon btn-md deleteConfirm"><i data-lucide="trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Categories Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Sub Category</h4>
                </div>
                <div class="card-footer">
                    <form action="{{ route('subcategory.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="subCategoryName" class="form-label">Sub-Category Name</label>
                            <input type="text" id="subCategoryName" name="name" class="form-control mb-3" placeholder="Sub-Category Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb">
                            <label for="subCategorySlug" class="form-label">Sub-Category Slug</label>
                            <input type="text" id="subCategorySlug" name="slug" class="form-control mb-3" placeholder="Sub-Category Slug">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" name="category" class="form-control mb-3">
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="subCategoryImage" class="form-label">Sub-Category Image</label>
                            <img src="{{ asset('default.webp') }}" alt="" class="mb-2" style="width: 150px; height: 100px; display: block;" id="subCategoryImagePreview">
                            <input type="file" id="subCategoryImage" name="image" class="form-control mb-3" onchange="validateImage(this)">
                            <span class="text-danger" id="imageError"></span>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready( function () {
            $('#subCategoryTable').DataTable();
        } );

        function validateImage(input) {
            const file = input.files[0];
            const errorMessage = document.getElementById('imageError');
            const imagePreview = document.getElementById('subCategoryImagePreview');
            const submit = document.getElementById('submit');
            errorMessage.textContent = '';

            if (file){
                const imgSize = file.size / 1024; // size in MB
                if(imgSize > 2048){
                    errorMessage.textContent = 'Image size should be less than 2MB';
                    input.value = '';
                    imagePreview.src = '{{ asset('default.webp') }}';
                    submit.disabled = true;
                } else {
                    imagePreview.src = URL.createObjectURL(file);
                    submit.disabled = false;
                }
            }
        }
    </script>
@endpush