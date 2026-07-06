<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\CropBlock;
use App\Models\PestReport;
use App\Models\Harvest;
use App\Models\Inventory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function dashboard()
{
    $totalTasks = Task::count();
    $pendingTasks = Task::where('status', 'Pending')->count();
    $totalPestReports = PestReport::count();
    $totalHarvest = Harvest::sum('yield_kg');

    return view('manager.dashboard.index', compact(
        'totalTasks',
        'pendingTasks',
        'totalPestReports',
        'totalHarvest'
    ));
}

    public function tasks()
{
    $tasks = Task::with(['user', 'cropBlock'])->latest()->get();
    $workers = User::where('role', 'worker')->where('status', 'Active')->get();
    $cropBlocks = CropBlock::all();

    return view('manager.tasks.index', [
        'tasks' => $tasks,
        'workers' => $workers,
        'cropBlocks' => $cropBlocks,
    ]);
}

    public function storeTask(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'crop_block_id' => 'required|exists:crop_blocks,id',
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'task_date' => 'required|date',
            'status' => 'required|in:Pending,In Progress,Done',
        ]);

        Task::create($request->all());

        return back()->with('success', 'Task assigned successfully.');
    }

 public function crops(Request $request)
{
    $query = CropBlock::query();

    if ($request->filled('block_name')) {
        $query->where('block_name', 'like', '%' . $request->block_name . '%');
    }

    if ($request->filled('crop_variety')) {
        $query->where('crop_variety', $request->crop_variety);
    }

    if ($request->filled('growth_status')) {
        $query->where('growth_status', $request->growth_status);
    }

    $cropBlocks = $query->latest()->get();

    $varieties = CropBlock::select('crop_variety')
        ->whereNotNull('crop_variety')
        ->distinct()
        ->pluck('crop_variety');

    return view('manager.crops.index', compact(
        'cropBlocks',
        'varieties'
    ));
}

    public function reports()
{
    $reports = PestReport::with(['user', 'cropBlock'])
        ->latest()
        ->get();

    return view('manager.reports.index', compact('reports'));
}

public function updateReportStatus(Request $request, PestReport $report)
{
    $request->validate([
        'severity' => 'required|in:Low,Medium,High',
    ]);

    $report->update([
        'severity' => $request->severity,
    ]);

    return redirect()
        ->route('manager.reports.index')
        ->with('success', 'Report reviewed successfully.');
}

   public function analytics()
{
    $harvests = \App\Models\Harvest::all();
    $pestReports = \App\Models\PestReport::all();

    $taskStatus = \App\Models\Task::select('status', \DB::raw('count(*) as total'))
        ->groupBy('status')
        ->pluck('total', 'status');

    $pestSeverity = \App\Models\PestReport::select('severity', \DB::raw('count(*) as total'))
        ->groupBy('severity')
        ->pluck('total', 'severity');

    $pestTypes = \App\Models\PestReport::select('pest_type', \DB::raw('count(*) as total'))
        ->groupBy('pest_type')
        ->pluck('total', 'pest_type');

    $harvestByGrade = \App\Models\Harvest::select('grade', \DB::raw('sum(yield_kg) as total'))
        ->groupBy('grade')
        ->pluck('total', 'grade');

    return view('manager.analytics.index', compact(
        'harvests',
        'pestReports',
        'taskStatus',
        'pestSeverity',
        'pestTypes',
        'harvestByGrade'
    ));
}

  public function harvest(Request $request)
{
    $query = Harvest::with(['user', 'cropBlock', 'approvedBy']);

    if ($request->filled('grade')) {
        $query->where('grade', $request->grade);
    }

    if ($request->filled('crop_block_id')) {
        $query->where('crop_block_id', $request->crop_block_id);
    }

    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    $harvests = $query->latest()->get();

    $cropBlocks = CropBlock::all();

    $totalRecords = $harvests->count();
    $totalYield = $harvests->sum('yield_kg');
    $averageYield = $totalRecords > 0 ? $totalYield / $totalRecords : 0;
    $gradeARecords = $harvests->where('grade', 'Grade A')->count();

    return view('manager.harvest.index', compact(
        'harvests',
        'cropBlocks',
        'totalRecords',
        'totalYield',
        'averageYield',
        'gradeARecords'
    ));
}

public function approveHarvest(Harvest $harvest)
{
    $harvest->update([
        'approval_status' => 'Approved',
        'approved_by' => auth()->id(),
        'approved_at' => now(),
    ]);

    return back()->with('success', 'Harvest record approved successfully.');
}

public function rejectHarvest(Harvest $harvest)
{
    $harvest->update([
        'approval_status' => 'Rejected',
        'approved_by' => auth()->id(),
        'approved_at' => now(),
    ]);

    return back()->with('success', 'Harvest record rejected.');
}

    public function export()
{
    return view('manager.export.index');
}

public function exportHarvestPdf()
{
    $harvests = Harvest::with(['user', 'cropBlock'])
        ->latest()
        ->get();

    $fileName = 'harvest-report-' . now()->format('Ymd-His') . '.pdf';

    $pdf = Pdf::loadView('manager.export.pdf.harvest', compact('harvests'))
        ->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

    Storage::disk('public')->put('reports/' . $fileName, $pdf->output());

    return $pdf->stream($fileName);
}
public function exportPestPdf()
{
    $reports = PestReport::with(['user', 'cropBlock'])
        ->latest()
        ->get();

    $fileName = 'pest-report-' . now()->format('Ymd-His') . '.pdf';

    $pdf = Pdf::loadView('manager.export.pdf.pest', compact('reports'))
        ->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

    Storage::disk('public')->put('reports/' . $fileName, $pdf->output());

    return $pdf->stream($fileName);
}

public function exportInventoryPdf()
{
    $inventories = Inventory::latest()->get();

    $fileName = 'inventory-report-' . now()->format('Ymd-His') . '.pdf';

    $pdf = Pdf::loadView('manager.export.pdf.inventory', compact('inventories'))
        ->setPaper('a4', 'landscape')
        ->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

    Storage::disk('public')->put('reports/' . $fileName, $pdf->output());

    return $pdf->stream($fileName);
}
}