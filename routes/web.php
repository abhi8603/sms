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
Auth::routes();
Route::get('/', function () {
    return view('login');
});
 
Route::get('online/new-admission','HomeController@newAdmission');
Route::match(['get'],'online/receipt/download','HomeController@Receiptdownload');
Route::match(['post'],'online/receipt/download/view','HomeController@ReceiptdownloadView');

Route::get('online/admission-form/list','HomeController@admissionFormList');
Route::get('payonline/receipt/{id}','HomeController@viewreceipt');
Route::get('payonline/fail/{id}','HomeController@paymentfailure');
Route::post('payonline/getresponse','HomeController@getpaymentgatwayresponse');
Route::get('admission-form','HomeController@admissionForm');
Route::get('payonline/pay/{id}','HomeController@onlinepay');
Route::post('payonline/paymentgatway/redirect','HomeController@payredirect');
Route::post('submitfrom','HomeController@submitfrom');
Route::get('user/password/update','settingController@updatePassword');
Route::post('user/password/update/updating','settingController@updateUserPassword');

//Route::get('/','HomeController@login');
//Route::get('home', 'HomeController@index');
//Route::get('home', 'HomeController@index')->name('home');
Route::get('checkuser','HomeController@checkuser');
Route::get('admission-form','HomeController@admissionForm');
Route::get('forgot_password','HomeController@forgot_password');
Route::post('checkuserhas','HomeController@checkuserhas');
Route::post('update_password','HomeController@update_password');
Route::get('welcome','settingController@index');
Route::get('parentwelcome','HomeController@parentindex');
Route::get('teacherwelcome','HomeController@teacherindex');
Route::get('Password/change_password','HomeController@changepassword');
Route::post('Password/update_password','HomeController@updatepassword');
Route::get('fee/payonline','onlinePaymentController@payonline');

// student_panelController

Route::get('student/online/classes','student_panelController@onlineClasses');
Route::get('student/online/classes/start/{id}','student_panelController@StartonlineClasses');


Route::get('studentwelcome','student_panelController@studentindex');
Route::get('parents/ward/attendance/report','student_panelController@attendancereport');

Route::post('parents/ward/attendance/show_att_report','student_panelController@show_att_report');
Route::get('parents/ward/homework/homework','student_panelController@homework');

Route::get('student/homework/homework','student_panelController@homework');
Route::post('student/homework/homeworklist','student_panelController@homework_report');
Route::get('student/homework/submit/{id}','student_panelController@homework_submit');
Route::post('student/homework/upload_homework','student_panelController@upload_homework');
Route::get('student/homework/view_homework','student_panelController@view_homework');
Route::get('student/exam/exam_hall_arrangement','student_panelController@exam_hall_arrangement');
Route::post('student/exam/view_exam_hall_arrangement','student_panelController@view_exam_hall_arrangement');
Route::get('student/timetable/daily_timetable','student_panelController@daily_timetable');
Route::get('student/lesson/lesson_plan','student_panelController@lesson_plane');
Route::get('student/leave/apply','student_panelController@leaveapply');
Route::post('student/apply/leave','student_panelController@applyleave');
Route::get('student/leave/view/{id}','student_panelController@viewleave');
Route::post('student/leave/update','student_panelController@updateleave');
Route::get('student/feedback','student_panelController@feedback');
Route::post('student/feedback/submit','student_panelController@submitfeedback');
Route::get('student/feedback/view/{id}','student_panelController@viewfeedback');
Route::post('student/feedback/comments','student_panelController@submitfeedbackcomments');
Route::get('student/feedback/close/{id}','student_panelController@closefeedbackcomments');
Route::get('student/announcement','student_panelController@announcement');
//ParentController
Route::get('parents/ward/view/{id}','parentController@viewward');
Route::get('parents/ward/fee/payonline','parentController@feepayonline');
Route::get('parents/ward/CurricularCertificate','parentController@CurricularCertificate');
Route::post('parents/ward/downloadCurricularCertificate','parentController@downloadCurricularCertificate');
Route::post('parents/ward/fee/payonline/get','parentController@getfeecolleciononline');
Route::get('parents/ward/fee/payonline/paymentgatway/{id}','parentController@paymentgatway');
Route::post('parents/ward/fee/payonline/paymentgatway/redirect','parentController@payredirect');
Route::post('parents/ward/fee/payonline/getresponse','parentController@getpaymentgatwayresponse');
Route::post('parents/ward/fee/payonline/tempered','parentController@paytempered');
Route::get('parents/ward/payonline/receipt/{id}','parentController@viewreceipt');
Route::get('parents/ward/payonline/fail/{id}','parentController@paymentfailure');
Route::get('parents/ward/feepaid/list','parentController@feepadlist');
Route::get('parents/ward/attendance/report','parentController@attendancereport');

Route::get('parents/ward/exam/result','parentController@exam_result');
Route::post('parents/ward/exam/result/get','parentController@getexam_report_particular');

Route::post('parents/ward/attendance/show_att_report','parentController@show_att_report');
Route::get('parents/ward/homework/homework','parentController@homework');
Route::post('parents/ward/homework/homeworkview','parentController@homeworkview');
Route::post('parents/ward/homework/homeworklist','parentController@homeworklist');
Route::get('parents/ward/homework/homework_report','parentController@homework_report');
Route::get('parents/ward/homework/assignment','parentController@assignment');
Route::post('parents/ward/homework/assignmentlist','parentController@assignmentlist');
Route::get('parents/ward/homework/assignment_report','parentController@assignment_report');
Route::get('parents/ward/homework/view_homework','parentController@view_homework');
Route::get('parents/ward/exam/exam_hall_arrangement','parentController@exam_hall_arrangement');
Route::post('parents/ward/exam/view_exam_hall_arrangement','parentController@view_exam_hall_arrangement');
Route::get('parents/ward/timetable/daily_timetable','parentController@daily_timetable');
Route::get('parents/ward/lesson/lesson_plane','parentController@lesson_plane');
Route::get('parents/ward/leave/apply','parentController@leaveapply');
Route::post('parents/ward/apply/leave','parentController@applyleave');
Route::get('parents/ward/leave/view/{id}','parentController@viewleave');
Route::post('parents/ward/leave/update','parentController@updateleave');
Route::get('parents/ward/feedback','parentController@feedback');
Route::post('parents/ward/feedback/submit','parentController@submitfeedback');
Route::get('parents/ward/feedback/view/{id}','parentController@viewfeedback');
Route::post('parents/ward/feedback/comments','parentController@submitfeedbackcomments');
Route::get('parents/ward/feedback/close/{id}','parentController@closefeedbackcomments');
Route::get('parents/ward/exam/announcement','parentController@announcement');
//setting Controller
Route::get('create-Institution','settingController@createInstitution');
Route::post('InstitutionDetails','settingController@InstitutionDetails');
Route::get('Academic-session','settingController@academicDetails');
Route::get('Academic-session/view/{id}','settingController@academicDetailsview');
Route::post('Academic-session/add','settingController@addacadmicyear');
Route::post('Academic-session/update','settingController@addacadmicyearupdate');
Route::get('Academic-session/delete/{id}','settingController@deleteacadmicyear');
Route::get('setting/branch','settingController@branch');
Route::post('setting/branch/add','settingController@addbranch');
Route::get('permission-error','settingController@permissionError');

