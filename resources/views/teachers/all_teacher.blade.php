@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | All Teacher 
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
                <h1 class="m-0">All Teacher</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">All Teacher</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
        <div class="card card-solid">
            <div class="card-header">
                <h3 class="card-title">All Teacher ({{$count}})</h3>
                <div class="card-tools">
                    <form action="{{route('teacher.search')}}" method="get">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="teacher_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark-green">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch">
                    @foreach ($teachers as $teacher)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                    {{ $teacher->designation }} ({{$teacher->subject}})
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{ $teacher->user->name }}</b></h2>
                                            <p class="text-muted text-sm"><b>Institute: </b> {{$teacher->institute }} </p>
                                            <p class="text-muted text-sm"><b>Qualification: </b> {{$teacher->qualification }} </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pen-nib"></i></span> Subject: {{$teacher->subject}}</li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{$teacher->address}}</li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Email: {{$teacher->user->email}}</li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 88 - {{$teacher->user->phone}}</li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="/teacher_images/{{$teacher->image}}" width="260" alt="user-avatar" class="img-circle img-fluid @if($teacher->isActive == 1){{"image-border-green"}}@else{{"image-border-red"}}@endif" style="height: 6rem !important;">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{route('teacher.display', $teacher->id)}}" class="btn btn-sm btn-dark-blue">
                                            <i class="fas fa-user"></i> View Profile
                                        </a>
                                        <a href="{{route('teacher.display_teacher', $teacher->id)}}" class="btn btn-sm btn-deep-purple"><i class="far fa-calendar-alt"></i></a>
                                        <a href="{{route('teacher.delete', $teacher->id)}}" class="btn btn-sm btn-dark-red">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <nav aria-label="Contacts Page Navigation">
                <ul class="pagination justify-content-center m-0">
                    {{$teachers->links()}}
                </ul>
            </nav>
            </div>
            <!-- /.card-footer -->
        </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
@endsection
@section('additional_scripts')
    
@endsection
