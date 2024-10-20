@php
    $pageTitle = 'Product List';
@endphp
@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <style>
        .ellipsis {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100px;
        }

        .create_form_card {
            height: 400px;
            overflow: auto;
            scrollbar-width: thin;
        }

        .btn-delete {
            cursor: pointer;
        }

        a {
            text-decoration: none;
        }
    </style>
@endpush
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item">List</li>
            </ol>
        </nav>
        <button type="button" class="btn btn-outline-primary btn-sm"
            onclick="window.location.href='{{ url('/product/create') }}';">Add Product</button>
    </div>
    <section class="row m-0 p-0">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($product as $value)
                        <tr>
                            <td>{{ $value->name }}</td>
                            <td class="ellipsis">{{ $value->description }}</td>
                            <td>{{ $value->amount }}</td>
                            <td>
                                <div class="">
                                    <div class="dropdown">
                                        <a class="text-danger px-1 btn-delete" data-id="{{ $value->id }}">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                        <a class="text-warning px-1" href="{{ url('product/' . $value->id . '/edit') }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a class="text-primary px-1" href="{{ url('product/' . $value->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="d-flex justify-content-center">
                    {{ $product->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"
        integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var baseUrl = "{{ url('/') }}";
        $('#productImage').on('change', function(event) {
            const file = event.target.files[0];
            const errorMessage = $('#error-message');
            errorMessage.text(''); // Clear any previous error message
            if (!file) {
                return;
            }
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(file.name)) {
                errorMessage.text('Invalid file type. Please upload an image in JPG, JPEG, or PNG format.');
                $(this).val(''); // Clear the file input
                return;
            }
        });

        $('.btn-delete').on('click', function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let deleteUrl = baseUrl + '/product/' + id;

            $.confirm({
                title: 'Confirm Delete',
                content: 'Are you sure you want to delete this item?',
                type: 'red',
                buttons: {
                    confirm: {
                        text: 'Yes',
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: deleteUrl,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log('Item deleted successfully');
                                    location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                    $.alert('An error occurred while deleting the item.');
                                }
                            });
                        }
                    },
                    cancel: function() {
                        console.log('Delete action canceled by user.');
                    }
                }
            });
        });
    </script>
@endpush
