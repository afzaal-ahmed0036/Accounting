@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">All Products</h4>
                            <div class="page-title-right ">

                                <div class="btn-group  shadow-sm dropstart">
                                    <a href="{{ URL('/Product/Create') }}" class="btn btn-primary"> + New </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
                        <script type="text/javascript">
                            function delete_confirm2(url, id) {
                                url = '{{ URL::TO('/') }}/' + url + '/' + id;
                                jQuery('#staticBackdrop').modal('show', {
                                    backdrop: 'static'
                                });
                                document.getElementById('delete_link').setAttribute('href', url);
                            }
                        </script>
                        @if (session('error'))
                            <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">
                                <strong>{{ Session::get('error') }} </strong>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div>
                                <div class="alert alert-danger p-1 border-1 bg-danger text-white">
                                    <p class="font-weight-bold"> There were some problems with your input.</p>
                                    <ul>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- card end here -->
                    <div class="card">
                        <div class="card-body">
                            {{-- @if (count($products) > 0) --}}
                            <div class="table-responsive">
                                <table class="table table-striped  table-sm  m-0" id="student_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $value)
                                            <tr>
                                                <td class="col-md-">{{ $key + 1 }}</td>
                                                <td class="col-md-7">{{ $value->ItemName }}</td>
                                                <td class="col-md-2">{{ $value->SellingPrice }}</td>
                                                <td class="col-md-2">{{ $value->description }}</td>
                                                <td class="col-md-2">
                                                    <a href="{{ URL('Product/View/' . $value->ItemID) }}"><i
                                                            class=" text-dark fa fa-eye align-middle me-1"></i></a>
                                                    <a href="{{ URL('Product/Edit/' . $value->ItemID) }}"><i
                                                            class=" text-dark bx bx-pencil align-middle me-1"></i></a>
                                                    <a href="#"
                                                        onclick="delete_confirm2('Product/Delete',{{ $value->ItemID }})"><i
                                                            class="bx bx-trash text-dark  align-middle me-1"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- @else
                                <p class=" text-danger">No data found</p>
                            @endif --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#student_table').DataTable();
        });
    </script>

    <!-- my own model -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure to delete this information ?</p>
                    <p class="text-center">
                        <a href="#" class="btn btn-danger " id="delete_link">Delete</a>
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end of my own model -->

    {{-- <script>
        window.onbeforeunload = function() {
            return 'Your changes will be lost!';
        };
    </script> --}}





@endsection
