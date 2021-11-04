@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | All Grades 
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
                <h1 class="m-0">All Grades</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">All Grades</li>
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
                            All Grades ({{$count}})
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Grade</th>
                                    <th>From(Marks)</th>
                                    <th>To(Marks)</th>
                                    <th>GPA Point</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $grade->id }}</td>
                                    <td>{{ $grade->grade }}</td>
                                    <td>{{ $grade->from_range }}</td>
                                    <td>{{ $grade->to_range }}</td>
                                    <td>{{ $grade->point }}</td>
                                    <td>{{ $grade->created_at->format('d.m.Y') }}</td>
                                    <td>
                                        <a href="{{route('grade.edit', $grade->id)}}" class="btn btn-sm btn-dark-blue"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('grade.delete', $grade->id)}}" class="btn btn-sm btn-dark-red"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{$grades->links()}}
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
