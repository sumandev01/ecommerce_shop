@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header display-flex justify-content-between align-items-center bg-light px-4">
                    <div class="card-title d-flex justify-content-between align-items-center py-3 mb-0">
                        <h5 class="">All Users</h5>
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                            <x-lucide-user-plus style="width: 20px; height: 20px;" class="mr-2" />
                            Add User
                        </a>
                    </div>
                </div>
                <div class="card-body py-2">
                    <form action="">
                        <div class="row justify-content-end">
                            <div class="col-lg-4 col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search"
                                        value="{{ request('search') }}" autocomplete="off" required>
                                    <div class="input-group-append ms-1">
                                        <button class="btn btn-primary" type="submit">
                                            search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <table class="table table-bordered table-hover table-striped" id="categoryTable">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th style="text-align: center;">Role</th>
                                <th style="text-align: center;">Image</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users ?? [] as $key => $user)
                                <tr>
                                    <td style="text-align: left;">{{ $key + 1 }}</td>
                                    <td> {{ $user?->name }} </td>
                                    <td> {{ $user?->email }} </td>
                                    <td style="text-align: center;">
                                        <span class="badge badge-success py-2">{{ $user?->getRoleNames()->first() }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        <img src="{{ $user?->thumbnail }}">
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('user.edit', $user?->id) }}"
                                            class="btn btn-info btn-icon btn-md">
                                            <x-lucide-edit /></a>
                                        <button class="btn btn-warning btn-icon btn-md" data-bs-toggle="modal"
                                            data-bs-target="#resetPasswordModal{{ $user->id }}">
                                            <x-lucide-key-round />
                                        </button>
                                        {{-- <a href="{{ route('user.destroy', $user?->id) }}" class="btn btn-danger btn-icon btn-md deleteConfirm"><i data-lucide="trash"></i></a> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Users Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
