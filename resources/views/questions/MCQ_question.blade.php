@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }} | MCQ Examination Questions
@endsection
@section('additional_headers')
    <link rel="stylesheet" href="{{asset('css/mcq_question.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">MCQ Examination Questions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('question.list')}}">All Questions</a></li>
                        <li class="breadcrumb-item active">MCQ Examination Questions</li>
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
                    <div class="card-header d-inline">
                        <h3 class="card-title text-bold">MCQ Examination Questions ({{$exam->name}}) <br><span class="font-weight-normal">- {{$exam->classroom->course->name}}</span></h3>
                        <div class="card-tools text-center">
                            <span class="text-bold">Total Marks:</span> {{$exam->marks}}
                            <span class="text-bold ml-3">Duration:</span> {{$exam->duration}} minutes <br>
                            <span class="text-bold ml-5">Time Counter:</span> <span class="ml-2" id="countDownTimer"></span>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <input type="hidden" id="exam_duration" value="{{$exam->duration}}">
                        <form action="{{route('exam.MCQ_taken')}}" method="POST">
                            @csrf
                        @if($questions->count() != 0)
                        <div class="items-container">
                            @php
                                $count = 1;
                                $number = 1;
                            @endphp
                            @if($exam->type == 2)
                                @foreach($questions as $question)
                                    @php
                                        $option_lists = explode(",", $question->option_list);
                                    @endphp
                                    <input type="hidden" id="examination_id" name="examination_id" value="{{$exam->id}}">
                                    @if($question->type == "select")
                                        <div class="item item-visible row mb-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5><b>{{$count}}. </b> {!!$question->question!!}</h5>
                                                    </div>
                                                    <div>
                                                        <a class="mark-neon-Text border border-info rounded-lg p-0 px-1">{{$question->mark}}</a>
                                                    </div>
                                                </div>
                                                <div class="row col-6">
                                                    <select name="answer{{$number}}" id="answer{{$number}}" class="custom-select form-control-border border-width-2">
                                                            <option value="" selected>select a Answer</option>
                                                        @for($i = 0; $i < $question->number_option; $i++)
                                                            <option value="{{$option_lists[$i]}}">{{$option_lists[$i]}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($question->type == "radio")
                                        <div class="item item-visible row mb-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5><b>{{$count}}. </b> {!!$question->question!!}</h5>
                                                    </div>
                                                    <div>
                                                        <a class="mark-neon-Text border border-info rounded-lg p-0 px-1">{{$question->mark}}</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @for($i = 0; $i < $question->number_option; $i++)
                                                        <div class="@if($question->number_option == 4 || $question->number_option == 3) col-3 @else col-6 @endif">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="{{$question->type}}" name="answer{{$number}}" id="answer{{$number}}" value="{{$option_lists[$i]}}">
                                                                <label class="form-check-label">{{$option_lists[$i]}}</label>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($question->type == "number")
                                        <div class="item item-visible row mb-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5><b>{{$count}}. </b> {!!$question->question!!}</h5>
                                                    </div>
                                                    <div>
                                                        <a class="mark-neon-Text border border-info rounded-lg p-0 px-1">{{$question->mark}}</a>
                                                    </div>
                                                </div>
                                                <div class="row col-6">
                                                    <input type="{{$question->type}}" class="form-control form-control-border border-width-2" name="answer{{$number}}" id="answer{{$number}}" placeholder="Enter Your Number">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $count++;
                                        $number++;
                                    @endphp
                                @endforeach
                                <hr>
                                <div class="row mt-3">
                                    <ul class="pagination-container mx-auto"></ul>
                                </div>
                            </div>
                                <hr>
                                <div class="row float-right">
                                    <button type="submit" class="btn btn-sm btn-deep-green">Submit</button>
                                </div>
                            </form>
                            @endif
                        </div>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <h4>No Question Available there. Please create some question for this sects</h4>
                                </div> 
                            </div>
                        @endif
                    </div>
            </div><!-- /.container-fluid -->
        </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('additional_scripts')
    <script src="{{asset('js/jquery.jold.paginator.min.js')}}"></script> 
    <script src="{{asset('js/mcq_question.js')}}"></script>
@endsection