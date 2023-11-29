@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-print-block d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Employee</h4>
                        </div>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div>
                        <div class="alert alert-danger p-1   border-3">
                            <p class="font-weight-bold"> There were some problems with your input.</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header bg-transparent border-bottom">
                        {{-- <small class="italic text-info">Please note that fields marked with an asterisk (*) are required.</small> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{ URL('/EmployeeSave') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Name *</label>
                                        <input type="text" class="form-control" name="EmployeeName"
                                            value="{{ old('EmployeeName') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Mobile</label>
                                        <input type="text" class="form-control" name="Mobile"
                                            value="{{ old('Mobile') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Address</label>
                                        <input type="text" class="form-control" name="Address"
                                            value="{{ old('Address') }} ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Designation *</label>
                                        <select name="designation" id="designation" class="form-control" required>
                                            <option value="">--Select Role--</option>
                                            <option value="TeamLead">TeamLead</option>
                                            <option value="TeamMember">Team Member</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 d-none" id="teamLeadDiv">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Team Lead *</label>
                                        <select name="team_lead_id" id="team_lead_id" class="form-control" required>
                                            <option value="">--Select Team Lead--</option>
                                            @foreach ($teamLeads as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success w-lg float-right">Save</button>
                                {{-- <a href="{{ URL('/Salesman') }}" class="btn btn-secondary w-lg float-right">Cancel</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm align-middle table-nowrap mb-0" id="employee_table">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">S.No</th> --}}
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Team Lead Name</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#employee_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ url('Employee') }}",
                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "mobile"
                    },
                    {
                        "data": "address"
                    },
                    {
                        "data": "designation"
                    },
                    {
                        "data": "teamLeadName"
                    },
                    // {
                    //     "data": "action"
                    // },
                ],
                "order": [
                    [0, 'desc']
                ],
            });
            $('#designation').change(function() {
                var designation = $(this).val();
                if (designation == "TeamLead") {
                    $('#teamLeadDiv').addClass('d-none');
                    $('#team_lead_id').prop('required', false);
                } else if (designation == "TeamMember") {
                    $('#teamLeadDiv').removeClass('d-none');
                    $('#team_lead_id').prop('required', true);
                } else {
                    $('#teamLeadDiv').addClass('d-none');
                    $('#team_lead_id').prop('required', true);
                }
            });
            $('#addTeamButton').click(function() {
                $('#exampleModal').modal('show');
            });
            $('.close').click(function() {
                $('#exampleModal').modal('hide');
            });
        });
    </script>
@endsection
