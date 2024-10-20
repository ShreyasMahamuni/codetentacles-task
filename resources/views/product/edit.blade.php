@php
    $pageTitle = 'Edit Product';
@endphp
@extends('layout.master')
@push('css')
    <style>
        .create_form_card {
            height: 400px;
            overflow: auto;
            scrollbar-width: thin;
        }
    </style>
@endpush
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/product') }}">Product</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit</li>
            </ol>
        </nav>
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.history.back();">Back</button>
    </div>

    <section class="row m-0 p-0">
        <div class="col-lg-12">
            <div class="card">
                <form class="" method="POST" action="{{ url('/product/' . $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h5>Edit</h5>
                    </div>
                    <div class="card-body create_form_card p-4">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-8 col-md-6 col-sm-12">
                                <label class="form-label">Name <span class="text-danger"> *</span></label>
                                <input class="form-control mb-2" type="text" name="name"
                                    value="{{ old('name', $product->name) }}" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-4 col-md-6 col-sm-12">
                                <label class="form-label">Amount <span class="text-danger"> *</span></label>
                                <input class="form-control mb-2" type="number" name="amount" step="0.01"
                                    value="{{ old('amount', $product->amount) }}" />
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-12 col-md-12 col-sm-12">
                                <label class="form-label">Description <span class="text-danger"> *</span></label>
                                <textarea class="form-control mb-2" type="text" name="description" value="">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-12 col-md-12 col-sm-12">
                                <label class="form-label">Product Image</label>
                                <input class="form-control mb-2" type="file" name="product_image" id="productImage"
                                    accept=".jpg,.jpeg,.png">
                                <span id="error-message" class="text-danger"></span>
                                @error('product_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div>
                                    @if ($product->product_image)
                                        <img width="100" height="100"
                                            src="{{ url('storage-bucket?path=' . $product->product_image) }}" />
                                        <button type="button" data-id="{{ $product->id }}" class="btn text-danger"
                                            id="deleteImage"><i class="bi bi-trash-fill"></i></button>
                                    @else
                                        <img width="100" height="100"
                                            src="https://img.icons8.com/fluency/48/image--v1.png" alt="image--v1" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success btn-md">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var baseUrl = "{{ url('/') }}"
        $('#deleteImage').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl + '/delete-product-image/' + id,
                type: 'GET',
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.log('Error deleting image: ' + xhr.responseText);
                }
            });
        });

        $('#productImage').on('change', function(event) {
            const file = event.target.files[0];
            const errorMessage = $('#error-message');
            errorMessage.text('');

            if (!file) {
                return;
            }

            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(file.name)) {
                errorMessage.text('Invalid file type. Please upload an image in JPG, JPEG, or PNG format.');
                $(this).val('');
                return;
            }
        });
    </script>
@endpush
