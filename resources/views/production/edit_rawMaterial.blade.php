@extends('tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="row">
                        @if (session('error'))
                            <div class="alert alert-{{ Session::get('class') }} p-3" id="success-alert">

                                <strong>{{ Session::get('error') }} </strong>
                            </div>
                        @endif
                        @if (count($errors) > 0)

                            <div>
                                <div class="alert alert-danger p-1   border-1 bg-danger text-white">
                                    <p class="font-weight-bold"> There were some problems with your input.</p>
                                    <ul>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        @endif


                        <div class="col-12">
                            <form action="{{ URL('/RawMaterialUpdate') }}" method="post">
                                <input type="hidden" name="ItemID" value="{{ $item->ItemID }}">
                                @csrf
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h2>Item</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label class="col-form-label fw-bold" for="first-name">Name</label>
                                                <input type="text" id="first-name" class="form-control" name="ItemName"
                                                    placeholder="Material Name" required value="{{ $item->ItemName }}">
                                            </div>
                                            <div class="col-4">
                                                <label class="col-form-label fw-bold" for="first-name">Unit</label>
                                                <select name="Unit" id="Unit" class="form-select" required>
                                                    <option value="">Select</option>
                                                    @foreach ($unit as $value)
                                                        <option value="{{ $value->UnitName }}"
                                                            {{ $item->UnitName == $value->UnitName ? 'selected' : '' }}>
                                                            {{ $value->UnitName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label class="col-form-label  text-danger" for="first-name">Cost
                                                    Price</label>
                                                <input type="number" id="first-name" class="form-control" name="CostPrice"
                                                    value="{{ $item->CostPrice }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">

                                        <div><button type="submit" class="btn btn-success w-lg float-right">Update</button>
                                            <a href="{{ URL('/Raw/Materials') }}"
                                                class="btn btn-secondary w-lg float-right">Cancel</a>


                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Content-->


            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                crossorigin="anonymous"></script>


            <script>
                $(document).on('change ', '#Taxable', function() {
                    if ($('#Taxable').val() == 'Yes') {
                        $("#Percentage").prop("disabled", false);
                        $("#Percentage").focus();
                        $("#Percentage").attr("placeholder", "5").placeholder();

                    } else {
                        $("#Percentage").prop("disabled", true);
                        $("#Percentage").removeAttr("placeholder");
                    }



                });
            </script>






            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#student_table').DataTable();
                });
            </script>

        @endsection
