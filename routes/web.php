<?php



// use Illuminate\Routing\Route;
// use Illuminate\Support\Facades\Auth;

Route::get('register/school','LoginController@RegisterSchool'); 
Route::post('post/register/school','LoginController@PostRegisterSchool')->name('school.postregisteration'); 

Route::get('school/dashboard3', 'SchoolController@Dashboard3');

//School Website Routes
Route::get('school/site/{website}','WebsiteController@Website')->name('school.website'); 
Route::get('school/website','WebsiteController@SchoolWebsite')->name('school.schoolwebsite'); 
Route::get('school/our_teachers/{website}', 'WebsiteController@OurTeachers')->name('school.our_teachers');
Route::get('school/our_school/{website}', 'WebsiteController@OurSchool')->name('school.our_school');
Route::get('school/online_admission/{website}', 'WebsiteController@OnlineAdminssion')->name('school.online_admission');
Route::get('school/contact_us/{website}', 'WebsiteController@ContactUs')->name('school.contact_us');
Route::get('school/about_us/{website}', 'WebsiteController@AboutUs')->name('school.about_us');
Route::get('school/register/{website}', 'WebsiteController@Register')->name('school.register');
Route::get('school/login/{website}', 'WebsiteController@Login')->name('school.login');
Route::get('school/gallary/{website}', 'WebsiteController@Gallary')->name('school.gallary');
Route::get('school/news/{website}', 'WebsiteController@News')->name('school.news');
Route::get('school/events/{website}', 'WebsiteController@Event')->name('school.events');

// School Events 
Route::get('school/event/{website}', 'WebsiteController@SchoolEvent')->name('school.event');
Route::post('admission/store', 'AdmissionController@Admission_Store')->name('admissions.save');


// School Contact Us
Route::post('post/contact_us', 'WebsiteController@postSchoolContactUs')->name('contact_us.send');


// Online Admissions Website

Route::post('post/online-Admission', 'WebsiteController@postOnlineAdmission')->name('onlineAdmission.send');


Route::get('/dynamicStudentGroup', ['as'=> 'dynamicStudentGroup', 'uses' =>
'WebsiteController@dynamicStudentGroup']);

Route::get('/dynamicSubject', ['as'=> 'dynamicSubject', 'uses' =>
'WebsiteController@dynamicSubject']);

Route::get('/PrimaryLevel', ['as'=> 'PrimaryLevel', 'uses' =>
'WebsiteController@PrimaryLevel']);

Route::get('/dynamicDepartmentClass', ['as'=> 'dynamicDepartmentClass', 'uses' =>
'WebsiteController@dynamicDepartmentClass']);


Route::resource('feeStructures', 'FeeStructureController');


Route::get('online/students', 'StudentController@Student_is_Online');



// here we will place all our routes here okay.


Route::match(['get','post'], '/noticeboard', 'StudentController@NoticeBoard')->name('notice');
Route::post('/save-notice', 'StudentController@SaveNoticeBoard')->name('save-notice');


Route::post('/settings', 'InstituteController@Settings')->name('update-template');





//attendace list route okat in the teachers part okay
Route::get('attendance/list','TeacherController@AttendanceList')->name('AttendanceList');

//insert attendace  route okat in the teachers part okay
Route::post('MarkAttendanceClass',array('as'=>'MarkAttendanceClass','uses'=> 'TeacherController@InsertClassAttendance'));

//edit attendace  route okat in the teachers part okay
Route::get('teacher/edit/attendance/{edit_date}/{class_id}/{semester_id}/{teacher_id}',
'TeacherController@TeacherEditAttendance')->name('Teacheredit.attendance');

//update attendace  route okat in the teachers part okay
Route::post('teacher_update_attendance', 'TeacherController@TeacherUpdateAttendance')->name('update.attendance');


//  here is for thee admin routes okay later i will place them inside the middleware okay


Route::get('/get/attendance/class','AttendanceController@GetClass'); //we will use this route for later okay

Route::get('class/attendance/list','AttendanceController@AttendanceList'); // attendace list route okat in the admin part okay
//edit attendace  route okat in the teachers part okay
Route::post('/update_attendance', 'AttendanceController@UpdateAttendance')->name('edit.attendance');


// Register School and logged in
// Route::get('/register/school','SchoolController@RegisterSchool')->name('school.registeration'); //we will use this route for later okay


















   //=======================================================Student Fee=================================================

   Route::get('/student/show/payment', ['as' => 'getPayment', 'uses' => 'FeeController@getPayment']);
   Route::get('/student/payment', ['as' => 'showStudentPayment', 'uses' => 'FeeController@showStudentPayment']);
   Route::get('/student/go/to/payment/{student_id}', ['as' => 'goPayment', 'uses' => 'FeeController@goPayment']);
   Route::post('/student/payement/save', ['as' => 'savePayment', 'uses' => 'FeeController@savePayment']);
   Route::post('multi/student/payement/save', ['as' => 'MultipleSavePayment', 'uses' => 'FeeController@MultipleSavePayment']);
//    Route::post('/fee/create', ['as' => 'createFee', 'uses' => 'FeeController@createFee']);
   Route::get('/fee/student/pay', ['as' => 'pay', 'uses' => 'FeeController@pay']);
   Route::post('/fee/student/exstra/pay', ['as' => 'exstraPay', 'uses' => 'FeeController@exstraPay']);
   // Route::get('/fee/student/print/invoice/{receipt_id}', ['as' => 'printInvoice', 'uses' => 'FeeController@printInvoice']);
   Route::get('/fee/student/transaction/delete/{transactId}', ['as' => 'deleteTransact', 'uses' => 'FeeController@deleteTransact']);
   Route::get('/student/fee/delete/{student_fee_id}', ['as' => 'deleteStudentFee', 'uses' => 'FeeController@deleteStudentFee']);
   Route::get('/fee/student/show/level', ['as' => 'showStudentLevel', 'uses' => 'FeeController@showStudentLevel']);


   Route::get('/student/show/roll/{studentID}/{semesterID}/{departmentID}/{levelID}', ['as' => 'student_semester', 'uses' => 'FeeController@student_roll1']);

   Route::get('/student/show/roll/{semesterID}', ['as' => 'showsemesterRoll', 'uses' => 'FeeController@student_roll']);


// FEE ROUTES PART 
Route::get('view/fee/collection', 'FeeController@ViewPayment');
Route::get('student/list/fee/collection', 'FeeController@StudentListPayment');
Route::group(['middlewere'=>'auth.check'], function(){
Route::get('/fee/student/print/invoice/{invoice_id}', ['as' => 'StudentInvoicePrint', 'uses' => 'FeeController@StudentInvoicePrint']);
});


Route::get('/get/attendance/class','AttendanceController@GetClass');
Route::get('class/attendance/list','AttendanceController@AttendanceList');
// Route::get('attendance/list/{teacher_id}','TeacherController@AttendanceList')->name('AttendanceList');
Route::post('MarkClassAttendance',array('as'=>'MarkClassAttendance','uses'=> 'AttendanceController@InsertAttendanceClass'));
// Route::post('MarkAttendanceClass',array('as'=>'MarkAttendanceClass','uses'=> 'TeacherController@InsertClassAttendance'));

Route::get('/search/attendance/by/date', 'AttendanceController@SearchAttendanceByDate');
Route::get('/search/attendance/by/class', 'AttendanceController@SearchAttendanceByClass');
Route::get('/search/attendance/by/roll_no', 'AttendanceController@SearchAttendanceByRollNo');
Route::get('/monthly_attendance', 'AttendanceController@MonthlyAttendance');
Route::get('/yearly_attendance', 'AttendanceController@YearlyAttendance');
Route::get('/class_wise_attendance', 'AttendanceController@ClassWiseAttendance');

Route::get('/attendance_report', 'AttendanceController@AttendanceReport');

Route::get('/edit/attendance/{edit_date}', 'AttendanceController@EditAttendance')->name('edit.attendance');
// Route::get('teacher/edit/attendance/{edit_date}/{class_id}/{semester_id}/{teacher_id}', 'TeacherController@TeacherEditAttendance')->name('Teacheredit.attendance');
// Route::post('teacher_update_attendance', 'TeacherController@TeacherUpdateAttendance')->name('update.attendance');
// Route::post('/update_attendance', 'AttendanceController@UpdateAttendance')->name('edit.attendance');


//Online Application
Route::get('/student-admission', ['as' => 'StudentAdmission', 'uses' => 'StudentController@StudentAdmission']);
Route::post('/student-take-admission', ['as' => 'StudentTakeAdmission', 'uses' => 'StudentController@StudentTakeAdmission']);
Route::get('/all-online-admission', ['as' => 'OnlineAdmissions', 'uses' => 'AdmissionController@OnlineAdmission']);

Route::post('/email_available/check', 'StudentController@check')->name('email_available.check');


