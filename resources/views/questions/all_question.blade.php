@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | All Questions 
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
                <h1 class="m-0">All Questions</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">All Questions</li>
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
                            All Questions (0)
                        </h3>
                        <div class="card-tools">
                            
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
                                @foreach ($examinations as $exam)
                                    <tr>
                                        <td>{{$exam->id}}</td>
                                        <td>{{$exam->name}}({!! App\Models\Examination::getType($exam->type) !!})</td>
                                        <td>{{$exam->classroom->name}}</td>
                                        <td>{{$exam->classroom->course->name}}</td>
                                        <td class="text-center">{{$exam->question->count()}}</td>
                                        <td class="text-center">{{$exam->question->sum('mark')}}/{{$exam->marks}}</td>
                                        <td>
                                            <a href="{{route('question.question_list', $exam->id)}}" class="btn btn-sm btn-dark-blue"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{$examinations->links()}}
                        </ul>
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