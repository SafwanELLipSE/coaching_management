@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Create Classroom 
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.css">
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Classroom</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create Classroom</li>
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
                            Create Classroom ({{$count}})
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form id="classroomForm" action="{{route('classroom.save_created')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="classroom_name">Name</label>
                                        <input type="text" name="classroom_name" value="{{old('classroom_name')}}" class="form-control form-control-border border-width-2" id="teacher_name" placeholder="Classroom Name">
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Select Class</label>
                                                <select name="select_class" class="form-control select2" >
                                                    <option selected="selected" value="" disabled>Choose a Class</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{$class->id}}" @if(old('select_class') == $class->id){{"selected"}}@endif>{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Select Course</label>
                                                <select name="select_course" class="form-control select2" >
                                                    <option selected="selected" value="" disabled>Choose a Course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{$course->id}}" @if(old('select_course') == $course->id){{"selected"}}@endif>{{$course->name}} ({{$course->code}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Select Teacher</label>
                                                <select name="select_teacher" class="form-control select2" >
                                                    <option selected="selected" value="" disabled>Choose a Teacher</option>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{$teacher->id}}" @if(old('select_teacher') == $teacher->id){{"selected"}}@endif>{{$teacher->user->name}} ({{$teacher->subject}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="student_capacity">Capacity of Student</label>
                                                <input type="text" name="student_capacity" value="{{old('student_capacity')}}" class="form-control form-control-border border-width-2" id="student_capacity" placeholder="Capacity of Student">
                                            </div>
                                        </div>
                                        @php
                                            $weeks = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
                                        @endphp
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Pick Days of Class</label>
                                                <select id="list_days" name="list_days[]" class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Select Days" style="width: 100%;" aria-hidden="true">
                                                    @foreach ($weeks as $item)
                                                        <option value="{{$item}}" @if(old('list_days')){{ (in_array($item ,old("list_days")) ? "selected":"") }}@endif>{{$item}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label for="start_time">Class Start Time:</label>
                                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                        <input type="text" name="start_time" value="{{old('start_time')}}" class="form-control datetimepicker-input" data-target="#timepicker" placeholder="Start Time">
                                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            <!-- /.form group -->
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bootstrap-timepicker">
                                                <div class="form-group">
                                                    <label for="end_time">Class End Time:</label>
                                                    <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                                        <input type="text" name="end_time" value="{{old('end_time')}}" class="form-control datetimepicker-input" data-target="#timepicker2" placeholder="End Time">
                                                        <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            <!-- /.form group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="starting_date">Starting Date:</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" name="starting_date" value="{{old('starting_date')}}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Class Start date"/>
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="ending_date">Ending Date:</label>
                                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                    <input type="text" name="ending_date" value="{{old('ending_date')}}" class="form-control datetimepicker-input" data-target="#reservationdate2" placeholder="Class End date"/>
                                                    <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark-green btn-sm float-right">Save</button>
                                </form>
                            </div>
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
    <script src="{{asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
    <!-- date-range-picker -->
    <script src="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- jquery-validation -->
    <script src="{{asset('assets')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    
    <script src="{{asset('js/classroom/connection_imported_file.js')}}"></script>
    <script src="{{asset('js/classroom/form_validation.js')}}"></script>
@endsection
