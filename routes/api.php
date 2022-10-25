<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;


Route::post('/course/subscription', [CourseController::class, 'updateSubscriptionStatus']);
