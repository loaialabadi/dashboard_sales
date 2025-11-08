<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
        ]);

        Branch::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('branches.index')->with('success', 'تم إضافة الفرع بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Branch::findOrFail($id);
        return view('branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('branches.index')->with('success', 'تم تحديث الفرع بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')->with('success', 'تم حذف الفرع بنجاح.');
    }
}
