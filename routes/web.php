<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MediaResourceController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VideoController;

use App\Http\Controllers\CommodityController;

//Uploading Controllers
use App\Http\Controllers\ICTVController;
use App\Http\Controllers\IECMaterialController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PromotionalActivityController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\TechnologyController;

// AI chatbox for openai
// use App\Http\Controllers\ChatController;
// Route::post('/chatbot/send', [ChatController::class, 'send']);

// for gemini
// use App\Http\Controllers\ChatBoxController; 

// gemini chatbot
// use App\Http\Controllers\GeminiChatController;

// Route::post('/chatbot/send', [GeminiChatController::class, 'send']);

// use App\Http\Controllers\ChatBoxController;
// Route::post('/chat', [ChatBoxController::class, 'send']);


// These routes are only accessible if NOT logged in
Route::middleware('admin.guest')->group(function () {
    Route::get('/admin/login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::post('/admin/login', [AdminController::class, 'login']);
});

// Protect *everything else* under /admin/*
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    // Add more protected admin routes here
    // Admin Content management page
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('ictv', [AdminController::class, 'ictv'])->name('admin.ictv');
    Route::get('iec', [AdminController::class, 'iec'])->name('admin.iec');
    Route::get('modules', [AdminController::class, 'modules'])->name('admin.modules');
    Route::get('newsletter', [AdminController::class, 'newsletter'])->name('admin.newsletter');
    Route::get('promotional', [AdminController::class, 'promotional'])->name('admin.promotional');
    Route::get('podcast', [AdminController::class, 'podcast'])->name('admin.podcast');
    Route::get('technology', [AdminController::class, 'technology'])->name('admin.technology');

    // Add if any(url/controller class/routename in the blade) 
});

//logout
Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
})->name('admin.logout');

Route::get('/videos/{type}/{id?}', [VideoController::class, 'show'])->name('video.show');


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
Route::post('/admin/newsletter/upload', [NewsletterController::class, 'upload'])->name('admin.newsletter.upload');
Route::get('/admin/newsletter-table', [NewsletterController::class, 'table'])->name('admin.newsletter-table');
Route::delete('/admin/newsletters/{id}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');
Route::put('/admin/newsletters/{id}', [NewsletterController::class, 'update'])->name('newsletters.update');

//upload for Promotional Activities
Route::post('/admin/promotionalactivities/upload', [PromotionalActivityController::class, 'store'])->name('admin.promotional.upload');
Route::get('/promotionalactivities-table', [PromotionalActivityController::class, 'table'])->name('admin.promotionalactivities-table');
Route::delete('/admin/promotionalactivities/{id}', [PromotionalActivityController::class, 'destroy'])->name('promotionalactivities.destroy');
Route::put('/admin/promotional/{id}', [PromotionalActivityController::class, 'update'])->name('promotional.update');


//upload for podcast
Route::post('/admin/podcasts/store', [PodcastController::class, 'store'])->name('admin.podcast.store');
Route::get('/podcast-table', [PodcastController::class, 'table'])->name('admin.podcast-table');
Route::delete('/podcasts/{id}', [PodcastController::class, 'destroy'])->name('podcast.destroy');
Route::put('/admin/podcast/{id}', [PodcastController::class, 'update'])->name('admin.podcast.update');



// recent activities
Route::delete('/admin/recent-activities/{id}', [AdminController::class, 'deleteRecentActivity'])->name('admin.recent-activities.delete');
Route::get('/admin/recent-activities', [AdminController::class, 'recentActivitiesTable'])->name('admin.recent-activities');
Route::delete('/recent-activities/delete-all', [AdminController::class, 'deleteAll'])->name('recent-activities.deleteAll');

//technology admin
Route::get('/technology-table', [TechnologyController::class, 'table'])->name('admin.technology-table');
Route::post('/technology/upload', [TechnologyController::class, 'upload'])->name('technology.upload');
Route::delete('/technologies/{id}', [TechnologyController::class, 'delete'])->name('technologies.delete');
Route::put('/admin/technology/{id}', [TechnologyController::class, 'update'])->name('admin.technology.update');


// Technology list page
Route::get('/technologies', [TechnologyController::class, 'index'])->name('technologies.index');
// Technology detail page
Route::get('/technologies/{id}', [TechnologyController::class, 'show'])->name('technologies.show');



// Static page: no logic or data passed, just a Blade file
Route::view('/', 'index')->name('index');
Route::redirect('/home', '/homepage')->name('home');

Route::view('/homepage', 'homepage')->name('homepage');

Route::get('/sdgs', function () {
    return view('sdg');
})->name('sdgs');



// By clicking the learn more button from index, it will increment the page view counter and redirect to the homepage
Route::get('/learn-more', function () {
    // Increment counter
    \DB::table('page_views')->increment('count');

    // Redirect to home
    return redirect('/home');
});

//For Commodity Database

Route::get('/commodities', [CommodityController::class, 'index']);

Route::get('/admin/database/commodities', [CommodityController::class, 'index'])
    ->name('admin.database.commodities');

Route::get('/commodities', [CommodityController::class, 'index'])->name('commodities.index');
Route::get('/commodities/{commodity}', [CommodityController::class, 'show'])->name('commodities.show');

Route::get('/admin/database/commodities/{commodity}', [CommodityController::class, 'show'])
    ->name('admin.database.commodities.show');

Route::post('/commodities', [CommodityController::class, 'store'])->name('commodities.store');
Route::put('/commodities/update/{id}', [CommodityController::class, 'update'])->name('commodities.update');
Route::delete('/commodities/{id}', [CommodityController::class, 'destroy'])->name('commodities.destroy');


    
// for redirect using the secret code
Route::get('/143123', function () {
    return redirect()->route('admin.login'); // if you named the admin login route
    // or return redirect('/admin/login'); if you use the direct path
});


// For main controller
Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/plagscan', [MainController::class, 'plagscan'])->name('plagscan');


// media resources controller
Route::get('/ictv', [MediaResourceController::class, 'ictv'])->name('ictv');
Route::get('/iec', [MediaResourceController::class, 'iec'])->name('iec');
Route::get('/modules', [MediaResourceController::class, 'modules'])->name('modules');
Route::get('/newsletter', [MediaResourceController::class, 'newsletter'])->name('newsletter');
Route::get('/tech-portfolio', [MediaResourceController::class, 'techPortfolio'])->name('tech-portfolio');

//Services Controller
Route::get('/promotional', [MainController::class, 'promotionalActivities'])->name('promotional');
Route::get('/podcast', [MainController::class, 'podcast'])->name('podcast');

// Research Controller
Route::get('/agriculture', [ResearchController::class, 'agriculture'])->name('agriculture');
Route::get('/aquaculture', [ResearchController::class, 'aquaculture'])->name('aquaculture');
Route::get('/livestock', [ResearchController::class, 'livestock'])->name('livestock');
Route::get('/livelihood', [ResearchController::class, 'livelihood'])->name('livelihood');
Route::get('/biotechnology', [ResearchController::class, 'biotechnology'])->name('biotechnology');
Route::get('/root-crops', [ResearchController::class, 'rootCrops'])->name('root-crops');
Route::get('/iot', [ResearchController::class, 'iot'])->name('iot');
Route::get('/others', [ResearchController::class, 'others'])->name('others');


// Search Controller
Route::get('/search', [SearchController::class, 'search'])->name('search');



