<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ProfessorController;
/*W
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('landing.index');
});

Route::get('/home', function () {
    return view('home.index');
})->middleware('token-verify');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});



Route::post('/auth/login', [AuthController::class, 'login']);

Route::post('/auth/register',  [AuthController::class, 'register']);

Route::post('/auth/logout', [AuthController::class, 'logout']);


Route::get('/classrooms',[ClassroomController::class,'index'])->middleware('token-verify');

Route::get('/classrooms/{id}',[ClassroomController::class,'show'])->middleware('token-verify');

Route::post('/classrooms', [ClassroomController::class, 'store'])->middleware('token-verify');

Route::delete('/classrooms/{id}',[ClassroomController::class,'destroy'])->middleware('token-verify');



Route::delete('/students/{id}',[StudentController::class,'destroy'])->middleware('token-verify');

Route::get('/students/{id}',[StudentController::class,'show'])->middleware('token-verify');

Route::get('/students', [StudentController::class, 'index'])->middleware('token-verify');

Route::post('/students', [StudentController::class, 'store'])->middleware('token-verify');

Route::patch('/students/{id}', [StudentController::class, 'changeClassroom'])->middleware('token-verify');



Route::post('/grades', [StudentController::class, 'addGrade'])->middleware('token-verify');



Route::get('/professors/{id}',[ProfessorController::class,'show'])->middleware('token-verify');

Route::get('/professors',[ProfessorController::class,'index'])->middleware('token-verify');

Route::post('/professors', [ProfessorController::class, 'store'])->middleware('token-verify');

Route::delete('/professors/{id}',[ProfessorController::class,'destroy'])->middleware('token-verify');

Route::patch('/professors/{id}',[ProfessorController::class,'changeClassroom'])->middleware('token-verify');



Route::get('/subjects',[SubjectController::class,'index'])->middleware('token-verify');

Route::get('/subjects/{id}',[SubjectController::class,'show'])->middleware('token-verify');

Route::post('/subjects', [SubjectController::class, 'store'])->middleware('token-verify');

Route::delete('/subjects/{id}',[SubjectController::class,'destroy'])->middleware('token-verify');