@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Create Teacher 
@endsection
@section('additional_headers')
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
                    <h1 class="m-0">Create Teacher</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create Teacher</li>
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
                            Create Teacher ({{$count}})
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form  action="{{route('teacher.save_created')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="teacher_name">Name</label>
                                        <input type="text" name="teacher_name" value="{{old('teacher_name')}}" class="form-control form-control-border border-width-2" id="teacher_name" placeholder="Teacher Name">
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_email">Email</label>
                                                <input type="email" name="teacher_email" value="{{old('teacher_email')}}" class="form-control form-control-border border-width-2" id="teacher_email" placeholder="Teacher Email">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_phone">Phone</label>
                                                <input type="text" name="teacher_phone" value="{{old('teacher_phone')}}" class="form-control form-control-border border-width-2" id="teacher_phone" placeholder="Teacher Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="national_id">Nation ID</label>
                                                <input type="text" name="national_id" value="{{old('national_id')}}" class="form-control form-control-border border-width-2" id="national_id" placeholder="National ID">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_gender">Gender</label>
                                                <select name="teacher_gender" id="teacher_gender" class="form-control form-control-border border-width-2">
                                                    <option value="" selected disabled>Choose a Gender</option>
                                                    <option value="Male" @if(old('teacher_gender') == 'Male'){{"selected"}}@endif>Male</option>
                                                    <option value="Female"@if(old('teacher_gender') == 'Female'){{"selected"}}@endif>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="teacher_dob">Date of Birth:</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" name="teacher_dob" value="{{old('teacher_dob')}}" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="teacher_experience">Experience</label>
                                                <input type="text" name="teacher_experience" value="{{old('teacher_experience')}}" class="form-control form-control-border border-width-2" id="teacher_experience" placeholder="Teacher Experience">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="teacher_salary">Salary</label>
                                                <input type="text" name="teacher_salary" value="{{old('teacher_salary')}}" class="form-control form-control-border border-width-2" id="teacher_salary" placeholder="Teacher Salary">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_designation">Designation</label>
                                                <input type="text" name="teacher_designation" value="{{old('teacher_designation')}}" class="form-control form-control-border border-width-2" id="teacher_designation" placeholder="Teacher Designation">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_subject">Subject</label>
                                                <input type="text" name="teacher_subject" value="{{old('teacher_subject')}}" class="form-control form-control-border border-width-2" id="teacher_subject" placeholder="Teacher Subject">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_qualification">Qualification</label>
                                                <textarea cols="3" class="form-control form-control-border border-width-2" id="teacher_qualification" name="teacher_qualification" placeholder="Current Qualification">{{old('teacher_qualification')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_institute">Institute</label>
                                                <textarea cols="3" class="form-control form-control-border border-width-2" id="teacher_institute" name="teacher_institute" placeholder="Institute Studied On">{{old('teacher_institute')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="teacher_address">Address</label>
                                        <textarea cols="3" class="form-control form-control-border border-width-2" id="teacher_address" name="teacher_address" placeholder="Address of Teacher">{{old('teacher_address')}}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="teacher_image">Image :</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="teacher_image" class="custom-file-input teacher_image" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <img id="imagePreview" src="{{asset('assets')}}/dist/img/No_Image_Available.jpg" class="rounded mx-auto d-block thumbnail" width="200" height="120" alt="Brand Image Upload">
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
    <!-- date-range-picker -->
    <script src="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- jquery-validation -->
    <script src="{{asset('assets')}}/plugins/jquery-validation/jquery.validate.min.js"></script>

    <script src="{{asset('js/teacher/teacher.js')}}"></script>
    <script src="{{asset('js/teacher/form_validation.js')}}"></script>
@endsection
