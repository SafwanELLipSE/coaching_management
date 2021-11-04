@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Student Attendance 
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    {{-- sweet alert 2 --}}
    <link src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.min.css">
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Student Attendance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Student Attendance</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark-moon card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            Student Attendance
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <select id="select-classroom" name="select_classroom" class="form-control select2" >
                                    <option selected="selected" value="" disabled>Choose a Classroom</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{$classroom->id}}" @if(old('select_classroom') == $classroom->id){{"selected"}}@endif>{{$classroom->name}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button onclick='studentList()' class="btn btn-dark-green">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <ul class="list-group">
                                    <span id="onPickClass" style="display: none">
                                        <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Class:</b> <span id="classroomClass"></span></li>
                                        <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Course:</b> <span id="classroomCourse"></span></li>
                                        <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Days of Week:</b> <span id="daysOfWeek"></span> </li>
                                    </span>
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Today's Time:</b> <span id="current_time"></span> </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>days in Month:</b> {{ now()->daysInMonth }} </li>
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Today's Date:</b> {{ date('d-m-Y') }} </li>
                                    <span id="onPickClass2" style="display: none">
                                        <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Attendance Time:</b> <span id="startTime"></span> </li>
                                        <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Enroll Student:</b> <span id="enrolledStudent"></span> </li>
                                    </span>
                                </ul>
                            </div>
                        </div>
                        <div id="student-attendance" style="display: none">
                            <form action="{{ route('attendance.student_attendance_save') }}" method="POST">
                            @csrf
                            <table id="exam_table" class="table table-bordered table-hover" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Name</th>
                                        <th>Unique ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="exam_table_data">
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-deep-green float-right"><i class="fas fa-power-off"></i> Submit</button>
                            </form>
                        </div>
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
    <script src="{{asset('js/student_attendance/student_attendance_dymanic_time.js')}}"></script>
    <script src="{{asset('js/student_attendance/student_attendance_list.js')}}"></script>
    <script src="{{asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    
    <script src="{{asset('js/student_attendance/connection_imported_file.js')}}"></script>
@endsection