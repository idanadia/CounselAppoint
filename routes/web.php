<?php
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientAppointmentController;
use App\Http\Controllers\ClientCounselorController;
use App\Http\Controllers\CounselorAppointmentController;
use App\Http\Controllers\CounselorClientController;
use App\Http\Controllers\CounselorReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupervisorAppointmentController;
use App\Http\Controllers\SupervisorClientController;
use App\Http\Controllers\SupervisorCounselorController;
use App\Http\Controllers\TimeslotsController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});
Route::get('/', [LandingController::class, 'index'])->name('landing');

Auth::routes();
//client
Route::middleware(['auth', 'user-role:client'])->group(function () {
    Route::get("/home", [HomeController::class, 'clientHome'])->name('home.client');
});
//counsellor
Route::middleware(['auth', 'user-role:counselor'])->group(function () {
    Route::get("/counselor/home", [HomeController::class, 'counselorHome'])->name('home.counselor');
});
//admin
Route::middleware(['auth', 'user-role:supervisor'])->group(function () {
    Route::get("/supervisor/home", [HomeController::class, 'supervisorHome'])->name('home.supervisor');
});
// Route::group(['middleware' => 'auth'], function () {
//     Route::resource('appointments', AppointmentController::class);
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{receiver}', [ChatController::class, 'show'])->name('chats.show');
    Route::get('/chats/{receiver}/switchSeen', [ChatController::class, 'switchSeen'])->name('chat.switchSeen');
    Route::post('/chats/{receiver}', [ChatController::class, 'store'])->name('chats.store');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');

    Route::middleware(['user-role:counselor'])->prefix('counselor')->group(function () {
        Route::resource('appointments', CounselorAppointmentController::class)->names([
            'index' => 'counselor.appointments.index',
            'create' => 'counselor.appointments.create',
            'store' => 'counselor.appointments.store',
            'show' => 'counselor.appointments.show',
            'edit' => 'counselor.appointments.edit',
            'update' => 'counselor.appointments.update',
            'destroy' => 'counselor.appointments.destroy',
        ]);

        Route::put('/appointments/{appointment}/change-status/{status}', [CounselorAppointmentController::class, 'changeStatus'])
            ->name('counselor.appointments.changeStatus');
        Route::resource('reports', CounselorReportController::class)->names([
            'index' => 'counselor.reports.index',
            'create' => 'counselor.reports.create',
            'store' => 'counselor.reports.store',
            'show' => 'counselor.reports.show',
            'edit' => 'counselor.reports.edit',
            'update' => 'counselor.reports.update',
            'destroy' => 'counselor.reports.destroy',
        ]);
        Route::resource('clients', CounselorClientController::class)->names([
            'index' => 'counselor.clients.index',
            'create' => 'counselor.clients.create',
            'store' => 'counselor.clients.store',
            'show' => 'counselor.clients.show',
            'edit' => 'counselor.clients.edit',
            'update' => 'counselor.clients.update',
            'destroy' => 'counselor.clients.destroy',
        ]);

        Route::resource('timeslots', TimeslotsController::class)->names([
            'index' => 'counselor.timeslots.index',
            'create' => 'counselor.timeslots.create',
            'store' => 'counselor.timeslots.store',
            'show' => 'counselor.timeslots.show',
            'edit' => 'counselor.timeslots.edit',
            'update' => 'counselor.timeslots.update',
            'destroy' => 'counselor.timeslots.destroy',

        ]);
        Route::put('/timeslots/{timeslotId}/switchActive}', [TimeslotsController::class, 'switchActive'])
            ->name('counselor.timeslots.switchActive');
    });

    Route::middleware(['user-role:client'])->prefix('client')->group(function () {
        Route::resource('appointments', ClientAppointmentController::class)->names([
            'index' => 'client.appointments.index',
            'create' => 'client.appointments.create',
            'store' => 'client.appointments.store',
            'show' => 'client.appointments.show',
            'edit' => 'client.appointments.edit',
            'update' => 'client.appointments.update',
            'destroy' => 'client.appointments.destroy',
        ]);
        Route::resource('counselors', ClientCounselorController::class)->names([
            'index' => 'client.counselors.index',
            'create' => 'client.counselors.create',
            'store' => 'client.counselors.store',
            'show' => 'client.counselors.show',
            'edit' => 'client.counselors.edit',
            'update' => 'client.counselors.update',
            'destroy' => 'client.counselors.destroy',
        ]);
        Route::put('/appointments/{appointment}/change-status/{status}', [ClientAppointmentController::class, 'changeStatus'])
            ->name('client.appointments.changeStatus');
    });
    Route::middleware(['user-role:supervisor'])->prefix('supervisor')->group(function () {
        Route::resource('appointments', SupervisorAppointmentController::class)->names([
            'index' => 'supervisor.appointments.index',
            'create' => 'supervisor.appointments.create',
            'store' => 'supervisor.appointments.store',
            'show' => 'supervisor.appointments.show',
            'edit' => 'supervisor.appointments.edit',
            'update' => 'supervisor.appointments.update',
            'destroy' => 'supervisor.appointments.destroy',
        ]);
        Route::resource('counselors', SupervisorCounselorController::class)->names([
            'index' => 'supervisor.counselors.index',
            'create' => 'supervisor.counselors.create',
            'store' => 'supervisor.counselors.store',
            'show' => 'supervisor.counselors.show',
            'edit' => 'supervisor.counselors.edit',
            'update' => 'supervisor.counselors.update',
            'destroy' => 'supervisor.counselors.destroy',
        ]);
        Route::resource('clients', SupervisorClientController::class)->names([
            'index' => 'supervisor.clients.index',
            'create' => 'supervisor.clients.create',
            'store' => 'supervisor.clients.store',
            // 'show' => 'supervisor.counselors.show',
            'edit' => 'supervisor.clients.edit',
            'update' => 'supervisor.clients.update',
            'destroy' => 'supervisor.clients.destroy',
        ]);
        // Route::get('/clients', [UserController::class, 'indexClient'])->name('supervisor.clients.index');
        // Route::get('/counselor/{id}', [UserController::class, 'showCounselor'])->name('supervisor.counselor.show');

        // Route::put('/appointments/{appointment}/change-status/{status}', [ClientAppointmentController::class, 'changeStatus'])
        //     ->name('client.appointments.changeStatus');
    });
    // Route::middleware(['user-role:counselor'])->prefix('counselor')->group(function () {

    // });

    // Route::middleware(['user-role:counselor'])->prefix('counselor')->group(function () {

    // });
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/home', 'HomeController@index')->name('home');

