@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Create Grade 
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
                <h1 class="m-0">Create Grade</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Grade</li>
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
                        Create Grade ({{$count}})
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="courseForm" action="{{route('grade.save_created')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="grade">Grade</label>
                                    <input type="text" name="grade" value="{{old('grade')}}" class="form-control form-control-border border-width-2" id="grade" placeholder="Grade">
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="starting_range">Starting Mark Range</label>
                                            <input type="text" name="starting_range" value="{{old('starting_range')}}" class="form-control form-control-border border-width-2" id="starting_range" placeholder="Starting Mark">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="ending_range">Ending Mark Range</label>
                                            <input type="text" name="ending_range" value="{{old('ending_range')}}" class="form-control form-control-border border-width-2" id="ending_range" placeholder="Ending Mark">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="point">Points</label>
                                            <input type="text" name="point" value="{{old('point')}}" class="form-control form-control-border border-width-2" id="point" placeholder="Point of GPA">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark-green btn-sm float-right"> Save </button>
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
    <!-- jquery-validation -->
    <script src="{{asset('assets')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('js/grading/form_validation.js')}}"></script>
@endsection
