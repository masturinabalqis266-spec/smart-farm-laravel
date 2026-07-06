<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pest;
use Illuminate\Http\Request;

class PestController extends Controller
{
    public function index()
    {
        $pests = Pest::latest()->get();

        return view('admin.pests.index', compact('pests'));
    }

    public function create()
    {
        return view('admin.pests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pest_name' => 'required|string|max:255',
            'threat_level' => 'required|in:Low,Medium,High',
            'treatment' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'detection_count' => 'required|integer|min:0',
        ]);

        Pest::create($request->only([
            'pest_name',
            'threat_level',
            'treatment',
            'location',
            'detection_count',
        ]));

        return redirect()->route('admin.pests.index')
            ->with('success', 'Pest data added successfully.');
    }

    public function edit(Pest $pest)
    {
        return view('admin.pests.edit', compact('pest'));
    }

    public function update(Request $request, Pest $pest)
    {
        $request->validate([
            'pest_name' => 'required|string|max:255',
            'threat_level' => 'required|in:Low,Medium,High',
            'treatment' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

     $pest->update($request->only([
    'pest_name',
    'threat_level',
    'treatment',
    'location',
]));

        return redirect()->route('admin.pests.index')
            ->with('success', 'Pest data updated successfully.');
    }

    public function destroy(Pest $pest)
    {
        $pest->delete();

        return redirect()->route('admin.pests.index')
            ->with('success', 'Pest data deleted successfully.');
    }
}