// Front Office
Route::get('FrontOffice/office_setup','FrontOfficeController@office_setup');
Route::get('FrontOffice/delete_purpose/{id}','FrontOfficeController@delete_purpose');
Route::get('FrontOffice/delete_complain/{id}','FrontOfficeController@delete_complain');
Route::get('FrontOffice/delete_sources/{id}','FrontOfficeController@delete_sources');
Route::get('FrontOffice/delete_references/{id}','FrontOfficeController@delete_references');
Route::get('FrontOffice/admission_enquiry','FrontOfficeController@admission_enquiry');
Route::post('FrontOffice/insert_admission_enquiry','FrontOfficeController@insert_admission_enquiry');
Route::post('FrontOffice/show_admission_enquiry','FrontOfficeController@show_admission_enquiry');
Route::get('FrontOffice/visitor_book','FrontOfficeController@visitor_book');
Route::post('FrontOffice/insert_visitor_book','FrontOfficeController@insert_visitor_book');
Route::get('FrontOffice/visitor_delete/{id}','FrontOfficeController@visitor_delete');
Route::get('FrontOffice/phone_call','FrontOfficeController@phone_call');
Route::post('FrontOffice/add_phone_call','FrontOfficeController@add_phone_call');
Route::get('FrontOffice/delete_call/{id}','FrontOfficeController@delete_call');
Route::get('FrontOffice/postal_dispatch','FrontOfficeController@postal_dispatch');
Route::post('FrontOffice/insert_postal_dispatch','FrontOfficeController@insert_postal_dispatch');
Route::get('FrontOffice/delete_postal/{id}','FrontOfficeController@delete_postal');
Route::get('FrontOffice/postal_recieve','FrontOfficeController@postal_recieve');
Route::post('FrontOffice/insert_postal_recieve','FrontOfficeController@insert_postal_recieve');
Route::get('FrontOffice/delete_postal_recive/{id}','FrontOfficeController@delete_postal_recive');
Route::get('FrontOffice/complain','FrontOfficeController@complain');
Route::post('FrontOffice/insert_complain','FrontOfficeController@insert_complain');
Route::get('FrontOffice/complain_delete/{id}','FrontOfficeController@complain_delete');
Route::post('FrontOffice/purpose','FrontOfficeController@purpose');
Route::post('FrontOffice/complain_type','FrontOfficeController@complain_type');
Route::post('FrontOffice/insert_source','FrontOfficeController@insert_source');
Route::post('FrontOffice/insert_reference','FrontOfficeController@insert_reference');
//feedback
Route::get('feedback','settingController@feedbacklist');
Route::get('feedback/view/{id}','settingController@schoolviewfeedback');
Route::post('feedback/comments','settingController@submitfeedbackcommentsschool');
//Academic Controller

Route::get('online/classes','academicController@onlineClasses');
Route::post('online/classes/create','academicController@onlineClassesCreate');
Route::get('online/classes/cancel/{id}','academicController@CancelonlineClasses');


Route::get('add-course','academicController@course');
Route::get('add-course/view/{id}','academicController@viewcourse');
Route::get('add-course/delete/{id}','academicController@deletecourse');
Route::post('course/update','academicController@updatecourse');
Route::post('course/new','academicController@addcourse');
Route::get('add-batch','academicController@addbatch');
Route::post('add-batch/new','academicController@newbatch');
Route::get('add-batch/delete/{id}','academicController@deletebatch');
Route::get('add-batch/view/{id}','academicController@viewbatch');
Route::post('add-batch/update','academicController@updatebatch');
Route::get('classTeacher-Allocation','academicController@classTeacherAllocation');
Route::get('subject/create','academicController@createsubject');
Route::post('subject/create/add','academicController@addsubject');
Route::get('subject/delete/{id}','academicController@deletesubject');
Route::get('subject/view/{id}','academicController@viewsubject');
Route::post('subject/update','academicController@updatesubject');
Route::get('subject/assign-subject','academicController@assignsubject');
Route::post('subject/assign-subject/add','academicController@addassignsubject');
Route::get('subject/assign-class-subject/delete/{id}','academicController@Deleteassignclasssubject');
Route::get('subject/subject-allocation','academicController@subjectallocation');
Route::get('subject/lession-planning','academicController@lessionplanning');
Route::post('subject/getSubject','academicController@getSubjectbyclass');
Route::post('subject/getSubjectbyclass_teacher','academicController@getSubjectbyclass_teacher');
Route::post('subject/getlessionplanning','academicController@getlessionplanning');
Route::post('subject/lession-planning/save','academicController@savelessionplanning');
Route::get('subject/lession-planning/delete/{id}','academicController@deletelessionplanning');
Route::get('subject/lession-planning/update-status/{id}','academicController@updateStatuslessionplanning');
Route::post('classTeacher/Allocation','academicController@allocateclassTeacher');
Route::get('classTeacher/delete/{id}','academicController@deleteclassTeacher');
Route::post('employee/emplist','academicController@emplist');
Route::post('subject/subject-assign','academicController@assignnewsubject');
Route::get('subject/subject-assign/delete/{id}','academicController@Deleteassignsubject');

