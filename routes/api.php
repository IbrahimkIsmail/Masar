<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::middleware();
Route::prefix('manager')->group(function () {
    Route::middleware(['cors'])->group(function () {
        Route::post('register', 'Manager\ManagerAuthController@register')->name('register');
        Route::post('login', 'Manager\ManagerAuthController@login')->name('login');

    });


    Route::middleware(['cors', 'auth:manager' ,'subscription'])->group(function () {

        Route::post('logout', 'Manager\ManagerAuthController@logout');
        Route::get('me', 'Manager\ManagerController@me');
        Route::post('update', 'Manager\ManagerController@update');
        Route::get('kindergarten', 'Manager\ManagerController@kindergarten');
        Route::post('kindergarten/update', 'Manager\ManagerController@updateKindergartenData');
        Route::post('teacher/show/report', 'Manager\TeacherReportController@showReport');
        Route::post('teacher/show/financial/report', 'Manager\TeacherReportController@showFinancialReport');

        Route::ApiResource('teacher', 'Manager\TeacherController');

        Route::post('teacher/salary/create', 'Manager\SalaryController@store');
        Route::ApiResource('student', 'Manager\StudentController');
        Route::apiResource('classroom', 'Manager\ClassRoomController');

        Route::get('notification/{student_id}', 'Manager\NotificationController@index');
        Route::post('notification', 'Manager\NotificationController@store');
        Route::get('dailynotification/{student_id}', 'Manager\NotificationController@index');

        Route::post('subjectrating', 'Manager\SubjectRatingController@store');
        Route::get('subjectrating/{student_id}/{subject_id}/{lastDay}', 'Manager\SubjectRatingController@index');

        Route::post('student/show/report', 'Manager\StudentReportController@showReport');
        Route::post('student/show/fatherReport', 'Manager\StudentReportController@showFatherReport');
        Route::post('student/show/financialReport', 'Manager\StudentReportController@showFinancialReport');

        Route::post('kindergarten/show/financial/report', 'Manager\ManagerReportController@showKindergartenFinancialReport');

        Route::get('subject', 'Manager\SubjectController@index');

        Route::get('fathers/{id}', 'Manager\FatherController@index');
        Route::get('fathers', 'Manager\FatherController@index');
        Route::get('fathers/students/{id}', 'Manager\FatherController@getStudentByFatherId');

        Route::get('expenses', 'Manager\ExpenseController@index');
        Route::post('expense/store', 'Manager\ExpenseController@store');

        Route::get('revenues', 'Manager\RevenueController@index');
        Route::post('revenue/store', 'Manager\RevenueController@store');

        Route::post('rfi/store', 'Manager\RegisterOfFinancialIlnstallment@store');

        Route::get('kindergarten/settings', 'Manager\KindergartenController@index');
        Route::post('kindergarten/settings/store', 'Manager\KindergartenController@store');
        Route::put('kindergarten/settings/update', 'Manager\KindergartenController@update');


        Route::get('messages', 'Manager\MessageController@index');
        Route::post('messages/store', 'Manager\MessageController@store');
        Route::get('messages/{student_id}/show', 'Manager\MessageController@show');

        Route::get('teacher/attendance/all', 'Manager\StaffAttendanceController@index');

        Route::post('teacher/attendance', 'Manager\StaffAttendanceController@store');
        Route::put('teacher/{teacher_id}/attendance', 'Manager\StaffAttendanceController@update');

    });
});