//Method1
// Route::get('/students', 'StudentController@index')->name('students.index');
// Route::get('/students/create', 'StudentController@create')->name('students.create');
// Route::post('/students', 'StudentController@store')->name('students.store');
// Route::get('/students/{student}', 'StudentController@show')->name('students.show');
// Route::get('/students/{student}/edit', 'StudentController@edit')->name('students.edit');
// Route::put('/students/{student}', 'StudentController@update')->name('students.update');
// Route::delete('/students/{student}', 'StudentController@destroy')->name('students.destroy');
// Route::resource('students', StudentController::class);
//Method2
Route::resource('halls', HallController::class);
Route::resource('groups', GroupController::class);
// Route::get('/subjects', 'SubjectController@index')->name('subjects.index');
// Route::get('/subjects/create', 'SubjectController@create')->name('subjects.create');
// Route::post('/subjects', 'SubjectController@store')->name('subjects.store');
// Route::get('/subjects/{subject}', 'SubjectController@show')->name('subjects.show');
// Route::get('/subjects/{subject}/edit', 'SubjectController@edit')->name('subjects.edit');
// Route::put('/subjects/{subject}', 'SubjectController@update')->name('subjects.update');
// Route::delete('/subjects/{subject}', 'SubjectController@destroy')->name('subjects.destroy');

// Route::get('/halls', 'HallController@index')->name('halls.index');
// Route::get('/halls/create', 'HallController@create')->name('halls.create');
// Route::post('/halls', 'HallController@store')->name('halls.store');
// Route::get('/halls/{hall}', 'HallController@show')->name('halls.show');
// Route::get('/halls/{hall}/edit', 'HallController@edit')->name('halls.edit');
// Route::put('/halls/{hall}', 'HallController@update')->name('halls.update');
// Route::delete('/halls/{hall}', 'HallController@destroy')->name('halls.destroy');

// Route::get('/groups', 'GroupController@index')->name('groups.index');
// Route::get('/groups/create', 'GroupController@create')->name('groups.create');
// Route::post('/groups', 'GroupController@store')->name('groups.store');
// Route::get('/groups/{group}', 'GroupController@show')->name('groups.show');
// Route::get('/groups/{group}/edit', 'GroupController@edit')->name('groups.edit');
// Route::put('/groups/{group}', 'GroupController@update')->name('groups.update');
// Route::delete('/groups/{group}', 'GroupController@destroy')->name('groups.destroy');

Route::resource('timetables', TimetableController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UserController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('inspections', InspectionController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('reports', ReportController::class)->parameters([
        'reports' => 'inspection',
    ]);
});
Route::get('/reports/{id}/pdf', [ReportController::class, 'generatePDF'])->name('reports.pdf');

// Route::resource('/days', 'DayController');
Auth::routes();
// Route::post('/search-patient', 'PatientController@search')->name('searchPatient');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
