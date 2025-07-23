<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaResourceController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;

//Uploading Controllers
use App\Http\Controllers\ICTVController;
use App\Http\Controllers\IECMaterialController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NewsletterController;



//Uploads for ICTV
Route::post('/ictv/upload', [ICTVController::class, 'upload'])->name('ictv.upload');
Route::get('/ictv-table', [ICTVController::class, 'table'])->name('ictv-table');
Route::delete('/admin/ictv/{id}', [ICTVController::class, 'destroy'])->name('admin.ictv.destroy');
Route::put('/admin/ictv/{id}', [ICTVController::class, 'update'])->name('ictv.update');



//Upload for IEC
Route::post('/admin/iec/upload', [IECMaterialController::class, 'upload'])->name('admin.iec.upload');
Route::get('/admin/iec-table', [IECMaterialController::class, 'index'])->name('admin.iec-table');
Route::delete('/iec-materials/{id}', [IECMaterialController::class, 'destroy'])->name('iec-materials.destroy');
Route::put('/iec-materials/{id}', [IECMaterialController::class, 'update'])->name('iec.update');



//Upload for Modules
Route::post('/admin/modules/upload', [ModuleController::class, 'upload'])->name('admin.modules.upload');
Route::get('/admin/modules-table', [ModuleController::class, 'table'])->name('admin.modules-table');
Route::delete('/admin/modules/{id}', [ModuleController::class, 'destroy'])->name('admin.modules.destroy');
Route::put('/admin/modules/{id}', [ModuleController::class, 'update'])->name('admin.modules.update');


//upload for newsletter
Route::get('/admin/newsletter-table', [NewsletterController::class, 'table'])->name('admin.newsletter-table');
Route::get('newsletters', [NewsletterController::class, 'index'])->name('admin.newsletters');
Route::post('newsletters', [NewsletterController::class, 'store'])->name('newsletters.store');
Route::put('newsletters/{id}', [NewsletterController::class, 'update'])->name('newsletters.update');
Route::delete('newsletters/{id}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');









Route::get('/', function () {
    return view('welcome');
});


// ✅ Static page: no logic or data passed, just a Blade file
Route::view('/', 'index')->name('index');
Route::view('/homepage', 'homepage')->name('homepage');
Route::get('/sdgs', function () {
    return view('sdg');
})->name('sdgs');

// For main controller
Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/plagscan', [MainController::class, 'plagscan'])->name('plagscan');
Route::get('/promotional', [MainController::class, 'promotional'])->name('promotional');

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

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Admin Content management page
//ictvs
Route::get('/admin/ictv', [AdminController::class, 'ictv'])->name('admin.ictv');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


Route::get('/admin/iec', [AdminController::class, 'iec'])->name('admin.iec');
Route::get('/admin/modules', [AdminController::class, 'modules'])->name('admin.modules');
Route::get('/admin/newsletter', [AdminController::class, 'newsletter'])->name('admin.newsletter');
Route::get('/admin/promotional', [AdminController::class, 'promotional'])->name('admin.promotional');
