@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Edit Student 
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
                    <h1 class="m-0">Edit Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('student.list_view')}}">All Students</a></li>
                        <li class="breadcrumb-item"><a href="{{route('student.display',$student->id)}}">Display Student</a></li>
                        <li class="breadcrumb-item active">Edit Student</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form  action="{{route('student.save_edit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-dark-moon card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Student Info.</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <input type="hidden" name="student_id" value="{{$student->id}}">
                                <input type="hidden" name="user_id" value="{{$student->user_id}}">
                                <div class="form-group">
                                    <label for="student_name">Name</label>
                                    <input type="text" name="student_name" value="{{ $student->user->name }}" class="form-control form-control-border border-width-2" id="student_name" placeholder="Student Name">
                                </div>
                                <div class="form-group">
                                    <label for="student_email">Email</label>
                                    <input type="email" name="student_email" value="{{$student->user->email}}" class="form-control form-control-border border-width-2" id="student_email" placeholder="Student Email">
                                </div>
                                <div class="form-group">
                                    <label for="student_phone">Phone</label>
                                    <input type="text" name="student_phone" value="{{$student->user->phone}}" class="form-control form-control-border border-width-2" id="student_phone" placeholder="Student Phone">
                                </div>
                                <div class="form-group">
                                    <label for="student_dob">Date of Birth:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="student_dob" value="{{ date('d-m-Y',strtotime($student->dob)) }}" placeholder="Date of Birth" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="student_gender">Gender</label>
                                    <select name="student_gender" id="student_gender" class="form-control form-control-border border-width-2">
                                        <option value="" selected disabled>Choose a Gender</option>
                                        <option value="Male" @if($student->gender == 'Male'){{"selected"}}@endif>Male</option>
                                        <option value="Female" @if($student->gender == 'Female'){{"selected"}}@endif>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="student_address">Address</label>
                                    <textarea cols="3" class="form-control form-control-border border-width-2" id="student_address" name="student_address" placeholder="Address of Student">{{ $student->address }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-dark-moon card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Parent's Info.</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                @php
                                    $fatherOccupations = ['Govt. Service', 'Civil Service', 'Private Service', 'Business', 'Retird'];
                                    $motherOccupations = ['Govt. Service', 'Civil Service', 'Private Service', 'Business', 'Housewife', 'Retird'];
                                @endphp
                                <div class="form-group">
                                    <label for="father_name">Father's Name</label>
                                    <input type="text" name="father_name" value="{{$student->father_name}}" class="form-control form-control-border border-width-2" id="father_name" placeholder="Father's Name">
                                </div>
                                <div class="form-group">
                                    <label for="father_nid">Father's National ID</label>
                                    <input type="text" name="father_nid" value="{{$student->father_nid}}" class="form-control form-control-border border-width-2" id="father_nid" placeholder="Father's National ID">
                                </div>
                                <div class="form-group">
                                    <label for="father_occupation">Father's Occupation</label>
                                    <select name="father_occupation" id="father_occupation" class="form-control form-control-border border-width-2">
                                        <option value="" disabled>Choose a Occupdation</option>
                                        @foreach ($fatherOccupations as $fatherOccupation)
                                            <option value="{{$fatherOccupation}}" @if($student->father_occupation == $fatherOccupation){{"selected"}}@endif>{{$fatherOccupation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mother_name">Mother's Name</label>
                                    <input type="text" name="mother_name" value="{{$student->mother_name}}" class="form-control form-control-border border-width-2" id="mother_name" placeholder="Mother's Name">
                                </div>
                                <div class="form-group">
                                    <label for="mother_nid">Mother's National ID</label>
                                    <input type="text" name="mother_nid" value="{{$student->mother_nid}}" class="form-control form-control-border border-width-2" id="mother_nid" placeholder="Mother's National ID">
                                </div>
                                <div class="form-group">
                                    <label for="mother_occupation">Mother's Occupation</label>
                                    <select name="mother_occupation" id="mother_occupation" class="form-control form-control-border border-width-2">
                                        <option value="" disabled>Choose a Occupdation</option>
                                        @foreach ($motherOccupations as $motherOccupation)
                                            <option value="{{$motherOccupation}}" @if($student->mother_occupation == $motherOccupation){{"selected"}}@endif>{{$motherOccupation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card card-dark-moon card-outline">
                            <div class="card-header">
                                <h4 class="card-title">Class Details</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Select Class</label>
                                            <select name="select_class" id="select_class" class="form-control select2" >
                                                <option value="" disabled>Choose a Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{$class->id}}" @if($student->class_id == $class->id){{"selected"}}@endif>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-dark-moon card-outline">
                            <div class="card-header">
                                <h4 class="card-title">Profile Image</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <img id="imagePreview" src="/student_images/{{$student->image}}" class="rounded-circle mx-auto d-block img-fluid @if($student->is_active == 1){{"image-border-green"}}@else{{"image-border-red"}}@endif" src="/student_images/{{$student->image}}" width="200" height="120" alt="Student Upload">
                                <div class="form-group">
                                    <label for="student_image">Image :</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="student_image" class="custom-file-input student_image" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-dark-moon card-outline">
                            <div class="card-header">
                                <h4 class="card-title">Guidance Contact</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="guidance_email">Guidance's Email</label>
                                            <input type="email" name="guidance_email" value="{{$student->guidance_email}}" class="form-control form-control-border border-width-2" id="guidance_email" placeholder="Guidance's Email">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="guidance_phone">Guidance's Phone</label>
                                            <input type="text" name="guidance_phone" value="{{$student->guidance_mobile}}" class="form-control form-control-border border-width-2" id="guidance_phone" placeholder="Guidance's Phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark-green btn-sm float-right mb-3">update</button>
            </div><!-- /.container-fluid -->
            </form>
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
        })
    </script>
    <script>
        $(document).ready(function(){
            $(".student_image").change(function(data){

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
