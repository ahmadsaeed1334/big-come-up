<?php

use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Admin\AffiliatePayoutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompetitionController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\EntryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoteController;
use App\Http\Controllers\Admin\WinnerPayoutController;
use App\Http\Controllers\Affiliate\DashboardController;
use App\Http\Controllers\Affiliate\TrackController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/', 'user-side.home.home')->name('user.home');
Route::view('/competitions', 'user-side.competitions.index')->name('competitios.index');
Route::view('/competitions/show', 'user-side.competitions.show')->name('competitios.show');
Route::view('/competitions/profile', 'user-side.competitions.profile')->name('competitios.profile');
Route::view('/competitions/details', 'user-side.competitions.submission-details.index')->name('competitios.submission-detsils.index');
Route::view('/artists/djs', 'user-side.artists.djs')->name('artists.djs');
Route::view('/judges/show', 'user-side.judges.show')->name('judges.show');

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
        Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('competitions', CompetitionController::class);
    });

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('entries', EntryController::class);
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('votes', [VoteController::class, 'index'])->name('votes.index');
        Route::delete('votes/{vote}', [VoteController::class, 'destroy'])->name('votes.destroy');
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('winner-payouts', WinnerPayoutController::class);
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('reports', ReportController::class);
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('orders', OrderController::class);
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('payments', PaymentController::class);
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('coupons', CouponController::class);
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle', [UserController::class, 'toggle'])
            ->name('users.toggle');
    });
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('affiliates', AffiliateController::class);
        Route::patch('affiliates/{affiliate}/toggle', [AffiliateController::class, 'toggle'])
            ->name('affiliates.toggle');

        Route::resource('affiliate-payouts', AffiliatePayoutController::class);
    });
Route::get('/ref/{code}', TrackController::class)->name('affiliate.track');

Route::middleware(['auth'])->prefix('affiliate')->name('affiliate.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/referrals', [DashboardController::class, 'referrals'])->name('referrals');
    Route::get('/payouts', [DashboardController::class, 'payouts'])->name('payouts');
});
