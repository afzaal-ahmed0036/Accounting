@extends('template.tmp')
@section('title', $pagetitle)

@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @if (session('error'))
                    <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">
                        <strong>{{ Session::get('error') }} </strong>
                    </div>
                @endif
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}
                    </div>
                @endif
                @if (session()->has('not_permitted'))
                    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                            data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
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
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">All Projects</h4>
                            <div class="page-title-right ">

                                <div class="btn-group  shadow-sm dropstart">
                                    <a href="{{ URL('/Project/Create') }}" class="btn btn-primary"> + New </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="student_table" class="table table-striped table-sm " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Team Lead</th>
                                            <th>Client</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Location</th>
                                            <th>Budget</th>
                                            <th>Action</th>

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
        </div>
    </div>
    <!-- END: Content-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#student_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ url('Project/Index') }}",
                "columns": [{
                        "data": "title"
                    },
                    {
                        "data": "teamleadName"
                    },
                    {
                        "data": "clientName"
                    },
                    {
                        "data": "start_date"
                    },

                    {
                        "data": "end_date"
                    },
                    {
                        "data": "location"
                    },
                    {
                        "data": "budget"
                    },


                    {
                        "data": "action"
                    },
                ],
                "order": [
                    [0, 'desc']
                ],
            });
        });
    </script>

@endsection
