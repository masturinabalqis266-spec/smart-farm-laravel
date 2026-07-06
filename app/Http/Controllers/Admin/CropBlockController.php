<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CropBlock;
use Illuminate\Http\Request;

class CropBlockController extends Controller
{
    public function index()
    {
        $crops = CropBlock::latest()->get();

        return view('admin.crops.index', compact('crops'));
    }

    public function create()
    {
        return view('admin.crops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'block_name' => 'required|string|max:255',
            'crop_variety' => 'required|string|max:255',
            'tree_count' => 'required|integer|min:1',
            'planting_date' => 'required|date',
            'growth_status' => 'required|in:Seedling,Maturing,Yielding,Harvested,Inactive',
        ]);

        CropBlock::create($request->all());

        return redirect()
            ->route('admin.crops.index')
            ->with('success', 'Crop block added successfully.');
    }

    public function edit(CropBlock $crop)
    {
        return view('admin.crops.edit', compact('crop'));
    }

    public function update(Request $request, CropBlock $crop)
    {
        $request->validate([
            'block_name' => 'required|string|max:255',
            'crop_variety' => 'required|string|max:255',
            'tree_count' => 'required|integer|min:1',
            'planting_date' => 'required|date',
            'growth_status' => 'required|in:Seedling,Maturing,Yielding,Harvested,Inactive',
        ]);

        $crop->update($request->all());

        return redirect()
            ->route('admin.crops.index')
            ->with('success', 'Crop block updated successfully.');
    }

    public function destroy(CropBlock $crop)
    {
        $crop->delete();

        return redirect()
            ->route('admin.crops.index')
            ->with('success', 'Crop block deleted successfully.');
    }
}