<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Harvest;
use App\Models\PestReport;
use App\Models\Inventory;
use App\Models\InventoryUsage;
use App\Models\CropBlock;
use App\Models\Pest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WorkerController extends Controller
{
    public function dashboard()
    {
        $workerId = auth()->id();

        $totalTasks = Task::where('user_id', $workerId)->count();

        $pendingTasks = Task::where('user_id', $workerId)
            ->where('status', 'Pending')
            ->count();

        $inProgressTasks = Task::where('user_id', $workerId)
            ->where('status', 'In Progress')
            ->count();

        $completedTasks = Task::where('user_id', $workerId)
            ->where('status', 'Done')
            ->count();

        $totalHarvest = Harvest::where('user_id', $workerId)
            ->sum('yield_kg');

        $totalPestReports = PestReport::where('user_id', $workerId)
            ->count();

        $totalInventoryUsages = InventoryUsage::where('user_id', $workerId)
            ->count();

        $recentTasks = Task::where('user_id', $workerId)
            ->latest()
            ->take(5)
            ->get();

        return view('worker.dashboard.index', compact(
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'totalHarvest',
            'totalPestReports',
            'totalInventoryUsages',
            'recentTasks'
        ));
    }

    public function tasks()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('worker.tasks.index', compact('tasks'));
    }

    public function harvest()
    {
        $cropBlocks = CropBlock::all();

        $harvests = Harvest::with(['cropBlock', 'approvedBy'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('worker.harvest.index', compact('cropBlocks', 'harvests'));
    }

    public function storeHarvest(Request $request)
    {
        $request->validate([
            'crop_block_id' => 'required|exists:crop_blocks,id',
            'harvest_date' => 'required|date',
            'harvest_time' => 'required',
            'yield_kg' => 'required|numeric|min:0',
            'grade' => 'required|in:Grade A,Grade B,Grade C',
            'notes' => 'nullable|string',
        ]);

        Harvest::create([
            'user_id' => auth()->id(),
            'crop_block_id' => $request->crop_block_id,
            'harvest_date' => $request->harvest_date,
            'harvest_time' => $request->harvest_time,
            'yield_kg' => $request->yield_kg,
            'grade' => $request->grade,
            'notes' => $request->notes,
            'approval_status' => 'Pending',
        ]);

        return redirect()
            ->route('worker.harvest.index')
            ->with('success', 'Harvest record submitted for manager approval.');
    }

    public function pest()
    {
        $cropBlocks = CropBlock::all();

        return view('worker.pest_reports.index', compact('cropBlocks'));
    }

    public function storePestReport(Request $request)
{
    $request->validate([
        'crop_block_id' => 'required|exists:crop_blocks,id',
        'pest_type' => 'required|string|max:255',
        'temperature' => 'nullable|numeric',
        'humidity' => 'nullable|numeric',
        'severity' => 'required|string|max:255',
        'remarks' => 'nullable|string',
    ]);

    $report = PestReport::create([
        'user_id' => auth()->id(),
        'crop_block_id' => $request->crop_block_id,
        'pest_type' => $request->pest_type,
        'temperature' => $request->temperature,
        'humidity' => $request->humidity,
        'severity' => $request->severity,
        'remarks' => $request->remarks,
    ]);

    $pest = Pest::where('pest_name', $request->pest_type)->first();

    if ($pest) {
        $pest->update([
            'threat_level' => $request->severity,
        ]);
    } else {
        Pest::create([
            'pest_name' => $request->pest_type,
            'threat_level' => $request->severity,
            'treatment' => 'Treatment not assigned yet.',
        ]);
    }

    $cropBlock = CropBlock::find($request->crop_block_id);

    $message =
        "🚨 SMART FARM PEST ALERT 🚨\n\n" .
        "Pest Type: {$request->pest_type}\n" .
        "Severity: {$request->severity}\n" .
        "Farm Zone: " . ($cropBlock->block_name ?? '-') . "\n" .
        "Temperature: " . ($request->temperature ?? '-') . " °C\n" .
        "Humidity: " . ($request->humidity ?? '-') . " %\n" .
        "Reported By: " . auth()->user()->name . "\n" .
        "Remarks: " . ($request->remarks ?? '-') . "\n" .
        "Date: " . now()->format('d M Y');

    if (strtolower(trim($request->severity)) == 'high') {
    $this->sendTelegramMessage($message);
}

    return redirect()
        ->route('worker.pest_reports.index')
        ->with('success', 'Pest report submitted successfully.');
}
    public function inventory()
    {
        $inventories = Inventory::all();

        $usages = InventoryUsage::with(['inventory', 'user'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('worker.inventory.index', compact('inventories', 'usages'));


    }
    
    public function storeInventoryUsage(Request $request)
{
    $request->validate([
        'inventory_id' => 'required|exists:inventories,id',
        'quantity_used' => 'required|integer|min:1',
        'remarks' => 'nullable|string',
    ]);

    $inventory = Inventory::findOrFail($request->inventory_id);

    if ($request->quantity_used > $inventory->current_stock) {
        return back()->with('error', 'Quantity used is more than current stock.');
    }

    InventoryUsage::create([
        'user_id' => auth()->id(),
        'inventory_id' => $inventory->id,
        'quantity_used' => $request->quantity_used,
        'remarks' => $request->remarks,
    ]);

    $inventory->update([
        'current_stock' => $inventory->current_stock - $request->quantity_used,
    ]);

    $inventory->refresh();

    if ($inventory->current_stock <= $inventory->minimum_stock) {
        $message =
            " 📍 LOW STOCK REMINDER \n\n" .
            "Item Name: {$inventory->item_name}\n" .
            "Category: {$inventory->category}\n" .
            "Current Stock: {$inventory->current_stock} {$inventory->unit}\n" .
            "Minimum Stock: {$inventory->minimum_stock} {$inventory->unit}\n" .
            "Used Quantity: {$request->quantity_used} {$inventory->unit}\n" .
            "Used By: " . auth()->user()->name . "\n" .
            "Remarks: " . ($request->remarks ?? '-') . "\n" .
            "Date: " . now()->format('d M Y');

        $this->sendTelegramMessage($message);
    }

    return redirect()
        ->route('worker.inventory.index')
        ->with('success', 'Inventory usage submitted successfully.');
}

    public function updateTaskStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Done',
        ]);

        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Task status updated successfully.');
    }

    private function sendTelegramMessage($message)
{
    $botToken = config('services.telegram.bot_token');
    $chatId = config('services.telegram.chat_id');

    if (!$botToken || !$chatId) {
        return;
    }

    Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
        'chat_id' => $chatId,
        'text' => $message,
    ]);
}
}