<?php

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
   return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('applicant/registration', 'ApplicantController@create')->name('applicant_registration');
Route::post('applicant/store', 'ApplicantController@store')->name('applicant_store');

Route::group(['prefix' => 'user'], function() {
   Route::get('/employees', 'Admin\UserController@index')->name('admin_user_index');
   Route::get('/create', 'Admin\UserController@create')->name('admin_user_create');
   // Route::post('/store', 'Admin\PendingUserController@store')->name('admin_pending_user_store');

   Route::get('/applicants', 'ApplicantController@index')->name('admin_user_applicant_index');
   Route::group(['prefix' => 'applicant'], function() {
      Route::get('/{applicant}', 'Admin\ApplicantController@show')->name('admin_user_applicant_show');
      Route::get('/{applicant}/edit', 'Admin\ApplicantController@edit')->name('admin_applicant_edit');
      Route::patch('/{applicant}/update', 'Admin\ApplicantController@update')->name('admin_user_applicant_update');
      Route::patch('/{applicant}/hire', 'Admin\ApplicantController@hireApplicant')->name('admin_hire_applicant');
      Route::patch('/{applicant}/interview/initial/pass', 'Admin\ApplicantController@passInitialInterview')->name('admin_pass_initial_applicant');
      Route::patch('/{applicant}/interview/exam/pass', 'Admin\ApplicantController@passFinalInterview')->name('admin_pass_exam_applicant');
      Route::patch('/{applicant}/interview/final/pass', 'Admin\ApplicantController@passfinalInterview')->name('admin_pass_final_applicant');
      Route::patch('/{applicant}/examination/pass', function(App\Applicant $applicant) {
         $applicant->update(['exam_interview' => 2]);

         return redirect()->back()->with('msg', 'Applicant passed the exam.');
      })->name('admin_pass_examination_applicant');

      Route::get('{applicant}/interview_question', function(App\Applicant $applicant) {
         if($applicant->job_position == "RECEPTIONIST") {
            return view('admin.interview.receptionist', compact('applicant'));
         }

         if($applicant->job_position == "WEB-DEVELOPER") {
            return view('admin.interview.it', compact('applicant'));
         }
      })->name('view_interview');
   });

   Route::group(['prefix' => 'employee'], function() {
      Route::get('/{employee}/profile', 'Admin\EmployeeController@show')->name('admin_user_employee_show');
      Route::get('/{employee}/edit', 'Admin\EmployeeController@edit')->name('admin_user_employee_edit');
      Route::patch('/{employee}/update_leaves', 'Admin\EmployeeController@adminEmployeeUpdateLeave')->name('admin_user_employee_update_leaves');
      Route::post('/{employee}/leave/vacation/submit', 'Employee\VacationLeaveController@store')->name('admin_user_employee_file_vacation_leaves');
      Route::patch('/{employee}/information/update', 'Admin\EmployeeController@update')->name('admin_user_employee_update');
      Route::get('/{employee}/training/{training}', 'Admin\EmployeeController@addTopicToEmployee')->name('add_topic_to_employee');
      Route::post('/{employee}/training/store', 'TrainingController@store')->name('admin_add_training_to_employee');
      Route::get('/{employee}/training', 'Admin\EmployeeController@viewTraining')->name('user_employee_view_training');
   });
});

// RESOURCES

Route::get('/exam/guard', 'ExamController@examGuard')->name('exam_guard');
Route::post('/exam/applicant/verify', 'ApplicantController@verifyApplicant')->name('verify_applicant');
Route::get('/exam/{exam}', 'ExamController@applicantTakeExam')->name('exam_taker');
Route::post('/exam/{exam}/submit', 'ExamController@submitExam')->name('submit_exam');
Route::post('/exam/{exam}/submit_exam', 'ExamController@submitReceptionistExam')->name('submit_receptionist_exam');

Route::group(['prefix' => 'training'], function() {
   Route::post('/{training}/topic/store', 'EmployeeTopicTrainingController@store')->name('add_lessons');
   Route::post('/{training}/enroll_employee', 'TrainingController@enrollEmployee')->name('training.enroll');
});

Route::post('/lesson/{lesson}', 'TopicController@uploadLessonModule')->name('upload_lesson');
Route::any('/lesson/{lesson}/{pdf}', function(App\Lesson $lesson, $pdf) {

   $path = $lesson->pathDir();
   $file = $path.'/'.$pdf;
   $filename = $pdf;
   header('Content-type: application/pdf');
   header('Content-Disposition: inline; filename="' . $filename . '"');
   header('Content-Transfer-Encoding: binary');
   header('Accept-Ranges: bytes');
   @readfile($file);

});

/*******************************************************************************************************************/

Route::resource('disciplinary_action', 'DisciplinaryActionController');
Route::resource('announcements', 'AnnouncementController');
Route::resource('exams', 'ExamController');

Route::resource('training', 'TrainingController');
Route::resource('topics', 'TopicController');
Route::resource('lessons', 'LessonController');

Route::resource('attendances', 'AttendanceController');
Route::resource('interviews', 'InterviewController');
