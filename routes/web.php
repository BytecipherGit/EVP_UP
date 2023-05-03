<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InterviewEmployee;
use App\Http\Controllers\InterviewProcess;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeSettingController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Superadmin;
use Illuminate\Support\Facades\Route;

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
    return view('web/index');
});

Route::get('/success', function () {
    return view('web/success');
});

Route::get('/response_submited', function () {
    return view('web/response_already_submitted');
});

Route::get('/confirmation', function () {
    return view('admin/confirm-msg');
});

Route::get('/status', function () {
    return view('welcome');
});

Route::get('/employee-details', function () {
    return view('admin/employee-details');
});

Route::get('/notification', function () {
  return view('admin/notification');
});

Route::get('/invite-confirm', function () {
    return view('org-invite/invite-confirm');
});

Route::get('/basic-info', function () {
    return view('org-invite/basic-info');
});

Route::get('/organization', function () {
    return view('superadmin/organization');
});


Route::get('/superlogin', [App\Http\Controllers\SuperAdminController::class, 'superAdminLogin'])->name('superlogin');
Route::post('/invite-email/{id?}', [App\Http\Controllers\InviteempController::class, 'sendemail'])->name('invite-email');
Route::post('send_invidation_to_employee',[App\Http\Controllers\InviteempController::class, 'sendInvidationToEmployee'])->name('send_invidation_to_employee');
Route::middleware([Superadmin::class])->group(function () {
    Route::get('/superadmin', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('superadmin');
    Route::get('superadmin/logout', [App\Http\Controllers\SuperAdminController::class, 'logout'])->name('superadmin.logout');
   
});
Route::get('/upload_document', [App\Http\Controllers\DocumentsController::class, 'index'])->name('upload.document');
Route::post('/store_document', [App\Http\Controllers\DocumentsController::class, 'store'])->name('store.document');

Route::get('demo-search', [App\Http\Controllers\DocumentsController::class, 'demoSearch'])->name('demo.search');
Route::get('getEmployeeNameThroughAutocomplete', [App\Http\Controllers\DocumentsController::class, 'getEmployeeNameThroughAutocomplete'])->name('employeeNameAutocomplete');
Route::get('getEmployeeDetailsForScheduleInterview', [App\Http\Controllers\DocumentsController::class, 'getEmployeeDetailsForScheduleInterview'])->name('getEmployeeDetailsForScheduleInterview');

Route::get('/email-config/{id?}', [App\Http\Controllers\InviteempController::class, 'getConfig'])->name('email-config');
Route::get('/basic-info/{id?}', [App\Http\Controllers\InviteempController::class, 'getBasicDetails'])->name('basic-info');
Route::post('/basic-info/{id?}', [App\Http\Controllers\InviteempController::class, 'getInviteDetails']);

Auth::routes();
Route::middleware([Admin::class])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('documents');
    Route::get('admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout')->middleware('documents');
    Route::post('/change_password', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('password.change')->middleware('documents');
    Route::get('/add-employee/{id?}', [App\Http\Controllers\EmployeeController::class, 'index'])->middleware('documents');
    Route::post('/add-employee/{id?}', [App\Http\Controllers\EmployeeController::class, 'basicInfo'])->middleware('documents');
    Route::get('edit-employee/{id?}', [App\Http\Controllers\EmployeeController::class, 'getEditEmployee'])->middleware('documents');
    Route::post('edit-employee/{id?}', [App\Http\Controllers\EmployeeController::class, 'editEmployee'])->middleware('documents');
    Route::get('/company_profile', [App\Http\Controllers\companySettingsController::class, 'profiledata'])->middleware('documents');
    Route::post('/update_company_profile', [App\Http\Controllers\companySettingsController::class, 'updateCompanyProfile'])->name('update_company_profile')->middleware('documents');
    Route::get('/employee-exit/{id?}', [App\Http\Controllers\EmployeeController::class, 'exitEmp'])->middleware('documents');
    Route::post('/employee-exit/{id?}', [App\Http\Controllers\EmployeeController::class, 'exitEmployee'])->middleware('documents');
    Route::get('/post-employee-details/{id}', [App\Http\Controllers\EmployeeController::class, 'postEmpDetails'])->middleware('documents');
    Route::get('/post-employee', [App\Http\Controllers\EmployeeController::class, 'addOldEmp'])->middleware('documents');
    Route::get('/current-employee', [App\Http\Controllers\EmployeeController::class, 'currentEmp'])->middleware('documents');
    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'getAllEmp'])->name('employee.index')->middleware('documents');
    Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'getCsvEmp'])->middleware('documents');
    Route::get('/downloadcsv', [App\Http\Controllers\EmployeeController::class, 'downloadCsv'])->middleware('documents');
    Route::get('/download_invitecsv', [App\Http\Controllers\InviteempController::class, 'downloadInviteCsv'])->middleware('documents');
    Route::get('/add-invite-employee', [App\Http\Controllers\InviteempController::class, 'inviteEmp'])->middleware('documents');
    Route::post('/add-invite-employee', [App\Http\Controllers\InviteempController::class, 'getInviteEmp'])->middleware('documents');
    Route::get('/invite_employee', [App\Http\Controllers\InviteempController::class, 'index'])->middleware('documents');
    Route::post('/invite-employee', [App\Http\Controllers\InviteempController::class, 'getCsvInvite'])->middleware('documents');
    Route::get('/edit-invite-employee/{id?}', [App\Http\Controllers\InviteempController::class, 'editInviteEmp'])->middleware('documents');
    Route::post('/edit-invite-employee/{id?}', [App\Http\Controllers\InviteempController::class, 'geteditInvite'])->middleware('documents');
    Route::get('/delete-invite/{id?}', [App\Http\Controllers\InviteempController::class, 'deleteInvite'])->middleware('documents');
    Route::get('/change_password', [App\Http\Controllers\AdminController::class, 'getPasswordReset'])->middleware('documents');
    Route::get('/download_qualification_doc/{id?}', [App\Http\Controllers\InviteempController::class, 'downloadQualDoc'])->middleware('documents');
    Route::get('/download_offerletter_doc/{id?}', [App\Http\Controllers\InviteempController::class, 'downloadOfferDoc'])->middleware('documents');
    Route::get('/download_expletter_doc/{id?}', [App\Http\Controllers\InviteempController::class, 'downloadExpDoc'])->middleware('documents');
    Route::get('/download_identity_doc/{id?}', [App\Http\Controllers\InviteempController::class, 'downloadIdDoc'])->middleware('documents');

    Route::get('/schedule_interview', [InterviewEmployee::class, 'index'])->name('schedule.interview')->middleware('documents');
    Route::get('interview-round-details/{id?}', [InterviewEmployee::class, 'interviewRoundDetails'])->name('interview.round.details')->middleware('documents');
    Route::any('/schedule-interview/form/{id?}', [InterviewEmployee::class, 'getScheduleInterviewForm'])->middleware('documents');
    Route::any('/schedule-searchemployee-interview/form/{id?}', [InterviewEmployee::class, 'getSearchEmpInterviewForm'])->middleware('documents');
    Route::post('schedule-searchemp-interview/submit', [InterviewEmployee::class, 'scheduleSearchempInterview'])->middleware('documents');
    Route::post('schedule-interview/submit', [InterviewEmployee::class, 'scheduleInterview'])->middleware('documents');
    Route::post('schedule-interview/changeHiringStage', [InterviewEmployee::class, 'update_hiring_stage'])->middleware('documents');
    Route::post('schedule-interview/deleteInterview', [InterviewEmployee::class, 'deleteInterview'])->middleware('documents');
    Route::post('schedule-interview/sendReminderForInterview', [InterviewEmployee::class, 'sendReminderForInterview'])->middleware('documents');
    Route::get('schedule_phone_interview', [InterviewEmployee::class, 'schedulePhoneInterview'])->middleware('documents');
    Route::post('interview/declined/{id?}', [InterviewEmployee::class, 'declineInterview'])->middleware('documents');
    Route::post('interview/newtime/{id?}', [InterviewEmployee::class, 'suggestNewTime'])->middleware('documents');
    Route::get('interview/confirmed/{id?}', [InterviewEmployee::class, 'interviewConfirmed'])->name('interview.confirmed')->middleware('documents');
    // Route::post('schedule-interview/changeInterviewerStatus', [InterviewEmployee::class, 'update_interviewer_status'])->middleware('documents');
    
    Route::get('offer/accepted/{id?}', [App\Http\Controllers\EmployeeStatusController::class, 'offerSendAcceptStatus'])->name('offer.accepted')->middleware('documents');
    Route::get('offer/declined/{id?}', [App\Http\Controllers\EmployeeStatusController::class, 'offerSendDeclineStatus'])->name('offer.declined')->middleware('documents');
    Route::post('offer_send/declined', [App\Http\Controllers\EmployeeStatusController::class, 'createOfferDeclinedFromMail'])->name('offer.declined_form')->middleware('documents');

    Route::get('interview/newtime/{id?}', [InterviewEmployee::class, 'interviewNewTime'])->name('interview.newtime')->middleware('documents');
    Route::get('interview/declined/{id?}', [InterviewEmployee::class, 'interviewDeclined'])->name('interview.declined')->middleware('documents');
    Route::post('interview/replied', [InterviewEmployee::class, 'interviewRepliedFromMail'])->name('interview.replied.mail')->middleware('documents');
    Route::get('interview_process', [InterviewProcess::class, 'index'])->name('interview.process.index')->middleware('documents');
    Route::any('interview_process/form/{id?}', [InterviewProcess::class, 'getInterviewProcessForm'])->middleware('documents');
    Route::post('interview_process/submit', [InterviewProcess::class, 'createInterviewProcess'])->middleware('documents');
    Route::post('interview_process/update', [InterviewProcess::class, 'updateInterviewProcess'])->middleware('documents');
    Route::post('interview_process/destroy', [InterviewProcess::class, 'deleteInterviewProcess'])->middleware('documents');


    Route::get('theme_setting', [ThemeSettingController::class, 'index'])->name('theme.setting.index')->middleware('documents');
    Route::any('theme_setting/form/{id?}', [ThemeSettingController::class, 'getThemeSettingForm'])->middleware('documents');
    Route::post('theme_setting/update', [ThemeSettingController::class, 'updateThemeSetting'])->middleware('documents');

    

    Route::get('exit_employee_process', [App\Http\Controllers\ExitEmployeeProcess::class, 'index'])->name('exitemployee.process.index')->middleware('documents');
    Route::any('exit_employee_process/form/{id?}', [App\Http\Controllers\ExitEmployeeProcess::class, 'exitEmployeeForm'])->middleware('documents');
    Route::post('exit_employee_process/submit', [App\Http\Controllers\ExitEmployeeProcess::class, 'createExitEmployeeProcess'])->middleware('documents');
    Route::post('exit_employee_process/update', [App\Http\Controllers\ExitEmployeeProcess::class, 'updateExitEmployeeProcess'])->middleware('documents');
    Route::post('exit_employee_process/destroy', [App\Http\Controllers\ExitEmployeeProcess::class, 'deleteExitEmployeeProcess'])->middleware('documents');
    
    Route::get('onboarding_process', [App\Http\Controllers\OnboardingController::class, 'index'])->name('onboarding.process.index')->middleware('documents');
    Route::any('onboarding_process/form/{id?}', [App\Http\Controllers\OnboardingController::class, 'onboardingForm'])->middleware('documents');
    Route::post('onboarding_process/submit', [App\Http\Controllers\OnboardingController::class, 'createOnboardingProcess'])->middleware('documents');
    Route::post('onboarding_process/update', [App\Http\Controllers\OnboardingController::class, 'updateOnboardingProcess'])->middleware('documents');
    Route::post('onboarding_process/destroy', [App\Http\Controllers\OnboardingController::class, 'deleteOnboardingProcess'])->middleware('documents');

    Route::any('onboarding/form/{id?}', [App\Http\Controllers\OnboardingController::class, 'getOnboardingForm'])->middleware('documents');
    Route::post('onboarding/submit', [App\Http\Controllers\OnboardingController::class, 'createOnboardingForm'])->middleware('documents');

    Route::get('offer_send_details', [App\Http\Controllers\EmployeeStatusController::class, 'index'])->name('employee.offer.send.index')->middleware('documents');
    Route::any('offer_send/form/{id?}', [App\Http\Controllers\EmployeeStatusController::class, 'getOfferSendForm'])->middleware('documents');
    Route::post('offer_send/submit', [App\Http\Controllers\EmployeeStatusController::class, 'createOfferSendForm'])->middleware('documents');
    Route::post('offer_send/changeOfferStatus', [App\Http\Controllers\EmployeeStatusController::class, 'update_send_offer_status'])->middleware('documents');

    Route::any('next_round_of_interview/form/{id?}', [InterviewEmployee::class, 'getNextRoundOfInterviewForm'])->middleware('documents');
    Route::post('next_round_of_interview/submit', [InterviewEmployee::class, 'scheduleNextRoundOfInterview'])->middleware('documents');
    Route::any('get_interview_details/form/{id?}', [InterviewEmployee::class, 'getInterviewDetailForm'])->middleware('documents');
  

    Route::get('position', [PositionController::class, 'index'])->name('position.index')->middleware('documents');
    Route::any('position/form/{id?}', [PositionController::class, 'getPositionForm'])->middleware('documents');
    Route::post('position/submit', [PositionController::class, 'createPosition'])->middleware('documents');
    Route::post('position/update', [PositionController::class, 'updatePosition'])->middleware('documents');
    Route::post('position/destroy', [PositionController::class, 'deletePosition'])->middleware('documents');
    Route::post('update_status', [PositionController::class, 'update_process_status'])->name('update_process_status')->middleware('documents');

    Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback.index')->middleware('documents');
    Route::any('feedback/form/{id?}', [FeedbackController::class, 'getFeedbackForm'])->middleware('documents');
    Route::post('feedback/submit', [FeedbackController::class, 'createFeedback'])->middleware('documents');
    Route::post('feedback/update', [FeedbackController::class, 'updateFeedback'])->middleware('documents');
    Route::post('feedback/destroy', [FeedbackController::class, 'deleteFeedback'])->middleware('documents');
    
    Route::get('search', [App\Http\Controllers\SearchController::class, 'index'])->middleware('documents');
    Route::get('search-global', [App\Http\Controllers\SearchController::class, 'search'])->name('search-global')->middleware('documents');
    
    // Route::get('posts', [App\Http\Controllers\EmailTemplatesController::class, "index"])->middleware('documents');
    Route::get("qualified_email_template", [App\Http\Controllers\CompanyEmailTemplatesController::class, "createQualifiedEmail"])->middleware('documents');
    Route::post('qualified-email-template', [App\Http\Controllers\CompanyEmailTemplatesController::class, "updateQualifiedTemplate"])->name('qualified-template')->middleware('documents');
    Route::get("not_qualified_template", [App\Http\Controllers\CompanyEmailTemplatesController::class, "createNotQualifiedEmail"])->middleware('documents');
    Route::post("not-qualified-template", [App\Http\Controllers\CompanyEmailTemplatesController::class,"updateNotQualifiedTemplate"])->name('not-qualified-template')->middleware('documents');
    Route::get("email_template/form/{id?}", [InterviewEmployee::class, 'getEmailTemplate'])->middleware('documents');
    Route::any("send_email_template/{id?}", [InterviewEmployee::class, 'sendEmailTemplate'])->name('send-email-template')->middleware('documents');
    Route::get("not_appeared/form/{id?}", [InterviewEmployee::class, 'createNotAppearedForm'])->middleware('documents');
    Route::any("send_not_appeared/{id?}", [InterviewEmployee::class, 'sendNotAppearedStatus'])->name('send.not.appeared')->middleware('documents');

    Route::get("exit-employee/form/{id?}", [App\Http\Controllers\ExitEmployeeProcess::class, 'getExitEmployee'])->middleware('documents');
    Route::any("exit-employee/submit/{id?}", [App\Http\Controllers\ExitEmployeeProcess::class, 'creiateExitEmployee'])->name('exit.employee.create')->middleware('documents');
    Route::post('exit-employee/update', [App\Http\Controllers\ExitEmployeeProcess::class, 'updateExtEmployee'])->middleware('documents');

    //new employee form for testing
    Route::get("Newemployee/form/{id?}", [App\Http\Controllers\NewEmployeeController::class, 'index'])->name('basicinfo.index')->middleware('documents');
    Route::any('Newemployee/submit/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'createEmployee'])->middleware('documents');
    Route::post('Newemployee/form/update', [App\Http\Controllers\NewEmployeeController::class, 'updateEmployee'])->middleware('documents');

    Route::get("qualification/form/{id?}", [App\Http\Controllers\NewEmployeeController::class, 'getQualificationForm'])->name('basicinfo.index')->middleware('documents');
    Route::any('qualification/submit/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'createEmployeeQualification'])->middleware('documents');
    Route::post('qualification/form/update', [App\Http\Controllers\NewEmployeeController::class, 'updateEmployeeQualification'])->middleware('documents');
    
    Route::get("workhistory/form/{id?}", [App\Http\Controllers\NewEmployeeController::class, 'getWorkhistoryForm'])->name('basicinfo.index')->middleware('documents');
    Route::any('workhistory/submit/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'createEmployeeWorkhistory'])->middleware('documents');
    Route::post('workhistory/form/update', [App\Http\Controllers\NewEmployeeController::class, 'updateEmployeeWorkhistory'])->middleware('documents');

    Route::get("employee_skills/form/{id?}", [App\Http\Controllers\NewEmployeeController::class, 'getSkillsForm'])->name('basicinfo.index')->middleware('documents');
    Route::any('employee_skills/submit/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'createEmployeeSkills'])->middleware('documents');
    Route::post('employee_skills/form/update', [App\Http\Controllers\NewEmployeeController::class, 'updateEmployeeSkills'])->middleware('documents');
    Route::any('add_employee_skills/submit/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'addMoreEmployeeSkills'])->middleware('documents');
    Route::any('add_employee_lang_skills/submit/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'addMorelangEmployeeSkills'])->middleware('documents');

    Route::get("employee_official/form/{id?}", [App\Http\Controllers\NewEmployeeController::class, 'getemployeeofficialForm'])->name('basicinfo.index')->middleware('documents');
    Route::any('employee_official/submit/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'createEmployeeOfficial'])->middleware('documents');
    Route::post('employee_official/form/update', [App\Http\Controllers\NewEmployeeController::class, 'updateEmployeeOfficial'])->middleware('documents');

    Route::any('edit_language/update/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'updateSkills'])->middleware('documents');
    Route::any('edit_language/update/{id?}', [App\Http\Controllers\NewEmployeeController::class, 'updateLanguage'])->middleware('documents');

});

Route::get('reload-captcha', [App\Http\Controllers\Auth\RegisteredUserController::class, 'reloadCaptcha'])->name('reloadCaptcha');
Route::get('verification-success/{id?}', [InterviewEmployee::class, 'verificationEmail'])->name('verification.success');
Route::any('resetverification-mail/{id?}', [App\Http\Controllers\Auth\RegisteredUserController::class, 'resetMailSend'])->name('resetverification.mail');

Route::get('account_verify', [InterviewEmployee::class, 'getCheckStatus']);
Route::get('resetaccount_verify', [InterviewEmployee::class, 'getResetStatus']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('country-state-city', [App\Http\Controllers\Auth\RegisteredUserController::class, 'index']);
Route::post('get-states-by-country', [App\Http\Controllers\Auth\RegisteredUserController::class, 'getState']);
Route::post('get-cities-by-state', [App\Http\Controllers\Auth\RegisteredUserController::class, 'getCity']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('interview/feedback/{id?}', [InterviewProcess::class, 'interviewFeedback'])->name('interview.feedback');
Route::post('interview/feedback', [InterviewProcess::class, 'interviewFeedbackForEmployee'])->name('interview.feedback.mail');

Route::get('csv', [App\Http\Controllers\CsvController::class, 'showForm']);
Route::post('csv', [App\Http\Controllers\CsvController::class, 'store']);
// Route::get('/export/{type}', [App\Http\Controllers\EmployeeController::class,'export']);
Route::get('/export-csv', [App\Http\Controllers\EmployeeController::class, 'exportsCSV']);
Route::get('/export-csv-invite', [App\Http\Controllers\InviteempController::class, 'exportsCSVInvite']);

require __DIR__ . '/auth.php';


Route::get('color_picker', [App\Http\Controllers\CsvController::class, 'colorPicker']);