Route::post('/student/fee/collection/payment', ['as' => 'FeeCollectionPayment', 'uses' => 'FeeController@FeeCollectionPayment']);
Route::post('/student/fee/collection/grade/class', ['as' => 'FeeCollectionPaymentGradeClass', 'uses' => 'FeeController@FeeCollectionPaymentGradeClass']);
Route::post('/fee/list/collection/payment', ['as' => 'StudentFeeListCollectionPayment', 'uses' => 'FeeController@StudentFeeListCollectionPayment']);
Route::get('/student/fee/list/collection/payment/{id}', ['as' => 'StudentFeeCollectionPayment', 'uses' => 'FeeController@StudentFeeCollectionPayment']);

Route::get('/student/payment/{id}', ['as' => 'showStudentRoll', 'uses' => 'FeeController@payment']);
//    Route::get('semester/department/{id}', ['as' => 'FilterBySemesterDepartment', 'uses' => 'FeeController@FilterBySemesterDepartment']);
   Route::get('semester/department/level', ['as' => 'FilterBySemesterDepartment', 'uses' => 'FeeController@FilterBySemesterDepartment']);
Route::get('/select/course/{student_id}', 'FeeController@SelectCourse');

Route::post('/insert/course',array('as'=>'insertCourse', 'uses'=>'FeeController@insert'));


// Route::post('create/subjects', 'SemesterController@createSemester');
Route::post('create/subjects', 'SemesterController@createSemester')->name('semesters.create.subjects');
Route::post('create/degree', 'SemesterController@createDegrees')->name('degree.create');
Route::get('create/cour/{id}', 'SemesterController@read_semester_course');


   Route::get('/school/fee/{id}', ['as' => 'showScoolFees', 'uses' => 'FeeController@show_school_fee']);

   // ==========================================REPORTS ROUTES ==============================================================

   Route::get('/attendance/monthly-report', 'AttendanceController@monthlyReport')->middleware('checkPermission:view_student_monthly_reports');




   Route::get('/reports', ['as' => 'Reports', 'uses' => 'FeeController@Reports']);
   Route::get('/fee/report', ['as' => 'FeeReport', 'uses' => 'FeeController@FeeReport']);
   Route::post('class/wise/show/report', ['as' => 'ClasswiseFeeReport', 'uses' => 'FeeController@ClasswiseFeeReport']);
   Route::post('roll/wise/show/report', ['as' => 'RollwiseFeeReport', 'uses' => 'FeeController@RollwiseFeeReport']);


   Route::get('/get/report', ['as' => 'getFeeReport', 'uses' => 'FeeController@getFeeReport']);
   Route::post('/show/report', ['as' => 'showFeeReport', 'uses' => 'FeeController@showFeeReport']);

   // =====================================STUDENT INFORMATION REPORT START HERE=================================
   // student report
   Route::get('/report/studentinformation', ['as' => 'getstudentInormation', 'uses' => 'ReportsController@getstudentInormation']);
   Route::get('/student/report', ['as' => 'getstudentReport', 'uses' => 'ReportsController@getstudentReport']);
   Route::post('/poststudent/report', ['as' => 'poststudentReport', 'uses' => 'ReportsController@poststudentReport']);
   
   // student guadian report
   Route::get('/guadian/report', ['as' => 'getguadianReport', 'uses' => 'ReportsController@getguadianReport']);
   Route::post('/poststudentguadian/report', ['as' => 'poststudentguadianReport', 'uses' => 'ReportsController@poststudentguadianReport']);
   
   // student academic history report
   Route::get('/studenthistory/report', ['as' => 'getstudenthistoryReport', 'uses' => 'ReportsController@getstudenthistoryReport']);
   Route::post('/poststudenthistory/report', ['as' => 'poststudenthistoryReport', 'uses' => 'ReportsController@poststudenthistoryReport']);
   

   // student academic history report
   Route::get('/studentlogindetail/report', ['as' => 'getstudentLogindetailReport', 'uses' => 'ReportsController@getstudentLogindetailReport']);
   Route::post('/post/student login/detail/report', ['as' => 'poststudentLoginDetailReport', 'uses' => 'ReportsController@poststudentLoginDetailReport']);
      
   // student admission report
   Route::get('/admission/report', ['as' => 'getadmissionReport', 'uses' => 'ReportsController@getadmissionReport']);
   Route::post('/post/admission/report', ['as' => 'postadmissionReport', 'uses' => 'ReportsController@postadmissionReport']);
   
   // ==================================================STUDENT INFORMATION REPORT END HERE==================================================

   Route::get('/school/related/info', ['as' => 'getSchoolInfo', 'uses' => 'ReportsController@getSchoolInfo']);
   Route::get('/grade/related/class/info', ['as' => 'getGradeRelatedClass', 'uses' => 'ReportsController@getGradeRelatedClass']);
   Route::get('/school/related/student', ['as' => 'getSchoolRelatedStudent', 'uses' => 'ReportsController@getSchoolRelatedStudent']);
   Route::get('/school/related/staff', ['as' => 'getSchoolRelatedStaff', 'uses' => 'ReportsController@getSchoolRelatedStaff']);
    
   
   // ===========================================FINANCE REPORT START HERE=========================================

    // fee statement report
   //  Route::get('/report/finance ', ['as' => 'getFinance', 'uses' => 'ReportsController@getFinance']);
    Route::get('/report/finance', ['as' => 'Finance', 'uses' => 'ReportsController@Finance']);
    Route::get('/fee-statement/report', ['as' => 'getfee_statementReport', 'uses' => 'ReportsController@getfee_statementReport']);
    Route::post('/post/fee-statement/report', ['as' => 'postfee_statementReport', 'uses' => 'ReportsController@postfee_statementReport']);
    
    // balance fee report
    Route::get('/balance/report', ['as' => 'getbalanceReport', 'uses' => 'ReportsController@getbalanceReport']);
    Route::post('/balance/poststudentbalance/report', ['as' => 'poststudentbalanceReport', 'uses' => 'ReportsController@poststudentbalanceReport']);
    
    // fee collections report
    Route::get('/feecollection/report', ['as' => 'getfee_collectionReport', 'uses' => 'ReportsController@getfee_collectionReport']);
    Route::post('/post/feecollection/report', ['as' => 'postfee_collectionReport', 'uses' => 'ReportsController@postfee_collectionReport']);
    
    Route::get('/online-fee-collection/report', ['as' => 'getOnlinefee_collectionReport', 'uses' => 'ReportsController@getOnlinefee_collectionReport']);
    Route::post('/post/online-fee-collection/report', ['as' => 'postOnlinefee_collectionReport', 'uses' => 'ReportsController@postOnlinefee_collectionReport']);
    
 
    // payroll report
    Route::get('/payroll/report', ['as' => 'getpayrollReport', 'uses' => 'ReportsController@getpayrollReport']);
    Route::post('/post/payroll/report', ['as' => 'postpayrollReport', 'uses' => 'ReportsController@postpayrollReport']);
       
    // income report
    Route::get('/income/report', ['as' => 'getincomeReport', 'uses' => 'ReportsController@getincomeReport']);
    Route::post('/post/income/report', ['as' => 'postincomeReport', 'uses' => 'ReportsController@postincomeReport']);
    
     // expense report
     Route::get('/expense/report', ['as' => 'getexpenseReport', 'uses' => 'ReportsController@getexpenseReport']);
     Route::post('/post/expense/report', ['as' => 'postexpenseReport', 'uses' => 'ReportsController@postexpenseReport']);
     

    // expense report
    Route::get('/transactions/report', ['as' => 'gettransactionsReport', 'uses' => 'ReportsController@gettransactionsReport']);
    Route::post('/transactions/posttransaction/report', ['as' => 'posttransactionsReport', 'uses' => 'ReportsController@posttransactionsReport']);
      

   Route::post('/student/report', ['as' => 'studentReport', 'uses' => 'ReportsController@studentReport']);

   // ==========================================================FINANCE REPORT END HERE=====================================================


   // ===========================================ATTENDANCE REPORT START HERE=========================================

    // attendance  report
   Route::get('/attendance/report', ['as' => 'AttendaceReport', 'uses' => 'ReportsController@AttendaceReport']);

   Route::post('/postattendace/report', ['as' => 'postAttendaceReport', 'uses' => 'ReportsController@postAttendaceReport']);
   Route::get('/attendance/monthly-report', ['as' => 'getAttendaceReport', 'uses' => 'ReportsController@monthlyReport'])->middleware('checkPermission:view_student_monthly_reports');
   
   Route::get('/classwise/attendance/report', ['as' => 'getClasswiseAttendaceReport', 'uses' => 'ReportsController@getClasswiseAttendaceReport'])->middleware('checkPermission:view_student_monthly_reports');
   Route::post('/post/classwise/attendance/report', ['as' => 'PostAttendaceReport', 'uses' => 'ReportsController@PostAttendaceReport'])->middleware('checkPermission:view_student_monthly_reports');
   
   // Yearly attendance report    
   Route::get('/yearly/attendance/report', ['as' => 'getYearlyAttendanceReport', 'uses' => 'ReportsController@getYearlyAttendanceReport'])->middleware('checkPermission:view_student_monthly_reports');
   Route::post('/post/yearly/attendance/report', ['as' => 'PostYearlyAttendanceReport', 'uses' => 'ReportsController@PostYearlyAttendanceReport'])->middleware('checkPermission:view_student_monthly_reports');
   
   // attendance report
   Route::get('/balance/report', ['as' => 'getbalanceReport', 'uses' => 'ReportsController@getbalanceReport']);
   Route::post('/poststudentbalance/report', ['as' => 'poststudentbalanceReport', 'uses' => 'ReportsController@poststudentbalanceReport']);
   

   
