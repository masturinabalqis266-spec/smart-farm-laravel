<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::latest()->get();

        return view('admin.inventories.index', compact('inventories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|in:Fertilizers,Pesticides,Packaging,Tools,Other',
            'current_stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'supplier' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Inventory::create([
            'item_name' => $request->item_name,
            'category' => $request->category,
            'current_stock' => $request->current_stock,
            'minimum_stock' => $request->minimum_stock,
            'unit' => $request->unit,
            'supplier' => $request->supplier,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.inventories.index')
            ->with('success', 'Inventory item added successfully.');
    }

    public function edit(Inventory $inventory)
    {
        return view('admin.inventories.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|in:Fertilizers,Pesticides,Packaging,Tools,Other',
            'current_stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:50',
            'supplier' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $inventory->update([
            'item_name' => $request->item_name,
            'category' => $request->category,
            'current_stock' => $request->current_stock,
            'minimum_stock' => $request->minimum_stock,
            'unit' => $request->unit,
            'supplier' => $request->supplier,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.inventories.index')
            ->with('success', 'Inventory item updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()
            ->route('admin.inventories.index')
            ->with('success', 'Inventory item deleted successfully.');
    }
}