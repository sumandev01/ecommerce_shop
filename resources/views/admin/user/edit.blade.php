@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Edit User</h4>
                            <a href="{{ route('user.index') }}" class="btn btn-primary">
                                <x-lucide-arrow-left style="width: 20px; height: 20px;" class="mr-2" />
                                Back to Users
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold h5 mb-2">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold h5 mb-2">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="userImage" class="form-label fw-bold h5 mb-2">User Image</label>
                                <img src="{{ $user->thumbnail }}" alt="" class="mb-2"
                                    style="width: 60px; height: 60px; border: 3px solid #a5a5a5a6; border-radius: 50%; display: block;"
                                    id="imagePreview">
                                <input type="file" id="userImage" name="image" class="form-control mb-3"
                                    onchange="validateImage(this)">
                                <span class="text-danger" id="imageError"></span>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="role" class="form-label fw-bold h5 mb-2">Role</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="" disabled>Select Role</option>
                                    @foreach ($roles ?? [] as $role)
                                        <option value="{{ $role->name }}"
                                            {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary btn-md">
                                <x-lucide-save style="width: 20px; height: 20px;" class="mr-2" />
                                Update User
                            </button>
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
            const submit = document.getElementById('submit');
            errorMessage.textContent = '';

            if (file) {
                const imgSize = file.size / 1024; // size in MB
                if (imgSize > 2048) {
                    errorMessage.textContent = 'Image size should be less than 2MB';
                    input.value = '';
                    imagePreview.src = '{{ asset('user.png') }}';
                    submit.disabled = true;
                } else {
                    imagePreview.src = URL.createObjectURL(file);
                    submit.disabled = false;
                }
            }
        }
        document.getElementById('passwordIcon').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const iconContainer = this;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconContainer.innerHTML = '<i data-lucide="eye-off"></i>';
            } else {
                passwordInput.type = 'password';
                iconContainer.innerHTML = '<i data-lucide="eye"></i>';
            }

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        })
    </script>
@endpush
