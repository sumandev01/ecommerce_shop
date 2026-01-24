@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h5>All Tags</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-bordered table-hover table-striped" id="tagTable">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Sl</th>
                                <th>Tag</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $tags ?? [] as $key => $tag )
                                <tr>
                                    <td style="text-align: left;">{{ $key + 1 }}</td>
                                    <td> {{ $tag?->name }} </td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('tag.edit', $tag?->id) }}" class="btn btn-info btn-icon btn-md"><i data-lucide="edit"></i></a>
                                        <a href="{{ route('tag.destroy', $tag?->id) }}" class="btn btn-danger btn-icon btn-md deleteConfirm"><i data-lucide="trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Tags Found</td>
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
                    <h4 class="card-title">Add New Tag</h4>
                </div>
                <div class="card-footer">
                    <form action="{{ route('tag.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="tagName" class="form-label">Tag</label>
                            <input type="text" id="tagName" name="tag" class="form-control mb-3" placeholder="Tag">
                            @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Add Tag</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready( function () {
            $('#tagTable').DataTable();
        });
    </script>
@endpush