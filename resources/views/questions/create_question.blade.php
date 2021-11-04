@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Create Question 
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/summernote/summernote-bs4.min.css">
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Question</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Question</li>
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
                        Create Question ({{$count}})
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="courseForm" action="{{route('question.save_created')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="select_examination">Select Examination</label>
                                    <select id="examination" name="select_examination" class="form-control select2" >
                                        <option selected="selected" value="" disabled>Choose a Examination</option>
                                        @foreach ($examinations as $exam)
                                            <option value="{{$exam->id}}" @if(old('select_examination') == $exam->id){{"selected"}}@endif>{{$exam->name}}({!! App\Models\Examination::getType($exam->type) !!})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="class_name" class="d-flex"> 
                                        Question <span id="countExam"></span>
                                    </label>
                                    <textarea id="summernote" name="question" class="form-control form-control-border border-width-2" placeholder="Question">
                                        {{old('question')}}
                                    </textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleSelectBorderWidth2">Select Your Type</label>
                                            <select name="type" class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                                                <option selected="selected" value="" disabled>Choose a Type</option>
                                                <option value="select" @if(old('type') == 'select'){{"selected"}}@endif>Select</option>
                                                <option value="radio" @if(old('type') == 'radio'){{"selected"}}@endif>Radio</option>
                                                <option value="number" @if(old('type') == 'number'){{"selected"}}@endif>Number</option>
                                                <option value="text" @if(old('type') == 'text'){{"selected"}}@endif>Text</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleSelectBorderWidth2">Select Your Option</label>
                                            <select name="option" class="custom-select form-control-border border-width-2" id="myOption" onchange="myFunction()">
                                                <option selected="selected" value="" disabled>Choose a Option</option>
                                                @for($i=0;$i<=5; $i++)
                                                    <option value="{{$i}}" @if(old('option') == $i){{"selected"}}@endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="demo">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="question">Answer</label>
                                            <input type="text" name="answer" value="{{old('answer')}}" class="form-control form-control-border border-width-2" id="answer" placeholder="Enter Answer">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="question" class="d-flex">
                                                Mark <span id="restOfMarks"></span>
                                            </label>
                                            <select name="mark" class="custom-select form-control-border border-width-2" id="mark">
                                                <option selected="selected" value="" disabled>Choose a Mark</option>
                                                @for($i=0;$i<=20; $i++)
                                                    <option value="{{$i}}" @if(old('mark') == $i){{"selected"}}@endif>{{$i}}</option>
                                                @endfor
                                            </select>
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
    <script src="{{asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Summernote -->
    <script src="{{asset('assets')}}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="{{asset('js/question/question.js')}}"></script>
@endsection

