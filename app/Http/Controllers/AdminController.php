<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CropBlock;
use App\Models\Inventory;
use App\Models\PestReport;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalWorkers = User::where('role', 'worker')->count();
        $totalManagers = User::where('role', 'manager')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        $totalCropBlocks = CropBlock::count();
        $totalInventory = Inventory::count();
        $totalPestReports = PestReport::count();

        // Change this if you have a Harvest model
        $totalHarvest = 0;

        // Change these if you have a Task model
        $activeTasks = 0;
        $completedTasks = 0;

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalWorkers',
            'totalManagers',
            'totalAdmins',
            'totalCropBlocks',
            'totalInventory',
            'totalPestReports',
            'totalHarvest',
            'activeTasks',
            'completedTasks'
        ));
    }
}