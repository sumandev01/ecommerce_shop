@extends('admin.layouts.app')
@section('content')
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title d-flex justify-content-between align-items-center pt-4">
                            <h4 class="">Edit Size</h4>
                            <a href="{{ route('size.index') }}" class="btn btn-primary btn-sm">
                                <i data-lucide="arrow-left" class="mr-2" style="width: 20px; height: 20px;"></i>
                                Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('size.update', $size?->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <x-input type="text" label="Size" name="size" id="sizeName" :value="old('size', $size?->name)" :max="2" placeholder="Size" :required="true"/>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Size</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection