<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommodityController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\ICTVController;
use App\Http\Controllers\IECMaterialController;
use App\Http\Controllers\Kmu_thesisController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MediaResourceController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DemographicController;
// Uploading Controllers
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\PromotionalActivityController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::post('/demographic/store', [DemographicController::class, 'store']);
Route::get('/admin/visitors', [DemographicController::class, 'index'])->name('admin.visitors');
Route::get('/dashboard', [DemographicController::class, 'index'])->name('dashboard');
Route::delete('admin/demographics/{id}', [DemographicController::class, 'destroy']);

use App\Http\Controllers\PostController;

Route::get('/updates', [PostController::class, 'index'])->name('updates.index');
Route::post('/admin/posts/{id}/approve', [PostController::class, 'approve'])->name('admin.posts.approve');
Route::prefix('admin')->group(function () {
    Route::get('/upload-updates', [PostController::class, 'adminIndex'])->name('admin.upload-updates');
    Route::post('/updates', [PostController::class, 'store'])->name('admin.updates.store');
    Route::get('/updates/{post}/edit', [PostController::class, 'edit'])->name('admin.updates.edit');
    Route::put('/updates/{post}', [PostController::class, 'update'])->name('admin.updates.update');
    Route::delete('/updates/{post}', [PostController::class, 'destroy'])->name('admin.updates.destroy');
});



use App\Http\Controllers\SdgController;

Route::get('/sdgs', [SdgController::class, 'index']);
Route::get('/sdg-gallery/{sdg}', [SdgController::class, 'show'])
    ->name('sdg.gallery');
Route::get('/sdg/{sdg}', [SdgController::class, 'show'])->name('sdg.show');


use App\Http\Controllers\SdgAdminController;

// SDG MAIN PAGE (description editing)
Route::get('/admin/sdg', [SdgAdminController::class, 'index'])
    ->name('admin.sdg.index');

// SDG MEDIA UPLOAD PAGE
Route::get('/admin/sdg/media', [SdgAdminController::class, 'mediaIndex'])
    ->name('admin.sdg.media');

// SDG MEDIA STORE
Route::post('/admin/sdg/media/store', [SdgAdminController::class, 'mediaStore'])
    ->name('admin.sdg.media.store');
Route::put('/admin/sdg/media/{media}', [SdgAdminController::class, 'mediaUpdate']);
Route::delete('/admin/sdg/media/{media}', [SdgAdminController::class, 'mediaDestroy']);


// For upload page

// All records page
Route::get('/admin/database/records', [DatabaseController::class, 'allRecords'])
    ->name('admin.database.records');
// Update record
Route::put('admin/database/records/{id}', [DatabaseController::class, 'updateRecord'])
    ->name('admin.database.update');
// notification dot
Route::get('/admin/dashboard', [AdminController::class, 'dot'])->name('admin.dashboard');

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

Route::prefix('admin')->group(function () {
    Route::get('/account-settings', [AccountController::class, 'index'])->name('admin.account-settings');
    Route::post('/account-settings/create', [AccountController::class, 'store'])->name('admin.account.store');
    Route::put('/account-settings/update', [AccountController::class, 'update'])->name('admin.account.update');
    Route::delete('/account-settings/{id}', [AccountController::class, 'destroy'])->name('admin.account.destroy');
});

// logout
Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
})->name('admin.logout');

Route::get('/videos/{type}/{id?}', [VideoController::class, 'show'])->name('video.show');

// Uploads for ICTV
Route::post('/ictv/upload', [ICTVController::class, 'upload'])->name('ictv.upload');
Route::get('/ictv-table', [ICTVController::class, 'table'])->name('ictv-table');
Route::delete('/admin/ictv/{id}', [ICTVController::class, 'destroy'])->name('admin.ictv.destroy');
Route::put('/admin/ictv/{id}', [ICTVController::class, 'update'])->name('ictv.update');

// Upload for IEC
Route::post('/admin/iec/upload', [IECMaterialController::class, 'upload'])->name('admin.iec.upload');
Route::get('/admin/iec-table', [IECMaterialController::class, 'index'])->name('admin.iec-table');
Route::delete('/iec-materials/{id}', [IECMaterialController::class, 'destroy'])->name('iec-materials.destroy');
Route::put('/iec-materials/{id}', [IECMaterialController::class, 'update'])->name('iec.update');