Route::prefix('father')->group(function () {
    Route::middleware(['cors'])->group(function () {
        Route::post('login', 'Mobile\FatherAuthController@login')->name('login');

    });

    Route::middleware(['cors', 'auth:father'])->group(function () {

        Route::get('{id}/children', 'Mobile\FatherController@getAllStudentByFatherId');
        //Route::get('{id}/notification', 'Mobile\FatherController@fatherNotification');
        Route::get('student/{id}/notification', 'Mobile\StudentController@Notificationsbyid');

        //Student Api
        Route::get('student/{id}/profile', 'Mobile\StudentController@profile');

        //Route::get('student/{id}/notifications', 'Mobile\StudentController@StudentNotifications');

        Route::get('student/{class_room}/tasks/{subject_id}', 'Mobile\StudentController@StudentTasksbySubject');

        Route::get('student/{student_id}/subjectrating/{subject_id}', 'Mobile\StudentController@StudentSubjectRatingBySubjectId');

           Route::get('homework/{classroom}', 'Mobile\Stff\HomeWorkController@listHomeWork');

           Route::get('/student/allratinglist/{std_id}', 'Mobile\Stff\SubjectRatingController@dailyRetingRecordList');

          Route::get('student/{student_id}/fees', 'Mobile\StudentController@StudentFessList');
          Route::get('/student/{id}/NoteAllss', 'Mobile\StudentController@NoteAllss');
    });


});

Route::prefix('teacher')->group(function () {
    Route::middleware(['cors'])->group(function () {
        Route::post('/login', 'Mobile\Stff\AuthController@login');

    });

    Route::middleware(['cors', 'auth:teacher'])->group(function () {


//Route::prefix('mobile/stff')->group(function () {
//    Route::post('login', 'Mobile\Stff\AuthController@login')->name('login');
        // Route::ApiResource('student', 'Mobile\StudentController');

        //Father Api
        Route::get('{id}/profile', 'Mobile\Stff\TeacherController@Profile');
        Route::Post('{id}/profile/edit', 'Mobile\Stff\TeacherController@EditProfile');

        //HomeWork
        Route::Post('homework', 'Mobile\Stff\HomeWorkController@addHomeWork');
        Route::get('homework/{classroom}', 'Mobile\Stff\HomeWorkController@listHomeWork');
        Route::get('homework/{classroom}/{subject_id}', 'Mobile\Stff\HomeWorkController@listSubjectHomeWork');
        Route::get('thsub/{id}', 'Mobile\Stff\HomeWorkController@thsub');

        //Route::get('/student/allclassroom/{class_room}', 'Mobile\Stff\StudentController@allStudent');

        Route::get('/classroom/{class_room}/student', 'Mobile\Stff\TeacherController@classRoomStd');
        Route::get('/classroom', 'Mobile\Stff\TeacherController@teacherClassRoom');


        Route::post('/student/subjectrating', 'Mobile\Stff\SubjectRatingController@store');
        Route::post('/student/allrating', 'Mobile\Stff\SubjectRatingController@dailyRetingRecord');
        Route::get('/student/allratinglist/{std_id}', 'Mobile\Stff\SubjectRatingController@dailyRetingRecordList');
        Route::get('/student/subjectratinglist/{std_id}', 'Mobile\Stff\SubjectRatingController@subjectRetingRecordList');

        Route::post('/student/notifications', 'Mobile\Stff\TeacherController@sendNotif');
        Route::get('student/{id}/notification', 'Mobile\Stff\TeacherController@fatherNotification');

        Route::post('/student/studentAttendance', 'Mobile\Stff\StudentController@saveStudentAttendance');
       // Route::get('student/{id}/notification', 'Mobile\Stff\TeacherController@fatherNotification');

    });
});




//
//    Route::get('test', function () {
//
//        $test = \App\Model\SubjectRating::sum('rating');
//
//        return $test;
//    });


    Route::get('test/class', function () {

//       $t = \App\Model\Subject::all();
//
//        foreach ($t as $i){
//            if($i->id > 10){
//                $i->delete();
//            }
//
//        }

//        $ts = \App\Model\Subject::create([
//            'title' => '',
//            'description' => 'العلوم العامة'
//        ]);
//
//        return $t;


    });

//    Route::get('test/manager' , 'Manager\TestController@callFunctions');
//    Route::get('x' , function (){
//
////        $teacher = \App\Model\Teacher::find(1);
//        $class_room = \App\Model\ClassRoom::find(1);
//        return $class_room->homeworks;
//    });
//
