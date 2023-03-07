<?php

use App\Http\Controllers\InterviewEmployee;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Mail\Emailinvite;
use App\Http\Middleware\Superadmin;

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

Route::get('/welcome', function () {
    return view('welcome');
});  

Route::get('/superlogin', function () {
    return view('auth/superadminlogin');
});

Route::get('/', function () {
    return view('web/index');
});

Route::get('/edit-employee', function () {
    return view('');
});
Route::get('/table', function () {
  return view('admin/datatable');
});

Route::get('/search', function () {
    return view('admin/search-history');
  });


  Route::get('/current-employee', function () {
    return view('admin/current-employee');
  });

  Route::get('/confirmation', function () {
    return view('admin/confirm-msg');
  });

  // Route::get('/schedule-interview', function () {
  //   return view('admin/schedule-for-interview');
  // });

  Route::get('/schedule-interview', [InterviewEmployee::class, 'index'])->name('schedule.interview');
  Route::any('/schedule-interview/form/{id?}', [InterviewEmployee::class, 'getScheduleInterviewForm']);
  Route::post('schedule-interview/submit', [InterviewEmployee::class, 'schedule_interview']);
  Route::post('schedule-interview/changeHiringStage', [InterviewEmployee::class, 'update_hiring_stage']);
  Route::post('schedule-interview/deleteInterview', [InterviewEmployee::class, 'deleteInterview']);
  Route::get('interview/confirmed/{id?}', [InterviewEmployee::class, 'interviewConfirmed'])->name('interview.confirmed');
  Route::get('interview/newtime/{id?}', [InterviewEmployee::class, 'interviewNewTime'])->name('interview.newtime');
  Route::get('interview/declined/{id?}', [InterviewEmployee::class, 'interviewDeclined'])->name('interview.declined');
  // Route::post('schedule-interview/update', [InterviewEmployee::class, 'schedule_interview_update']);
  // Route::post('admin/add_company', [\App\Http\Controllers\CommonController::class, 'add_company']);
  // Route::post('admin/update_company', [\App\Http\Controllers\CommonController::class, 'update_company']);

  Route::get('/settings', function () {
    return view('admin/settings');
  });

  Route::get('/status', function () {
    return view('welcome');
  });

  Route::get('/employee-details', function () {
    return view('admin/employee-details');
  });

  // Route::get('/employee-exit', function () {
  //   return view('admin/employee-exit');
  // });

  Route::get('/change_password', function () {
    return view('company/change-password');
  })->name('document');

  Route::get('/invite-confirm', function () {
    return view('org-invite/invite-confirm');
  });
  
  Route::get('/basic-info', function () {
    return view('org-invite/basic-info');
  });
 
  Route::get('/organization', function () {
    return view('superadmin/organization');
});

// Route::get('/invite-email',function(){
//   Mail::to('jharshita259@gmail.com')
//   ->send(new Emailinvite());
// return redirect()->back()->with('message','Invitation Email Successfully Send');
// });
Route::get('/invite-email/{id?}', [App\Http\Controllers\InviteempController::class,'sendemail'])->name('invite-email');
Route::middleware([Superadmin::class])->group(function () {
Route::get('/superadmin', [App\Http\Controllers\SuperAdminController::class,'index'])->name('superadmin');
Route::get('superadmin/logout', [App\Http\Controllers\SuperAdminController::class, 'logout'])->name('superadmin.logout');
});
Route::post('/document', [App\Http\Controllers\DocumentsController::class,'getDocument'])->name('document');
Route::get('/document', [App\Http\Controllers\DocumentsController::class,'index'])->name('document');

Route::get('/email-config/{id?}', [App\Http\Controllers\InviteempController::class,'getConfig'])->name('email-config');
Route::get('/basic-info/{id?}', [App\Http\Controllers\InviteempController::class,'getBasicDetails'])->name('basic-info');
Route::post('/basic-info/{id?}', [App\Http\Controllers\InviteempController::class,'getInviteDetails']);

Auth::routes();
Route::middleware([Admin::class])->group(function () {
Route::get('/admin', [App\Http\Controllers\AdminController::class,'index'])->name('admin');
Route::get('admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
Route::post('/change_password', [App\Http\Controllers\AdminController::class,'changePassword'])->name('password.change');
Route::get('/add-employee/{id?}', [App\Http\Controllers\EmployeeController::class,'index']);
Route::post('/add-employee/{id?}', [App\Http\Controllers\EmployeeController::class, 'basicInfo']);
Route::get('/edit-employee/{id?}', [App\Http\Controllers\EmployeeController::class, 'basicIndex'])->name('edit-employee');
Route::post('/edit-employee/{id?}', [App\Http\Controllers\EmployeeController::class, 'editEmployee']);
Route::get('/settings',[App\Http\Controllers\companySettingsController::class,'profiledata'])->name('settings');
Route::post('/settings',[App\Http\Controllers\companySettingsController::class,'getprofile']);
Route::get('/employee-exit/{id?}', [App\Http\Controllers\EmployeeController::class, 'exitEmp']);
Route::post('/employee-exit/{id?}', [App\Http\Controllers\EmployeeController::class, 'getExitEmp']);
Route::get('/post-employee-details/{id}', [App\Http\Controllers\EmployeeController::class, 'postEmpDetails']);
Route::get('/post-employee', [App\Http\Controllers\EmployeeController::class, 'pastEmp']);
Route::get('/current-employee', [App\Http\Controllers\EmployeeController::class, 'currentEmp']);
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'getAllEmp']);
Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'getCsvEmp']);
Route::get('/downloadcsv', [App\Http\Controllers\EmployeeController::class, 'downloadCsv']);
Route::get('/download_invitecsv', [App\Http\Controllers\InviteempController::class, 'downloadInviteCsv']);
Route::get('/add-invite-employee', [App\Http\Controllers\InviteempController::class, 'inviteEmp']);
Route::post('/add-invite-employee', [App\Http\Controllers\InviteempController::class, 'getInviteEmp']);
Route::get('/invite-employee', [App\Http\Controllers\InviteempController::class, 'index']);
Route::post('/invite-employee', [App\Http\Controllers\InviteempController::class, 'getCsvInvite']);
Route::get('/edit-invite-employee/{id?}', [App\Http\Controllers\InviteempController::class, 'editInviteEmp']);
Route::post('/edit-invite-employee/{id?}', [App\Http\Controllers\InviteempController::class, 'geteditInvite']);
Route::get('/delete-invite/{id?}', [App\Http\Controllers\InviteempController::class, 'deleteInvite']);
});
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

Route::get('csv',[App\Http\Controllers\CsvController::class,'showForm']);
Route::post('csv',[App\Http\Controllers\CsvController::class,'store']);
// Route::get('/export/{type}', [App\Http\Controllers\EmployeeController::class,'export']);
Route::get('/export-csv', [App\Http\Controllers\EmployeeController::class,'exportsCSV']);
Route::get('/export-csv-invite', [App\Http\Controllers\InviteempController::class,'exportsCSVInvite']);


require __DIR__.'/auth.php';
