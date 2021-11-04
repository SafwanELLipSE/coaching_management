@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Display Student 
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Display Student</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('student.list_view')}}">All Students</a></li>
                <li class="breadcrumb-item active">Display Student</li>
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
                                <img class="profile-user-img img-fluid img-circle @if($student->is_active == 1){{"image-border-green"}}@else{{"image-border-red"}}@endif" src="/student_images/{{$student->image}}" alt="Student profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $student->user->name }}</h3>

                                <p class="text-muted text-center"> <span class="badge badge-pill @if($student->is_active == 1){{"badge-success"}}@else{{"badge-danger"}}@endif"> Student </p>

                                <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="float-right text-dark-moon">{{ $student->gender }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Date of Birth</b> <a class="float-right text-dark-moon">{{ date('d.m.Y', strtotime($student->dob)) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right text-dark-moon">{{ $student->user->phone }}</a>
                                </li>
                                </ul>
                                <a href="{{route('student.edit', $student->id)}}" class="btn btn-dark-blue btn-block"><i class="fas fa-pencil-alt mr-1"></i><b> Edit</b></a>
                            </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Courses Taken</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-dark-moon"><i class="fas fa-info-circle"></i> Details</h3>
                                        <div class="row border-bottom border-muted mb-1">
                                            <div class="col-6">
                                                <p> <b><i class="fas fa-envelope-open-text"></i> Email:</b> {{$student->user->email}}</p>
                                            </div>
                                            <div class="col-6">
                                                <p> <b><i class="fas fa-phone-volume"></i> Phone:</b> {{$student->user->phone}}</p>
                                            </div>
                                            <div class="col-12">
                                                <p> <b><i class="fas fa-map-marker-alt"></i> Address:</b> <br> {{$student->address}}</p>
                                            </div>
                                        </div>
                                        <div class="row border-bottom border-muted mb-1">
                                            <div class="col-12">
                                                <h6 class="text-muted">Father Info.</h5>
                                            </div>
                                            <div class="col-4">
                                                <p> <b><i class="fas fa-user-alt"></i> Name:</b> {{$student->father_name}}</p>
                                            </div>
                                            <div class="col-4">
                                                <p> <b><i class="far fa-id-card"></i> National Id:</b> {{$student->father_nid}}</p>
                                            </div>
                                            <div class="col-4">
                                                <p> <b><i class="fas fa-briefcase"></i> Occupation:</b> {{$student->father_occupation}}</p>
                                            </div>
                                        </div>
                                        <div class="row border-bottom border-muted mb-1">
                                            <div class="col-12">
                                                <h6 class="text-muted">Mother Info.</h5>
                                            </div>
                                            <div class="col-4">
                                                <p> <b><i class="fas fa-user-alt"></i> Name:</b> {{$student->mother_name}}</p>
                                            </div>
                                            <div class="col-4">
                                                <p> <b><i class="far fa-id-card"></i> National Id:</b> {{$student->mother_nid}}</p>
                                            </div>
                                            <div class="col-4">
                                                <p> <b><i class="fas fa-briefcase"></i> Occupation:</b> {{$student->mother_occupation}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="text-muted">Guidance Info.</h5>
                                            </div>
                                            <div class="col-6">
                                                <p> <b><i class="fas fa-envelope-open-text"></i> Email:</b> {{$student->guidance_email }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p> <b><i class="fas fa-phone-volume"></i> Phone:</b> {{$student->guidance_mobile}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-dark-moon"><i class="fas fa-user-graduate"></i> Course Info.</h3>
                                        <div class="row border-bottom border-muted mb-1">
                                            <div class="col-12">
                                                <p> <b><i class="fas fa-graduation-cap"></i> Class:</b> {{$student->class->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card card-dark-moon card-outline">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Selected Courses</h3>
                                                        <div class="card-tools">
                                                            <a class="btn btn-xs btn-light-green" data-toggle="modal" data-target="#modal-assign-course"><i class="fas fa-plus-square"></i> Assign Course</a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                <th style="width: 10px">#ID</th>
                                                                <th>Course</th>
                                                                <th>Code</th>
                                                                <th>Label</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($assignCourses as $course)
                                                                    <tr>
                                                                        <td>{{$course->id}}</td>
                                                                        <td>{{$course->course->name}}</td>
                                                                        <td>{{$course->course->code}}</td>
                                                                        <td><a href="{{route('student.remove_course',$course->id)}}" class="btn btn-xs btn-dark-red"><i class="far fa-trash-alt"></i> Remove</a></td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <ul class="pagination pagination-sm m-0 float-right">
                                                                    {{$assignCourses->links()}}
                                                                </ul>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
<div class="modal fade show" id="modal-assign-course" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark-moon">
                <h4 class="modal-title text-light">Assign Course ({{$student->class->name}})</h4>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('student.assign_course')}}" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" value="{{$student->id}}">
                <div class="form-group">
                    <label>Pick Courses</label>
                    <select id="list_courses" name="list_courses[]" class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Select Subjects" style="width: 100%;" aria-hidden="true">
                        @foreach ($availableCourses as $course)
                            <option value="{{$course->id}}" @if (old("list_courses")){{ (in_array($course->id, old("list_courses")) ? "selected":"") }} @endif>{{$course->name}} ({{$course->code}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-dark-moon" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark-green">Assign</button>
                
            </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
@endsection
@section('additional_scripts')
    <script src="{{asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection