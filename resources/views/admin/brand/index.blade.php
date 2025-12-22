@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h5>All Brands</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display stripe" id="brandTable">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Sl</th>
                                <th>Brand Name</th>
                                <th>Brand Slug</th>
                                <th style="text-align: center;">Brand Image</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $brands ?? [] as $key => $brand )
                                <tr>
                                    <td style="text-align: left;">{{ $key + 1 }}</td>
                                    <td> {{ $brand->name }} </td>
                                    <td> {{ $brand->slug }} </td>
                                    <td style="text-align: center;"><img src="{{ $brand->thumbnail }}" alt="{{ $brand->alt }}"></td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('brand.edit', $brand?->id) }}" class="btn btn-info btn-icon btn-md"><i data-lucide="edit"></i></a>
                                        <a href="{{ route('brand.destroy', $brand?->id) }}" class="btn btn-danger btn-icon btn-md deleteConfirm"><i data-lucide="trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Brands Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Brand</h4>
                </div>
                <div class="card-footer">
                    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="brandName" class="form-label">Brand Name</label>
                            <input type="text" id="brandName" name="name" class="form-control mb-3" placeholder="Brand Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb">
                            <label for="brandSlug" class="form-label">Brand Slug</label>
                            <input type="text" id="brandSlug" name="slug" class="form-control mb-3" placeholder="Brand Slug">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="brandImage" class="form-label">Brand Image</label>
                            <img src="{{ asset('default.webp') }}" alt="" class="mb-2" style="width: 150px; height: 100px; display: block;" id="imagePreview">
                            <input type="file" id="brandImage" name="image" class="form-control mb-3" onchange="validateImage(this)">
                            <span class="text-danger" id="imageError"></span>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Add Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready( function () {
            $('#brandTable').DataTable();
        })
        function validateImage(input) {
            const file = input.files[0];
            const errorMessage = document.getElementById('imageError');
            const imagePreview = document.getElementById('imagePreview');
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