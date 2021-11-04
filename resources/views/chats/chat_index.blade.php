@extends('layouts.app')
@section('title')
    {{ env('APP_NAME') }} | Classroom Chat  
@endsection
@section('additional_headers')
    <!-- Emojionearea -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/emojionearea/emojionearea.min.css">
@endsection
@section('content')
<div class="container-fliud">
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Classroom Chat View</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('classroom.list_view')}}">All Classroom</a></li>
                    <li class="breadcrumb-item"><a href="{{route('classroom.display',$classroom->id)}}">Display Classroom</a></li>
                    <li class="breadcrumb-item active">Classroom Chat View</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <div class="card card-dark-moon card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    All People in Classroom
                                </h3>
                                <div class="card-tools">
                                    <a class="btn btn-xs btn-dark-blue"><i class="fas fa-users"></i></a>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-y: scroll !important; height:400px !important;">
                                <ul class="contacts-list">
                                    <li>
                                        <a href="#">
                                            <img class="contacts-list-img @if($classroom->teacher->user_id == Auth::user()->id){{"image-border-green"}}@else{{"image-border-red"}}@endif" height="40" width="40" src="/teacher_images/{{$classroom->teacher->image}}" alt="Teacher Avatar">

                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name text-dark-moon d-inline">
                                                    {{$classroom->teacher->user->name}}
                                                    <span class="badge badge-primary float-right">3</span> <br>
                                                    <span class="text-dark" style="font-size: .7rem;">Teacher</span>
                                                </span>
                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    @foreach($enrolledStudentLists as $enrolledStudent)
                                    <li>
                                        <a href="#">
                                            <img class="contacts-list-img @if($enrolledStudent->student->user_id == Auth::user()->id){{"image-border-green"}}@else{{"image-border-red"}}@endif" height="40" width="40" src="/student_images/{{$enrolledStudent->student->image}}" alt="Student Avatar">

                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name text-dark-moon ">
                                                    <td>{{ $enrolledStudent->student->user->name }}</td>
                                                    <span class="badge badge-primary float-right">3</span> <br>
                                                    <span class="text-dark" style="font-size: .7rem;">Student</span>
                                                </span>
                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                    <!-- End Contact Item -->
                                    @endforeach
                                </ul>
                                <!-- /.contacts-list -->
                            </div>
                        </div>
                    </div>    
                    <div class="col-9">
                        
                    </div>      
                </div>      
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>


@endsection
@section('additional_scripts')
    <!-- Emojionearea -->
    <script src="{{asset('assets')}}/plugins/emojionearea/emojionearea.min.js"></script>
    {{-- Jscroll js --}}
    <script src="{{asset('assets')}}/plugins/jscroll/jscroll.min.js"></script>
    {{-- Pusher js --}}
    <script src="{{asset('assets')}}/plugins/pusher/7.0/pusher.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#example1").emojioneArea();
    });
    </script>
    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="mx-auto d-block" src="/assets/image/icons/loader.svg" alt="Loading..." />', // MAKE SURE THAT YOU PUT THE CORRECT IMG PATH
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
@endsection