Route::resource('studentFees', 'StudentFeeController');

Route::resource('teacherSalaries', 'TeacherSalaryController');

Route::get('teachers/list', 'TeacherController@TeacherList');

Route::resource('salaryTypes', 'SalaryTypeController');

Route::resource('studentFees', 'StudentFeeController');

Route::resource('teacherSalaries', 'TeacherSalaryController');

Route::resource('fees', 'FeesController');

Route::resource('salaryTypes', 'SalaryTypeController');

Route::resource('teacherSalaries', 'TeacherSalaryController');

Route::resource('studentFees', 'StudentFeeController');

Route::resource('feeStructures', 'FeeStructureController');

Route::resource('examinations', 'ExaminationController');
























Route::get('/teacher/create-timetable','TeacherController@index_timetable');

Route::get('newMessage','InboxController@newMessage');
Route::post('sendNewMessage', 'InboxController@sendNewMessage');
Route::post('/sendMessage', 'InboxController@sendMessage')->name('bulkMessage');





// messenger start
Route::get('/getMessages', function(){
    $allUsers1 = DB::table('users')
    ->Join('conversation','users.id','conversation.user_one')
    // ->Join('messages','messages.id','messages.conversation_id')
    ->where('conversation.user_two', Auth::user()->id)->get();
    //return $allUsers1;

    $allUsers2 = DB::table('users')
    ->Join('conversation','users.id','conversation.user_two')
    // ->leftJoin('messages','messages.id','messages.conversation_id')
    ->where('conversation.user_one', Auth::user()->id)->get();

    $allmessages = array_merge($allUsers1->toArray(), $allUsers2->toArray());
    return view('inbox.message',compact('allmessages')); 
  });

  Route::get('/getMessages/{id}', function($id){
              //update cov status
              $update_status = DB::table('conversation')->where('id',$id)
              ->update([
                  'status' => 0 // now read by user
              ]);

    $userMsg = DB::table('messages')
    ->join('users', 'users.id','messages.user_from')
    ->where('messages.conversation_id', $id)->get();
    return view('inbox.message',compact('userMsg'));
  });

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
Route::get('/', 'StudentController@index');

Route::get('/inboxes', 'InboxController@index')->name('inbox');
Route::get('/updateInbox', 'InboxController@UpdateInbox');

Route::get('/dashboard', 'DashboardController@index')->name('admins.dashboard');

Route::get('/teacher-status-update', 'TeacherController@UpdateTeacherStatus');

Route::Resource('timetables', 'TimeTableController');

Route::get('class/students','TimeTableController@ViewStudentsClass' );

Route::post('get-fee-type', ['as' => 'getFeeTypes', 'uses' => 'FeeController@getFeeTypes']);

Route::get('feetypes', 'FeeController@FeeType')->name('feetypes.index');
Route::post('feetypes', 'FeeController@StoreFeeType')->name('feetypes.store');
Route::get('edit/feetypes/{id}', 'FeeController@EditFeeType')->name('feetypes.edit');
Route::post('updte/feetypes/{id}', 'FeeController@UpdateFeeType')->name('feetypes.update');
Route::delete('delete/feetypes/{feetypeid}', 'FeeController@DeleteFeeType')->name('feetypes.delete');


// Countries State Cities Route

Route::get('country/state/', ['as' => 'country_state', 'uses' => 'AdmissionController@Country_state']);
Route::get('state/city/', ['as' => 'state_city', 'uses' => 'AdmissionController@State_city']);



Route::get('filter-class-by-class', ['as' => 'FilterByClass', 'uses' => 'TimeTableController@FilterByClass']);
Route::get('filter-class-by-course', ['as' => 'FilterByCourse', 'uses' => 'TimeTableController@FilterByCourse']);
Route::get('filter-class-by-level', ['as' => 'FilterByLevel', 'uses' => 'TimeTableController@FilterByLevel']);
Route::get('filter-class-by-course-level-class/{id}', ['as' => 'FilterByCourseLevelClass', 'uses' => 'TimeTableController@FilterByCourseLevelClass']);
Route::get('/print-single-class-timetable/{id}','TimeTableController@print');
Route::get('/print-single-class-timetable-pdf/{id}','TimeTableController@PDFgeneratorSingle');

// Teacher timetable by ID
Route::get('/print-single-teacher-timetable-pdf/{id}','TimeTableController@PDFTeacherSingleTimetable');


Route::post('timetables', 'TimeTableController@createTimeTable');

Route::get('/teacher-view-timetable/{id}','TimeTableController@view_timetable1');

Route::get('/student-view-timetable/{id}', ['as' => 'view_student_timetable', 'uses' => 'FeeController@view_student_timetable']);

Route::post('/generate-class-timetable', ['as' => 'Generate_Class_Timetables', 'uses' => 'TimeTableController@Generate_Class_Timetables']);
Route::get('/generate-teacher-timetable', ['as' => 'Generate_c_Timetables', 'uses' => 'TimeTableController@Generate_Teacher_Timetables']);
Route::get('/mark-teacher-attendance','AttendanceController@Mark_Teacher_Attendance')->name('MarkTeacherAttedance');
// Route::get('/get-class-attendance','AttendanceController@GetTeacherStudents');
// Route::get('/get-class-attendance/{class_id}','AttendanceController@GetTeacherStudents');

Route::get('/class-attendance','AttendanceController@DynamicAttendanceByClass');
Route::get('/dynamic-by-class','AttendanceController@DynamicByClass');
Route::get('/dynamic-by-faculty','AttendanceController@DynamicByFaculty');
Route::get('/dynamic-by-course','AttendanceController@DynamicByCourse');

Route::get('/get/teacher/{teacher_id}','TimeTableController@getTeacherinfo');

// Route::get('/class/getsubjects/{class}','CourseController@getCourses');

Route::get('/dynamicCourse', ['as'=> 'dynamicCourse', 'uses' =>
'CourseController@dynamicCourse']);

Route::get('/dynamicLevels', ['as'=> 'dynamicLevels', 'uses' =>
'CourseController@dynamicLevels']);

Route::get('/dynamicDegrees', ['as'=> 'dynamicDegrees', 'uses' =>
'CourseController@dynamicDegrees']);

Route::get('/dynamicDepartments', ['as'=> 'dynamicDepartments', 'uses' =>
'CourseController@dynamicDepartments']);

Route::get('/dynamicDepartmentsWithClass', ['as'=> 'dynamicDepartmentsWithClass', 'uses' =>
'CourseController@dynamicDepartmentsWithClass']);



Route::get('/dynamicStudentsByClass', ['as'=> 'dynamicStudentsByClass', 'uses' =>
'CourseController@dynamicStudentsByClass']);


Route::get('/course/getmarks/{course}/{class}','CourseController@getmarks');
Route::get('/course/getList/{class}','CourseController@getsubjects');

Route::get('/class/getcourses/{class}','ClassesController@getCourses');

Route::get('/subject/create','SubjectController@index');
Route::post('/subject/create','SubjectController@create');
Route::get('/subject/list','SubjectController@show');
Route::get('/subject/edit/{id}','SubjectController@edit');
Route::post('/subject/update','SubjectController@update');
Route::get('/subject/delete/{id}','SubjectController@delete');

Route::get('/subject/getmarks/{subject}/{cls}','subjectController@getmarks');
Route::get('/subject/getList/{cls}','subjectController@getsubjects');

// Route::get('/subject/edit', ['as'=> 'edit', 'uses' => 'SubjectController@edit']);

// Route::Resource('subject', 'SubjectController');


//GPA Routes
Route::get('/gpa','gpaController@index');
Route::post('/gpa/create','gpaController@create');
Route::get('/gpa/list','gpaController@show');
Route::get('/gpa/edit/{id}','gpaController@edit');
Route::post('/gpa/update','gpaController@update');
Route::get('/gpa/delete/{id}','gpaController@delete');

// E PAPER GENERATION ROUTE

// Route::Resource('examanagements', 'ExamQuestionPaperGenerateController');
Route::get('/question/create','ExamQuestionPaperGenerateController@create');
Route::post('/question/create','ExamQuestionPaperGenerateController@store');
Route::get('/paper/generate','ExamQuestionPaperGenerateController@generate');
Route::post('/paper/generate','ExamQuestionPaperGenerateController@post_generate');
Route::get('/question/list','ExamQuestionPaperGenerateController@list');
Route::post('/question/list','ExamQuestionPaperGenerateController@getlist');

Route::get('/question','ExamQuestionPaperGenerateController@index');


Route::get('/question/edit/{id}','ExamQuestionPaperGenerateController@edit');
Route::post('/question/update','ExamQuestionPaperGenerateController@update');
Route::get('/question/delete/{id}','ExamQuestionPaperGenerateController@delete');
Route::get('/chapter/getList/{class}','ExamQuestionPaperGenerateController@chapters');


