@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Create Class 
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
                <h1 class="m-0">Create Class</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Create Class</li>
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
                        Create Class ({{$count}})
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="courseForm" action="{{route('class.save_created')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="class_name">Class Name</label>
                                    <input type="text" name="class_name" value="{{old('class_name')}}" class="form-control form-control-border border-width-2" id="class_name" placeholder="Class Name">
                                </div>

                                <button type="submit" class="btn btn-dark-green btn-sm float-right"> Save </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
@endsection
@section('additional_scripts')
    <!-- jquery-validation -->
    <script src="{{asset('assets')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $('#courseForm').validate({
            rules: {
                class_name: {
                    required: true,
                },
            },
            messages: {
                class_name: {
                    required: "Please enter your Class Name.",
                },
            },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    </script>
@endsection

