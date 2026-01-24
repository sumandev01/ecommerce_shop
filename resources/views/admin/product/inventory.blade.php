@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h5>Product Name: {{ $product->name }}</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-bordered table-hover table-striped" id="sizeTable">
                        <thead>
                            <tr>
                                <th class="text-start">Sl</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $inventories ?? [] as $key => $inventory )
                            <tr>
                                <td class="text-start ps-2">{{ $key + 1 }}</td>
                                <td class="text-center">
                                    <div style="width: 30px; height: 30px; background-color: {{ $inventory?->color?->hex_code }}; border-radius: 50%; margin: 0 auto; border: 1px solid #000"></div>
                                </td>
                                <td class="text-center"> {{ $inventory?->size?->name }} </td>
                                <td class="text-center">{{ $inventory?->quantity }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-info btn-icon btn-md editBtn" data_inventory="{{ json_encode($inventory->toArray()) }}"><i data-lucide="edit"></i></button>
                                    <a href="{{ route('inventory.destroy', $inventory?->id) }}" class="btn btn-danger btn-icon btn-md deleteConfirm"><i data-lucide="trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No Product Inventory Found</td>
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
                    <form action="{{ route('inventory.store', $product?->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product?->id }}" />

                        <div class="mb-4">
                            <x-select label="Color" name="color_id" :required="false">
                                <option value="" disabled selected>Select Color</option>
                                @foreach ($colors ?? [] as $color )
                                    <option value="{{ $color?->id }}" {{ ($color?->color_id ?? old('color')) == $color?->id ? 'selected' : '' }}>{{ $color?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">
                            <x-select label="Size" name="size_id" :required="false">
                                <option value="" disabled selected>Select Size</option>
                                @foreach ($sizes ?? [] as $size )
                                    <option value="{{ $size?->id }}" {{ ($size?->size_id ?? old('size')) == $size?->id ? 'selected' : '' }}>{{ $size?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">
                            <x-input label="Quantity" type="number" name="quantity" :required="false" placeholder="Quantity" :value="old('quantity')" />
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Add Size</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="inventoryEditModal" tabindex="-1" role="dialog" aria-labelledby="inventoryEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="inventoryUpdateForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    {{-- ami akhane form ta nibo --}}
                    <input type="hidden" name="inventory_id" value="{{ $inventory?->id }}" />
                    <div class="mb-4">
                        <x-select label="Color" name="editColor" :required="false" :disabled="true">
                            <option value="" disabled selected>Select Color</option>
                            @foreach ($colors ?? [] as $color )
                                <option value="{{ $color?->id }}" {{ ($color?->color_id ?? old('color')) == $color?->id ? 'selected' : '' }}>{{ $color?->name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="mb-4">
                        <x-select label="Size" name="editSize" :required="false" :disabled="true">
                            <option value="" disabled selected>Select Size</option>
                            @foreach ($sizes ?? [] as $size )
                                <option value="{{ $size?->id }}" {{ ($size?->size_id ?? old('size')) == $size?->id ? 'selected' : '' }}>{{ $size?->name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="mb-4">
                        <x-input label="Quantity" type="number" name="editQuantity" :required="false" placeholder="Quantity" :value="old('quantity')" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit">Update Now</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(document).ready( function () {
            $('#sizeTable').DataTable();

            $('.editBtn').on('click', function(){
                const inventory = JSON.parse($(this).attr('data_inventory'));
                const url = "{{ route('inventory.update', ':id') }}".replace(':id', inventory.id);

                $('#inventoryUpdateForm').attr('action', '');
                $('#editColor').val('');
                $('#editSize').val('');
                $('#editQuantity').val('');


                $('#inventoryEditModal').modal('show');
                $('#inventoryUpdateForm').attr('action', url);
                $('#editColor').val(inventory.color_id).trigger('change');
                $('#editSize').val(inventory.size_id).trigger('change');
                $('#editQuantity').val(inventory.quantity).trigger('change');
            });
        });
    </script>
@endpush