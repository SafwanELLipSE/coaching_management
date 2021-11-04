@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | All Examinations 
@endsection
@section('additional_headers')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                <h1 class="m-0">All Examinations</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">All Examinations</li>
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
                            All Examinations ({{$count}})
                        </h3>
                        <div class="card-tools">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="exam_table" class="table table-bordered table-striped table-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="15%">Name</th>
                                    <th width="15%">
                                        <select id="classroom" class="custom-select form-control-border border-width-2">
                                            <option value="" selected>Class</option>
                                            @foreach($classrooms as $classroom)
                                                <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th width="15%">
                                        <select id="type_exam" class="custom-select form-control-border border-width-2">
                                            <option value="" selected>Status</option>
                                            <option value="2">Written</option>
                                            <option value="3">MCQ</option>
                                        </select>
                                    </th>
                                    <th width="10%">Date</th>
                                    <th width="10%">Time</th>
                                    <th width="10%">Duration (Min)</th>
                                    <th width="10%">Marks</th>
                                    <th width="25%">
                                        <select id="status_exam" class="custom-select form-control-border border-width-2">
                                            <option value="" selected>Status</option>
                                            <option value="1">Inactive</option>
                                            <option value="2">Active</option>
                                        </select>
                                    </th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            
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
    {{-- sweet alert 2 --}}
    <script src="{{asset('assets')}}/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('assets')}}/plugins/jszip/jszip.min.js"></script>
    <script src="{{asset('assets')}}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{asset('assets')}}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('assets')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{asset('js/examination/examination_list.js')}}"></script>
@endsection