Route::post('subject/subject-assign/postsearch','academicController@assignsubjectpostsearch');
Route::get('create_timetable','academicController@createtimetable');
Route::post('time-table/set-timetable','academicController@SetTimeTable');
Route::post('student/batchlist','academicController@batchlist');
Route::get('student/subjectlist','academicController@subjectlist');
Route::post('createtimetable','academicController@create_time_table');
Route::get('view_timetable','academicController@viewtimetable');
Route::post('student/timetablelist','academicController@timetablelist');
Route::get('batch_timetable','academicController@batchtimetable');
Route::post('timetable/batchtimetablelist','academicController@batchtimetablelist');
Route::post('timetable/timetablebyRoom','academicController@timetablebyRoom');
Route::post('timetable/timetablebyTeacher','academicController@timetablebyTeacher');
Route::post('timetable/timetablebysubject','academicController@timetablebysubject');
Route::post('timetable/timetablebyclasssubject','academicController@timetablebyclasssubject');
Route::post('student/getteacherlist','academicController@getteacherlist');
Route::get('teacher_timetable','academicController@teachertimetable');
Route::post('student/teachertimetablelist','academicController@teachertimetablelist');
Route::get('add-room','academicController@room');
Route::post('add-room/add','academicController@Addroom');
Route::get('add-room/delete/{id}','academicController@Deleteroom');
Route::get('period_master','academicController@period_master');
Route::post('add_period','academicController@add_period');
Route::get('period/delete_period/{get}','academicController@delete_period');
Route::post('student/periodlist','academicController@periodlist');
Route::get('student/updatetimetable/{bid}&{cid}&{id}','academicController@updatetimetable');
Route::post('student/edit_timetable','academicController@edit_timetable');
Route::get('semester','academicController@semester');
Route::post('add_semester','academicController@add_semester');
//HR_Payroll Controller
Route::get('hr/add-userType','HRController@newusertype');
Route::get('hr/delete/{id}','HRController@deleteusertype');
Route::post('hr/add-userType-new','HRController@newusertypeadd');
Route::get('hr/designation','HRController@designation');
Route::post('hr/designation/add','HRController@adddesignation');
Route::get('hr/delete/degination/{id}','HRController@deletedegination'); //delete degination
Route::get('hr/department','HRController@newdepartment');
Route::post('hr/department/add','HRController@addnewdepartment');
Route::get('hr/department/delete/{id}','HRController@deletedepartment'); //delete department
Route::get('hr/employee','HRController@employee');
Route::post('hr/employee/add','HRController@addemployee');
Route::get('hr/employee/list','HRController@employeelist');
Route::get('hr/employee/delete/{id}','HRController@deleteemployee');
Route::get('hr/employee/view/{id}','HRController@viweemployee');
Route::post('hr/employee/update','HRController@updateemployee');
Route::post('hr/employee/search','HRController@searchemployee');
Route::get('hr/employee/set-roles/{id}','HRController@setroles');
Route::post('hr/employee/update-employee-set-roles','HRController@updateEmployeeSetRoles');
Route::post('hr/employee/empinfo','HRController@empinfo');
//leave
Route::get('employee/leave/leave-type','HRController@leave_type');
Route::post('employee/leave/leave-type/add','HRController@Addleave_type');
Route::get('employee/leave/leave-type/set-status/{id}/{status}','HRController@Change_status_leave_type');
Route::get('employee/leave/leave-type/delete/{id}','HRController@delete_leave_type');
Route::get('employee/leave/apply','HRController@applyLeave');
Route::post('employee/leave/apply/submit','HRController@submitLeave');
Route::get('employee/leave/Leave-applied-view','HRController@LeaveAppliedview');
Route::get('employee/leave/Leave-view','HRController@Leaveview');
Route::get('hr/employee/leave/view/{id}/{empcode}','HRController@EmpLeaveview');
Route::post('hr/employee/leave/Leave-view/action','HRController@LeaveviewAction');
Route::get('hr/employee/leave/all','HRController@allLeave');

Route::get('user_profile','HRController@user_profile');
Route::post('user/update_profile_image','HRController@update_profile_image');
Route::post('user/update_password','HRController@update_password');
Route::post('hr/employee/update_profile','HRController@update_profile');

Route::post('hr/employee/admin_update_profile','HRController@admin_update_profile');
Route::post('hr/employee/admin_update_profile_image','HRController@admin_update_profile_image');
Route::post('hr/employee/admin_update_password','HRController@admin_update_password');
Route::get('hr/category','HRController@category');
Route::post('hr/category/add','HRController@addCategory');
Route::get('hr/category/delete/{id}','HRController@deleteCategory');
//Student Controller

//Route::get('student/category','studentController@studentcategory');
//Route::post('student/category/add','studentController@addstuCategory');

Route::get('student/promotion','StudentPromote@promoteStudent');
Route::post('search/student/promotion','StudentPromote@promoteStudent');
Route::post('student/batch','StudentPromote@batchlist');
Route::post('promote/student','StudentPromote@promoteStudentDetails');


Route::get('student/admission','studentController@studentaddmission');
Route::post('student/admission/Registration','studentController@studentregister');
Route::get('student/list','studentController@studentlist');
Route::get('student/boylist','studentController@studentboylist');
// Send SMS Start
Route::get('/Member/Getsubcategory/{category}','studentController@getSubcategory');
Route::get('/Member/Getsubcategoryss/{category}','studentController@getSubcategoryss');

Route::post('particular/post/send/sms/insert','studentController@particular_send_sms_insert');
// particular message send 



Route::post('student/post/send/sms/insert','studentController@stu_send_sms_insert');
Route::get('sms/student/list/send/sms','studentController@studentlistSendSms');
Route::get('sms/emplyee/list/send/sms','studentController@emplyeelistSendSms');
Route::get('smsscheck/emplyee/list/send/sms','MenuPermission@emplyeelistSendSms1');
Route::get('student/boylist','studentController@studentboylist');
Route::post('student/batchlist/wise','studentController@batchlistwise');





Route::post('search/between/days','studentController@search_days_wise');
Route::post('student/postsearch/sir','studentController@studentlistSendSms');
Route::post('employee/postsearch/send','studentController@employeelistSendSms12');
//Route::post('student/postsearch/sir','studentController@studentsearchsir');


