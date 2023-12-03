<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});


Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

    Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\CourseController@index']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\CourseController@store']);
        Route::get('list', ['as' => 'list', 'uses' => 'Admin\CourseController@list']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\CourseController@edit']);
        Route::post('save-edit', ['as' => 'save_edit', 'uses' => 'Admin\CourseController@update']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'Admin\CourseController@delete']);
        Route::get('search', ['as' => 'search', 'uses' => 'Admin\CourseController@list']);
    });

    Route::group(['prefix' => 'grade', 'as' => 'grade.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\GradeController@index']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\GradeController@store']);
        Route::get('list', ['as' => 'list', 'uses' => 'Admin\GradeController@list']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\GradeController@edit']);
        Route::post('save-edit', ['as' => 'save_edit', 'uses' => 'Admin\GradeController@update']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'Admin\GradeController@delete']);
        Route::get('search', ['as' => 'search', 'uses' => 'Admin\GradeController@list']);
    });

    Route::group(['prefix' => 'class', 'as' => 'class.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\ClassController@index']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\ClassController@store']);
        Route::get('list', ['as' => 'list', 'uses' => 'Admin\ClassController@list']);
        Route::post('save-edit', ['as' => 'save_edit', 'uses' => 'Admin\ClassController@update']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'Admin\ClassController@delete']);
        Route::get('search', ['as' => 'search', 'uses' => 'Admin\ClassController@list']);
    });

    Route::group(['prefix' => 'teacher', 'as' => 'teacher.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\TeacherController@index']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\TeacherController@store']);
        Route::get('list', ['as' => 'list', 'uses' => 'Admin\TeacherController@list']);
        Route::get('display/{id}', ['as' => 'display', 'uses' => 'Admin\TeacherController@display']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\TeacherController@edit']);
        Route::post('save-edit', ['as' => 'save_edit', 'uses' => 'Admin\TeacherController@update']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'Admin\TeacherController@delete']);
        Route::get('search', ['as' => 'search', 'uses' => 'Admin\TeacherController@list']);
        // Attendance Teacher 
        Route::get('display-teacher/{id}', ['as' => 'display_teacher', 'uses' => 'Admin\TeacherAttendanceController@displayAttendanceTeacher']);
        Route::post('report-teacher', ['as' => 'report_teacher', 'uses' => 'Admin\TeacherAttendanceController@monthlyReportTeacher']);
    });

    Route::group(['prefix' => 'student', 'as' => 'student.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\StudentController@index']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\StudentController@store']);
        Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\StudentController@allStudent']);
        Route::post('list', ['as' => 'list', 'uses' => 'Admin\StudentController@list']);
        Route::get('display/{id}', ['as' => 'display', 'uses' => 'Admin\StudentController@display']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\StudentController@edit']);
        Route::post('save-edit', ['as' => 'save_edit', 'uses' => 'Admin\StudentController@update']);
        Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\StudentController@delete']);
        Route::post('assign-course', ['as' => 'assign_course', 'uses' => 'Admin\StudentController@saveAssignCourse']);
        Route::get('remove-course/{id}', ['as' => 'remove_course', 'uses' => 'Admin\StudentController@removeCourse']);
        // Attendance Student
        Route::get('display-student/{id}', ['as' => 'display_student', 'uses' => 'Admin\StudentAttendanceController@displayAttendanceStudent']);
        Route::post('report-student', ['as' => 'report_student', 'uses' => 'Admin\StudentAttendanceController@monthlyReportStudent']); 
    });

    Route::group(['prefix' => 'classroom', 'as' => 'classroom.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\ClassroomController@index']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\ClassroomController@store']);
        Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\ClassroomController@allClassroom']);
        Route::post('list', ['as' => 'list', 'uses' => 'Admin\ClassroomController@list']);
        Route::get('display/{id}', ['as' => 'display', 'uses' => 'Admin\ClassroomController@display']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\ClassroomController@edit']);
        Route::post('save-edit', ['as' => 'save_edit', 'uses' => 'Admin\ClassroomController@update']);
        Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ClassroomController@delete']);
        Route::post('assign-student', ['as' => 'assign_student', 'uses' => 'Admin\ClassroomController@enrollStudent']);
        Route::get('status-change/{id}', ['as' => 'status_change', 'uses' => 'Admin\ClassroomController@changeStatus']);
        Route::get('remove-student/{id}', ['as' => 'remove_student', 'uses' => 'Admin\ClassroomController@removeStudent']);
        Route::post('create-zoom', ['as' => 'create_zoom', 'uses' => 'Admin\ClassroomController@createZoom']);
        Route::get('remove-zoom/{id}', ['as' => 'remove_zoom', 'uses' => 'Admin\ClassroomController@removeZoom']);
        Route::post('edit-zoom', ['as' => 'edit_zoom', 'uses' => 'Admin\ClassroomController@editZoom']);
        Route::get('assign-exam/{id}', ['as' => 'assign_exam', 'uses' => 'Admin\ClassroomController@assignedExams']);
    });

    Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
        Route::get('chat-view/{id}', ['as' => 'chat_view', 'uses' => 'Admin\ChatController@chatView']);
        Route::post('save-chat', ['as' => 'save_chat', 'uses' => 'Admin\ChatController@storeChat']);
        Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\ChatController@allExamination']);
    });

    Route::group(['prefix' => 'exam', 'as' => 'exam.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\ExaminationController@index']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\ExaminationController@store']);
        Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\ExaminationController@allExamination']);
        Route::post('list', ['as' => 'list', 'uses' => 'Admin\ExaminationController@list']);
        Route::get('display/{id}', ['as' => 'display', 'uses' => 'Admin\ExaminationController@display']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\ExaminationController@edit']);
        Route::post('save-edit', ['as' => 'save_edit', 'uses' => 'Admin\ExaminationController@update']);
        Route::get('written-question-pdf/{id}', ['as' => 'written_question_pdf', 'uses' => 'Admin\ExaminationController@printWrittenQuestion']);
        Route::get('MCQ-exam/{id}', ['as' => 'MCQ_exam', 'uses' => 'Admin\ExaminationController@mcqExamination']);
        Route::post('MCQ-taken', ['as' => 'MCQ_taken', 'uses' => 'Admin\ExaminationController@mcqExamSubmission']);
        Route::get('written-markdown-exam/{id}', ['as' => 'written_markdown_exam', 'uses' => 'Admin\ExaminationController@markingWrittenExam']);
        Route::post('written-markdown-submit', ['as' => 'written_markdown_submit', 'uses' => 'Admin\ExaminationController@submitWrittenMarks']);

        Route::post('status-exam-count', ['as' => 'status_exam_count', 'uses' => 'Admin\ExaminationController@statusCountSimilarClassroom']);
        Route::post('mark-checker', ['as' => 'mark_checker', 'uses' => 'Admin\ExaminationController@markCheckClassroom']);
    });

    Route::group(['prefix' => 'question', 'as' => 'question.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'Admin\QuestionController@index']);
        Route::post('count', ['as' => 'count', 'uses' => 'Admin\QuestionController@count']);
        Route::post('remainer-mark', ['as' => 'remainer_mark', 'uses' => 'Admin\QuestionController@remainerMark']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\QuestionController@store']);
        Route::get('list', ['as' => 'list', 'uses' => 'Admin\QuestionController@list']);
        Route::get('question-list/{id}', ['as' => 'question_list', 'uses' => 'Admin\QuestionController@listOfQuestions']);
        Route::get('answer-question/{id}', ['as' => 'answer_question', 'uses' => 'Admin\QuestionController@listOfQuestions']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\QuestionController@edit']);
        Route::post('save-edit', ['as' => 'save_edit', 'uses' => 'Admin\QuestionController@update']);
        Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'Admin\QuestionController@delete']);
    });

    Route::group(['prefix' => 'attendance', 'as' => 'attendance.'], function () {
        Route::get('student-view', ['as' => 'student_view', 'uses' => 'Admin\StudentAttendanceController@index']);
        Route::post('student-list', ['as' => 'student_list', 'uses' => 'Admin\StudentAttendanceController@listOfAttendance']);
        Route::post('student-attendance-save', ['as' => 'student_attendance_save', 'uses' => 'Admin\StudentAttendanceController@storeStudentAttendance']);
        Route::post('classroom-detail', ['as' => 'classroom_detail', 'uses' => 'Admin\StudentAttendanceController@classroomInformation']);
        Route::get('teacher-view', ['as' => 'teacher_view', 'uses' => 'Admin\TeacherAttendanceController@index']);
        Route::post('teacher-attendance-save', ['as' => 'teacher_attendance_save', 'uses' => 'Admin\TeacherAttendanceController@storeTeacherAttendance']);
    });
    
    Route::group(['prefix' => 'studentGrade', 'as' => 'studentGrade.'], function () {
        Route::get('grading-student/{id}', ['as' => 'grading_student', 'uses' => 'Admin\StudentGradeController@index']);
        Route::post('determine-grade', ['as' => 'determine_grade', 'uses' => 'Admin\StudentGradeController@gradeEstimation']);
        Route::post('save-created', ['as' => 'save_created', 'uses' => 'Admin\StudentGradeController@store']);
        
    });
});
