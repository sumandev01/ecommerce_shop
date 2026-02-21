@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-light py-4">
                    <h5>All Coupons</h5>
                </div>
                <div class="card-footer table-responsive px-3">
                    <table class="table table-bordered table-hover table-striped" id="couponTable">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Sl</th>
                                <th>Name</th>
                                <th><p>Usage /</p> Limit</th>
                                <th><p>Start Date /</p> Expiry Date</th>
                                <th>Status</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $coupons ?? [] as $key => $coupon )
                                <tr>
                                    <td style="text-align: left;">{{ $key + 1 }}</td>
                                    <td>
                                        <p class="mb-2 fs-6">{{ $coupon?->coupon_code ?? 'N/A' }}</p>
                                        <p class="mb-0 text-capitalize text-muted small">Type: 
                                            <span class="badge {{ $coupon?->coupon_type === 'percentage' ? 'bg-primary' : 'bg-warning text-dark' }} text-capitalize">{{ $coupon?->coupon_type }}</span>
                                        </p>
                                    </td>
                                    <td>
                                        <span class="mb-0 text-muted">{{ $coupon?->total_apply ?? 'N/A' }}</span> / 
                                        <span class="mb-2">{{ $coupon?->limit ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <p class="mb-2">{{ $coupon?->start_date->format('d-M-Y; h:i A') ?? 'N/A' }}</p>
                                        <p class="mb-0">{{ $coupon?->end_date->format('d-M-Y; h:i A') ?? 'N/A' }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if ($coupon->end_date > now())
                                            @if ($coupon->status == 1)
                                                <span class="badge badge-success py-2">Active</span>
                                            @else
                                                <span class="badge badge-warning py-2">Inactive</span>
                                            @endif
                                        @else
                                            <span class="badge badge-danger py-2">Expired</span>
                                        @endif
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="javascript:void(0)" data-coupon="{{ json_encode($coupon->toArray()) }}" class="btn btn-info btn-icon btn-md viewCoupon"><i data-lucide="eye"></i></a>
                                        <a href="javascript:void(0)" data-coupon="{{ json_encode($coupon->toArray()) }}" class="btn btn-warning btn-icon btn-md editCoupon"><i data-lucide="edit"></i></a>
                                        <a href="{{ route('coupon.destroy', $coupon?->id) }}" class="btn btn-danger btn-icon btn-md deleteConfirm"><i data-lucide="trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Coupons Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-light py-4">
                    <h4 class="card-title mb-0">Add New Coupon</h4>
                </div>
                <div class="card-footer">
                    <form action="{{ route('coupon.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-input label="Coupon Code" name="coupon_code" placeholder="Enter coupon code" :required="true" />
                        
                        <x-select label="Type" name="coupon_type" class="text-capitalize">
                            <option value="" disabled selected>Select Type</option>
                            @foreach ($couponTypes ?? [] as $couponType)
                                <option value="{{ $couponType }}" class="text-capitalize">{{ $couponType }}</option>
                            @endforeach
                        </x-select>

                        <x-input label="Minimum Amount" type="number" name="min_amount" placeholder="Enter minimum amount" :required="true" />

                        <x-input label="Discount" type="number" name="discount" placeholder="Enter discount" :required="true" />

                        <x-input label="Limit" type="number" name="limit" placeholder="Enter limit" :required="true" />

                        <x-input label="Start Date" name="start_date" type="datetime-local" placeholder="Enter start date" :required="true" />

                        <x-input label="Expiry Date" name="end_date" type="datetime-local" placeholder="Enter expiry date" :required="true" />

                        <button type="submit" class="btn btn-primary" id="submit">Add Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="couponEditModal" tabindex="-1" role="dialog" aria-labelledby="couponEditModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-light py-4">
                    <h5 class="modal-title">Edit Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="UpdateCoupon" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row modal-body">
                        <input type="hidden" name="update_coupon_id" id="update_coupon_id">
                        <div class="col-md-6">
                            <x-input label="Coupon Code" id="update_coupon_code" name="update_coupon_code" placeholder="Enter coupon code" :required="true" :readonly="true" />
                        </div>
                        <div class="col-md-6">
                            <x-select label="Coupon Type" name="update_coupon_type" id="update_coupon_type" class="text-capitalize">
                                <option value="" disabled selected>Select Type</option>
                                @foreach ($couponTypes ?? [] as $couponType)
                                    <option value="{{ $couponType }}" class="text-capitalize">{{ $couponType }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-6">
                            <x-input label="Minimum Amount" id="update_min_amount" type="number" name="update_min_amount" placeholder="Enter minimum amount" :required="true" />
                        </div>
                        <div class="col-md-6">
                            <x-input label="Discount" type="number" id="update_discount" name="update_discount" placeholder="Enter discount" :required="true" />
                        </div>
                        <div class="col-md-6">
                            <x-input label="Limit" type="number" id="update_limit" name="update_limit" placeholder="Enter limit" :required="true" />
                        </div>
                        <div class="col-md-6">
                            <x-select label="Status" name="update_status" id="update_status">
                                <option value="1" {{ ($coupon?->status ?? old('status')) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($coupon?->status ?? old('status')) == 0 ? 'selected' : '' }}>Inactive</option>
                        </x-select>
                        </div>
                        <div class="col-md-6">
                            <x-input label="Start Date" name="update_start_date" id="update_start_date" type="datetime-local" placeholder="Enter start date" :required="true" />
                        </div>
                        <div class="col-md-6">
                            <x-input label="Expiry Date" name="update_end_date" id="update_end_date" type="datetime-local" placeholder="Enter expiry date" :required="true" />
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

    <!-- View Modal -->
    <div class="modal fade" id="couponViewModal" tabindex="-1" role="dialog" aria-labelledby="couponViewModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-light py-4">
                    <h5 class="modal-title">View Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row modal-body p-4">
                    <h5 class="mb-3">
                        <span class="font-weight-bold">Coupon Code:</span>
                        <span class="fw-normal" id="view_code"></span>
                    </h5>
                    <h5 class="mb-3">
                        <span class="font-weight-bold">Coupon Type:</span>
                        <span class="fw-normal text-capitalize" id="view_type"></span>
                    </h5>
                    <h5 class="mb-3">
                        <span class="font-weight-bold">Minumum Amount:</span>
                        <span class="fw-normal" id="view_min_amount"></span>
                    </h5>
                    <h5 class="mb-3">
                        <span class="font-weight-bold">Discount:</span>
                        <span class="fw-normal" id="view_discount"></span>
                    </h5>
                    <h5 class="mb-3">
                        <span class="font-weight-bold">Limit:</span>
                        <span class="fw-normal" id="view_limit"></span>
                    </h5>
                    <h5 class="mb-3">
                        <span class="font-weight-bold">Total Apply:</span>
                        <span class="fw-normal" id="view_apply"></span>
                    </h5>
                    <h5 class="mb-3">
                        <span class="font-weight-bold">Start Date:</span>
                        <span class="fw-normal" id="view_start_date"></span>
                    </h5>
                    <h5 class="mb-3">
                        <span class="font-weight-bold">End Date:</span>
                        <span class="fw-normal" id="view_end_date"></span>
                    </h5>
                    <h5 class="mb-3">
                        <span class="font-weight-bold">Status:</span>
                        <span class="fw-normal" id="view_status"></span>
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready( function () {
            $('#couponTable').DataTable();
        });
        $(document).on('click', '.editCoupon', function() {
            const coupon = $(this).data('coupon');

            $("#couponEditModal").modal('show');

            $('#update_coupon_id').val(coupon.id);
            $('#update_coupon_code').val(coupon.coupon_code);
            $('#update_coupon_type').val(coupon.coupon_type);
            $('#update_min_amount').val(coupon.min_amount);
            $('#update_discount').val(coupon.discount);
            $('#update_limit').val(coupon.limit);
            $('#update_start_date').val(new Date(coupon.start_date).toISOString().slice(0, 16));
            $('#update_end_date').val(new Date(coupon.end_date).toISOString().slice(0, 16));
            $('#update_status').val(coupon.status);

            $('#UpdateCoupon').attr('action', "{{ route('coupon.update', ':id') }}".replace(':id', coupon.id));
        });

        $(document).on('click', '.viewCoupon', function() {
            const coupon = $(this).data('coupon');
            $("#couponViewModal").modal('show');
            $('#view_code').text(coupon.coupon_code);
            $('#view_type').text(coupon.coupon_type);
            $('#view_min_amount').text(coupon.min_amount);
            $('#view_discount').text(coupon.discount);
            $('#view_limit').text(coupon.limit);
            $('#view_apply').text(coupon.total_apply);
            if (coupon.status == 1) {
                $('#view_status').text('Active').addClass('bg-success p-2 text-white rounded').removeClass('bg-danger');
            } else {
                $('#view_status').text('Inactive').addClass('bg-danger p-2 text-white rounded').removeClass('bg-success');
            }
            $('#view_start_date').text(new Date(coupon.start_date).toLocaleString());
            $('#view_end_date').text(new Date(coupon.end_date).toLocaleString());

        });
    </script>
@endpush