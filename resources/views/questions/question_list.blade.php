@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }} | Question List
@endsection
@section('additional_headers')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Question List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('question.list')}}">All Questions</a></li>
                        <li class="breadcrumb-item active">Question List</li>
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
                        <h3>Question Lists({{$exam->name}})</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($questions->count() != 0)
                            @php
                                $count = 1;
                                $number = 1;
                            @endphp
                            @if($exam->type == 1)
                                @foreach($questions as $question)
                                    @if($question->type == "text")
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between row">
                                                    <div class="col-11">
                                                        <h5><b>{{$count}}.</b></h5> {!! $question->question !!}
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="btn-group">
                                                            <a href="{{route('question.edit',$question->id)}}" class="ml-3 text-dark-blue-gradient"><i class="fas fa-edit"></i></a> 
                                                            <a href="{{route('question.delete',$question->id)}}" class="ml-2 text-dark-red-gradient"><i class="fas fa-trash-alt"></i></a> 
                                                        </div>
                                                        <div class="ml-4 mt-4 mark-neon-Text">{{$question->mark}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            @elseif($exam->type == 2)
                                @foreach($questions as $question)
                                    @php
                                        $option_lists = explode(",", $question->option_list);
                                    @endphp
                                    @if($question->type == "select")
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5><b>{{$count}}. </b> {{$question->question}}  <span class="ml-3 mark-neon-Text">{{$question->mark}}</span></h5>
                                                    </div>
                                                    <div>
                                                        <a href="{{route('question.edit',$question->id)}}" class="ml-3 text-dark-blue-gradient"><i class="fas fa-edit"></i></a> 
                                                        <a href="{{route('question.delete',$question->id)}}" class="ml-2 text-dark-red-gradient"><i class="fas fa-trash-alt"></i></a> 
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
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5><b>{{$count}}. </b> {{$question->question}} <span class="ml-3 mark-neon-Text">{{$question->mark}}</span></h5>
                                                    </div>
                                                    <div>
                                                        <a href="{{route('question.edit',$question->id)}}" class="ml-3 text-dark-blue-gradient"><i class="fas fa-edit"></i></a> 
                                                        <a href="{{route('question.delete',$question->id)}}" class="ml-2 text-dark-red-gradient"><i class="fas fa-trash-alt"></i></a> 
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
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5><b>{{$count}}. </b> {{$question->question}}  <span class="ml-3 mark-neon-Text">{{$question->mark}}</span></h5>
                                                    </div>
                                                    <div>
                                                        <a href="{{route('question.edit',$question->id)}}" class="ml-3 text-dark-blue-gradient"><i class="fas fa-edit"></i></a> 
                                                        <a href="{{route('question.delete',$question->id)}}" class="ml-2 text-dark-red-gradient"><i class="fas fa-trash-alt"></i></a> 
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
@endsection