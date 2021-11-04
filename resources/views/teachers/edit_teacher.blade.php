@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Edit Teacher 
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
                    <h1 class="m-0">Edit Teacher</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('teacher.list')}}">All Teacher</a></li>
                        <li class="breadcrumb-item"><a href="{{route('teacher.display',$teacher->id)}}">Teacher Display</a></li>
                        <li class="breadcrumb-item active">Edit Teacher</li>
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
                            Edit Teacher
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form  action="{{route('teacher.save_edit')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                                    <input type="hidden" name="user_id" value="{{$teacher->user_id}}">
                                    <div class="form-group">
                                        <label for="teacher_name">Name</label>
                                        <input type="text" name="teacher_name" value="{{$teacher->user->name}}" class="form-control form-control-border border-width-2" id="teacher_name" placeholder="Teacher Name">
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_email">Email</label>
                                                <input type="email" name="teacher_email" value="{{$teacher->user->email}}" class="form-control form-control-border border-width-2" id="teacher_email" placeholder="Teacher Email">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_phone">Phone</label>
                                                <input type="text" name="teacher_phone" value="{{$teacher->user->phone}}" class="form-control form-control-border border-width-2" id="teacher_phone" placeholder="Teacher Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="national_id">Nation ID</label>
                                                <input type="text" name="national_id" value="{{$teacher->national_id}}" class="form-control form-control-border border-width-2" id="national_id" placeholder="National ID">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_gender">Gender</label>
                                                <select name="teacher_gender" id="teacher_gender" class="form-control form-control-border border-width-2">
                                                    <option value="" selected disabled>Choose a Gender</option>
                                                    <option value="Male" @if($teacher->gender == 'Male'){{"selected"}}@endif>Male</option>
                                                    <option value="Female"@if($teacher->gender == 'Female'){{"selected"}}@endif>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            @php
                                                $dateBirth = date('d-m-Y',strtotime($teacher->dob));
                                            @endphp
                                            <div class="form-group">
                                                <label for="teacher_dob">Date of Birth:</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" name="teacher_dob" value="{{$dateBirth}}" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="teacher_experience">Experience</label>
                                                <input type="text" name="teacher_experience" value="{{$teacher->experience}}" class="form-control form-control-border border-width-2" id="teacher_experience" placeholder="Teacher Experience">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="teacher_salary">Salary</label>
                                                <input type="text" name="teacher_salary" value="{{$teacher->salary}}" class="form-control form-control-border border-width-2" id="teacher_salary" placeholder="Teacher Salary">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_designation">Designation</label>
                                                <input type="text" name="teacher_designation" value="{{$teacher->designation}}" class="form-control form-control-border border-width-2" id="teacher_designation" placeholder="Teacher Designation">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_subject">Subject</label>
                                                <input type="text" name="teacher_subject" value="{{$teacher->subject}}" class="form-control form-control-border border-width-2" id="teacher_subject" placeholder="Teacher Subject">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_qualification">Qualification</label>
                                                <textarea cols="3" class="form-control form-control-border border-width-2" id="teacher_qualification" name="teacher_qualification" placeholder="Current Qualification">{{$teacher->qualification}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="teacher_institute">Institute</label>
                                                <textarea cols="3" class="form-control form-control-border border-width-2" id="teacher_institute" name="teacher_institute" placeholder="Institute Studied On">{{$teacher->institute}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="teacher_address">Address</label>
                                        <textarea cols="3" class="form-control form-control-border border-width-2" id="teacher_address" name="teacher_address" placeholder="Address of Teacher">{{$teacher->address}}</textarea>
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
                                            <img id="imagePreview" src="/teacher_images/{{$teacher->image}}" class="rounded mx-auto d-block thumbnail" width="200" height="120" alt="Brand Image Upload">
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
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('#reservationdate').datetimepicker({
                format: 'D-M-Y',
            });
        })
    </script>
    <script>
        $('#teacherForm').validate({
            rules: {
                teacher_name: {
                    required: true,
                },
                teacher_email: {
                    required: true,
                    email: true
                },
                teacher_phone: {
                    required: true,
                },
                national_id: {
                    required: true,
                    number: true,
                    digits: true,
                    min: 0,
                },
                teacher_gender: {
                    required: true,
                },
                teacher_dob:{
                    required: true,
                },
                teacher_experience: {
                    required: true,
                },
                teacher_qualification: {
                    required: true,
                },
                teacher_institute: {
                    required: true,
                },
                teacher_image:{
                    required: true,
                },
                teacher_salary:{
                    required: true,
                    number: true,
                    digits: true,
                    min: 0,
                },
                teacher_designation:{
                    required: true,
                },
                teacher_subject:{
                    required: true,
                },
                teacher_address: {
                    required: true,
                },
            },
            messages: {
                teacher_name: {
                    required: "Please enter your Teacher Name.",
                },
                teacher_email: {
                    required: "Please enter your Teacher Email.",
                    email: "Please enter a valid email address."
                },
                teacher_phone: {
                    required: "Please enter your Teacher Phone.",
                },
                national_id: {
                    required: "Please enter your National ID.",
                    number: "Only can use Number",
                    digits: "Only can use Digit",
                    min: "please provide value greater than or equal to 0",
                },
                teacher_gender: {
                    required: "Select a Gender.",
                },
                teacher_dob: {
                    required: "Please enter your Date of Birth",
                },
                teacher_experience: {
                    required: "Please enter your Experience",
                },
                teacher_qualification: {
                    required: "Please enter your Teacher's Qualification",
                },
                teacher_institute: {
                    required: "Please enter your Teacher's Institute",
                },
                teacher_image:{
                    required: "Please Upload your Image",
                },
                teacher_salary: {
                    required: "Please enter your Teacher's Salary",
                    number: "Only can use Number",
                    digits: "Only can use Digit",
                    min: "please provide value greater than or equal to 0",
                },
                teacher_designation:{
                    required: "Please enter your Designation",
                },
                teacher_subject:{
                    required: "Please enter your Subject for Teaching",
                },
                teacher_address: {
                    required: "Please enter your Address",
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
    <script>
        $(document).ready(function(){
            $(".teacher_image").change(function(data){

            var imageFile = data.target.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(imageFile);

                reader.onload = function(evt){
                $('#imagePreview').attr('src', evt.target.result);
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
                }		
            });
        });
    </script>
@endsection
