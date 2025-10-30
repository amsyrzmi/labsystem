<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LabassistantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;



Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('show.login');
    });

    //? authentication Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');


    //? reset Password Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //! Role admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        
        // User Management
        Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');
        Route::post('/users/{id}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
        Route::post('/users/{id}/reject', [AdminController::class, 'rejectUser'])->name('users.reject');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
        
        // Edit User
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        
        // Create User
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');

        // NEW: Lab Request Management
        Route::get('/requests', [AdminController::class, 'allRequests'])->name('requests');
        Route::get('/requests/{id}', [AdminController::class, 'requestDetails'])->name('requests.details');
        Route::post('/requests/{id}/complete', [AdminController::class, 'markCompleted'])->name('requests.complete');
        Route::post('/requests/{id}/no-show', [AdminController::class, 'markNoShow'])->name('requests.noshow');
        Route::post('/requests/{id}/cancel', [AdminController::class, 'cancelRequest'])->name('requests.cancel');
        Route::delete('/requests/{id}', [AdminController::class, 'deleteRequest'])->name('requests.delete');
        
        // NEW: History
        Route::get('/history', [AdminController::class, 'allHistory'])->name('history');
    });

    //! Role lab assistant
    Route::middleware('role:lab_assistant')->group(function () {
        Route::get('/lab-assistant', [LabassistantController::class, 'index'])->name('lab_assistant.index');
    
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
        Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
        Route::get('/requests',[TeacherController::class, 'requests'])->name('teacher.requests');
        Route::get('/subjects-by-form', [TeacherController::class, 'getSubjectsByFormLevel'])->name('subjects.by.form');
        Route::get('/topics-by-subject', [TeacherController::class, 'getTopicsBySubject'])->name('topics.by.subject');
        Route::get('/experiments-by-topic', [TeacherController::class, 'getExperimentsByTopic'])->name('experiments.by.topic');
        Route::get('/experiment-details', [TeacherController::class, 'getExperimentDetails'])->name('experiment.details');
        Route::post('/teacher/requests/submit', [TeacherController::class, 'submitRequest'])->name('teacher.requests.submit');

        //? Availability check 
        Route::post('/teacher/check-availability', [TeacherController::class, 'checkAvailability'])->name('teacher.check.availability');

        //? list all requests by the currently authenticated teacher
        Route::get('/teacher/requests/list', [TeacherController::class, 'listUserRequests'])->name('teacher.requests.list');

        //? list all requests history by the currently authenticated teacher
        Route::get('/teacher/requests/history', [TeacherController::class, 'listUserHistory'])->name('teacher.history');

        //? show details (materials & apparatus) for a specific request
        Route::get('/teacher/requests/{id}/details', [TeacherController::class, 'requestDetails'])->name('teacher.requests.details');
        Route::get('/teacher/requests/{id}/history', [TeacherController::class, 'requestDetailsH'])->name('teacher.requests.detailsH');
    });
    });