Route::post('employee/post/send/sms/insert','studentController@emp_send_sms_insert');
// Send Sms End 


//Akash start
//Event
Route::get('event/event_type','EventController@event_type');
Route::post('event/add_event_type','EventController@insert_event_type');
//Event
Route::get('event','EventMstr@eventList');
Route::get('add/event','EventMstr@add_update');
Route::post('addevent','EventMstr@add_update');
Route::get('update/{id}','EventMstr@add_update');
Route::get('delete/{id}','EventMstr@delete');
//Assign Event
Route::get('assignevent','AddEvent@eventList');
Route::get('assign/event','AddEvent@add_update');
Route::post('assign/event','AddEvent@add_update');
Route::get('update/event/{id}','AddEvent@add_update');
Route::get('delete/event/{id}','AddEvent@delete');
//Event Report
Route::get('report','EventReport@report');
Route::post('event/report/detail','EventReport@report');
//Bulk Print
Route::get('search/print','StudentIdBulkPrint@bulkPrint');
Route::post('search','StudentIdBulkPrint@bulkPrint');
Route::get('search/upload','StudentPhotoUpload@studentDetails');
Route::post('search/upload','StudentPhotoUpload@studentDetails');
Route::get('view/student/details/{id}','StudentPhotoUpload@studentDetails');
Route::post('upload/photo','StudentPhotoUpload@studentDetails');
//Category Details
Route::get('category','CategoryWiseStudent@studentDetails');
Route::post('search/student/category','CategoryWiseStudent@studentDetails');
Route::get('cast','CastDetails@studentCastDetails');
Route::post('cast/details','CastDetails@studentCastDetails');

// Akash End
Route::get('student/girllist','studentController@studentgirllist');
Route::get('student/delete/{id}','studentController@Deletestudent');
Route::get('student/view/{id}','studentController@viewstudent');
Route::post('student/update','studentController@updatestudent');
Route::post('student/postsearch','studentController@studentsearch');
Route::post('student/boypostsearch','studentController@boysearch');
Route::post('student/girlpostsearch','studentController@girlsearch');
Route::post('student/batchlist','studentController@batchlist');
Route::post('student/feeamt','studentController@feeamt');
Route::post('student/countstu','studentController@countstu');
Route::get('student/transport','studentController@transportallocation');
Route::post('student/stuinfo','studentController@stuinfo');
Route::post('transport/routedestination','studentController@xyz');
Route::post('transport/transport/allocate','studentController@allocatetransport');
Route::get('student/attendance','studentController@studentAttendance');
Route::post('student/attendance/getstudent','studentController@getstudent');
Route::post('student/attendance/save','studentController@savestudentAttendance');
Route::post('student/attendance/report','studentController@studentAttendancereport');
Route::get('student/attendance/attendancereport','studentController@Attendancereport');
Route::post('student/attendance/getAttendancereport','studentController@getAttendancereport');
Route::post('student/attendance/postattendancereport','studentController@postAttendancereport');
Route::get('student/roll_section','studentController@roll_section');
Route::post('student/studenlist','studentController@studenlist');
Route::post('student/assign_roll_section','studentController@assign_roll_section');
Route::get('student/update_roll_section','studentController@update_roll_section');
Route::post('student/edit_roll_section','studentController@edit_roll_section');
Route::get('student/student_get_pass','studentController@student_get_pass');
Route::post('student/studentlist','studentController@student_list');
Route::post('student/studentlist','studentController@student_list');
Route::post('student/insert_get_pass_student','studentController@insert_get_pass_student');
Route::get('student/student_get_pass_list','studentController@student_get_pass_list');
Route::get('student/gate_pass/download/{id}','studentController@student_get_pass_download');
Route::get('student/delete_get_pass_list/{id}','studentController@delete_get_pass_list');
Route::post('student/generate_attendance_report','studentController@generate_attendance_report');
Route::get('student/CurricularCertificate','studentController@CurricularCertificate');
Route::post('student/downloadCurricularCertificate','studentController@downloadCurricularCertificate');

Route::get('student/DomicileCertificate','studentController@DomicileCertificate');
Route::post('student/downloadDomicile','studentController@DomicilePostsearch');
Route::get('student/trialCertificate','studentController@trialCertificate');
Route::post('student/downloadTrail','studentController@downloadTrail');
Route::get('student/CharacterCertificate','studentController@CharacterCertificate');
Route::post('student/downloadCharacter','studentController@downloadCharacter');
Route::get('student/BonafideCertificate','studentController@BonafideCertificate');
Route::post('student/downloadBonafied','studentController@downloadBonafied');
Route::get('student/LeavingCertificate','studentController@LeavingCertificate');
Route::post('student/LeavingCertificate/generate','studentController@generateLeavingCertificate');
Route::get('student/import','studentController@studentimport');
Route::post('student/student_bulk_upload','studentController@student_bulk_upload');



//Finance Controller
Route::get('finance/Fee-Category','financeController@feecategory');
Route::post('finance/Fee-Category/add','financeController@addfeecategory');
Route::get('finance/Fee-Category/update-status/{status}/{id}','financeController@update_status_fee_category');  //delete fee category
Route::get('finance/Fee-Category/update/{id}','financeController@viewfeecategory');
Route::post('finance/Fee-Category/update','financeController@updatefeecategory');
Route::get('finance/Fee-SubCategory','financeController@feesubcategory');
Route::post('finance/Fee-SubCategory/add','financeController@addfeesubcategory');
Route::get('finance/Fee-subCategory/update/{id}','financeController@view_fee_sub_category');
Route::get('finance/Fee-subCategory/update-status/{status}/{id}','financeController@update_status_fee_subcategory');  //delete fee category
Route::post('finance/Fee-subCategory/update','financeController@updatefeesubcategory');
Route::get('finance/Fee-SubCategory/fine','financeController@feesubcategoryfine');
Route::get('finance/Fee-Sub-Category-fine/delete/{id}','financeController@delete_fee_sub_category_fine');  //delete fee sub category fine
Route::post('finance/Fee-SubCategory/getsubcategory','financeController@getfeesubcategory');
Route::post('finance/Fee-SubCategory/fine/add','financeController@addfeesubcategoryfine');
Route::get('finance/Fee-subCategory-fine/update-status/{status}/{category}/{subcategory}','financeController@update_status_fee_subcategory_fine');  //delete fee category
Route::get('finance/Fee-subCategory-fine/update/{id}','financeController@update_fee_subcategory_fine');  //delete fee category

