<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = request('per_page', 10);

        $visitors = Visitor::when($search, function ($query) use ($search) {
            return $query->where('full_name', 'like', "%{$search}%")
                        ->orWhere('id_number', 'like', "%{$search}%")
                        ->orWhere('host_name', 'like', "%{$search}%");
        })->latest()->paginate($perPage);

        return view('visitors.index', compact('visitors', 'search', 'perPage'));
    }

    public function create()
    {
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'id_number' => 'required|unique:visitors',
            'phone' => 'nullable',
            'organization' => 'nullable',
            'host_name' => 'required',
            'department' => 'required',
            'purpose' => 'required',
        ]);

        $validated['check_in_time'] = now();
        $validated['status'] = 'IN';

        Visitor::create($validated);

        return redirect()->route('visitors.index')->with('success', 'Visitor checked in successfully.');
    }

    public function show(Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', compact('visitor'));
    }

    public function update(Request $request, Visitor $visitor)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'id_number' => 'required|unique:visitors,id_number,' . $visitor->id,
            'phone' => 'nullable',
            'organization' => 'nullable',
            'host_name' => 'required',
            'department' => 'required',
            'purpose' => 'required',
            'status' => 'required|in:IN,OUT',
        ]);

        if ($request->filled('status') && $request->status === 'OUT' && $visitor->status === 'IN') {
            $validated['check_out_time'] = now();
        }

        $visitor->update($validated);

        return redirect()->route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->route('visitors.index')->with('success', 'Visitor deleted successfully.');
    }
}
