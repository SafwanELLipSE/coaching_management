@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Create Examination 
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
                <h1 class="m-0">Create Examination</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Examination</li>
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
                        Create Examination ({{$count}})
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="examForm" action="{{route('exam.save_created')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exam_name">Examination Name</label>
                                    <input type="text" name="exam_name" value="{{old('exam_name')}}" class="form-control form-control-border border-width-2" id="exam_name" placeholder="Examination Name">
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        <div class="form-group">
                                            <label for="select_exam_type">Choose Type of Examination</label>
                                            <select name="select_exam_type" id="select_exam_type" class="form-control form-control-border border-width-2">
                                                <option selected="selected" value="" disabled>Choose Type of Examination</option>
                                                <option value="1" @if(old('select_exam_type') == 1){{"selected"}}@endif>Written</option>
                                                <option value="2" @if(old('select_exam_type') == 2){{"selected"}}@endif>MCQ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <div class="form-group">
                                            <label for="select_classroom">Select Class</label>
                                            <select id="select_classroom" name="select_classroom" class="form-control select2" >
                                                <option selected="selected" value="" disabled>Choose a Classroom</option>
                                                @foreach ($classrooms as $classroom)
                                                    <option value="{{$classroom->id}}" @if(old('select_classroom') == $classroom->id){{"selected"}}@endif>{{$classroom->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-4">
                                        <div class="form-group">
                                            <label for="exam_date">Examination Date:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" name="exam_date" value="{{old('exam_date')}}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Examination date"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label for="exam_start_time">Examination Start Time:</label>
                                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                    <input type="text" name="exam_start_time" value="{{old('exam_start_time')}}" class="form-control datetimepicker-input" data-target="#timepicker" placeholder="Examination Time">
                                                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label for="exam_end_time">Examination End Time:</label>
                                                <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                                    <input type="text" name="exam_end_time" value="{{old('exam_end_time')}}" class="form-control datetimepicker-input" data-target="#timepicker2" placeholder="Examination End Time">
                                                    <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        <!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exam_marks">
                                                Examination Marks <span id="markDiffer"></span>
                                            </label>
                                            <input type="text" id="exam_marks" name="exam_marks" value="{{old('exam_marks')}}" class="form-control form-control-border border-width-2" placeholder="Examination Marks">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="row" id="statusClassroom" style="display: none">
                                            <div class="col-6 text-center">
                                                <p><b>Written:</b> <span id="writtenQuestion"></span></p>
                                            </div>
                                            <div class="col-6 text-center">
                                                <p><b>MCQ:</b> <span id="mcqQuestion"></span></p>
                                            </div>
                                            <div class="col-12 text-center">
                                                <p><b>Total Marks:</b> <span id="totalMarks"></span> Out of 100</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-dark-green btn-sm float-right mt-3"> Save </button>
                                    </div>
                                </div>
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
    <script src="{{asset('js/examination/connect_with_imported_file.js')}}"></script>
    <script src="{{asset('js/examination/examination_form_validation.js')}}"></script>
    <script src="{{asset('js/examination/examination.js')}}"></script>
@endsection