Route::get('finance/fee-report/individual','financeController@individualFeeReport');
Route::post('finance/fee-report/individual/search','financeController@individualFeeReportSearch');

Route::get('finance/Fee/dailyCashRegister','financeController@dailyCashRegister');
Route::post('finance/Fee/dailyCashRegister/report','financeController@dailyCashRegisterSearch');
Route::post('finance/Fee/dailyCashRegister/reportdaywise','financeController@dailyCashRegisterDaySearch');

Route::get('finance/fee/waiver','financeController@feewaiver');
Route::post('finance/fee/waiver/stuinfo','financeController@feewaiverstuinfo');
Route::post('finance/fee/fee-waiver','financeController@savefeewaiver');

//Route::get('finance/waiver/delete/{id}','financeController@deletefeemaster');
Route::get('finance/waiver/update-status/{status}/{id}','financeController@update_status_fee_waiver');  //delete fee category
Route::get('finance/waiver/view/{id}','financeController@viewfeewaiver');
Route::post('finance/waiver/update','financeController@updatefeewaiver');

Route::post('finance/stuinfo','financeController@stuinfo');
Route::post('finance/feehistoryByStudents','financeController@feehistoryByStudents');

Route::post('finance/dueinfoBystu','financeController@dueinfoBystu');
Route::get('finance/Fee/getfeehead','financeController@getfeehead');
Route::get('finance/Fee/fee-Collection','financeController@feecollecion');
Route::post('finance/Fee/fee-Collection/get','financeController@getfeecollecion');
Route::get('finance/Fee/fee-Collection/getpdf','financeController@getfeecollecionpdf');
Route::get('finance/Fee-master','financeController@feemaster');
Route::post('finance/Fee-master/add','financeController@addfeemaster');
Route::get('finance/Fee-master/delete/{id}','financeController@deletefeemaster');
Route::get('finance/Fee-master/update-status/{status}/{id}','financeController@update_status_fee_master');  //delete fee category
Route::get('finance/Fee-master/view/{id}','financeController@viewfeemaster');
Route::post('finance/Fee-master/update','financeController@updatefeemaster');

Route::post('finance/Fee/fee-details','financeController@getStudentfeeDetails');
Route::post('finance/Fee/feeCollection/','financeController@feecollection');
Route::get('finance/Fee/feeCollection/list','financeController@feecollectionlist');
Route::get('finance/Fee/onlinefeeCollection/list','financeController@onlinefeecollectionlist');
Route::get('finance/feeCollection/receipt/{id}','financeController@feereceipt');
Route::post('finance/feeCollection/search','financeController@searchfeeCollection');
Route::post('finance/feeCollection/searchbydate','financeController@searchbydatefeeCollection');
Route::post('finance/feeCollection/searchbydateonline','financeController@searchbydateonline');
Route::get('finance/feeCollection/receipt/download/{id}','financeController@downloadreceipt');
Route::get('finance/Fee-collection/reports','financeController@feereports');

Route::post('finance/feesubcollectionlist','financeController@feesubcollectionlist');
Route::get('finance/Fee/duereport','financeController@duereport');
Route::post('finance/Fee/postduereport','financeController@postduereport');
Route::get('finance/account/account-group','financeController@accountgroup');
Route::post('finance/account/account-group/add','financeController@saveaccountgroup');
Route::get('finance/account/account-group/delete/{id}','financeController@deleteaccountgroup');
Route::get('finance/account/account-group/view/{id}','financeController@viewaccountgroup');
Route::post('finance/account/account-group/update','financeController@updateaccountgroup');
Route::get('finance/account/voucher-master','financeController@vouchermaster');
Route::post('finance/account/voucher-master/add','financeController@vouchermasteradd');
Route::get('finance/account/voucher-master/delete/{id}','financeController@deletevouchermaster');
Route::get('finance/account/voucher-master/view/{id}','financeController@viewvouchermaster');
Route::post('finance/account/voucher-master/update','financeController@updatevouchermaster');
Route::get('finance/account/voucher-head','financeController@voucherhead');
Route::post('finance/account/voucher-head/add','financeController@addvoucherhead');
Route::get('finance/account/voucher-head/delete/{id}','financeController@deletevoucherhead');
Route::get('finance/account/voucher-head/view/{id}','financeController@viewvoucherhead');
Route::post('finance/account/voucher-head/update','financeController@updatevoucherhead');
Route::get('finance/account/voucher/','financeController@voucher');
Route::post('finance/feeheadlist','financeController@feeheadlist');
Route::post('finance/account/voucher/create','financeController@createvoucher');
Route::get('finance/account/voucher/list','financeController@voucherlist');
Route::post('finance/account/voucher/list/postsearch','financeController@postsearchvoucherlist');
Route::get('finance/account/voucher/daybook','financeController@daybook');
Route::post('finance/account/voucher/daybook/postsearch','financeController@postsearchdaybook');
Route::get('finance/account/voucher/legder-account','financeController@legderaccount');
Route::get('finance/account/voucher/trial-account','financeController@trialaccount');
Route::post('finance/account/voucher/trial-account/postsearch','financeController@trialaccountpostsearch');
Route::get('finance/account/voucher/view/{id}','financeController@viewvoucher');
Route::get('finance/account/voucher/delete/{id}','financeController@deletevoucher');
Route::get('finance/account/voucher/receiptupdate/{id}','financeController@updateReceipt');

// Examination Controller
Route::get('Exam/final_result/print/individual','ExamController@finalResultPrint');
Route::get('Exam/result/release/cancel/{id}/{session}','ExamController@resultReleaseCancel');
Route::get('Exam/result/release/{session}','ExamController@resultRelease');
Route::post('Exam/result/release/save','ExamController@resultReleaseSave');

Route::get('Exam/marksSubmit/report','ExamController@marksSubmitReport');
Route::get('exam/marksSubmit/reopen/{id}','ExamController@marksSubmitReportRepoen');
Route::post('Exam/marksSubmit/report/search','ExamController@marksSubmitReportSearch');



