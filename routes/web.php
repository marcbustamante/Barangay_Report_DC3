<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\IncidentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('incidents.index');
    })->name('dashboard');

    Route::resource('incidents', IncidentController::class);

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [IncidentController::class, 'adminDashboard'])->name('admin.index');
        Route::get('/admin/reports', [IncidentController::class, 'adminIndex'])->name('admin.reports');
        Route::put('/admin/reports/{incident}/resolve', [IncidentController::class, 'markResolved'])->name('admin.reports.resolve');
    });
});

Route::delete('/incidents/{id}', [IncidentController::class, 'destroy'])->name('incidents.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
