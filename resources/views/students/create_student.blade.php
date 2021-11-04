@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Create Student 
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/toastr/toastr.min.css">
    <style>
        .btn-dark-moon {
            border-radius: 8px;
        }
    </style>
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create Student</li>
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
                            Create Student ({{$count}})
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('student.save_created')}}" method="POST" id="formStudent" enctype="multipart/form-data">
                                    @csrf
                                    <div class="list-group">

                                        <div class="list-group-item py-3" data-acc-step>
                                            <h5 class="mb-0" data-acc-title>Student Information</h5>
                                            <div data-acc-content>
                                                <div class="form-group mt-3">
                                                    <label for="student_name">Name</label>
                                                    <input type="text" name="student_name" value="{{old('student_name')}}" class="form-control form-control-border border-width-2" id="student_name" placeholder="Student Name">
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="student_email">Email</label>
                                                            <input type="email" name="student_email" value="{{old('student_email')}}" class="form-control form-control-border border-width-2" id="student_email" placeholder="Student Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="student_phone">Phone</label>
                                                            <input type="text" name="student_phone" value="{{old('student_phone')}}" class="form-control form-control-border border-width-2" id="student_phone" placeholder="Student Phone">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="student_dob">Date of Birth:</label>
                                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                                <input type="text" name="student_dob" id="student_dob" value="{{old('student_dob')}}" placeholder="Date of Birth" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="student_gender">Gender</label>
                                                            <select name="student_gender" id="student_gender" class="form-control form-control-border border-width-2">
                                                                <option value="" selected disabled>Choose a Gender</option>
                                                                <option value="Male" @if(old('student_gender') == 'Male'){{"selected"}}@endif>Male</option>
                                                                <option value="Female"@if(old('student_gender') == 'Female'){{"selected"}}@endif>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item py-3" data-acc-step>
                                            <h5 class="mb-0" data-acc-title>Class Details</h5>
                                            <div data-acc-content>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Select Class</label>
                                                            <select name="select_class" id="select_class" class="form-control select2" >
                                                                <option selected="selected" value="" disabled>Choose a Class</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{$class->id}}" @if(old('select_class') == $class->id){{"selected"}}@endif>{{$class->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Pick Subjects to Study</label>
                                                            <select id="list_courses" name="list_courses[]" class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Select Subjects" style="width: 100%;" aria-hidden="true">
                                                                @foreach ($courses as $course)
                                                                    <option value="{{$course->id}}" @if (old("list_courses")){{ (in_array($course->id, old("list_courses")) ? "selected":"") }} @endif>{{$course->name}} ({{$course->code}})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item py-3" data-acc-step>
                                            <h5 class="mb-0" data-acc-title>Guidance Information</h5>
                                            <div data-acc-content>
                                                @php
                                                    $fatherOccupations = ['Govt. Service', 'Civil Service', 'Private Service', 'Business', 'Retird']
                                                @endphp
                                                <div class="row mt-3">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="father_name">Father's Name</label>
                                                            <input type="text" name="father_name" value="{{old('father_name')}}" class="form-control form-control-border border-width-2" id="father_name" placeholder="Father's Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="father_nid">Father's National ID</label>
                                                            <input type="text" name="father_nid" value="{{old('father_nid')}}" class="form-control form-control-border border-width-2" id="father_nid" placeholder="Father's National ID">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="father_occupation">Father's Occupation</label>
                                                            <select name="father_occupation" id="father_occupation" class="form-control form-control-border border-width-2">
                                                                <option value="" selected disabled>Choose a Occupdation</option>
                                                                @foreach ($fatherOccupations as $fatherOccupation)
                                                                    <option value="{{$fatherOccupation}}" @if(old('father_occupation') == $fatherOccupation){{"selected"}}@endif>{{$fatherOccupation}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $motherOccupations = ['Govt. Service', 'Civil Service', 'Private Service', 'Business', 'Housewife', 'Retird']
                                                @endphp
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="mother_name">Mother's Name</label>
                                                            <input type="text" name="mother_name" value="{{old('mother_name')}}" class="form-control form-control-border border-width-2" id="mother_name" placeholder="Mother's Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="mother_nid">Mother's National ID</label>
                                                            <input type="text" name="mother_nid" value="{{old('mother_nid')}}" class="form-control form-control-border border-width-2" id="mother_nid" placeholder="Mother's National ID">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="mother_occupation">Mother's Occupation</label>
                                                            <select name="mother_occupation" id="mother_occupation" class="form-control form-control-border border-width-2">
                                                                <option value="" selected disabled>Choose a Occupdation</option>
                                                                @foreach ($motherOccupations as $motherOccupation)
                                                                    <option value="{{$motherOccupation}}" @if(old('mother_occupation') == $motherOccupation){{"selected"}}@endif>{{$motherOccupation}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="guidance_email">Guidance's Email</label>
                                                            <input type="email" name="guidance_email" value="{{old('guidance_email')}}" class="form-control form-control-border border-width-2" id="guidance_email" placeholder="Guidance's Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="guidance_phone">Guidance's Phone</label>
                                                            <input type="text" name="guidance_phone" value="{{old('guidance_phone')}}" class="form-control form-control-border border-width-2" id="guidance_phone" placeholder="Guidance's Phone">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="list-group-item py-3" data-acc-step>
                                            <h5 class="mb-0" data-acc-title>Address &amp; Image</h5>
                                            <div data-acc-content>
                                                <div class="form-group">
                                                    <label for="student_address">Address</label>
                                                    <textarea cols="3" class="form-control form-control-border border-width-2" id="student_address" name="student_address" placeholder="Address of Student">{{old('student_address')}}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="student_image">Image :</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="student_image" class="custom-file-input student_image" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img id="imagePreview" src="{{asset('assets')}}/dist/img/No_Image_Available.jpg" class="rounded mx-auto d-block thumbnail" width="200" height="120" alt="Student Image Upload">
                                                    </div>
                                                </div>
                                            </div>
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
    <!-- SweetAlert2 -->
    <script src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{{asset('assets')}}/plugins/toastr/toastr.min.js"></script>
    <script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
    <script src="{{asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
    <!-- date-range-picker -->
    <script src="{{asset('assets')}}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{asset('js/create_student.js')}}"></script>
@endsection
