@extends('tmp')

@section('title', 'Project View')


@section('content')

    <!-- BEGIN: Content-->
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
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Project Details</h4>
                            <div class="page-title-right ">

                                <div class="btn-group  shadow-sm dropstart">
                                    <a href="{{ URL('/Project/Index') }}" class="btn btn-primary">Back </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <strong> Title</strong>
                                            </div>
                                            <div class="card-body" align="center">
                                                {{ $project->title }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <strong> Team Lead</strong>
                                            </div>
                                            <div class="card-body" align="center">
                                                {{ $project->teamLead->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <strong> Client</strong>
                                            </div>
                                            <div class="card-body" align="center">
                                                {{ $project->client->PartyName }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <strong> Start Date</strong>
                                            </div>
                                            <div class="card-body" align="center">
                                                {{ $project->start_date }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <strong> End Date</strong>
                                            </div>
                                            <div class="card-body" align="center">
                                                {{ $project->end_date }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <strong> Location</strong>
                                            </div>
                                            <div class="card-body" align="center">
                                                {{ $project->location }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <strong> Budget</strong>
                                            </div>
                                            <div class="card-body" align="center">
                                                AED: {{ $project->budget }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="card">
                                            <div class="card-header" align="center">
                                                <strong> Description/Overview</strong>
                                            </div>
                                            <div class="card-body" align="center">
                                                {{ $project->overview }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