Route::get('Exam/final_result/print','ExamController@final_result_print');
Route::post('Exam/final_result/print/back','ExamController@final_result_print_back');



Route::get('Exam/final_result/bunch','ExamController@final_result_bunch');
Route::get('Exam/download/result/final/bunch/{id}/{session}/{batch}/{exam}','ExamController@downloadResultfinalBunch');

Route::post('exam/annual/report/generate','ExamController@annualExamReportGenerate');
Route::get('Exam/annual/Finalreport','ExamController@AnnualExamReport');

Route::post('Exam/report/get','ExamController@getexamReport');
Route::get('Exam/report','ExamController@examReport');
Route::get('Exam/exam_list','ExamController@examlist');
Route::post('exam/add_exam','ExamController@add_exam');
Route::get('exam/delete/{id}','ExamController@delete_exam');
Route::get('Exam/exam_schedule_list','ExamController@exam_schedule');
Route::get('Exam/add_exam_schedule','ExamController@add_exam_schedule');
Route::post('student/subjectlist','ExamController@subjectlist');
Route::post('Exam/createschedule','ExamController@createschedule');
Route::post('Exam/result/all','ExamController@all_result');
Route::post('Exam/student/subjectlist','ExamController@subjectlist');
Route::post('Exam/teacher/byclass','ExamController@teacherByclass');
Route::get('exam/download/result/{subject}/{course}/{batch}/{acadmic_year}/{emp_id}','ExamController@downloadmarksByTeacher');
Route::get('Exam/bunch/report','ExamController@ExamBunchReport');
Route::post('subjectlist/bunch','ExamController@subjectlistReport');
Route::post('Exam/student/subjectlist','ExamController@subjectlist');
Route::post('create_exam_schedule','ExamController@create_exam_schedule');
Route::post('Exam/schedulelist','ExamController@schedulelist');
Route::post('Exam/exam_time_table','ExamController@exam_time_table');
Route::get('Exam/mark_grade','ExamController@mark_grade');
Route::post('exam/add_mark_grade','ExamController@add_mark_grade');
Route::get('exam/delete_grade/{id}','ExamController@delete_grade');
Route::get('Exam/mark_register','ExamController@mark_register');
Route::get('Exam/Finalreport','ExamController@finalExamReport');
Route::post('exam/final/report/generate','ExamController@finalExamReportGenerate');
Route::get('Exam/create_mark_register','ExamController@create_mark_register');
Route::post('Exam/createmarkregister','ExamController@createmarkregister');
Route::post('Exam/student_details','ExamController@student_details');
Route::post('Exam/p_student_details','ExamController@p_student_details');
Route::post('Exam/insert_mark_register','ExamController@insert_mark_register');
Route::post('Exam/final_submit','ExamController@final_submit');
Route::get('Exam/marks/download/subjectwise/{subject}/{class}/{section}/{academic_year}/{exam}','ExamController@downloadMarksSubjectWise');
Route::get('Exam/marks/download/subjectwise/monthly/{subject}/{class}/{section}/{academic_year}/{exam}/{month}','ExamController@downloadMarksSubjectWiseMonthly');
Route::post('Exam/marklist','ExamController@marklist');
Route::post('Exam/marks_studentlist','ExamController@marks_studentlist');
Route::get('Exam/download/result/{id}/{reg_no}/{session}/{batch}/{exam}','ExamController@downloadResult');
Route::get('Exam/personality_traits','ExamController@personality_traits');
Route::post('Exam/personality_traits/save','ExamController@savepersonality_traits');
Route::get('Exam/final_result','ExamController@final_result');
Route::get('Exam/download/result/final/{id}/{reg_no}/{session}/{batch}/{exam}','ExamController@downloadResultfinal');
Route::get('Exam/monthly/mark/register','ExamController@monthlymarkRegister');
Route::post('Exam/monthly/mark/save','ExamController@savemonthlymark');
Route::post('Exam/student_details/monthly','ExamController@student_details_monthly');
Route::get('exam/view_report/{id}','ExamController@view_report');
Route::post('Exam/search_grade_name','ExamController@search_grade_name');
Route::get('Exam/student_exam_report','ExamController@student_exam_report');
Route::post('Exam/student_exam_report/view','ExamController@view_student_exam_report');
Route::post('Exam/student_for_mark','ExamController@student_for_mark');
Route::get('Exam/mark_by_student_name/{cid}&{id}','ExamController@mark_by_student_name');

/*
Route::post('Exam/report/get','ExamController@getexamReport');
Route::get('Exam/report','ExamController@examReport');
Route::get('Exam/exam_list','ExamController@examlist');
Route::post('exam/add_exam','ExamController@add_exam');
Route::get('exam/delete/{id}','ExamController@delete_exam');
Route::get('Exam/exam_schedule_list','ExamController@exam_schedule');
Route::get('Exam/add_exam_schedule','ExamController@add_exam_schedule');
Route::post('student/subjectlist','ExamController@subjectlist');
Route::post('Exam/createschedule','ExamController@createschedule');
Route::post('Exam/result/all','ExamController@all_result');
Route::post('Exam/student/subjectlist','ExamController@subjectlist');
Route::post('create_exam_schedule','ExamController@create_exam_schedule');
Route::post('Exam/schedulelist','ExamController@schedulelist');
Route::post('Exam/exam_time_table','ExamController@exam_time_table');
Route::get('Exam/mark_grade','ExamController@mark_grade');
Route::post('exam/add_mark_grade','ExamController@add_mark_grade');
Route::get('exam/delete_grade/{id}','ExamController@delete_grade');
Route::get('Exam/mark_register','ExamController@mark_register');
Route::get('Exam/Finalreport','ExamController@finalExamReport');
Route::post('exam/final/report/generate','ExamController@finalExamReportGenerate');
Route::get('Exam/create_mark_register','ExamController@create_mark_register');
Route::post('Exam/createmarkregister','ExamController@createmarkregister');
Route::post('Exam/student_details','ExamController@student_details');
Route::post('Exam/p_student_details','ExamController@p_student_details');
Route::post('insert_mark_register','ExamController@insert_mark_register');
Route::post('Exam/marklist','ExamController@marklist');
Route::post('Exam/marks_studentlist','ExamController@marks_studentlist');
Route::get('Exam/download/result/{id}/{reg_no}/{session}/{batch}/{exam}','ExamController@downloadResult');
Route::get('Exam/personality_traits','ExamController@personality_traits');
Route::post('Exam/personality_traits/save','ExamController@savepersonality_traits');
Route::get('Exam/final_result','ExamController@final_result');
Route::get('Exam/download/result/final/{id}/{reg_no}/{session}/{batch}/{exam}','ExamController@downloadResultfinal');
Route::get('Exam/monthly/mark/register','ExamController@monthlymarkRegister');
Route::post('Exam/monthly/mark/save','ExamController@savemonthlymark');
Route::post('Exam/student_details/monthly','ExamController@student_details_monthly');
Route::get('exam/view_report/{id}','ExamController@view_report');
Route::post('Exam/search_grade_name','ExamController@search_grade_name');
Route::get('Exam/student_exam_report','ExamController@student_exam_report');
Route::post('Exam/student_exam_report/view','ExamController@view_student_exam_report');
Route::post('Exam/student_for_mark','ExamController@student_for_mark');
Route::get('Exam/mark_by_student_name/{cid}&{id}','ExamController@mark_by_student_name'); */

