<?php

use App\Http\Controllers\CourseController;
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

Route::get('/dashboard', [
    CourseController::class, 'index'
])->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/course/save', [
    CourseController::class, 'store'
])->middleware(['auth', 'verified'])->name('course.save');


require __DIR__.'/auth.php';