//Exam

Route::get('/exam/create','ExamQuestionPaperGenerateController@index');
Route::get('/exams/create','ExamQuestionPaperGenerateController@examCreate');
Route::post('/insert/exam','ExamQuestionPaperGenerateController@InsertExam');
Route::get('/exam/list','ExamQuestionPaperGenerateController@show');
Route::get('/exam/edit/{id}','ExamQuestionPaperGenerateController@edit');
Route::post('/exam/update','ExamQuestionPaperGenerateController@update');
Route::get('/exam/delete/{id}','ExamQuestionPaperGenerateController@delete');
Route::get('/exam/getList/{class}','ExamQuestionPaperGenerateController@getexams');



Route::get('/result/generate','gradesheetControllers@getgenerate');
Route::post('/result/generate','gradesheetController@postgenerate');
Route::post('/result/m_generate','gradesheetController@mpostgenerate');


Route::get('/result/search','gradesheetController@search');
Route::post('/result/search','gradesheetController@postsearch');
Route::post('/result/search/roll','gradesheetController@searchResultRoll_no')->name('result.roll');

Route::get('/results','gradesheetController@searchpub');
Route::post('/results','gradesheetController@postsearchpub');


Route::get('/result/home','gradesheetController@index');
Route::get('/gradesheet','gradesheetController@home');
Route::post('/gradesheet','gradesheetController@studentdlistresult');
Route::get('/gradesheet/print/{regiNo}/{exam}/{class}','gradesheetController@printsheet');
Route::get('/gradesheet/m_print/{regiNo}/{exam}/{class}','gradesheetController@m_printsheet');


//Institute routes
Route::get('/institute','instituteController@index');
Route::post('/institute','instituteController@save');
Route::get('/branches','instituteController@branches');
Route::post('/branch','instituteController@createbranch');

//Repeat Student Route
Route::get('/home/repeat_students/{class}/{exam}','HomeController@RepeatStudentsList');


//Mark routes
Route::get('/marks','markController@home');

Route::get('/mark/create','markController@index');
Route::post('/mark/create','markController@create');

Route::post('/new/mark/create','markController@newcreate');
Route::get('/marks/section/{class}','markController@getForMarksjoin');
Route::get('/create/marks','markController@createmarks');

Route::get('/mark/m_create','markController@m_index');
Route::post('/mark/m_create','markController@m_create');

Route::get('/show/mark/list','markController@show');
Route::post('/mark/list','markController@getlist');

Route::get('/mark/m_list','markController@m_show');
Route::post('/mark/m_list','markController@m_getlist');

Route::get('/mark/edit/{id}','markController@edit');
Route::get('/mark/m_edit/{id}','markController@m_edit');
Route::post('/mark/update','markController@update');
Route::post('/mark/m_update','markController@m_update');
Route::get('/mark/delete/{id}','markController@delete');


Route::match(['get','post'], '/getVerify', 'SendVerificationCodeController@getVerify');
Route::match(['get','post'], '/send-Verify-code', 'SendVerificationCodeController@sendVerifyCode');

Route::match(['get','post'], '/register-verification', 'SendVerificationCodeController@VerifyCode');
Route::match(['get','post'], '/Verify', 'SendVerificationCodeController@Verify');


Route::group(['middleware' => ['studentLogin']], function(){

Route::match(['get','post'], '/account','StudentController@account');
Route::match(['get','post'], 'student-biodata','StudentController@studentBiodata');

Route::match(['get','post'], 'student-transaction','StudentController@studentTransaction');
Route::match(['get','post'], 'student-timetable','StudentController@studentTimetable');

Route::match(['get','post'], 'student-choose-course','StudentController@studentChooseCourse');
Route::match(['get','post'], 'student-lecture-calendar','StudentController@studentLectureCalendar');
Route::match(['get','post'], 'student-lecture-activity','StudentController@studentLectureActivity');
Route::match(['get','post'], 'student-exam-marks','StudentController@studentExamMarks');
// now we need to make function inside the student controller okay
Route::match(['get','post'], '/varify-password','StudentController@verifyPassword');
Route::match(['get', 'post'], 'student-update-password', 'StudentController@changePassword');

// STUDENT EXAM MARKS

Route::match(['get', 'post'], 'student-exam-marks', 'StudentController@GetStudentExamMarks');

// / STUDENT EXAM RESULT
Route::match(['get', 'post'], 'student-exam-result', 'StudentController@GetStudentExamResult');


// / STUDENT TRANSACRIPT
Route::match(['get', 'post'], 'student-transcript', 'StudentController@GetStudentTranscript');
});

Route::get('/message/index', 'HomeController@messageindex')->name('message.index');
Route::get('/message/{id}', 'HomeController@getMessage')->name('message');
Route::post('message', 'HomeController@sendMessage');
Route::post('typing-event', 'HomeController@typingEvent')->name('event.typing');


Route::group(['middleware' => 'App\Http\Middleware\TeacherMiddleware'], function() {
    
   Route::get('attendance/list','TeacherController@AttendanceList')->name('AttendanceList');
   Route::get('/mark-teacher-attendance','AttendanceController@Teacher_Attendance')->name('MarkTeacherAttedance');
   Route::get('/mark-teacher-attendance/{teacher_id}','AttendanceController@Mark_Teacher_Attendance')->name('MarkTeacherAttedance');
   Route::get('/get-class-attendance/{class_id}','AttendanceController@GetTeacherStudents');

   //=========================teacher Subject Detail ROUTES===================================
   Route::get('/enter-subject-detail', 'CourseController@EnterSubjectDetails');
   Route::get('/edit-subject-detail/{id}', 'CourseController@EditSubjectDetails');
   Route::post('/update-subject-detail/{id}', 'CourseController@UpdateSubjectDetails');

   //=========================teacher hOMEWORK ROUTES===================================
   
   Route::get('/studentsincharge', 'TeacherController@StudentListInCharge')->name('students');
   Route::get('/studentsincharge/{class_id}', 'TeacherController@GetStudentListInCharge');
   Route::get('/classincharge', 'TeacherController@ClassListInCharge');
   Route::get('/ send-class-homework', 'TeacherController@GetTeacherHomeWork');
   Route::get('/ send-class-homework/{class_id}', 'TeacherController@SendTeacherHomeWork');
   Route::post('/create-class-homework', 'TeacherController@CreateHomeWork')->name('create-class-homework');
   Route::get('/upload-student-homework/{id}', 'TeacherController@HomeWorkUploaded')->name('upload-student-homework');

   Route::get('/homework-list', 'TeacherController@HomeWorkList')->name('homework-list');
   Route::get('/homework-edit/{id}', 'TeacherController@HomeWorkEdit')->name('homework-edit');
   Route::post('/homework-update/{id}', 'TeacherController@HomeWorkUpdate')->name('homework-update');
   Route::post('/homework-delete/{id}', 'TeacherController@HomeWorkDelete')->name('homework-delete');

   Route::get('/get-student-homework/{id}', 'TeacherController@getStudentHomeWork')->name('get-student-homework');


   // All student in class details
   Route::get('/class/students-details/{class_code}', 'TeacherController@AllStudentDetail_In_Class')->name('class-students.detail');



   //=========================teacher TIMETABLES ROUTES===================================
   Route::get('/generate-teacher-timetable', ['as' => 'Generate_c_Timetables', 'uses' => 'TimeTableController@Generate_Teacher_Timetables']);

   //=========================teacher MARKS ROUTES===================================
   Route::get('/mark/entry','TeacherController@markindex');
   Route::post('/teacherEnterMarks','TeacherController@TeacherEnterMarks');
   // Route::post('/teacherEnterMarks','markController@create');

   Route::get('/get/mark/list','TeacherController@GetMarkList');
   Route::post('/teacher/mark/list','TeacherController@TeacherGetMarkList');
   Route::get('/teacher/mark/edit/{id}','TeacherController@markedit');
   Route::post('/teacher/mark/update','TeacherController@markupdate');
   Route::get('/teacher/mark/delete/{id}','TeacherController@markelete');

   Route::get('/teacher/gradesheet','TeacherController@TeacherResultHome');
   Route::match(['get','post'], '/teacher/gradesheet/{class_id}','TeacherController@TeacherResultByClass');
   Route::post('/teacher/gradesheet','gradesheetController@TeacherStudentdListResult');
   Route::get('/teacher/gradesheet/print/{regiNo}/{exam}/{class}','gradesheetController@printsheet');
     
//  Route::match(['get', 'post'], '/superAdminOnlyPage/', 'HomeController@super_admin');

});





Route::post('/student/add/{f_id}','StudentController@add_family_student');
Route::post('/students/shift/{f_id}','StudentController@shift_student_family');

Route::get('/student/getList/{class}/{department}/{batch}','StudentController@getForMarks');
Route::get('/get/refral/{refral}','StudentController@getrefral');
Route::get('/get/family_id/list/{refral}','StudentController@f_id_list');
Route::get('/student/getsList/{class}/{department}/{batch}','StudentController@getForMarksjoin');
Route::post('/student/search','StudentController@search');

// Route::match(['get','post'], '/logout','StudentController@logout');


