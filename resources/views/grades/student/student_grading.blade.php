@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Student Grading 
@endsection
@section('additional_headers')
    {{-- sweet alert 2 --}}
    <link src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.min.css">
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Student Grading</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('classroom.list_view')}}">All Classroom</a></li>
                    <li class="breadcrumb-item"><a href="{{route('classroom.display',$id)}}">Display Classroom</a></li>
                    <li class="breadcrumb-item active">Student Grading</li>
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
                                    <th>Number of Question</th>
                                    <th>Mark</th>
                                    <th>Obtain Mark</th>
                                    <th>Mark Count(%)</th>
                                    <th>Calculation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                <input type="hidden" id="numberOfExam" value="{{count($examinations)}}">
                                @if(count($examinations) != 0)
                                    @foreach ($examinations as $exam)
                                        <tr>
                                            <td>{{$exam->id}}</td>
                                            <td>
                                                {{$exam->name}}({!! App\Models\Examination::getType($exam->type) !!})
                                            </td>
                                            <td class="text-center">
                                                {{$exam->question->count()}}
                                            </td>
                                            <td class="text-center">
                                                {{$exam->question->sum('mark')}}/{{$exam->marks}} 
                                                <input type="hidden" id="examMark{{$count}}" value="{{$exam->marks}}">
                                            </td>
                                            <td class="text-center">
                                                {{-- Written --}}
                                                @if($exam->type == 1) 
                                                    {!! App\Models\Student_grading::getMarkWritten($exam->id,$id) !!}
                                                    <input type="hidden" id="obtain{{$count}}" value="{{App\Models\Student_grading::getMarkWritten($exam->id,$id)}}">
                                                {{-- MCQ --}}
                                                @elseif($exam->type == 2)
                                                    {!! App\Models\Student_grading::getMarkMCQ($exam->id,$id) !!}
                                                    <input type="hidden" id="obtain{{$count}}" value="{{App\Models\Student_grading::getMarkMCQ($exam->id,$id)}}">
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" id="percentage{{$count}}" class="form-control form-control-border border-width-2 mx-auto" style="width:30%;">
                                            </td>
                                            <td>
                                                <span id="markCalulation{{$count++}}"></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>#</td>
                                        <td colspan="5" class="text-center"><b>Total Marks:</b></td>
                                        <td><input type="text" id="calculatedTotal" value="" class="form-control form-control-border border-width-2 mx-auto" style="width:40%;"></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No Examinations is Available there.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-6">
                            </div>
                            <div class="col-4 text-center">
                                <a id="totalMarkCalculation" class="btn btn-sm btn-dark-blue mt-2 mr-3"> Calution </a>
                                <a onclick="gradeCalculation()" class="btn btn-sm btn-light-green mt-2"> Grading </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="viewGradeLayer" class="card card-dark-moon card-outline" style="display: none">
                    <div class="card-body">
                        <form action="{{route('studentGrade.save_created')}}" method="POST">
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="total_mark">Total Mark</label>
                                        <input type="text" name="total_mark" value="{{old('total_mark')}}" class="form-control form-control-border border-width-2" id="total_mark" placeholder="Total Marks">
                                    </div>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="student_grade">Grade</label>
                                        <select name="student_grade" id="student_grade" class="form-control form-control-border border-width-2">
                                            <option value="" selected disabled>Choose a Grade</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{$grade->grade}}">{{$grade->grade}} ({{$grade->from_range}}-{{$grade->to_range}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-sm btn-light-green mx-auto">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
@endsection
@section('additional_scripts')
    {{-- sweet alert 2 --}}
    <script src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="{{asset('js/grading/grading_student.js')}}"></script>
@endsection