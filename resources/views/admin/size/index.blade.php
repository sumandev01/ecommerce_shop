@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h5>All Sizes</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-bordered table-hover table-striped" id="sizeTable">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Sl</th>
                                <th>Size</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $sizes ?? [] as $key => $size )
                                <tr>
                                    <td style="text-align: left;">{{ $key + 1 }}</td>
                                    <td> {{ $size?->name }} </td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('size.edit', $size?->id) }}" class="btn btn-info btn-icon btn-md"><i data-lucide="edit"></i></a>
                                        <a href="{{ route('size.destroy', $size?->id) }}" class="btn btn-danger btn-icon btn-md deleteConfirm"><i data-lucide="trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Sizes Found</td>
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
                    <h4 class="card-title">Add New Size</h4>
                </div>
                <div class="card-footer">
                    <form action="{{ route('size.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input type="text" label="Size" name="size" id="sizeName" :value="old('size')" :max="2" placeholder="Size" :required="true"/>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Add Size</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready( function () {
            $('#sizeTable').DataTable();
        });
    </script>
@endpush