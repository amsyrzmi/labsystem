<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LabassistantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::middleware('auth')->group(function () {

    //! Role admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/Admin', [AdminController::class, 'index'])->name('admin.index');
    });

    //! Role lab assistant
    Route::middleware('role:lab_assistant')->group(function () {
        Route::get('/Labassistant', [LabassistantController::class, 'index'])->name('lab_assistant.index');
    
        Route::get('/lab-assistant/requests', [LabassistantController::class, 'listAllRequests'])->name('lab_assistant.requests.list');
        Route::get('/lab-assistant/history', [LabassistantController::class, 'listAllHistory'])->name('lab_assistant.history');
        Route::get('/lab-assistant/requests/{id}', [LabassistantController::class, 'requestDetails'])->name('lab_assistant.requests.details');
        
        //? Scheeduling
        Route::get('/lab-assistant/requests/{id}/approve', [LabassistantController::class, 'showApproveForm'])->name('lab_assistant.requests.approve.form');
        Route::post('/lab-assistant/requests/{id}/approve-schedule', [LabassistantController::class, 'approveRequestWithSchedule'])->name('lab_assistant.requests.approve.schedule');
        
        Route::post('/lab-assistant/requests/{id}/reject', [LabassistantController::class, 'rejectRequest'])->name('lab_assistant.requests.reject');
        
       //? Timetable
        Route::get('/lab-assistant/timetable', [LabassistantController::class, 'timetable'])->name('lab_assistant.timetable');
    });
    //! Role teacher
    Route::middleware('role:teacher')->group(function () {
        Route::get('/Teacher', [TeacherController::class, 'index'])->name('teacher.index');
        Route::get('/requests',[TeacherController::class, 'requests'])->name('teacher.requests');
        Route::get('/subjects-by-form', [TeacherController::class, 'getSubjectsByFormLevel'])->name('subjects.by.form');
        Route::get('/topics-by-subject', [TeacherController::class, 'getTopicsBySubject'])->name('topics.by.subject');
        Route::get('/experiments-by-topic', [TeacherController::class, 'getExperimentsByTopic'])->name('experiments.by.topic');
        Route::get('/experiment-details', [TeacherController::class, 'getExperimentDetails'])->name('experiment.details');
        Route::post('/teacher/requests/submit', [TeacherController::class, 'submitRequest'])->name('teacher.requests.submit');

        //? list all requests by the currently authenticated teacher
        Route::get('/teacher/requests/list', [TeacherController::class, 'listUserRequests'])->name('teacher.requests.list');

         //? list all requests history by the currently authenticated teacher
        Route::get('/teacher/requests/history', [TeacherController::class, 'listUserHistory'])->name('teacher.history');

        //? show details (materials & apparatus) for a specific request
        Route::get('/teacher/requests/{id}/details', [TeacherController::class, 'requestDetails'])->name('teacher.requests.details');
        Route::get('/teacher/requests/{id}/history', [TeacherController::class, 'requestDetailsH'])->name('teacher.requests.detailsH');
        });
    });

//? authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//? reset Password Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');