@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Display Examination 
@endsection
@section('additional_headers')
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Display Examination</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('exam.list_view')}}">All Examination</a></li>
                    <li class="breadcrumb-item active">Display Examination</li>
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
                        <h3 class="card-title"><i class="fas fa-info-circle @if($exam->is_active == 1){{"text-success"}}@else{{"text-danger"}}@endif"></i> Display Examination ({{ $exam->name }})</h3>
                        <div class="card-tools">
                            <a href="{{route('exam.edit',$exam->id)}}" class="d-inline btn btn-xs btn-dark-blue"><i class="far fa-edit"></i> Edit</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-md-3 col-sm-6">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted"><i class="far fa-clock"></i> Start Time</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{ date('h:i a', strtotime($exam->start_time)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 col-sm-6">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted"><i class="fas fa-clock"></i> End Time</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{ date('h:i a', strtotime($exam->end_time)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 col-sm-6">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted"><i class="fas fa-calendar-day"></i> Date</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{ date('d.m.Y', strtotime($exam->date)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 col-sm-6">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted"><i class="fas fa-stopwatch"></i> Duration</span>
                                                <span class="info-box-number text-center text-muted mb-0">{{ $exam->duration }} Minutes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4><i class="far fa-user-circle"></i> Teacher Details</h4>
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle @if($exam->classroom->teacher->isActive == 1){{"image-border-green"}}@else{{"image-border-red"}}@endif" src="/teacher_images/{{$exam->classroom->teacher->image}}" alt="Teacher Image">
                                                <span class="username">
                                                    <a href="#" class="text-dark-moon">{{$exam->classroom->teacher->user->name}}</a> ({{$exam->classroom->teacher->designation}})
                                                </span>
                                                <span class="description">{{$exam->classroom->teacher->subject}}</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row">
                                                <div class="col-6">
                                                    <p> <b><i class="fas fa-envelope-open-text"></i> Email:</b> {{$exam->classroom->teacher->user->email}}</p>
                                                </div>
                                                <div class="col-6">
                                                    <p> <b><i class="fas fa-phone-volume"></i> Phone:</b> {{$exam->classroom->teacher->user->phone}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p> <b><i class="fas fa-user-alt"></i> Gender:</b> {{$exam->classroom->teacher->gender}}</p>
                                                </div>
                                                <div class="col-6">
                                                    <p> <b><i class="fas fa-graduation-cap"></i> Experience:</b> {{$exam->classroom->teacher->experience}}</p>
                                                </div>
                                            </div>
                                            <p>
                                                <a href="{{route('teacher.display', $exam->classroom->teacher_id)}}" class="btn btn-xs btn-dark-blue"><i class="fas fa-eye"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                <h3 class="text-dark-moon"><i class="fas fa-paint-brush"></i> Details</h3> 
                                <p class="text-muted">
                                    <b>Name:</b> {{$exam->classroom->name}} <br> 
                                    <b>Class:</b> {{$exam->classroom->class->name}} <br>
                                    <b>Course:</b> {{$exam->classroom->course->name}} ({{$exam->classroom->course->code}})
                                </p>
                                <div class="text-muted">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-sm">Capacity:
                                                <b class="d-block">{{$exam->classroom->capacity}}</b>
                                            </p>
                                            <p class="text-sm">Enrolled:
                                                <b class="d-block">{{$exam->classroom->enrolled}}</b>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-sm">Status:
                                                <b class="d-block">
                                                    {!! App\Models\Classroom::getStatus($exam->is_active) !!}
                                                </b>
                                            </p>
                                            <p class="text-sm">Marks:
                                                <b class="d-block">{{$exam->marks}}</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>

@endsection
@section('additional_scripts')

@endsection