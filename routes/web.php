<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaResourceController;
use App\Http\Controllers\ResearchController;


// ✅ Static page: no logic or data passed, just a Blade file
Route::view('/index', 'index');
Route::view('/homepage', 'homepage')->name('homepage');
Route::get('/sdgs', function () {
    return view('sdg');
})->name('sdgs');
Route::view('/contact', 'contact')->name('contact');





// ✅ Dynamic page: use a closure if you plan to add logic later
Route::get('/contact', function () {
    // You can add logic or pass data here in the future
    return view('contact');
});

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