Route::get('/department/getList/{class}/{batch}','DepartmentController@getDepartmentByclassANDbatch');
Route::get('/department/getList/{class}','DepartmentController@getDepartmentByclass');

// here is the login form route okay.
Route::get('/student', 'StudentController@studentLogin')->name('login.website');
Route::get('/student/logout/{website}', 'StudentController@studentLogout')->name('logout.website');

// ------------------------- this route is for login----------------
route::post('student-login', 'StudentController@LoginStudent');

Route::get('/parent', 'StudentController@parentLogin');
route::post('parent-login', 'StudentController@LoginParent');

// Forgot password route okay.
route::get('/student/forgot-password/{website}', 'StudentController@getForgotPassword');
route::post('/forgot-password', 'StudentController@ForgotPassword');

Auth::routes();

Route::group(['middlewere'=>'auth'], function(){

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/dashboard2', 'HomeController@Dashboard')->name('home.dashboard2');
Route::get('/chart/dynamic', 'HomeController@index')->name('chart.dynamic');

Route::resource('users', 'UserController');

Route::resource('permissions', 'PermissionController');


Route::post('admissions/chart', 'HomeController@index')->name('admissions.chart');

// Banner Route 
Route::get('get/banner', 'HomeController@getSchoolBanner')->name('banner.create');
Route::get('edit/banner/{id}', 'HomeController@editSchoolBanner')->name('banner.edit');
Route::post('delete/banner/{id}', 'HomeController@deleteSchoolBanner')->name('banner.delete');
Route::post('post/banner', 'HomeController@postSchoolBanner')->name('banner.store');
Route::post('update/banner', 'HomeController@updateSchoolBanner')->name('banner.update');


// Event Route 
Route::get('get/event', 'HomeController@getSchoolEvent')->name('event.create');
Route::get('event/edit/{id}', 'HomeController@editSchoolEvent')->name('event.edit');
Route::delete('delete/event/{id}', 'HomeController@deleteSchoolEvent')->name('event.delete');
Route::post('post/event', 'HomeController@postSchoolEvent')->name('event.store');
Route::get('get/event/{id}', 'HomeController@getSchoolEventDetail')->name('event.detail');
Route::post('event/update', 'HomeController@updateSchoolEvent')->name('event.update');
// Route::match(['get', 'post'], 'school-event-update', 'HomeController@updateSchoolEvent')->name('event.update');


// News Route 
Route::get('news', 'HomeController@SchoolNewsIndex')->name('news.index');
Route::get('get/news', 'HomeController@getSchoolNews')->name('news.create');
Route::get('edit/news/{id}', 'HomeController@editSchoolNews')->name('news.edit');
Route::post('delete/news/{id}', 'HomeController@deleteSchoolNews')->name('news.delete');
Route::post('post/news', 'HomeController@postSchoolNews')->name('news.store');
Route::get('get/news/{id}', 'HomeController@getSchoolNewsDetail')->name('news.detail');
Route::match(['get', 'post'], 'school-news-update', 'HomeController@updateSchoolNews')->name('news.update');


// Contact Us Route 
Route::get('get/contact_us', 'HomeController@getContactUs')->name('contact_us.index');
Route::get('edit/contact_us/{id}', 'HomeController@editContactUs')->name('contact_us.edit');
Route::post('delete/contact_us/{id}', 'HomeController@deleteContactUs')->name('contact_us.delete');
Route::get('get/contact_us/{id}', 'HomeController@getContactUsDetail')->name('contact_us.detail');
Route::match(['get', 'post'], 'school-contact_us-update', 'HomeController@updateContactUs')->name('contact_us.update');


// Income  Route 
Route::get('get/income', 'IncomeController@getIncome')->name('income.index');
Route::get('edit/income/{id}', 'IncomeController@editIncome')->name('income.edit');
Route::post('post/income', 'IncomeController@saveIncome')->name('income.store');
Route::post('delete/income/{id}', 'IncomeController@deleteIncome')->name('income.delete');
Route::get('get/income/{id}', 'IncomeController@getIncomeDetail')->name('income.detail');
Route::match(['get', 'post'], 'school-income-update/{id}', 'IncomeController@updateIncome')->name('income.update');


// Incometype  Route 
Route::get('get/incometype', 'IncomeController@getIncomeType')->name('incometype.index');
Route::get('edit/incometype/{id}', 'IncomeController@editIncomeType')->name('incometype.edit');
Route::post('post/incometype', 'IncomeController@saveIncomeType')->name('incometype.store');
Route::post('delete/incometype/{id}', 'IncomeController@deleteIncomeType')->name('incometype.delete');
Route::get('get/incometype/{id}', 'IncomeController@getIncomeTypeDetail')->name('incometype.detail');
Route::match(['get', 'post'], 'school-incometype-update/{id}', 'IncomeController@updateIncomeType')->name('incometype.update');


// Expenses Route 
Route::get('get/expensestype', 'ExpenseController@getExpensesType')->name('expensestype.index');
Route::get('edit/expensestype/{id}', 'ExpenseController@editExpensesType')->name('expensestype.edit');
Route::post('post/expensestype', 'ExpenseController@saveExpensesType')->name('expensestype.store');
Route::post('delete/expensestype/{id}', 'ExpenseController@deleteExpensesType')->name('expensestype.delete');
Route::get('get/expensestype/{id}', 'ExpenseController@getExpensesTypeDetail')->name('expensestype.detail');
Route::match(['get', 'post'], 'school-expensestype-update/{id}', 'ExpenseController@updateExpensesType')->name('expensestype.update');

// Expenses Route 
Route::get('get/expenses', 'ExpenseController@getExpenses')->name('expenses.index');
Route::get('edit/expenses/{id}', 'ExpenseController@editExpenses')->name('expenses.edit');
Route::post('post/expenses', 'ExpenseController@saveExpenses')->name('expenses.store');
Route::post('delete/expenses/{id}', 'ExpenseController@deleteExpenses')->name('expenses.delete');
Route::get('get/expenses/{id}', 'ExpenseController@getExpensesDetail')->name('expenses.detail');
Route::match(['get', 'post'], 'school-expenses-update/{id}', 'ExpenseController@updateExpenses')->name('expenses.update');


// book Route 
Route::get('get/book', 'LibraryController@getBooks')->name('book.index');
Route::get('add/book', 'LibraryController@addBooks')->name('book.add');
Route::get('edit/book/{id}', 'LibraryController@editBooks')->name('book.edit');
Route::post('post/book', 'LibraryController@saveBooks')->name('book.store');
Route::post('delete/book/{id}', 'LibraryController@deleteBooks')->name('book.delete');
Route::get('get/book/{id}', 'LibraryController@getBooksDetail')->name('book.detail');
Route::match(['get', 'post'], 'school-book-update/{id}', 'LibraryController@updateBooks')->name('book.update');


// library member Route 
Route::get('get/librarymember', 'LibraryController@getLibraryMember')->name('librarymember.index');
Route::get('add/librarymember', 'LibraryController@addLibraryMember')->name('librarymember.add');
Route::get('edit/librarymember/{id}', 'LibraryController@editLibraryMember')->name('librarymember.edit');
Route::post('post/librarymember', 'LibraryController@saveLibraryMember')->name('librarymember.store');
Route::post('delete/librarymember/{id}', 'LibraryController@deleteLibraryMember')->name('librarymember.delete');
Route::get('get/librarymember/{id}', 'LibraryController@getLibraryMemberDetail')->name('librarymember.detail');
Route::match(['get', 'post'], 'school-librarymember-update/{id}', 'LibraryController@updateLibraryMember')->name('librarymember.update');


// issue book Route 
Route::get('get/issuebook/{id}', 'LibraryController@getIssueBook')->name('issuebook.index');
Route::get('add/issuebook', 'LibraryController@addIssueBook')->name('issuebook.add');
Route::get('edit/issuebook/{id}', 'LibraryController@editIssueBook')->name('issuebook.edit');
Route::post('post/issuebook', 'LibraryController@saveIssueBook')->name('issuebook.store');
Route::post('delete/issuebook/{id}', 'LibraryController@deleteIssueBook')->name('issuebook.delete');
Route::get('get/issuebook/{id}', 'LibraryController@getIssueBookDetail')->name('issuebook.detail');
Route::match(['get', 'post'], 'school-IssueBook-update/{id}', 'LibraryController@updateIssueBook')->name('issuebook.update');


// design ID card Route 
Route::get('design/id_card', 'IDCARDController@getStudentIDCard')->name('student_idCard.index');
Route::post('print_preview', 'IDCARDController@printIDCARD')->name('student_idCard.printpreview');
Route::get('generate/id_card', 'IDCARDController@genarateIDCARD')->name('student_idCard.generate');
Route::get('edit/id_card/{id}', 'IDCARDController@editStudentIDCard')->name('student_idCard.edit');
Route::post('post/id_card', 'IDCARDController@saveStudentIDCard')->name('student_idCard.store');
Route::post('delete/id_card/{id}', 'IDCARDController@deleteStudentIDCard')->name('student_idCard.delete');
Route::get('get/id_card/{id}', 'IDCARDController@getStudentIDCardDetail')->name('student_idCard.detail');
Route::match(['get', 'post'], 'school-id_card-update/{id}', 'IDCARDController@updateStudentIDCard')->name('student_idCard.update');

// Design Certifcate Route
Route::resource('design_certiifcate', 'DesignCertificatesController');
// ->middleware(['auth','check-subscription']);;
// Route::get('design/certificate', 'DesignCertificatesController@getStudentIDCard')->name('certificate.index');
// Route::post('print_preview', 'DesignCertificatesController@printIDCARD')->name('student_idCard.printpreview');
// Route::get('generate/id_card', 'DesignCertificatesController@genarateIDCARD')->name('student_idCard.generate');
// Route::get('edit/id_card/{id}', 'DesignCertificatesController@editStudentIDCard')->name('student_idCard.edit');
// Route::post('post/id_card', 'DesignCertificatesController@saveStudentIDCard')->name('student_idCard.store');
// Route::post('delete/id_card/{id}', 'DesignCertificatesController@deleteStudentIDCard')->name('student_idCard.delete');
// Route::get('get/id_card/{id}', 'DesignCertificatesController@getStudentIDCardDetail')->name('student_idCard.detail');
// Route::match(['get', 'post'], 'school-id_card-update/{id}', 'DesignCertificatesController@updateStudentIDCard')->name('student_idCard.update');

Route::delete('design_certificates/truncate',array('as'=>'visitor.truncate', 'uses'=>'DesignCertificatesController@truncate'));

Route::get('design_certificates/sample', 'DesignCertificatesController@SampleCertificate')->name('sample');
Route::get('generate/certificate', 'DesignCertificatesController@genarateCertificate')->name('design_certificates.generate');
Route::post('print/certificate', 'DesignCertificatesController@printCertificate')->name('design_certificates.print');
Route::get('certificate/list', 'DesignCertificatesController@ListCertificate')->name('design_certificates.list');




// Subscription Payment Routes

Route::get('subcription', 'PaymentController@payment')->name('subscription.payment');
// Route::post('subcription/subscribe', 'PaymentController@subscribe')->name('subscription.subscribe');
// Route::get('payment', 'PaymentController@payment');
Route::post('subscribe', 'PaymentController@subscribe');




// QrCode Routes

Route::get('qrcode', 'QrCodeController@generateQrcode')->name('qrcode.generate');


// Word Routes

Route::get('word', 'WordController@wordGenerate')->name('word.generate');
Route::post('store','WordController@store');



// Event Routes

// Route::resource('event', 'EventController');
// /fullcalender
Route::get('/event','EventController@index');
Route::post('/event/create','EventController@create');
Route::post('/event/update','EventController@update');
Route::post('/event/delete','EventController@destroy');
Route::post('/event/delete','EventController@destroy');


// Media Manager 

Route::get('get/media_manager', 'HomeController@getMediaManager')->name('media.index');
Route::get('edit/media_manager/{id}', 'HomeController@editMediaManager')->name('media.edit');
Route::delete('delete/media_manager/{id}', 'HomeController@deleteMediaManager')->name('media.delete');
Route::post('post/media_manager', 'HomeController@postMediaManager')->name('media.store');
Route::get('detail/media_manager/{id}', 'HomeController@detailMediaManager')->name('media.detail');
Route::match(['get', 'post'], 'school-event-update', 'HomeController@updateMediaManager')->name('media.update');



// Front Cms Settings
route::resource('front_cms', 'FrontCmsController' );
// Route::get('front/cms', 'FrontCmsController@FrontCmsIndex')->name('front_cms.index');
Route::get('edit/front_cms/{id}', 'HomeController@editMediaManager')->name('media.edit');
Route::delete('delete/media_manager/{id}', 'HomeController@deleteMediaManager')->name('media.delete');
Route::post('post/media_manager', 'HomeController@postMediaManager')->name('media.store');
Route::get('detail/media_manager/{id}', 'HomeController@detailMediaManager')->name('media.detail');
Route::match(['get', 'post'], 'school-event-update', 'HomeController@updateMediaManager')->name('media.update');


// Video Media Manager 

// Route::get('get/media_manager', 'HomeController@getMediaManager')->name('media.index');
Route::get('edit/media_manager/{id}', 'HomeController@editMediaManager')->name('media.edit');
Route::post('delete/media_manager/{id}', 'HomeController@deleteMediaManager')->name('media.delete');
Route::post('post/videomedia_manager', 'HomeController@SaveVideoMediaManager')->name('videomedia.store');
Route::get('detail/media_manager/{id}', 'HomeController@detailMediaManager')->name('media.detail');
Route::match(['get', 'post'], 'school-event-update', 'HomeController@updateMediaManager')->name('media.update');




// Contact us Route 
Route::get('show/contact_us/{id}', 'HomeController@getSchoolContactUs')->name('contact_us.show');
Route::get('edit/contact_us/{id}', 'HomeController@editSchoolContactUs')->name('contact_us.edit');
Route::post('delete/contact_us/{id}', 'HomeController@deleteSchoolContactUs')->name('contact_us.delete');
Route::post('update/contact_us', 'HomeController@postSchoolContactUs')->name('contact_us.update');



// Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('checkPermission:roll_add');
// Route::get('roles/index', 'RoleController@index')->name('roles.index')->middleware('checkPermission:roll_view');
// Route::get('roles/edit', 'RoleController@edit')->name('roles.edit')->middleware('checkPermission:roll_edit');
// Route::post('roles/{id}', 'RoleController@update')->name('roles.update')->middleware('checkPermission:roll_edit');
// Route::get('roles/show/{id}', 'RoleController@show')->name('roles.show')->middleware('checkPermission:roll_view');
// Route::post('roles/{id}', 'RoleController@destroy')->name('roles.destroy')->middleware('checkPermission:roll_delete');
// Route::post('roles/store', 'RoleController@store')->name('roles.store');


Route::post('/delete/{permission}', 'PermissionController@delete')->name('permission-delete');

// ------------------------- UPDATE STUDENT STATUS ADMISSION-----------------
Route::get('user/role/update', 'UserController@updateRole')->name('user.update.roles');
Route::get('user/status/update', 'UserController@updateUserStatus')->name('user.update.status');


Route::get('/users', 'UserController@index')->name('users.index');

Route::resource('classes', 'ClassesController');

// ------------------------- STATUS DEPARTMENT UPDATE ROUTE -----------------
Route::get('classes/status/update', 'ClassesController@updateClassStatus')->name('classes.update.status');


Route::resource('batches', 'BatchController');

// ------------------------- STATUS DEPARTMENT UPDATE ROUTE -----------------
Route::get('batch/status/update', 'BatchController@updateBatchStatus')->name('batch.update.status');


Route::resource('courses', 'CourseController');

// ------------------------- STATUS DEPARTMENT UPDATE ROUTE -----------------
Route::get('course/status/update', 'CourseController@updateCourseStatus')->name('course.update.status');


Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('checkPermission:roll_add');
Route::get('roles/index', 'RoleController@index')->name('roles.index')->middleware('checkPermission:roll_view');
Route::get('roles/edit', 'RoleController@edit')->name('roles.edit')->middleware('checkPermission:roll_edit');
Route::post('roles/{id}', 'RoleController@update')->name('roles.update')->middleware('checkPermission:roll_edit');
Route::get('roles/show/{id}', 'RoleController@show')->name('roles.show')->middleware('checkPermission:roll_view');
Route::post('roles/{id}', 'RoleController@destroy')->name('roles.destroy')->middleware('checkPermission:roll_delete');
Route::post('roles/store', 'RoleController@store')->name('roles.store');

Route::resource('days', 'DayController');
// ------------------------- UPDATE DAYS STATUS -----------------
Route::get('days/status/update', 'DayController@updateDayStatus')->name('days.update.status');


Route::resource('admissions', 'AdmissionController');
Route::resource('admin\admissions', 'Admin\AdmissionController');

Route::get('all/student/list', 'AdmissionController@StudentList');
Route::get('sort/students', 'AdmissionController@SortStudent');
Route::get('sort/teachers', 'TeacherController@SortTeacher');

Route::resource('classAssignings', 'ClassAssigningController');

Route::get('/search-teachers','ClassAssigningController@search');

Route::resource('attendances', 'AttendanceController');

Route::post('/insert',array('as'=>'insert', 'uses'=>'ClassAssigningController@insert'));
// function need to create okay

});