//Transport Controller
Route::get('transport/vehicle','tranpostController@vehicle');
Route::post('transport/vehicle/add','tranpostController@addvehicle');
Route::get('transport/vehicle/delete/{id}','tranpostController@deletevehicle');
Route::get('transport/vehicle/view/{id}','tranpostController@viewvehicle');
Route::post('transport/vehicle/update','tranpostController@updatevehicle');
Route::get('transport/driver','tranpostController@driver');
Route::post('transport/driver/add','tranpostController@adddriver');
Route::get('transport/driver/delete/{id}','tranpostController@deletedriver');
Route::get('transport/driver/view/{id}','tranpostController@viewdriver');
Route::post('transport/driver/update','tranpostController@updatedriver');
Route::get('transport/route','tranpostController@route');
Route::post('transport/route/add','tranpostController@addroute');
Route::get('transport/route/delete/{id}','tranpostController@deleteroute');
Route::get('transport/route/view/{id}','tranpostController@viewroute');
Route::post('transport/route/update','tranpostController@routedriver');
Route::get('transport/destination','tranpostController@designation');
Route::post('transport/destination/add','tranpostController@adddesignation');
Route::get('transport/destination/delete/{id}','tranpostController@deletedestination');
Route::get('transport/destination/view/{id}','tranpostController@viewdestination');
Route::post('transport/destination/update','tranpostController@updatedestination');
Route::get('transport/allocation/list','tranpostController@transportallocationlist');
Route::get('transport/allocation/view/{id}','tranpostController@studenttranportallocation');
Route::post('transport/allocation/update','tranpostController@studenttranportallocationupdate');

//Hostel Controller
Route::get('hostel/details','hostelController@hosteldetails');
Route::get('hostel/room','hostelController@hostelroom');
Route::get('hostel/allocation','hostelController@hostelallocation');
Route::get('hostel/request/details','hostelController@requestdetails');
Route::get('hostel/transfer/vacate','hostelController@hosteltransfervacate');
Route::get('hostel/register','hostelController@hostelregister');
Route::get('hostel/visitors','hostelController@hostelvisitors');
Route::get('hostel/fee/collection','hostelController@hostelfeecollection');
Route::get('hostel/details/report','hostelController@hosteldetailsreport');
Route::get('hostel/room/availability/report','hostelController@roomavailabilityreport');
Route::post('hostel/getrommbytype','hostelController@getrommbytype');
Route::post('hostel/report/getHostelOccupancyView','hostelController@getHostelOccupancyView');
Route::get('hostel/room/request/report','hostelController@roomrequestreport');
Route::get('hostel/room/occupancy/report','hostelController@roomroccupancyreport');
Route::get('hostel/fee/reports','hostelController@feereports');
Route::post('hostel/hosteltype','hostelController@hosteltype');
Route::get('hostel/hosteltype/delete/{id}','hostelController@deletehosteltype');
Route::post('hostel/hosteldetails','hostelController@hosteldetailssave');
Route::get('hostel/hosteldetails/delete/{id}','hostelController@hosteldetailsdelete');
Route::get('hostel/hosteldetails/view/{id}','hostelController@hosteldetailsview');
Route::post('hostel/hosteldetails/update','hostelController@hosteldetailsupdate');
Route::post('hostel/hostel/addRoom','hostelController@hostelroomAdd');
Route::post('hostel/hostelname','hostelController@hostelname');
Route::get('hostel/deleteroom/{id}','hostelController@deleteroom');
Route::get('hostel/room/view/{id}','hostelController@hostelroomview');
Route::post('hostel/room/update','hostelController@hostelroomupdate');
Route::post('hostel/hostelname','hostelController@hostelnamebytype');
Route::post('hostel/hostelroom','hostelController@hostelroombyname');
Route::post('hostel/hostelroom/check','hostelController@hostelcheck');
Route::post('hostel/hostelroomdetails','hostelController@hostelroomdetails');
Route::post('hostel/room/savenew','hostelController@hostelroomsavenew');
Route::post('hostel/room/hostelstudentroomdetails','hostelController@hostelstudentroomdetails');
Route::post('hostel/report/hostel_allocation_info','hostelController@hostel_allocation_info');
Route::post('hostel/room/hosteltranfer','hostelController@hosteltranfer');
Route::post('hostel/register/update','hostelController@hostelregisterupdate');
Route::get('hostel/register/delete/{id}','hostelController@hostelregisterdelete');
Route::post('hostel/room/savevisitor','hostelController@savevisitor');
Route::get('hostel/visitors/delete/{id}','hostelController@visitorsdelete');

