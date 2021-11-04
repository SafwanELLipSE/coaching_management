@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Classroom Examinations 
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
                <h1 class="m-0">Classroom Examinations</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('classroom.list_view')}}">All Classroom</a></li>
                    <li class="breadcrumb-item"><a href="{{route('classroom.display',$id)}}">Display Classroom</a></li>
                    <li class="breadcrumb-item active">Classroom Examinations</li>
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
                            Classroom Examinations 
                        </h3>
                        <div class="card-tools">
                            <h6 class="text-dark-red-gradient"><b>Total Marks:</b> {{$examinations->sum('marks')}}</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Classroom</th>
                                    <th>Subject</th>
                                    <th>Number of Question</th>
                                    <th>Mark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($examinations) != 0)
                                    @foreach ($examinations as $exam)
                                        <tr>
                                            <td>{{$exam->id}}</td>
                                            <td>{{$exam->name}}({!! App\Models\Examination::getType($exam->type) !!})</td>
                                            <td>{{$exam->classroom->name}}</td>
                                            <td>{{$exam->classroom->course->name}}</td>
                                            <td class="text-center">{{$exam->question->count()}}</td>
                                            <td class="text-center">{{$exam->question->sum('mark')}}/{{$exam->marks}}</td>
                                            <td>
                                                @if($exam->type == 2)
                                                    <a href="{{route('exam.MCQ_exam',$exam->id)}}" class="btn btn-sm btn-light-green"><i class="fas fa-pen-nib"></i> Take Exam</a>
                                                @elseif($exam->type == 1)
                                                    <span class="d-flex-inline">
                                                        <a href="{{route('exam.written_question_pdf',$exam->id)}}" class="btn btn-sm btn-deep-purple"><i class="fas fa-print"></i> Print Exam</a>
                                                        <a href="{{route('exam.written_markdown_exam',$exam->id)}}" class="btn btn-sm btn-lemon-green"><i class="fas fa-highlighter"></i> Mark Down</a>
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No Examinations is Available there.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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