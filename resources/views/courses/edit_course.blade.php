@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Edit Course 
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
                <h1 class="m-0">Edit Course</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('course.list')}}">All Course</a></li>
                <li class="breadcrumb-item active">Edit Course</li>
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
                        Edit Course
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{route('course.save_edit')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    <label for="course_name">Course Name</label>
                                    <input type="text" name="course_name" value="{{$course->name}}" class="form-control form-control-border border-width-2" id="course_name" placeholder="Course Name">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="course_code">Course Code</label>
                                            <input type="text" name="course_code" value="{{$course->code}}" class="form-control form-control-border border-width-2" id="course_code" placeholder="Course Code">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="course_mark">Course Mark</label>
                                            <input type="text" name="course_mark" value="{{$course->marks}}" class="form-control form-control-border border-width-2" id="course_mark" placeholder="Course Mark">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark-green btn-sm float-right"> Update </button>
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
    
@endsection
