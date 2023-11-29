@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
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
                        <form action="{{ URL('/RawMaterialSave') }}" method="post">
                            @csrf
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h2>Raw Materials</h2>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <div class="col-4">
                                            <label class="col-form-label fw-bold" for="first-name">Name</label>
                                            <input type="text" id="first-name" class="form-control" name="ItemName"
                                                placeholder="Material Name" required>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label fw-bold" for="first-name">Unit</label>
                                            <select name="Unit" id="Unit" class="form-select" required>
                                                <option value="0">Select</option>
                                                @foreach ($unit as $value)
                                                    <option value="{{ $value->UnitName }}">{{ $value->UnitName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label class="col-form-label  text-danger" for="first-name">Cost
                                                Price</label>
                                            <input type="number" id="first-name" class="form-control" name="CostPrice"
                                                value="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success w-lg float-right">Save</button>
                                    {{-- <a href="{{ URL('/') }}" class="btn btn-secondary w-lg float-right">Cancel</a> --}}
                                </div>
                            </div>

                    </div>
                    </form>
                    <!-- card end here -->
                    <div class="card">
                        <div class="card-body">
                            @if (count($item) > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped  table-sm  m-0" id="student_table">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Cost Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item as $key => $value)
                                                <tr>
                                                    <td class="col-md-">{{ $key + 1 }}</td>
                                                    <td class="col-md-7">{{ $value->ItemName }}</td>
                                                    <td class="col-md-2">{{ $value->UnitName }}</td>
                                                    <td class="col-md-2">{{ $value->CostPrice }}</td>
                                                    <td class="col-md-2"><a
                                                            href="{{ URL('/RawMaterialEdit/' . $value->ItemID) }}"><i
                                                                class=" text-dark bx bx-pencil align-middle me-1"></i></a>
                                                        <a href="#"
                                                            onclick="delete_confirm2('RawMaterialDelete',{{ $value->ItemID }})"><i
                                                                class="bx bx-trash text-dark  align-middle me-1"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class=" text-danger">No data found</p>
                            @endif
                        </div>
                    </div>




                    {{-- <div class="card">
                        <div class="card-header bg-secondary bg-soft">Import Bulk Data</div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" action="{{ url('/ItemImport') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <table class="table">
                                        <tr>
                                            <td width="40%" align="right"><label>Select File for Upload</label>
                                            </td>
                                            <td width="30">
                                                <input type="file" name="file1" class="form-control" required>
                                            </td>
                                            <td width="30%" align="left">
                                                <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%" align="right"></td>
                                            <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                                            <td width="30%" align="left"></td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div> --}}



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

    <!-- <script>
        window.onbeforeunload = function() {
            return 'Your changes will be lost!';
        };
    </script> -->





@endsection