//Library Controller
Route::get('library/category','LibraryController@librarycategory');
Route::post('library/category/add','LibraryController@addlibrarycategory');
Route::get('library/category/delete/{id}','LibraryController@deletelibrarycategory');
Route::get('library/category/view/{id}','LibraryController@viewlibrarycategory');
Route::post('library/category/update','LibraryController@updatelibrarycategory');
Route::get('library/books','LibraryController@books');
Route::post('library/books/add','LibraryController@addbooks');
Route::get('library/books/delete/{id}','LibraryController@deletebooks');
Route::get('library/books/view/{id}','LibraryController@viewbook');
Route::post('library/books/update','LibraryController@updatebook');
Route::get('library/books/issue','LibraryController@issuebooks');
Route::post('library/bookissue/issue','LibraryController@bookissue');
Route::post('library/bookissue/bookinfo','LibraryController@bookinfo');
Route::get('library/bookissue/return','LibraryController@returnbook');
Route::post('library/bookissue/bookdetails','LibraryController@bookdetails');
Route::post('library/bookissue/bookreturn','LibraryController@bookreturn');
Route::get('library/returnbooks/view/{id}','LibraryController@returnbookdetails');

// Stock Controller

Route::get('stock/issue_item','StockController@issue_item');
Route::get('stock/add_item_stock','StockController@add_item_stock');
Route::get('stock/add_item','StockController@add_item');
Route::get('stock/item/view/{id}','StockController@view_item');
Route::get('stock/item_category','StockController@item_category');
Route::get('stock/item_stock/delete/{id}','StockController@delete_item_stock');
Route::get('stock/item_stock/view/{id}','StockController@view_item_stock');
Route::get('stock/item_store','StockController@item_store');
Route::get('stock/item_supplier','StockController@item_supplier');
Route::post('stock/insert_item_category','StockController@insert_item_category');
Route::get('stock/delet_category/{id}','StockController@delet_category');
Route::post('stock/insert_item_store','StockController@insert_item_store');

Route::post('stock/insert_item_supplier','StockController@insert_item_supplier');
Route::post('stock/insert_item','StockController@insert_item');
Route::post('stock/update_item','StockController@update_item');
Route::post('stock/insert_item_stock','StockController@insert_item_stock');
Route::post('stock/update_item_stock','StockController@update_item_stock');
Route::get('stock/add_issue_item','StockController@add_issue_item');
Route::post('stock/itemlist','StockController@itemlist');
Route::post('stock/insert_issue_item','StockController@insert_issue_item');
Route::get('stock/delete_item/{id}','StockController@delete_item');
Route::post('stock/all_issue','StockController@all_issue');
Route::get('stock/update_stock_status/{id}','StockController@update_stock_status');
Route::get('stock/delete_item_store/{id}','StockController@delete_item_store');
Route::get('stock/delet_item_supplier/{id}','StockController@delet_item_supplier');

//Home Work
Route::get('homework/homeworklist','HomeWorkController@homeworklist');
Route::get('homework/createhomework','HomeWorkController@createhomework');
Route::post('homework/getSubjectbyclass','HomeWorkController@getSubjectbyclass');
Route::post('homework/insert_homework','HomeWorkController@insert_homework');
Route::post('homework/homework','HomeWorkController@homework');
Route::get('homework/evaluate/{id}','HomeWorkController@evaluate');
Route::get('homework/evaluate_homework/{id}/{status}/{hwid}','HomeWorkController@evaluate_homework');
Route::get('homework/evaluation_report','HomeWorkController@evaluation_report');
Route::post('homework/show_report_list','HomeWorkController@show_report_list');

//Teacher Controller
Route::get('teacher/ward/view/{id}','TeacherController@viewdetail');
// Route::get('teacher/attendance','TeacherController@attendance');
Route::get('teacher/teacher_subject','TeacherController@teacher_subject');
Route::get('teacher/give_assignment','TeacherController@give_assignment');
Route::post('teacher/add_assignment','TeacherController@add_assignment');
Route::get('teacher/assignmentlist','TeacherController@assignment_list');
Route::post('teacher/view_assignment','TeacherController@view_assignment');
Route::get('teacher/evaluate_assignment/{bid}&{cid}&{sid}&{hid}','TeacherController@evaluate_assignment');
Route::post('teacher/evaluate_assignment_status','TeacherController@evaluate_assignment_status');
Route::get('teacher/assignment_report','TeacherController@assignment_report');
Route::post('teacher/evalution_report_list','TeacherController@evalution_report_list');
Route::get('teacher/set_marks','TeacherController@set_marks');
Route::get('teacher/student_attendance','TeacherController@student_attendance');
Route::post('teacher/insert_student_attendance','TeacherController@insert_student_attendance');
Route::get('teacher/student_attendance_report','TeacherController@student_attendance_report');
Route::get('teacher/announcement','TeacherController@announcement');

Route::get('teacher/lession-planning','TeacherController@lessionplanning');
Route::post('teacher/getSubjectbyclass','TeacherController@getSubjectbyclass');

Route::post('teacher/lession-planning/save','TeacherController@savelessionplanning');



//Announcement
Route::get('announcement/parents','announcementController@parents');
Route::post('announcement/studentlist','announcementController@studentlist');
Route::post('announcement/parents_msg','announcementController@parents_msg');
Route::get('announcement/teacher','announcementController@teachers');
Route::post('announcement/teacher_msg','announcementController@teacher_msg');


//Event
Route::get('event/event_type','EventController@event_type');
Route::post('event/add_event_type','EventController@insert_event_type');




//Fee Colection Month Wise
Route::get('fee/collection/month','FeeCollection@feeCollectionDetails');
Route::post('fee/collection/month','FeeCollection@feeCollectionDetails');
//Attendance Report
Route::get('attendance/report','AttendanceReport@studentReport');
Route::post('attendance/report','AttendanceReport@studentReport');
//EmployeeDocMstr
Route::get('emp/doc/mstr/list','EmployeeDocTypeMstr@employeeDocList');
Route::get('emp/doc/add','EmployeeDocTypeMstr@add_update');
Route::post('add/emp/doc','EmployeeDocTypeMstr@add_update');
Route::get('add/emp/doc/{id}','EmployeeDocTypeMstr@add_update');
Route::get('delete/emp/doc/{id}','EmployeeDocTypeMstr@delete');



//Student Report Card Print
Route::get('search/student/card','StudentReportCard@studentCardReport');
Route::post('search/report/card','StudentReportCard@studentCardReport');

Route::get('search/report/card/particular','StudentReportCardParticular@studentCardReport');
Route::post('search/student/card/one','StudentReportCardParticular@studentCardReport');
Route::post('generate/report','StudentReportCardParticular@generateReportCard');


