@extends('tmp')

@section('title', $pagetitle)


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
                            <h4 class="mb-sm-0 font-size-18">Update Project Details</h4>
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
                                <form class="row g-3 mb-6" action="{{ url('Project/Update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <div class="col-sm-6 col-md-8">
                                        <div class="form-floating">
                                            <input class="form-control" id="floatingInputGrid" type="text"
                                                placeholder="Project title" name="title" required
                                                value="{{ $project->title }}">
                                            <label for="floatingInputGrid">Project title</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-floating">
                                            <select name="task_view" class="form-select" id="floatingSelectTask">
                                                <option selected="selected">Select task view</option>
                                                <option value="1" {{ $project->task_view == 1 ? 'selected' : '' }}>
                                                    technical</option>
                                                <option value="2" {{ $project->task_view == 2 ? 'selected' : '' }}>
                                                    external</option>
                                                <option value="3" {{ $project->task_view == 3 ? 'selected' : '' }}>
                                                    organizational</option>
                                            </select>
                                            <label for="floatingSelectTask">Defult task view</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-floating">
                                            <select name="team_lead_id" class="form-select" id="floatingSelectAdmin">
                                                <option selected="selected">Select Team Lead</option>
                                                @foreach ($teamLeads as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $project->team_lead_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelectAdmin">Project Lead</label>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6 col-md-4">
                                        <div class="flatpickr-input-container">
                                            <div class="form-floating"><input
                                                    class="form-control datetimepicker flatpickr-input"
                                                    id="floatingInputStartDate" type="text" placeholder="end date"
                                                    data-options="{&quot;disableMobile&quot;:true}"
                                                    readonly="readonly"><label class="ps-6"
                                                    for="floatingInputStartDate">Start date</label><span
                                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6 col-md-4">
                                        <div class="flatpickr-input-container">
                                            <div class="form-floating" id="startDate">
                                                <input type="date" name="start_date" autocomplete="off"
                                                    class="form-control" value="{{ $project->start_date }}" required>
                                                <label class="ps-6" for="floatingInputStartDate">Start date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="flatpickr-input-container">
                                            <div class="form-floating" id="startDate">
                                                <input type="date" name="end_date" autocomplete="off"
                                                    class="form-control" value="{{ $project->end_date }}" required>
                                                <label class="ps-6" for="floatingInputStartDate">Deadline</label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6 col-md-4">
                                        <div class="flatpickr-input-container">
                                            <div class="form-floating"><input
                                                    class="form-control datetimepicker flatpickr-input"
                                                    id="floatingInputDeadline" type="text" placeholder="deadline"
                                                    data-options="{&quot;disableMobile&quot;:true}"
                                                    readonly="readonly"><label class="ps-6"
                                                    for="floatingInputDeadline">Deadline</label><span
                                                    class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                                            </div>
                                        </div>Create
                                    </div> --}}
                                    <div class="col-12 gy-6">
                                        <div class="form-floating">
                                            <textarea name="overview" class="form-control" id="floatingProjectOverview" placeholder="Leave a comment here"
                                                style="height: 100px">{{ $project->overview }}</textarea>
                                            <label for="floatingProjectOverview">Project overview</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 gy-6">
                                        <div class="form-floating">
                                            <select name="client_id" class="form-select" id="floatingSelectClient">
                                                <option selected="selected">Select client</option>
                                                @foreach ($parties as $item)
                                                    <option value="{{ $item->PartyID }}"  {{ $project->client_id == $item->PartyID ? 'selected' : '' }}>{{ $item->PartyName }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelectClient">Client/Customer</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 gy-6">
                                        <div class="form-floating">
                                            <input name="budget" class="form-control" id="floatingInputBudget"
                                                type="number" step="0.001" placeholder="Budget" value="{{ $project->budget }}">
                                            <label for="floatingInputBudget">Budget</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 gy-6">
                                        <div class="form-floating">
                                            <input name="location" class="form-control" id="floatingInputLocation"
                                                type="text" placeholder="Location" value="{{ $project->location }}">
                                            <label for="floatingInputLocation">Location</label>
                                        </div>
                                    </div>

                                    <div class="col-12 gy-6">
                                        <div class="row g-3 justify-content-end">
                                            <div class="col-auto"><button id="cancel_btn" type="button"
                                                    class="btn btn-secondary px-5">Cancel</button>
                                            </div>
                                            <div class="col-auto"><button type="submit"
                                                    class="btn btn-primary px-5 px-sm-15">Update</button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // $("#flatpickr-input-container .flatpickr-input").flatpickr({
            //     dateFormat: "Y-m-d",
            //     // Add any additional Flatpickr options as needed
            // });

            // // Open the calendar on clicking anywhere inside the input container
            // $("#datepickerContainer").on("click", function() {
            //     var input = $(this).find(".flatpickr-input")[0];
            //     if (input && input._flatpickr) {
            //         input._flatpickr.toggle();
            //     }
            // });
            $('#cancel_btn').click(function() {
                window.location.href = "{{ url('Project/Index') }}";
            });
        });
    </script>
@endsection
