<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CropBlockController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\PestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    if (auth()->user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    if (auth()->user()->role === 'manager') {
        return redirect('/manager/dashboard');
    }

    return redirect('/worker/dashboard');

})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/crops', [CropBlockController::class, 'index'])
            ->name('crops.index');

        Route::get('/inventories', [InventoryController::class, 'index'])
            ->name('inventories.index');

        Route::get('/pests', [PestController::class, 'index'])
            ->name('pests.index');

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}/edit', [UserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('users.update');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');

        Route::get('/crops', [CropBlockController::class, 'index'])
        ->name('crops.index');

        Route::get('/crops/create', [CropBlockController::class, 'create'])
            ->name('crops.create');

        Route::post('/crops', [CropBlockController::class, 'store'])
            ->name('crops.store');

        Route::get('/crops/{crop}/edit', [CropBlockController::class, 'edit'])
            ->name('crops.edit');

        Route::put('/crops/{crop}', [CropBlockController::class, 'update'])
            ->name('crops.update');

        Route::delete('/crops/{crop}', [CropBlockController::class, 'destroy'])
            ->name('crops.destroy');

        Route::get('/harvest', [ManagerController::class, 'harvest'])
            ->name('harvest.index');

        Route::put('/harvest/{harvest}/approve', [ManagerController::class, 'approveHarvest'])
            ->name('harvest.approve');

        Route::put('/harvest/{harvest}/reject', [ManagerController::class, 'rejectHarvest'])
            ->name('harvest.reject');

        Route::get('/inventories', [InventoryController::class, 'index'])
        ->name('inventories.index');

        Route::get('/inventories/create', [InventoryController::class, 'create'])
            ->name('inventories.create');

        Route::post('/inventories', [InventoryController::class, 'store'])
            ->name('inventories.store');

        Route::get('/inventories/{inventory}/edit', [InventoryController::class, 'edit'])
            ->name('inventories.edit');

        Route::put('/inventories/{inventory}', [InventoryController::class, 'update'])
            ->name('inventories.update');

        Route::delete('/inventories/{inventory}', [InventoryController::class, 'destroy'])
            ->name('inventories.destroy');

        Route::get('/pests', [PestController::class, 'index'])
    ->name('pests.index');

Route::get('/pests/create', [PestController::class, 'create'])
    ->name('pests.create');

Route::post('/pests', [PestController::class, 'store'])
    ->name('pests.store');

Route::get('/pests/{pest}/edit', [PestController::class, 'edit'])
    ->name('pests.edit');

Route::put('/pests/{pest}', [PestController::class, 'update'])
    ->name('pests.update');

Route::delete('/pests/{pest}', [PestController::class, 'destroy'])
    ->name('pests.destroy');
            });

Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {

        Route::get('/dashboard', [ManagerController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/tasks', [ManagerController::class, 'tasks'])
            ->name('tasks.index');

        Route::post('/tasks', [ManagerController::class, 'storeTask'])
            ->name('tasks.store');

        Route::get('/crops', [ManagerController::class, 'crops'])
            ->name('crops.index');

        Route::get('/reports', [ManagerController::class, 'reports'])
            ->name('reports.index');

        Route::put('/reports/{report}', [ManagerController::class, 'updateReportStatus'])
            ->name('reports.update');

        Route::get('/analytics', [ManagerController::class, 'analytics'])
            ->name('analytics.index');

        // Harvest
        Route::get('/harvest', [ManagerController::class, 'harvest'])
            ->name('harvest.index');

        Route::put('/harvest/{harvest}/approve', [ManagerController::class, 'approveHarvest'])
            ->name('harvest.approve');

        Route::put('/harvest/{harvest}/reject', [ManagerController::class, 'rejectHarvest'])
            ->name('harvest.reject');

        Route::get('/export', [ManagerController::class, 'export'])
            ->name('export.index');

        Route::get('/export/harvest/pdf', [ManagerController::class, 'exportHarvestPdf'])
            ->name('export.harvest.pdf');

        Route::get('/export/pest/pdf', [ManagerController::class, 'exportPestPdf'])
            ->name('export.pest.pdf');

        Route::get('/export/inventory/pdf', [ManagerController::class, 'exportInventoryPdf'])
            ->name('export.inventory.pdf');
    });

Route::middleware(['auth', 'role:worker'])
    ->prefix('worker')
    ->name('worker.')
    ->group(function () {

        Route::get('/dashboard', [WorkerController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/tasks', [WorkerController::class, 'tasks'])
            ->name('tasks.index');

        Route::put('/tasks/{task}/status', [WorkerController::class, 'updateTaskStatus'])
            ->name('tasks.updateStatus');

        Route::get('/harvest', [WorkerController::class, 'harvest'])
            ->name('harvest.index');

        Route::post('/harvest', [WorkerController::class, 'storeHarvest'])
            ->name('harvest.store');

        // Pest Report
Route::get('/pest-reports', [WorkerController::class, 'pest'])
    ->name('pest_reports.index');

Route::post('/pest-reports', [WorkerController::class, 'storePestReport'])
    ->name('pest_reports.store');

        Route::get('/inventory', [WorkerController::class, 'inventory'])
            ->name('inventory.index');

        Route::post('/inventory-usages', [WorkerController::class, 'storeInventoryUsage'])
            ->name('inventory_usages.store');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';