// Upload for Modules
Route::post('/admin/modules/upload', [ModuleController::class, 'upload'])->name('admin.modules.upload');
Route::get('/admin/modules-table', [ModuleController::class, 'table'])->name('admin.modules-table');
Route::delete('/admin/modules/{id}', [ModuleController::class, 'destroy'])->name('admin.modules.destroy');
Route::put('/admin/modules/{id}', [ModuleController::class, 'update'])->name('admin.modules.update');

// upload for newsletter
Route::post('/admin/newsletter/upload', [NewsletterController::class, 'upload'])->name('admin.newsletter.upload');
Route::get('/admin/newsletter-table', [NewsletterController::class, 'table'])->name('admin.newsletter-table');
Route::delete('/admin/newsletters/{id}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');
Route::put('/admin/newsletters/{id}', [NewsletterController::class, 'update'])->name('newsletters.update');

// upload for Promotional Activities
Route::post('/admin/promotionalactivities/upload', [PromotionalActivityController::class, 'store'])->name('admin.promotional.upload');
Route::get('/promotionalactivities-table', [PromotionalActivityController::class, 'table'])->name('admin.promotionalactivities-table');
Route::delete('/admin/promotionalactivities/{id}', [PromotionalActivityController::class, 'destroy'])->name('promotionalactivities.destroy');
Route::put('/admin/promotional/{id}', [PromotionalActivityController::class, 'update'])->name('promotional.update');

// upload for podcast
Route::post('/admin/podcasts/store', [PodcastController::class, 'store'])->name('admin.podcast.store');
Route::get('/podcast-table', [PodcastController::class, 'table'])->name('admin.podcast-table');
Route::delete('/podcasts/{id}', [PodcastController::class, 'destroy'])->name('podcast.destroy');
Route::put('/admin/podcast/{id}', [PodcastController::class, 'update'])->name('admin.podcast.update');

// recent activities
Route::delete('/admin/recent-activities/{id}', [AdminController::class, 'deleteRecentActivity'])->name('admin.recent-activities.delete');
Route::get('/admin/recent-activities', [AdminController::class, 'recentActivitiesTable'])->name('admin.recent-activities');
Route::delete('/recent-activities/delete-all', [AdminController::class, 'deleteAll'])->name('recent-activities.deleteAll');

// New research aquired

Route::get('/admin/new-research', function () {
    return view('admin.new-research');
})->name('admin.new-research');

// ---------------------------------New Research Added
// Show Add Research form
Route::get('/admin/new-research', [ThesisController::class, 'index'])->name('admin.new-research');

// For research Team
Route::get('/admin/add-thesis', [ThesisController::class, 'addThesis'])->name('admin.add-thesis');

Route::delete('/admin/add-thesis/{id}', [ThesisController::class, 'destroy'])->name('admin.add-thesis.destroy');
// add new research from kmu
Route::post('/admin/add-thesis/store', [ThesisController::class, 'store'])->name('admin.add-thesis.store');

// destroy for kmu
Route::delete('/admin/new-research/{id}', [ThesisController::class, 'destroy'])
    ->name('admin.new-research.destroy');
Route::post('/admin/new-research/{id}/acknowledge', [ThesisController::class, 'acknowledge'])
    ->name('admin.new-research.acknowledge');

// add new research from research
Route::post('/admin/add-thesis/storetokmu', [Kmu_thesisController::class, 'storetokmu'])->name('admin.add-thesis.storetokmu');
// badge showing
Route::get('/admin/new-research', [Kmu_thesisController::class, 'index'])->name('admin.new-research');
// KMU to iptbm
Route::post('/admin/push-to-iptbm', [Kmu_thesisController::class, 'pushToIptbm'])
    ->name('admin.pushToIptbm');

// for extension
Route::post('/extensions/push/{id}', [ExtensionController::class, 'pushToExtension'])->name('extensions.push');
Route::get('/admin/extensions', [ExtensionController::class, 'index'])
    ->name('admin.extensions.index');
Route::delete('/admin/extensions/delete/{id}', [ExtensionController::class, 'destroy'])
    ->name('admin.extensions.destroy');

