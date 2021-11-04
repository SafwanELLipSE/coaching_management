@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Teacher Attendance Display
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    {{-- sweet alert 2 --}}
    <link src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fullcalendar/main.css">
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Teacher Attendance Display</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('teacher.list')}}">All Teachers</a></li>
                    <li class="breadcrumb-item active">Teacher Attendance Display</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-dark-moon card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle @if($teacher->isActive == 1){{"image-border-green"}}@else{{"image-border-red"}}@endif" src="/teacher_images/{{$teacher->image}}" style="height: 6rem !important" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{$teacher->user->name}}</h3>
                                <p class="text-muted text-center text-justify"> <span class="badge badge-pill @if($teacher->isActive == 1){{"badge-success"}}@else{{"badge-danger"}}@endif">{{$teacher->designation}}</span></p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Gender</b> <a class="float-right text-dark-moon">{{ $teacher->gender }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Experience</b> <a class="float-right text-dark-moon">{{ $teacher->experience }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Date of Birth</b> <a class="float-right text-dark-moon">{{ date('d.m.Y', strtotime($teacher->dob)) }}</a>
                                    </li>
                                </ul>
                            </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="sticky-top mb-3">
                            <div class="card card-dark-moon card-outline">
                                <div class="card-header">
                                <h4 class="card-title">Status Indicator</h4>
                                </div>
                                <div class="card-body">
                                <!-- the events -->
                                <div id="external-events">
                                    <div class="external-event bg-dark-green-gradient text-light">Present</div>
                                    <div class="external-event bg-dark-yellow-gradient text-light">Late</div>
                                    <div class="external-event bg-dark-red-gradient text-light">Absent</div>

                                    {{-- <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove">
                                            remove after drop
                                        </label>
                                    </div> --}}
                                </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            {{-- <div class="card">
                                <div class="card-header">
                                <h3 class="card-title">Create Event</h3>
                                </div>
                                <div class="card-body">
                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                <div class="input-group">
                                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                    <div class="input-group-append">
                                    <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                    <!-- /btn-group -->
                                </div>
                                <!-- /input-group -->
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <input type="hidden" id="allAttendance" value="{{$attendedTeachers}}">
                    <div class="col-md-9">
                        <div class="card card-dark-moon card-outline">
                            <div class="card-body">
                                @php
                                    $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                                    $count = 1;
                                @endphp
                                <form id="reportSubmit" action="{{route('teacher.report_teacher')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" id="teacher_id" name="teacher_id" value="{{$teacher->id}}">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Month</label>
                                                <select id="month" name="month" class="form-control form-control-border border-width-2 text-center">
                                                    <option value="" disabled selected>Select A Month</option>
                                                    @foreach ($months as $month)
                                                        <option value="{{$count++}}" @if(old('month') == $count) {{ "selected" }} @endif>{{$month}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="year">Year</label>
                                                <input type="text" class="form-control form-control-border border-width-2 text-center" id="year" name="year" value="{{old('year')}}" placeholder="Year">
                                            </div>
                                        </div>
                                        <div class="col-4 text-center mt-4">
                                            <button id="submit" type="submit" class="btn btn-sm btn-deep-green"><i class="fas fa-print"></i> Print</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <!-- /.card-body -->
                        </div>
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar"></div>
                            </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
@endsection
@section('additional_scripts')
    {{-- sweet alert 2 --}}
    <script src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{asset('assets')}}/plugins/moment/moment.min.js"></script>
    <script src="{{asset('assets')}}/plugins/fullcalendar/main.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{asset('js/teacher_attendance/teacher_attendance_view.js')}}"></script>
@endsection