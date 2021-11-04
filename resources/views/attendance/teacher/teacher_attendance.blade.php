@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Teacher Attendance 
@endsection
@section('additional_headers')
<style>
    
</style>
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Teacher Attendance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Teacher Attendance</li>
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
                            Teacher Attendance
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-5">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Month:</b> {{ now()->setMonth(now()->month)->format('F') }}</li>
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Year:</b> {{ now()->year }}</li>
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Number Of Teachers:</b> {{$count}} </li>
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Today's Time:</b> <span id="current_time"></span> </li>
                                </ul>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>days in Month:</b> {{ now()->daysInMonth }} </li>
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Weekend This Month:</b> {{$weeklyHoliday}} </li>
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Today's Date:</b> {{ date('d-m-Y') }} </li>
                                    <li class="list-group-item d-flex justify-content-between p-0 p-2"><b>Attendance Time:</b> 9 AM </li>
                                </ul>
                            </div>
                        </div>
                        <form action="{{ route('attendance.teacher_attendance_save') }}" method="POST">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Unique ID</th>
                                    <th>Created At</th>
                                    <th  class="text-center">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-dark-green-gradient">Present </span>/
                                            <span class="text-dark-yellow-gradient"> Late </span>/
                                            <span class="text-dark-red-gradient"> Absent </span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $teacher->id }}</td>
                                        <td>{{ $teacher->user->name }}</td>
                                        <td>weqr</td>
                                        <td>{{ $teacher->created_at->format('d.m.Y') }}</td>
                                        <td>
                                            @php
                                                $checker = App\Models\Attendance_teacher::checkTeacherAttendance($teacher->id);
                                            @endphp
                                            <div class="d-flex justify-content-between">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio1{{$teacher->id}}" name="teacher{{$teacher->id}}" value="{{$teacher->id}},P" class="custom-control-input custom-control-input-dark-green" @if($checker != null || !(now()->format('H') < "9")) disabled @endif @if($checker != null && $checker->status == "P")checked @endif>
                                                    <label class="custom-control-label" for="customRadio1{{$teacher->id}}">P</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio2{{$teacher->id}}" name="teacher{{$teacher->id}}" value="{{$teacher->id}},L" class="custom-control-input custom-control-input-dark-yellow" @if($checker != null) disabled @endif @if($checker != null && $checker->status == "L")checked @endif>
                                                    <label class="custom-control-label" for="customRadio2{{$teacher->id}}">L</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio3{{$teacher->id}}" name="teacher{{$teacher->id}}" value="{{$teacher->id}},A" class="custom-control-input custom-control-input-dark-danger" @if($checker != null) disabled @endif @if($checker != null && $checker->status == "A")checked @endif>
                                                    <label class="custom-control-label" for="customRadio3{{$teacher->id}}">A</label>
                                                </div>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-sm btn-deep-green float-right"><i class="fas fa-power-off"></i> Submit</button>
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
    <script src="{{asset('js/teacher_attendance/current_time_finder.js')}}"></script>
@endsection