<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaResourceController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ContactController;


// ✅ Static page: no logic or data passed, just a Blade file
Route::view('/', 'index')->name('index');
Route::view('/homepage', 'homepage')->name('homepage');
Route::get('/sdgs', function () {
    return view('sdg');
})->name('sdgs');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

// media resources controller
Route::get('/ictv', [MediaResourceController::class, 'ictv'])->name('ictv');
Route::get('/iec', [MediaResourceController::class, 'iec'])->name('iec');
Route::get('/modules', [MediaResourceController::class, 'modules'])->name('modules');
Route::get('/newsletter', [MediaResourceController::class, 'newsletter'])->name('newsletter');
Route::get('/tech-portfolio', [MediaResourceController::class, 'techPortfolio'])->name('tech-portfolio');

// Research Controller

Route::get('/agriculture', [ResearchController::class, 'agriculture'])->name('agriculture');
Route::get('/aquaculture', [ResearchController::class, 'aquaculture'])->name('aquaculture');
Route::get('/livestock', [ResearchController::class, 'livestock'])->name('livestock');
Route::get('/livelihood', [ResearchController::class, 'livelihood'])->name('livelihood');
Route::get('/biotechnology', [ResearchController::class, 'biotechnology'])->name('biotechnology');
Route::get('/root-crops', [ResearchController::class, 'rootCrops'])->name('root-crops');
Route::get('/iot', [ResearchController::class, 'iot'])->name('iot');
Route::get('/others', [ResearchController::class, 'others'])->name('others');

//admin login

// Admin Login Page (UI only for now)
Route::get('/admin/login', function () {
    return view('admin.auth.login');
})->name('admin.login');

//Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
