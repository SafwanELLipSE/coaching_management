@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Display Classrooms 
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
                <h1 class="m-0">Display Classroom</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('classroom.list_view')}}">All Classrooms</a></li>
                    <li class="breadcrumb-item active">Display Classroom</li>
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
                        <h3 class="card-title"><i class="fas fa-info-circle @if($classroom->is_active == 1){{"text-success"}}@else{{"text-danger"}}@endif"></i> Display Classroom ({{ $classroom->name }})</h3>
                        <div class="card-tools">
                            <a href="{{route('chat.chat_view',$classroom->id)}}" class="d-inline btn btn-xs btn-dark-moon btn-dark-moon2 mr-3" style="border-radius: 50%;"><i class="far fa-comments"></i></a>
                            <a href="{{route('classroom.edit',$classroom->id)}}" class="d-inline btn btn-xs btn-dark-blue"><i class="far fa-edit"></i> Edit</a>
                            <a class="d-inline btn btn-xs btn-light-green" data-toggle="modal" data-target="#modal-assign-student"><i class="far fa-plus-square"></i> Assign Student</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-md-3 col-sm-6">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted"><i class="fas fa-hourglass-start"></i> Starting Date</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{ date('d.m.Y', strtotime($classroom->start_date)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 col-sm-6">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted"><i class="fas fa-hourglass-end"></i> Ending Date</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{ date('d.m.Y', strtotime($classroom->end_date)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 col-sm-6">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted"><i class="far fa-clock"></i> Start Time</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{ date('h:i a', strtotime($classroom->start_time)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 col-sm-6">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted"><i class="fas fa-clock"></i> End Time</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{ date('h.i a', strtotime($classroom->end_time)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4><i class="far fa-user-circle"></i> Teacher Details</h4>
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle @if($classroom->teacher->isActive == 1){{"image-border-green"}}@else{{"image-border-red"}}@endif" src="/teacher_images/{{$classroom->teacher->image}}" alt="Teacher Image">
                                                <span class="username">
                                                    <a href="#" class="text-dark-moon">{{$classroom->teacher->user->name}}</a> ({{$classroom->teacher->designation}})
                                                </span>
                                                <span class="description">{{$classroom->teacher->subject}}</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row">
                                                <div class="col-6">
                                                    <p> <b><i class="fas fa-envelope-open-text"></i> Email:</b> {{$classroom->teacher->user->email}}</p>
                                                </div>
                                                <div class="col-6">
                                                    <p> <b><i class="fas fa-phone-volume"></i> Phone:</b> {{$classroom->teacher->user->phone}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p> <b><i class="fas fa-user-alt"></i> Gender:</b> {{$classroom->teacher->gender}}</p>
                                                </div>
                                                <div class="col-6">
                                                    <p> <b><i class="fas fa-graduation-cap"></i> Experience:</b> {{$classroom->teacher->experience}}</p>
                                                </div>
                                            </div>
                                            <p>
                                                <a href="{{route('teacher.display', $classroom->teacher_id)}}" class="btn btn-xs btn-dark-blue"><i class="fas fa-eye"></i></a>
                                                <a href="{{route('classroom.assign_exam', $classroom->id)}}" class="btn btn-xs btn-deep-green"><i class="far fa-question-circle"></i> Examinations</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                <h3 class="text-dark-moon"><i class="fas fa-paint-brush"></i> Details</h3> 
                                <p class="text-muted">
                                    <b>Name:</b> {{$classroom->name}} <br> 
                                    <b>Class:</b> {{$classroom->class->name}} <br>
                                    <b>Course:</b> {{$classroom->course->name}} ({{$classroom->course->code}})
                                </p>
                                <div class="text-muted">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-sm">Capacity:
                                                <b class="d-block">{{$classroom->capacity}}</b>
                                            </p>
                                            <p class="text-sm">Enrolled:
                                                <b class="d-block">{{$classroom->enrolled}}</b>
                                            </p>
                                            @php
                                                $startTime = \Carbon\Carbon::parse($classroom->start_time);
                                                $endTime = \Carbon\Carbon::parse($classroom->end_time);
                                                $totalDuration = $endTime->diff($startTime)->format('%H.%I');
                                            @endphp
                                            <p class="text-sm">Duration:
                                                <b class="d-block">{{$totalDuration}}</b>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-sm">Status:
                                                <b class="d-block">
                                                    {!! App\Models\Classroom::getStatus($classroom->is_active) !!}
                                                </b>
                                            </p>
                                            @php
                                                $days = explode(',',$classroom->days);
                                                $daysCount = Count($days);
                                                $count = 1;
                                            @endphp
                                            <p class="text-sm">Week Days ({{$daysCount}}):
                                                <b class="d-block">
                                                    @foreach ($days as $day)
                                                        @if($count < $daysCount)
                                                            {{$count++.'. '. $day.','}}
                                                        @else
                                                            {{$count++.'. '. $day}}
                                                        @endif
                                                    @endforeach
                                                </b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                @if($classroom->zoom_id != null && $classroom->zoom_password != null)
                <div class="card card-dark-moon card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle @if($classroom->is_active == 1){{"text-success"}}@else{{"text-danger"}}@endif"></i> Display Classroom ({{ $classroom->name }})</h3>
                        <div class="card-tools">
                            <a href="#" class="d-inline btn btn-xs btn-dark-blue" data-zoompass="{{$classroom->zoom_password}}" data-toggle="modal" data-target="#video-call-edit"><i class="far fa-edit"></i> Edit</a>
                            <a href="{{route('classroom.remove_zoom',$classroom->id)}}" class="d-inline btn btn-xs btn-dark-red"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-center">
                                <h5><b>Capacity:</b> {{$classroom->zoom_id}}</h5>
                            </div>
                            <div class="col-6 text-center">
                                <h5><b>Enrolled:</b> {{$classroom->zoom_password}}</h5>
                            </div>
                        </div>
                        @if($classroom->zoom_link != null)
                        <div class="row">
                            <a href="{{$classroom->zoom_link}}" target="_blank" class="d-inline btn btn-light-green mx-auto"><i class="fas fa-link"></i> Zoom Link</a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                @if(count($enrolledStudentLists))
                <div class="card card-dark-moon card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> Enrolled Students({{$classroom->enrolled}})</h3>
                        <div class="card-tools">
                            <a class="d-inline btn btn-xs btn-light-green" data-toggle="modal" data-target="#modal-video-call"><i class="fas fa-video"></i> Create Zoom Room</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Student Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($enrolledStudentLists as $enrolledStudent)
                                <tr>
                                    <td>{{ $enrolledStudent->id }}</td>
                                    <td>{{ $enrolledStudent->student->user->name }}</td>
                                    <td>{{ $enrolledStudent->student->user->email }}</td>
                                    <td>{{ $enrolledStudent->student->user->phone }}</td>
                                    <td> {!! App\Models\Classroom_students::getStatus($enrolledStudent->is_active) !!}</td>
                                    <td>{{ $enrolledStudent->created_at->format('d.m.Y') }}</td>
                                    <td>
                                        <a href="{{route('classroom.status_change',$enrolledStudent->id)}}" class="btn btn-sm @if($enrolledStudent->is_active == 1){{"btn-outline-dark-green"}}@else{{"btn-outline-dark-red"}}@endif"><i class="far @if($enrolledStudent->is_active == 1){{"fa-check-circle"}}@else{{"fa-times-circle"}}@endif"></i></a>
                                        <a href="{{route('studentGrade.grading_student',$classroom->id)}}" class="btn btn-sm btn-deep-green"><i class="fas fa-poll"></i></a>
                                        <a href="{{route('classroom.remove_student',$enrolledStudent->id)}}" class="btn btn-sm btn-dark-red"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{$enrolledStudentLists->links()}}
                        </ul>
                    </div>
                </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>

<div class="modal fade show" id="modal-video-call" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark-moon">
                <h4 class="modal-title text-light">Create Zoom Room ({{$classroom->class->name}})</h4>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('classroom.create_zoom')}}" method="POST" >
                    @csrf
                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                <div class="form-group mt-3">
                    <label for="zoom_password">Zoom Password</label>
                    <input type="text" name="zoom_password" value="{{old('zoom_password')}}" class="form-control form-control-border border-width-2" id="zoom_password" placeholder="Zoom Password">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-dark-moon" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark-green">Create</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade show" id="video-call-edit" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark-moon">
                <h4 class="modal-title text-light">Edit Zoom ID ({{$classroom->class->name}})</h4>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('classroom.edit_zoom')}}" method="POST" >
                    @csrf
                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                <div class="form-group mt-3">
                    <label for="zoom_password">Zoom Password</label>
                    <input type="text" name="zoom_password" id="password_zoom" value="" class="form-control form-control-border border-width-2" placeholder="Zoom Password">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-dark-moon" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark-green">update</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade show" id="modal-assign-student" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark-moon">
                <h4 class="modal-title text-light">Assign Student ({{$classroom->class->name}})</h4>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('classroom.assign_student')}}" method="POST" >
                    @csrf
                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                <div class="form-group">
                    <label>Pick Student</label>
                    <select id="list_students" name="list_students[]" class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Select Subjects" style="width: 100%;" aria-hidden="true">
                        @foreach ($students as $student)
                            <option value="{{$student->id}}" @if (old("list_students")){{ (in_array($student->id, old("list_students")) ? "selected":"") }} @endif>{{$student->user->name}}</option>
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
    <script type="text/javascript">
    $('#video-call-edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var zoomPass = button.data('zoompass')
            console.log(zoomPass)
            var modal = $(this)
            modal.find('.modal-body #password_zoom').val(zoomPass);
    })
    </script>
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