Route::get('get/promote/students', ['as' => 'PromoteStudents', 'uses' => 'AdmissionController@PromoteStudents' ]);
Route::post('promote/student', ['as' => 'PromoteStudent', 'uses' => 'AdmissionController@PromoteStudent' ]);
Route::post('save/promote/student', ['as' => 'SavePromoteStudent', 'uses' => 'AdmissionController@SavePromoteStudent' ]);
Route::post('save/promote/student-classwise', ['as' => 'SavePromoteStudentClasswise', 'uses' => 'AdmissionController@SavePromoteStudentClasswise' ]);
Route::get('show/promote/student', ['as' => 'ShowPromoteStudent', 'uses' => 'AdmissionController@ShowPromoteStudent' ]);

Route::post('filter/promote/student', ['as' => 'FilterPromoteStudent', 'uses' => 'AdmissionController@FilterPromoteStudent' ]);
Route::get('previous/promote/student/{student_id}', ['as' => 'ShowPreviousPromotedStudent', 'uses' => 'AdmissionController@ShowPreviousPromotedStudent' ]);

Route::delete('delete/Promote/student/{id}', ['as' => 'DeletePromotedStudent', 'uses' =>'AdmissionController@deletePromoteStudent']);
Route::delete('delete_multiple_promoted_student', ['as' => 'DeleteMultiPromotedStudent', 'uses' => 'AdmissionController@deletePromoteStudentAll']);

