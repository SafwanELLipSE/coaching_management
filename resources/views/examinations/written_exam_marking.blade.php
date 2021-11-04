@extends('layouts.app')

@section('title')
    {{ env('APP_NAME') }} | Written Examination Questions
@endsection
@section('additional_headers')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
                    <h1 class="m-0">Written Examination Questions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('question.list')}}">All Questions</a></li>
                        <li class="breadcrumb-item active">Written Examination Questions</li>
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
                        <h3 class="card-title text-bold">Written Examination Questions ({{$exam->name}}) <br><span class="font-weight-normal">- {{$exam->classroom->course->name}}</span></h3>
                        <div class="card-tools text-center">
                            <span class="text-bold">Total Marks:</span> {{$exam->marks}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{route('exam.written_markdown_submit')}}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-5">
                                <p class="text-center text-bold h5">Select Student</p>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <div class="form-group">
                                    <select name="select_student" class="form-control select2" >
                                        <option selected="selected" value="" disabled>Choose a Student</option>
                                        @foreach ($enrolledStudentLists as $enrolledStudent)
                                            <option value="{{$enrolledStudent->id}}" @if(old('select_student') == $enrolledStudent->id){{"selected"}}@endif>{{$enrolledStudent->user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="examination_id" name="examination_id" value="{{$exam->id}}">
                        @if($questions->count() != 0)
                        <div class="items-container">
                            @php
                                $count = 1;
                                $number = 1;
                            @endphp
                            @if($exam->type == 1)
                                @foreach($questions as $question)
                                    @php
                                        $option_lists = explode(",", $question->option_list);
                                    @endphp
                                    @if($question->type == "text")
                                        <div class="item item-visible row mb-2">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h5><b>{{$count}}. </b> {!!$question->question!!}</h5>
                                                    </div>
                                                    <div>
                                                        <a class="mark-neon-Text border border-info rounded-lg p-0 px-1 ml-1">{{$question->mark}}</a>
                                                    </div>
                                                </div>
                                                <div class="row col-4">
                                                    <input type="hidden" id="question_id" name="question_ids[]" value="{{$question->id}}">
                                                    <input type="{{$question->type}}" class="form-control form-control-border border-width-2" name="marks[]" value="{{old('marks[]')}}" id="mark{{$number}}" placeholder="Enter Your Mark">
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
    <script src="{{asset('assets')}}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{asset('js/jquery.jold.paginator.min.js')}}"></script> 
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
        })
    </script>
    <script>
        (function($){
            // Initiate the paginator on the .items-container element.
            var paginator = new $('.items-container').joldPaginator({
                'perPage': 6,
                'items': '.item',
                'paginator': '.pagination-container',
                'indicator': {
                    'selector': '.pagination-indicator',
                    'text': 'Showing item {start}-{end} of {total}',
                }
            });
            // Toggle items
            $('body').on('change', '.js-toggle-items', function(e) {
                e.preventDefault();
                var checked = this.checked;
                $('.items-container').find('.item')
                    .removeClass('item-hidden')
                    .addClass('item-visible');
                // Include historical reports (invalid)
                if ( checked == true ) {
                    $('.items-container').find('.item-toggleable')
                        .removeClass('item-hidden')
                        .addClass('item-visible');
                }
                // Exclude historical reports (invalid)
                if ( checked == false ) {
                    $('.items-container').find('.item-toggleable')
                        .removeClass('item-visible')
                        .addClass('item-hidden');
                }
                // Reset the paginator
                paginator.init();
            });
        })(jQuery);
    </script>
@endsection