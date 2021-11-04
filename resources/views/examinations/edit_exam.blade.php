@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Edit Examination 
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
                <h1 class="m-0">Edit Examination</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('exam.list_view')}}">All Examinations</a></li>
                <li class="breadcrumb-item"><a href="{{route('exam.display',$exam->id)}}">Display Examination</a></li>
                <li class="breadcrumb-item active">Edit Examination</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <form id="examForm" action="{{route('exam.save_edit')}}" method="POST">
                @csrf
            <div class="row">
                <div class="col-8">
                    <div class="card card-dark-moon card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                Examination Info.
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" name="exam_id" value="{{$exam->id}}">
                                    <div class="form-group">
                                        <label for="exam_name">Examination Name</label>
                                        <input type="text" name="exam_name" value="{{$exam->name}}" class="form-control form-control-border border-width-2" id="exam_name" placeholder="Examination Name">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="select_exam_type">Choose Type of Examination</label>
                                                <select name="select_exam_type" id="select_exam_type" class="form-control form-control-border border-width-2">
                                                    <option selected="selected" value="" disabled>Choose Type of Examination</option>
                                                    <option value="1" @if($exam->type == 1){{"selected"}}@endif>Written</option>
                                                    <option value="2" @if($exam->type == 2){{"selected"}}@endif>MCQ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="select_classroom">Select Class</label>
                                                <select name="select_classroom" class="form-control select2" >
                                                    <option selected="selected" value="" disabled>Choose a Classroom</option>
                                                    @foreach ($classrooms as $classroom)
                                                        <option value="{{$classroom->id}}" @if($exam->classroom_id == $classroom->id){{"selected"}}@endif>{{$classroom->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exam_marks">Examination Marks</label>
                                        <input type="text" name="exam_marks" value="{{$exam->marks}}" class="form-control form-control-border border-width-2" id="exam_marks" placeholder="Examination Marks">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card card-dark-moon card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                Examination Timing
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exam_date">Date:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name="exam_date" value="{{date('d-m-Y',strtotime($exam->date))}}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Examination date"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label for="exam_start_time">Start Time:</label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" name="exam_start_time" value="{{$exam->start_time}}" class="form-control datetimepicker-input" data-target="#timepicker" placeholder="Examination Time">
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            <!-- /.form group -->
                            </div>
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label for="exam_end_time">End Time:</label>
                                    <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                        <input type="text" name="exam_end_time" value="{{$exam->end_time}}" class="form-control datetimepicker-input" data-target="#timepicker2" placeholder="Examination End Time">
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
                </div>
            </div>
            <button type="submit" class="btn btn-dark-green btn-sm float-right"> Update </button>
            </form>
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
    <script>
        $(function () {
            bsCustomFileInput.init();
             //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#reservationdate').datetimepicker({
                format: 'D-M-Y',
            });
             //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })
            $('#timepicker2').datetimepicker({
                format: 'LT'
            })
        })
    </script>
    <script>
        $('#examForm').validate({
            rules: {
                exam_name:{
                    required: true,
                },
                select_exam_type:{
                    required: true,
                },
                select_classroom:{
                    required: true,
                },
                exam_date:{
                    required: true,
                },
                exam_start_time:{
                    required: true,
                },
                exam_end_time:{
                    required: true,
                },
                exam_marks:{
                    required: true,
                    number: true,
                    digits: true,
                    min: 0,
                },
            },
            messages: {
                exam_name: {
                    required: "Please enter your Examination Name.",
                },
                select_exam_type: {
                    required: "Select a Examination Type.",
                },
                select_classroom: {
                    required: "Select a Classroom.",
                },
                exam_date: {
                    required: "Please enter your Starting Date",
                },
                exam_start_time: {
                    required: "Please enter Starting Time",
                },
                exam_end_time: {
                    required: "Please enter your Ending Time",
                },
                exam_marks: {
                    required: "Please enter Examination Marks",
                    number: "Only can use Number",
                    digits: "Only can use Digit",
                    min: "please provide value greater than or equal to 0",
                },
            },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    </script>
@endsection

