<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('assets')}}/dist/img/main-logo.svg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8; background: #ffffff;">
        <span class="brand-text font-weight-light">Clubspectre</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('dashboard')}}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{Request::is('dashboard') || Request::is('dashboard/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{Request::is('course') || Request::is('course/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('course') || Request::is('course/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Course
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('course.index')}}" class="nav-link {{Request::is('course') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('course.list')}}" class="nav-link {{Request::is('course/list') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>All Course</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::is('grade') || Request::is('grade/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('grade') || Request::is('grade/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-award"></i>
                        <p>
                            Grade
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('grade.index')}}" class="nav-link {{Request::is('grade') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('grade.list')}}" class="nav-link {{Request::is('grade/list') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>All Grades</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::is('class') || Request::is('class/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('class') || Request::is('class/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Class
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('class.index')}}" class="nav-link {{Request::is('class') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('class.list')}}" class="nav-link {{Request::is('class/list') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>All Class</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::is('teacher') || Request::is('teacher/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('teacher') || Request::is('teacher/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Teacher
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('teacher.index')}}" class="nav-link {{Request::is('teacher') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('teacher.list')}}" class="nav-link {{Request::is('teacher/list') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>All Teacher</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::is('student') || Request::is('student/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('student') || Request::is('student/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Student
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('student.index')}}" class="nav-link {{Request::is('student') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('student.list_view')}}" class="nav-link {{Request::is('student/list-view') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>All Student</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::is('classroom') || Request::is('classroom/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('classroom') || Request::is('classroom/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>
                            Classroom
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('classroom.index')}}" class="nav-link {{Request::is('classroom') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('classroom.list_view')}}" class="nav-link {{Request::is('classroom/list-view') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>All Classroom</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::is('exam') || Request::is('exam/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('exam') || Request::is('exam/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-pen-fancy"></i>
                        <p>
                            Examination
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('exam.index')}}" class="nav-link {{Request::is('exam') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('exam.list_view')}}" class="nav-link {{Request::is('exam/list-view') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>All Examination</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::is('question') || Request::is('question/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('question') || Request::is('question/*') ? 'active' : ''}}">
                        <i class="nav-icon far fa-question-circle"></i>
                        <p>
                            Question
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('question.index')}}" class="nav-link {{Request::is('question') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('question.list')}}" class="nav-link {{Request::is('question/list-view') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>All Question</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{Request::is('attendance') || Request::is('attendance/*') ? 'menu-is-opening menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('attendance') || Request::is('attendance/*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Attendance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('attendance.teacher_view')}}" class="nav-link {{Request::is('attendance/teacher-view') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Teacher Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('attendance.student_view')}}" class="nav-link {{Request::is('attendance/student-view') ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                                <p>Student Attendance</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
