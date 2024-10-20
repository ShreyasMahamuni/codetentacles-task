@php
    $pageTitle = 'View Product';
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
                <li class="breadcrumb-item" aria-current="page">View</li>
            </ol>
        </nav>
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.history.back();">Back</button>
    </div>

    <section class="row m-0 p-0">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h5>View</h5>
                </div>
                <div class="card-body create_form_card p-4">
                    <div class="row">
                        <div class="form-group mb-3 col-lg-8 col-md-6 col-sm-12">
                            <label class="form-label">Name</label>
                            <input class="form-control mb-2" type="text" name="name" value="{{ $product->name }}"
                                readonly />
                        </div>
                        <div class="form-group mb-3 col-lg-4 col-md-6 col-sm-12">
                            <label class="form-label">Amount</label>
                            <input class="form-control mb-2" type="number" name="amount" value="{{ $product->amount }}"
                                readonly />
                        </div>
                        <div class="form-group mb-3 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control mb-2" type="text" name="description" value="" readonly>{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group mb-3 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label">Product Image</label>
                            <div>
                                @if ($product->product_image)
                                    <img width="100" height="100"
                                        src="{{ url('storage-bucket?path=' . $product->product_image) }}" />
                                @else
                                    <img width="100" height="100" src="https://img.icons8.com/fluency/48/image--v1.png"
                                        alt="image--v1" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
