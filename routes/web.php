<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AwardeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PencairanController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ProfileController;
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
    return view('pages.landing-page');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('operator')->middleware('role:operator')->group(function () {
        Route::get('', [OperatorController::class, 'index'])->name('operator.index');
        Route::get('create', [OperatorController::class, 'create'])->name('operator.create');
        Route::post('create', [OperatorController::class, 'store']);
        Route::get('{user:uuid}/show', [OperatorController::class, 'show'])->name('operator.show');
        Route::get('{user:uuid}/edit', [OperatorController::class, 'edit'])->name('operator.edit');
        Route::put('{user:uuid}/edit', [OperatorController::class, 'update']);
        Route::delete('{user:uuid}/delete', [OperatorController::class, 'delete'])->name('operator.delete');
    });

    Route::prefix('awardee')->middleware('role:operator')->group(function () {
        Route::get('', [AwardeeController::class, 'index'])->name('awardee.index');
        Route::get('create', [AwardeeController::class, 'create'])->name('awardee.create');
        Route::post('create', [AwardeeController::class, 'store']);
        Route::get('{user:uuid}/show', [AwardeeController::class, 'show'])->name('awardee.show');
        Route::get('{user:uuid}/edit', [AwardeeController::class, 'edit'])->name('awardee.edit');
        Route::put('{user:uuid}/edit', [AwardeeController::class, 'update']);
        Route::delete('{user:uuid}/delete', [AwardeeController::class, 'delete'])->name('awardee.delete');
    });

    Route::prefix('profile')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('settings', [ProfileController::class, 'setting'])->name('profile.setting');
        Route::put('settings', [ProfileController::class, 'saveSetting'])->name('profile.save.setting');
        Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('awardee/edit', [ProfileController::class, 'awardeeUpdate'])->name('profile.awardee.update')->middleware('role:awardee');
        Route::put('operator/edit', [ProfileController::class, 'operatorUpdate'])->name('profile.operator.update')->middleware('role:operator');
    });

    Route::prefix('document')->group(function () {
        Route::get('', [DocumentController::class, 'index'])->name('document.index');
        Route::middleware('role:awardee')->group(function () {
            Route::get('create', [DocumentController::class, 'create'])->name('document.create');
            Route::post('create', [DocumentController::class, 'store']);
            Route::get('{document:uuid}/edit', [DocumentController::class, 'edit'])->name('document.edit');
            Route::put('{document:uuid}/edit', [DocumentController::class, 'update']);
            Route::delete('{document:uuid}', [DocumentController::class, 'delete'])->name('document.delete')->middleware('role:awardee');
        });
        Route::put('{document:uuid}', [DocumentController::class, 'validation'])->name('document.validation')->middleware('role:operator');
        Route::post('document/reminder', [DocumentController::class, 'broadcastWhtasapp'])->name('document.reminder')->middleware('role:operator');
    });

    Route::prefix('pencairan')->group(function () {
        Route::get('', [PencairanController::class, 'index'])->name('pencairan.index');
        Route::middleware('role:operator')->group(function () {
            Route::get('{fund:uuid}', [PencairanController::class, 'show'])->name('pencairan.show');
            Route::get('{fund:uuid}/edit', [PencairanController::class, 'edit'])->name('pencairan.edit');
            Route::put('{fund:uuid}/edit', [PencairanController::class, 'create']);
        });
    });

    Route::prefix('information')->group(function () {
        Route::get('', [InformationController::class, 'index'])->name('information.index');
        Route::middleware('role:operator')->group(function () {
            Route::get('create', [InformationController::class, 'create'])->name('information.create');
            Route::post('create', [InformationController::class, 'store']);
        });
        Route::get('{information:slug}', [InformationController::class, 'show'])->name('information.show');
        Route::middleware('role:operator')->group(function () {
            Route::get('{information:slug}/edit', [InformationController::class, 'edit'])->name('information.edit');
            Route::put('{information:slug}/edit', [InformationController::class, 'update']);
            Route::delete('{information:slug}/delete', [InformationController::class, 'delete'])->name('information.delete');
        });
    });

    Route::prefix('mutation')->group(function () {
        Route::get('', [MutationController::class, 'index'])->name('mutation.index');
        Route::middleware('role:operator')->group(function () {
            Route::get('{mutation:uuid}/edit', [MutationController::class, 'edit'])->name('mutation.edit');
            Route::put('{mutation:uuid}/edit', [MutationController::class, 'update']);
        });
    });

    Route::post('periode', [PeriodController::class, 'store'])->name('period.store')->middleware('role:operator');
    Route::get('penerima', [AwardeeController::class, 'awardeeView'])->middleware('role:awardee');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/dashboard-ecommerce-dashboard', function () {
    return view('pages.dashboard-ecommerce-dashboard', ['type_menu' => 'dashboard']);
});


