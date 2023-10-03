<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DisciplinaryController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [AuthController::class, 'loginPage']);

Route::prefix('/login')->group(function () {
    Route::get('/', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {

    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/accounts', [RegisterController::class, 'accounts'])->name('admin.accounts');

    Route::prefix('/students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/{id}', [StudentController::class, 'getStudent'])->name('students.getStudent');
        Route::post('/', [StudentController::class, 'store'])->name('students.store');
        Route::put('/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    Route::get('/student-add', [StudentController::class, 'addStudentPage'])->name('students.addStudentPage');

    Route::prefix('/reports-acd')->group(function () {
        Route::get('/', [StudentController::class, 'indexAcdRpt'])->name('rpt.acd.index');
        Route::get('/{id}', [StudentController::class, 'getStudentGradeReport'])->name('rpt.acd.getStudentGradeReport');
        Route::put('/{id}', [StudentController::class, 'updateStudentGradeReport'])->name('rpt.acd.updateStudentGradeReport');
        Route::post('/{id}', [StudentController::class, 'addStudentGradeReport'])->name('rpt.acd.addStudentGradeReport');
    });

    Route::prefix('/reports-dcpl')->group(function () {
        Route::get('/', [StudentController::class, 'indexStudsList'])->name('rpt.dcpl.index');
        Route::get('/{id}', [DisciplinaryController::class, 'showDisciplinaryRecordsForStudent'])->name('rpt.dcpl.showDisciplinaryRecordsForStudent');
        Route::post('/', [DisciplinaryController::class, 'store'])->name('rpt.dcpl.store');
    });

    Route::prefix('/students-info')->group(function () {
        Route::get('/', [StudentController::class, 'indexStudent'])->name('students-info.index');
        Route::get('/{id}', [StudentController::class, 'getStudentInfo'])->name('students-info.getStudentInfo');
        Route::put('/{id}', [StudentController::class, 'updateStudent'])->name('students-info.updateStudent');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