Route::post('/admin/extensions/push/{id}', [ExtensionController::class, 'pushfromrecords'])->name('admin.extensions.push');

// technology admin
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



// By clicking the learn more button from index, it will increment the page view counter and redirect to the homepage
Route::get('/learn-more', function () {
    // Increment counter
    DB::table('page_views')->increment('count');

    // Redirect to home
    return redirect('/home');
});

// For Commodity Database

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
Route::delete('/admin/notifications/{id}', [NotificationController::class, 'destroy'])
    ->name('notifications.destroy');

Route::get('/admin/database/show/{filter}', [CommodityController::class, 'show'])
    ->name('admin.database.show');

Route::get('/admin/database/priority/{priority_area}', [CommodityController::class, 'showByPriority'])
    ->name('admin.database.priority.show');

// Add this for activity log
Route::get('/admin/database/activities', [CommodityController::class, 'activities'])
    ->name('admin.database.activity');
// Delete single activity
Route::delete('/activities/{id}', [CommodityController::class, 'deleteActivity'])->name('activities.delete');

// Clear all activities
Route::delete('/activities', [CommodityController::class, 'clearAllActivities'])->name('activities.clearAll');

// Graphs
Route::get('/admin/database/graphs', [CommodityController::class, 'graphs'])
    ->name('admin.database.graphs');

// View page for commodities
Route::get('/admin/database/view-ip-applied', [CommodityController::class, 'view'])
    ->middleware('guest')
    ->name('admin.database.view-ip-applied');

// ---------------------------------------------------------------------------notif

Route::prefix('admin')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications');
    Route::post('/notifications/push/{id}', [NotificationController::class, 'pushFromCommodity'])->name('notifications.push');
    Route::delete('/notifications/revert/{id}', [NotificationController::class, 'revertPush'])->name('notifications.revert');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

// applied
Route::get('/admin/registered-technology', [RegisteredController::class, 'index'])
    ->name('admin.registered-technology');
// pushing applied
Route::post('/admin/registered-technology/store', [RegisteredController::class, 'store'])
    ->name('admin.registered-technology.store');
// destroy applied
Route::delete('/admin/registered-technology/{id}', [RegisteredController::class, 'destroy'])
    ->name('admin.registered-technology.destroy');

// ✅ This route renders the view
Route::get('/admin/database/view-regtech', [RegisteredController::class, 'table'])
    ->name('admin.database.view-regtech');

// for redirect using the secret code
Route::get('/143123', function () {
    return redirect()->route('admin.login'); // if you named the admin login route
    // or return redirect('/admin/login'); if you use the direct path
});

// For main controller
Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/plagscan', [MainController::class, 'plagscan'])->name('plagscan');
Route::get('/iptbm', [MainController::class, 'iptbm'])->name('iptbm');
Route::get('/tbi', [MainController::class, 'tbi'])->name('tbi');
// media resources controller
Route::get('/ictv', [MediaResourceController::class, 'ictv'])->name('ictv');
Route::get('/iec', [MediaResourceController::class, 'iec'])->name('iec');
Route::get('/modules', [MediaResourceController::class, 'modules'])->name('modules');
Route::get('/newsletter', [MediaResourceController::class, 'newsletter'])->name('newsletter');
Route::get('/tech-portfolio', [MediaResourceController::class, 'techPortfolio'])->name('tech-portfolio');

// Services Controller
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


use App\Http\Controllers\StudentThesisController;

Route::get('/upload-thesis', function () {
    return view('media-resources-section.thesis_upload');})->name('thesis.form');
    Route::get('/admin/student-research/theses/{id}', [StudentThesisController::class, 'show']);

Route::post('/upload-thesis', [StudentThesisController::class, 'upload'])->name('thesis.upload');
// Route for final submission
Route::post('/submit-thesis', [StudentThesisController::class, 'submit'])->name('thesis.submit');
Route::get('/admin/student-research/theses', [StudentThesisController::class, 'index'])->name('admin.thesis-papers');
// New routes for update & delete
Route::post('/admin/student-research/theses/update/{thesis}', [StudentThesisController::class, 'update'])->name('thesis.update');
Route::delete('/admin/student-research/theses/delete/{thesis}', [StudentThesisController::class, 'destroy'])->name('thesis.delete');