// Layout
Route::get('/layout-default-layout', function () {
    return view('pages.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});

// Bootstrap
Route::get('/bootstrap-alert', function () {
    return view('pages.bootstrap-alert', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-badge', function () {
    return view('pages.bootstrap-badge', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-breadcrumb', function () {
    return view('pages.bootstrap-breadcrumb', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-buttons', function () {
    return view('pages.bootstrap-buttons', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-card', function () {
    return view('pages.bootstrap-card', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-carousel', function () {
    return view('pages.bootstrap-carousel', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-collapse', function () {
    return view('pages.bootstrap-collapse', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-dropdown', function () {
    return view('pages.bootstrap-dropdown', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-form', function () {
    return view('pages.bootstrap-form', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-list-group', function () {
    return view('pages.bootstrap-list-group', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-media-object', function () {
    return view('pages.bootstrap-media-object', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-modal', function () {
    return view('pages.bootstrap-modal', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-nav', function () {
    return view('pages.bootstrap-nav', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-navbar', function () {
    return view('pages.bootstrap-navbar', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-pagination', function () {
    return view('pages.bootstrap-pagination', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-popover', function () {
    return view('pages.bootstrap-popover', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-progress', function () {
    return view('pages.bootstrap-progress', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-table', function () {
    return view('pages.bootstrap-table', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-tooltip', function () {
    return view('pages.bootstrap-tooltip', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-typography', function () {
    return view('pages.bootstrap-typography', ['type_menu' => 'bootstrap']);
});


// components
Route::get('/components-article', function () {
    return view('pages.components-article', ['type_menu' => 'components']);
});
Route::get('/components-avatar', function () {
    return view('pages.components-avatar', ['type_menu' => 'components']);
});
Route::get('/components-chat-box', function () {
    return view('pages.components-chat-box', ['type_menu' => 'components']);
});
Route::get('/components-empty-state', function () {
    return view('pages.components-empty-state', ['type_menu' => 'components']);
});
Route::get('/components-gallery', function () {
    return view('pages.components-gallery', ['type_menu' => 'components']);
});
Route::get('/components-hero', function () {
    return view('pages.components-hero', ['type_menu' => 'components']);
});
Route::get('/components-multiple-upload', function () {
    return view('pages.components-multiple-upload', ['type_menu' => 'components']);
});
Route::get('/components-pricing', function () {
    return view('pages.components-pricing', ['type_menu' => 'components']);
});
Route::get('/components-statistic', function () {
    return view('pages.components-statistic', ['type_menu' => 'components']);
});
Route::get('/components-tab', function () {
    return view('pages.components-tab', ['type_menu' => 'components']);
});
Route::get('/components-table', function () {
    return view('pages.components-table', ['type_menu' => 'components']);
});
Route::get('/components-user', function () {
    return view('pages.components-user', ['type_menu' => 'components']);
});
Route::get('/components-wizard', function () {
    return view('pages.components-wizard', ['type_menu' => 'components']);
});

// forms
Route::get('/forms-advanced-form', function () {
    return view('pages.forms-advanced-form', ['type_menu' => 'forms']);
});
Route::get('/forms-editor', function () {
    return view('pages.forms-editor', ['type_menu' => 'forms']);
});
Route::get('/forms-validation', function () {
    return view('pages.forms-validation', ['type_menu' => 'forms']);
});

// google maps
// belum tersedia

// modules
Route::get('/modules-calendar', function () {
    return view('pages.modules-calendar', ['type_menu' => 'modules']);
});
Route::get('/modules-chartjs', function () {
    return view('pages.modules-chartjs', ['type_menu' => 'modules']);
});
Route::get('/modules-datatables', function () {
    return view('pages.modules-datatables', ['type_menu' => 'modules']);
});
Route::get('/modules-flag', function () {
    return view('pages.modules-flag', ['type_menu' => 'modules']);
});
Route::get('/modules-font-awesome', function () {
    return view('pages.modules-font-awesome', ['type_menu' => 'modules']);
});
Route::get('/modules-ion-icons', function () {
    return view('pages.modules-ion-icons', ['type_menu' => 'modules']);
});
Route::get('/modules-owl-carousel', function () {
    return view('pages.modules-owl-carousel', ['type_menu' => 'modules']);
});
Route::get('/modules-sparkline', function () {
    return view('pages.modules-sparkline', ['type_menu' => 'modules']);
});
Route::get('/modules-sweet-alert', function () {
    return view('pages.modules-sweet-alert', ['type_menu' => 'modules']);
});
Route::get('/modules-toastr', function () {
    return view('pages.modules-toastr', ['type_menu' => 'modules']);
});
Route::get('/modules-vector-map', function () {
    return view('pages.modules-vector-map', ['type_menu' => 'modules']);
});
Route::get('/modules-weather-icon', function () {
    return view('pages.modules-weather-icon', ['type_menu' => 'modules']);
});

// auth
Route::get('/auth-forgot-password', function () {
    return view('pages.auth-forgot-password', ['type_menu' => 'auth']);
});
Route::get('/auth-login', function () {
    return view('pages.auth-login', ['type_menu' => 'auth']);
});
Route::get('/auth-login2', function () {
    return view('pages.auth-login2', ['type_menu' => 'auth']);
});
Route::get('/auth-register', function () {
    return view('pages.auth-register', ['type_menu' => 'auth']);
});
Route::get('/auth-reset-password', function () {
    return view('pages.auth-reset-password', ['type_menu' => 'auth']);
});

// error
Route::get('/error-403', function () {
    return view('pages.error-403', ['type_menu' => 'error']);
});
Route::get('/error-404', function () {
    return view('pages.error-404', ['type_menu' => 'error']);
});
Route::get('/error-500', function () {
    return view('pages.error-500', ['type_menu' => 'error']);
});
Route::get('/error-503', function () {
    return view('pages.error-503', ['type_menu' => 'error']);
});

// features
Route::get('/features-activities', function () {
    return view('pages.features-activities', ['type_menu' => 'features']);
});
Route::get('/features-post-create', function () {
    return view('pages.features-post-create', ['type_menu' => 'features']);
});
Route::get('/features-post', function () {
    return view('pages.features-post', ['type_menu' => 'features']);
});
Route::get('/features-profile', function () {
    return view('pages.features-profile', ['type_menu' => 'features']);
});
Route::get('/features-settings', function () {
    return view('pages.features-settings', ['type_menu' => 'features']);
});
Route::get('/features-setting-detail', function () {
    return view('pages.features-setting-detail', ['type_menu' => 'features']);
});
Route::get('/features-tickets', function () {
    return view('pages.features-tickets', ['type_menu' => 'features']);
});

// utilities
Route::get('/utilities-contact', function () {
    return view('pages.utilities-contact', ['type_menu' => 'utilities']);
});
Route::get('/utilities-invoice', function () {
    return view('pages.utilities-invoice', ['type_menu' => 'utilities']);
});
Route::get('/utilities-subscribe', function () {
    return view('pages.utilities-subscribe', ['type_menu' => 'utilities']);
});

// credits
Route::get('/credits', function () {
    return view('pages.credits', ['type_menu' => '']);
});
