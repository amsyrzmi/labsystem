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

    //?   authentication Routes
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
        Route::post('/requests/{id}/reject', [AdminController::class, 'rejectRequest'])->name('requests.reject');
        Route::post('/requests/{id}/approve', [AdminController::class, 'approveRequest'])->name('requests.approve');
        Route::delete('/requests/{id}', [AdminController::class, 'deleteRequest'])->name('requests.delete');
        
        // NEW: History
        Route::get('/history', [AdminController::class, 'allHistory'])->name('history');
        //? Experiments Management - NEW ROUTES
        Route::get('/manage-experiments', [AdminController::class, 'manageExperimentsIndex'])->name('manage_experiments.index');
        Route::get('/manage-experiments/create', [AdminController::class, 'manageExperimentsCreate'])->name('manage_experiments.create');
        Route::post('/manage-experiments', [AdminController::class, 'manageExperimentsStore'])->name('manage_experiments.store');
        Route::get('/manage-experiments/{id}/edit', [AdminController::class, 'manageExperimentsEdit'])->name('manage_experiments.edit');
        Route::put('/manage-experiments/{id}', [AdminController::class, 'manageExperimentsUpdate'])->name('manage_experiments.update');
        Route::delete('/manage-experiments/{id}', [AdminController::class, 'manageExperimentsDestroy'])->name('manage_experiments.destroy');
        
        //? AJAX endpoints for dynamic dropdowns
        Route::get('/api/subjects/{formLevel}', [AdminController::class, 'getSubjectsByForm'])->name('api.subjects');
        Route::get('/api/topics/{subjectId}', [AdminController::class, 'getTopicsBySubject'])->name('api.topics');
        Route::post('/users/{id}/send-password-reset', [AdminController::class, 'sendPasswordReset'])
        ->name('users.send_password_reset');
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

        //? Print routes
        Route::get('/lab_assistant/history/print/{id}', [LabassistantController::class, 'printRequest'])
            ->name('lab_assistant.print.request');
        
        Route::get('/lab_assistant/history/batch-print', [LabassistantController::class, 'showBatchPrint'])
            ->name('lab_assistant.print.batch');
        
        Route::post('/lab_assistant/history/batch-print', [LabassistantController::class, 'printBatch'])
            ->name('lab_assistant.print.batch.process');

        // Route for calculating reagents (add to your lab assistant routes group)
        Route::post('/requests/{id}/calculate-reagents', [LabassistantController::class, 'calculateReagents'])
            ->name('lab_assistant.requests.calculate_reagents');

        //? Experiments Management - NEW ROUTES
        Route::get('/lab-assistant/manage-experiments', [LabassistantController::class, 'manageExperimentsIndex'])->name('lab_assistant.manage_experiments.index');
        Route::get('/lab-assistant/manage-experiments/create', [LabassistantController::class, 'manageExperimentsCreate'])->name('lab_assistant.manage_experiments.create');
        Route::post('/lab-assistant/manage-experiments', [LabassistantController::class, 'manageExperimentsStore'])->name('lab_assistant.manage_experiments.store');
        Route::get('/lab-assistant/manage-experiments/{id}/edit', [LabassistantController::class, 'manageExperimentsEdit'])->name('lab_assistant.manage_experiments.edit');
        Route::put('/lab-assistant/manage-experiments/{id}', [LabassistantController::class, 'manageExperimentsUpdate'])->name('lab_assistant.manage_experiments.update');
        Route::delete('/lab-assistant/manage-experiments/{id}', [LabassistantController::class, 'manageExperimentsDestroy'])->name('lab_assistant.manage_experiments.destroy');
        
        //? AJAX endpoints for dynamic dropdowns
        Route::get('/lab-assistant/api/subjects/{formLevel}', [LabassistantController::class, 'getSubjectsByForm'])->name('lab_assistant.api.subjects');
        Route::get('/lab-assistant/api/topics/{subjectId}', [LabassistantController::class, 'getTopicsBySubject'])->name('lab_assistant.api.topics');
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

       //? Timetable
        Route::get('/teacher/timetable', [TeacherController::class, 'timetable'])->name('teacher.timetable');

        //? Print routes
        Route::get('/teacher/history/print/{id}', [TeacherController::class, 'printRequest'])
            ->name('teacher.print.request');
        
        Route::get('/teacher/history/batch-print', [TeacherController::class, 'showBatchPrint'])
            ->name('teacher.print.batch');
        
        Route::post('/teacher/history/batch-print', [TeacherController::class, 'printBatch'])
            ->name('teacher.print.batch.process');
    });
    });



