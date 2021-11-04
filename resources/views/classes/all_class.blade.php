@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | All Classes 
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
                <h1 class="m-0">All Classes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">All Classes</li>
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
                            All Classes ({{$count}})
                        </h3>
                        <div class="card-tools">
                            <form action="{{route('class.search')}}" method="get">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="class_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-dark-green">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classes as $class)
                                <tr>
                                    <td>{{ $class->id }}</td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->created_at->format('d.m.Y') }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#modal-edit-class" data-classid="{{$class->id}}" data-classname="{{$class->name}}" class="btn btn-sm btn-dark-blue"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('class.delete', $class->id)}}" class="btn btn-sm btn-dark-red"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {{$classes->links()}}
                        </ul>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
<div class="modal fade" id="modal-edit-class" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-navy">
                <h4 class="modal-title">Edit Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('class.save_edit')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="class_id" name="class_id" value="">
                        <div class="form-group">
                            <label for="class_name">Class Name</label>
                            <input type="text" name="class_name" id="class_name" value="" class="form-control form-control-border border-width-2" placeholder="Class Name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <a class="btn btn-dark-moon" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-dark-green">Update</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

@endsection
@section('additional_scripts')
    <script type="text/javascript">
        $('#modal-edit-class').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var class_id = button.data('classid');
            var class_name = button.data('classname');
            var modal = $(this);
            modal.find('.modal-body #class_id').val(class_id);
            modal.find('.modal-body #class_name').val(class_name);
        })
    </script>
@endsection