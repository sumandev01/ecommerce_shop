@extends('admin.layouts.app')
@section('content')
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-header bg-light py-4">
                        <div class="card-title d-flex justify-content-between align-items-center mb-0">
                            <h5 class="">Edit Tag</h5>
                            <a href="{{ route('tag.index') }}" class="btn btn-primary btn-sm">
                                <i data-lucide="arrow-left" class="mr-2" style="width: 20px; height: 20px;"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tag.update', $tag?->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="tagName" class="form-label">Tag Name</label>
                                <input type="text" id="tagName" name="tag" class="form-control mb-3" value="{{ old('tag', $tag?->name) }}" placeholder="Tag Name">
                                @error('tag')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror                                    
                            </div>
                            <button type="submit" class="btn btn-primary">Update Tag</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection