@php
    $pageTitle = 'Add Product';
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
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/product') }}">Product</a></li>
                <li class="breadcrumb-item" aria-current="page">Add</li>
            </ol>
        </nav>
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.history.back();">Back</button>
    </div>
    <section class="row m-0 p-0">
        <div class="col-lg-12">
            <div class="card">
                <form class="" method="POST" action="{{ url('/product') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h5>Add</h5>
                    </div>
                    <div class="card-body create_form_card p-4">
                        <div class="row">
                            <div class="form-group mb-3 col-lg-8 col-md-6 col-sm-12">
                                <label class="form-label">Name <span class="text-danger"> *</span></label>
                                <input class="form-control mb-2" type="text" name="name"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-4 col-md-6 col-sm-12">
                                <label class="form-label">Amount <span class="text-danger"> *</span></label>
                                <input class="form-control mb-2" type="number" name="amount" step="0.01"
                                    value="{{ old('amount') }}" />
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-12 col-md-12 col-sm-12">
                                <label class="form-label">Description <span class="text-danger"> *</span></label>
                                <textarea class="form-control mb-2" type="text" name="description" value="{{ old('description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-lg-12 col-md-12 col-sm-12">
                                <label class="form-label">Product Image</label>
                                <h6><small class="form-label text-primary">Accept Format Only: JPG, JPEG, PNG</small></h6>
                                <input class="form-control mb-2" type="file" name="product_image" id="productImage"
                                    accept=".jpg,.jpeg,.png">
                                <span id="error-message" class="text-danger"></span>
                                @error('product_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success btn-md">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