Route::get('delete_student_transaction/{transact_id}', ['as' => 'DeleteTransactions', 'uses' => 'TransactionController@DeleteTransactions']);

Route::delete('delete_multiple_student', ['as' => 'deleteStudentAll', 'uses' => 'AdmissionController@deleteStudentAll']);
Route::delete('delete_multiple_teacher', ['as' => 'deleteTeacherAll', 'uses' => 'TeacherController@deleteTeacherAll']);
Route::delete('delete_multiple_class', ['as' => 'deleteClassAll', 'uses' => 'ClassesController@deleteClassAll']);
Route::delete('delete_multiple_semester', ['as' => 'deleteSemesterAll', 'uses' => 'SemesterController@deleteSemesterAll']);


// Route::resource('admissions', 'AdmissionController');

// Route::resource('teachers', 'TeacherController');

Route::resource('classSchedulings', 'Class_SchedulingController');

Route::resource('classRooms', 'ClassRoomController');

Route::resource('times', 'TimeController');

Route::resource('academics', 'AcademicController');

// ------------------------- UPDATE DAYS STATUS -----------------
Route::get('academics/status/update', 'AcademicController@updateAcademicStatus')->name('academics.update.status');


Route::resource('levels', 'LevelController');
// ------------------------- STATUS DEPARTMENT UPDATE ROUTE -----------------
Route::get('level/status/update', 'LevelController@updateLevelStatus')->name('level.update.status');


Route::resource('shifts', 'ShiftController');
// ------------------------- UPDATE SHIFT STATUS -----------------
Route::get('shift/status/update', 'ShiftController@updateShiftStatus')->name('shift.update.status');


// Route::resource('semesters', 'SemesterController');

// ------------------------- UPDATE SEMESTER STATUS -----------------
Route::get('semesters/status/update', 'SemesterController@updateSemesterStatus')->name('semesters.update.status');



Route::resource('levels', 'LevelController');

Route::resource('attendances', 'AttendanceController');

Route::resource('semesters', 'SemesterController');

Route::resource('teachers', 'TeacherController');

// ------------------------- UPDATE STUDENT STATUS ADMISSION-----------------
Route::get('teacher/status/update', 'TeacherController@updateStatus')->name('teacher.update.status');

// Route::get('edit', ['as'=> 'edit_teach', 'uses' => 'TeacherController@edit_teach']);


//TRANACTIONS ROUTE PART
Route::resource('transactions', 'TransactionController');
Route::get('student/transactions/{student_id}', ['as' => 'StudentTransactionPrint', 'uses' => 'TransactionController@StudentTransactionPrint' ]);
Route::get('all/student/transactions/{student_id}', ['as' => 'All_Student_Fee_Transactios', 'uses' => 'FeeController@All_Student_Fee_Transactios' ]);


Route::resource('classRooms', 'ClassRoomController');

Route::resource('classRooms', 'ClassRoomController');

Route::resource('$Academics', '$AcademicController');

Route::resource('academics', 'AcademicController');

Route::resource('classSchedules', 'ClassScheduleController');

// UPDATE STATUS OF CLASS SCHEDULE ROUTE
Route::get('schedule/status/update', 'ClassScheduleController@updateStatus')->name('classSchedules.update.status');


Route::get('/get_permission','permissionController@index');
Route::post('/permission/create','permissionController@store');

Route::resource('/school', 'SchoolController')->middleware('auth');
Route::get('school/review', 'SchoolController@School_Confirmation')->name('school.review')->middleware('auth');



// Route::resource('/school', 'SchoolController');
//IN HERE WE WILL WRITE THE ROUTE FOR OUR DYNAMIC SELECTION OKAY.

Route::get('/dynamicLevel', ['as'=> 'dynamicLevel', 'uses' =>
'ClassScheduleController@DynamicLevel']); // so we will pass this DynamicLevel inside our controller okay.

// Edit route:
Route::get('/class_schedules/edit', ['as'=> 'edit', 'uses' => 'ClassScheduleController@edit']);

// Update route:
// Route::post('/class_schedules/update',['as'=> 'update', 'uses' =>'ClassScheduleController@update' ]); //we are using array

// i will use the resouse route okay

Route::get('/search','TeacherController@search');


Route::resource('departments', 'DepartmentController');


Route::resource('faculties', 'FacultyController');

// MULTIPLE LANGUAGES ROURE
Route::get('locale/{locale}', 'StudentController@language');


// Chart Route
Route::get('admin/admission/chart', 'ChartController@AdmissionChart')->name('admission.chart');
Route::get('admin/attendance/chart', 'ChartController@AttendanceChart')->name('attendance.chart');

// language routes
// Route::get('admin/language/{locale}', 'AdminController@language');

Route::get('change-skin/{value}','LoginController@change_skin')->where('value', '[A-Za-z0-9-_]+');


Route::get('prints{$id}', 'AdmissionController@print');
// Excel Route for Teachers

Route::get('excel-export-teachers_xlsx', 'TeacherController@ExportExcel_xlsx');
Route::get('excel-export-teachers_xls', 'TeacherController@ExportExcel_xls');
Route::get('excel-export-teachers_csv', 'TeacherController@ExportExcel_csv');

Route::post('excel-import-teachers', 'TeacherController@ExcelImport');

Route::get('prints-teachers/{id}', 'TeacherController@PrintTeacher');
Route::get('prints-all-teachers', 'TeacherController@PrintAllTeacher');
Route::get('pdf-download-teacher-single/{id}', 'TeacherController@PDFTeacher_Single');

// teachers mark create route
Route::get('/mark/entry','TeacherController@markindex');
Route::post('/teacherEnterMarks','TeacherController@TeacherEnterMarks');
// Route::post('/teacherEnterMarks','markController@create');

Route::get('/get/mark/list','TeacherController@GetMarkList');
Route::post('/teacher/mark/list','TeacherController@TeacherGetMarkList');

Route::get('/teacher/mark/edit/{id}','TeacherController@markedit');
Route::post('/teacher/mark/update','TeacherController@markupdate');
Route::get('/teacher/mark/delete/{id}','TeacherController@markelete');

Route::get('/teacher/gradesheet','TeacherController@TeacherResultHome');
Route::match(['get','post'], '/teacher/gradesheet/{class_id}','TeacherController@TeacherResultByClass');
Route::post('/teacher/gradesheet','gradesheetController@TeacherStudentdListResult');
Route::get('/teacher/gradesheet/print/{regiNo}/{exam}/{class}','gradesheetController@printsheet');
// next let's work on the teacher controller okay.

// Route::get('/lockscreen', 'LoginController@lockscreen')->name('lockscreen');

Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login/action', 'LoginController@loginAction')->name('login-action');


Route::get('/ student-class-homework', 'StudentController@GetStudentHomeWork');
Route::post('/ upload-class-homework', 'StudentController@UploadStudentHomeWork')->name('upload-class-homework');


   //=========================teacher hOMEWORK ROUTES===================================
       
   Route::get('/studentsincharge', 'TeacherController@StudentListInCharge');
   Route::get('/classincharge', 'TeacherController@ClassListInCharge');
   Route::get('/ send-class-homework', 'TeacherController@GetTeacherHomeWork');
   Route::get('/ send-class-homework/{class_id}', 'TeacherController@SendTeacherHomeWork');
   Route::post('/create-class-homework', 'TeacherController@CreateHomeWork')->name('create-class-homework');
   Route::get('/upload-student-homework/{id}', 'TeacherController@HomeWorkUploaded')->name('upload-student-homework');

   Route::get('/homework-list', 'TeacherController@HomeWorkList')->name('homework-list');
   Route::get('/homework-edit/{id}', 'TeacherController@HomeWorkEdit')->name('homework-edit');
   Route::post('/homework-update/{id}', 'TeacherController@HomeWorkUpdate')->name('homework-update');
   Route::post('/homework-delete/{id}', 'TeacherController@HomeWorkDelete')->name('homework-delete');


Route::get('/studentsincharge', 'TeacherController@StudentListInCharge');
Route::get('/classincharge', 'TeacherController@ClassListInCharge');

Route::group(['middleware' => 'auth.check'], function () {
    //common routes
    Route::get('/dashboard', 'LoginController@dashboard')->name('dashboard');
    Route::get('/my/profile', 'UserController@profileView')->name('user-profile');
    Route::get('/my/profile/edit', 'UserController@editProfile')->name('profile-edit');
    Route::post('/my/profile/update/action', 'UserController@updateProfile')->name('profile-update-action');
    Route::get('/lockscreen', 'LoginController@lockscreen')->name('lockscreen');
    Route::post('/logout-action', 'LoginController@logout')->name('logout-action');
    Route::get('/error/404', 'LoginController@invalidUrl')->name('invalid-url');
    Route::get('/error/500', 'LoginController@serverError')->name('server-error');

    //general timetable views
    Route::get('/timetable/teacher', 'TimetableController@teacherLevel')->name('timetable-teacher');
    Route::get('/timetable/student', 'TimetableController@studentLevel')->name('timetable-student');
    //substituted timetable
    Route::get('/substitution/temp/timetable', 'SubstitutionController@substitutedTimetable')->name('substituted-timetable');

    //superadmin routes
    Route::group(['middleware' => ['user.role:0,,']], function () {
        Route::get('/user/register', 'UserController@register')->name('user-register');
        Route::post('/user/register/action', 'UserController@registerAction')->name('user-register-action');
        Route::get('/user/list', 'UserController@userList')->name('user-list');
    });

});


Route::get('/search-teachers', 'ClassAssigningController@ShowClassAssign');


Route::get('/enter-subject-detail', 'CourseController@EnterSubjectDetails');
Route::get('/edit-subject-detail/{id}', 'CourseController@EditSubjectDetails');
Route::post('/update-subject-detail/{id}', 'CourseController@UpdateSubjectDetails');


//=========================teacher Report List===================================

Route::get('/teacher-report/teacher-list', ['as' => 'getTeacherReportList', 'uses' => 'TeacherReportController@getTeacherReportList']);
Route::get('/teacher-report/teacher-info', ['as' => 'showteacherInfo', 'uses' => 'TeacherReportController@showteacherInfo']);
Route::get('/teacher-report/teacher-multi-class', ['as' => 'getTeacherMultiClassList', 'uses' => 'TeacherReportController@getTeacherMultiClassList']);
Route::get('/teacher-report/teacher-info-multi-class', ['as' => 'showTeacherMultiClassList', 'uses' => 'TeacherReportController@showTeacherMultiClassList']);



Route::get('/class-schedule/classinfo', ['as' => 'showClassInformation', 'uses' => 'ClassScheduleController@showClassInformation']);

// FILTER DATA ROUTE




Route::post('get/student/transactions', ['as' => 'getStudentTransactions', 'uses' => 'TransactionController@getStudentTransactions']);


Route::get('filter-classSchedules-by-class', ['as' => 'FilterByClass', 'uses' => 'ClassScheduleController@FilterByClass']);
Route::get('filter-classSchedules-by-course', ['as' => 'FilterByCourse', 'uses' => 'ClassScheduleController@FilterByCourse']);
Route::get('filter-classSchedules-by-level', ['as' => 'FilterByLevel', 'uses' => 'ClassScheduleController@FilterByLevel']);
Route::get('filter-classSchedules-by-course-level', ['as' => 'FilterByCourseLevel', 'uses' => 'ClassScheduleController@FilterByCourseLevel']);

Route::get('show-bus-list', 'ClassScheduleController@showBusList')->name('show-bus-list');

// Route::get('show-class-list', 'ClassScheduleController@showClassList')->name('show-class-list');


Route::resource('prints', 'PrintController');

// ------------------------- PDF Class Assigning -----------------
Route::get('/pdf-download-class-assign','ClassAssigningController@PDFgenerator');
Route::get('/pdf-download-class','ClassesController@PDFgenerator');

Route::get('/pdf-download-class-assign-single/{id}','ClassAssigningController@PDFgeneratorSingle');
Route::get('/print-class-assign-single/{id}','ClassAssigningController@print');
Route::get('/print-class-assign-by-teacher-single/{id}','ClassAssigningController@print');
Route::get('prints-all-teacher-class', 'ClassAssigningController@PrintAllTeacherClassAssign');
// ------------------------- PDF Class Schedule -----------------
Route::get('/pdf-download-class-schedule','ClassScheduleController@PDFgenerator');

Route::get('/pdf-download-class-schedule-single/{id}','ClassScheduleController@PDFgeneratorSingle');
Route::get('/print-class-schedule-single/{id}','ClassScheduleController@print');

// ------------------------- PDF Teachers -----------------
Route::get('/pdf-download-teachers','TeacherController@PDFgenerator');

// ------------------------- PDF  Academics -----------------
Route::get('/pdf-download-academics','AcademicController@PDFgenerator');

// ------------------------- PDF  Users -----------------
Route::get('/pdf-download-classes','ClassesController@PDFgenerator');

Route::get('/pdf-download-class-single/{id}','ClassesController@PDFgeneratorSingle');
Route::get('/print-class-single/{id}','ClassesController@print');

// ------------------------- PDF  Batchs -----------------
Route::get('/pdf-download-batches','BatchController@PDFgenerator');

Route::get('/pdf-download-batches-single/{id}','BatchController@PDFgeneratorSingle');
Route::get('/print-batches-single/{id}','BatchController@print');

// ------------------------- PDF  Courses -----------------
Route::get('/pdf-download-courses','CourseController@PDFgenerator');

Route::get('/pdf-download-courses-single/{id}','BatchController@PDFgeneratorSingle');
Route::get('/print-courses-single/{id}','BatchController@print');

// ------------------------- PDF  Level -----------------
Route::get('/pdf-download-level','LevelController@PDFgenerator');

Route::get('/pdf-download-level-single/{id}','BatchController@PDFgeneratorSingle');
Route::get('/print-level-single/{id}','BatchController@print');

// ------------------------- PDF  Day -----------------
Route::get('/pdf-download-days','DayController@PDFgenerator');

Route::get('/pdf-download-days-single/{id}','BatchController@PDFgeneratorSingle');
Route::get('/print-days-single/{id}','BatchController@print');

// ------------------------- PDF  Shift -----------------
Route::get('/pdf-download-shifts','ShiftController@PDFgenerator');

Route::get('/pdf-download-shifts-single/{id}','BatchController@PDFgeneratorSingle');
Route::get('/print-shifts-single/{id}','BatchController@print');

// ------------------------- PDF  Time -----------------
Route::get('/pdf-download-times','TimeController@PDFgenerator');

Route::get('/pdf-download-times-single/{id}','TimeController@PDFgeneratorSingle');
Route::get('/print-times-single/{id}','TimeController@print');

// ------------------------- UPDATE DAYS STATUS -----------------
Route::get('time/status/update', 'TimeController@updateTimeStatus')->name('time.update.status');

// ------------------------- PDF  ClassRoom -----------------
Route::get('/pdf-download-classroom','ClassRoomController@PDFgenerator');

Route::get('/pdf-download-classroom-single/{id}','ClassRoomController@PDFgeneratorSingle');
Route::get('/print-classroom-single/{id}','ClassRoomController@print');

// ------------------------- UPDATE DAYS STATUS -----------------
Route::get('classrooms/status/update', 'ClassRoomController@updateClassroomStatus')->name('classrooms.update.status');

// ------------------------- PDF  Semester -----------------
Route::get('/pdf-download-semester','SemesterController@PDFgenerator');

Route::get('/pdf-download-semester-single/{id}','BatchController@PDFgeneratorSingle');
Route::get('/print-semester-single/{id}','BatchController@print');

// ------------------------- PDF  Faculty -----------------
Route::get('/pdf-download-faculty','FacultyController@PDFgenerator');

Route::get('/pdf-download-faculty-single/{id}','FacultyController@PDFgeneratorSingle');
Route::get('/print-faculty-single/{id}','FacultyController@print');

// UPDATE STATUS OF CLASS SCHEDULE ROUTE
Route::get('/status/update', 'FacultyController@updateStatus')->name('faculties.update.status');

// ------------------------- PDF  Department -----------------
Route::get('/pdf-download-department','DepartmentController@PDFgenerator');

Route::get('/pdf-download-department-single/{id}','DepartmentController@PDFgeneratorSingle');
Route::get('/print-department-single/{id}','DepartmentController@print');

// ------------------------- STATUS DEPARTMENT UPDATE ROUTE -----------------
Route::get('department/status/update', 'DepartmentController@updateDepartmentStatus')->name('department.update.status');

// ------------------------- PDF  Admission -----------------
Route::get('/pdf-download-admission','AdmissionController@PDFgenerator');

Route::get('/pdf-download-admission-single/{id}','AdmissionController@PDFgeneratorSingle');
Route::get('/print-admission-single/{id}','AdmissionController@print');

// ------------------------- UPDATE STUDENT STATUS ADMISSION-----------------

Route::get('student/status/update', 'AdmissionController@updateStatus')->name('student.update.status');


// ------------------------- PDF  Users -----------------
Route::get('/pdf-download-users','UserController@PDFgenerator');

Route::get('/pdf-download-users-single/{id}','UserController@PDFgeneratorSingle');
Route::get('/print-users-single/{id}','UserController@print');

// ------------------------- PDF  Roles -----------------
Route::get('/pdf-download-roles','RoleController@PDFgenerator');

Route::get('/pdf-download-roles-single/{id}','RoleController@PDFgeneratorSingle');
Route::get('/print-roles-single/{id}','RoleController@print');
