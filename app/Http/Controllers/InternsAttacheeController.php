<?php

namespace App\Http\Controllers;

use App\Models\InternsAttachee;
use Illuminate\Http\Request;

class InternsAttacheeController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = request('per_page', 10);

        $interns = InternsAttachee::when($search, function ($query) use ($search) {
            return $query->where('full_name', 'like', "%{$search}%")
                        ->orWhere('id_number', 'like', "%{$search}%")
                        ->orWhere('institution', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%");
        })->latest()->paginate($perPage);

        return view('interns_attachees.index', compact('interns', 'search', 'perPage'));
    }

    public function create()
    {
        return view('interns_attachees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:50',
            'phone' => 'nullable|string|max:20',
            'institution' => 'required|string|max:255',
            'purpose' => 'required|string',
            'department' => 'required|string|max:255',
            'signature' => 'required|string|max:255',
        ]);

        $validated['check_in_time'] = now();
        $validated['status'] = 'IN';

        InternsAttachee::create($validated);

        return redirect()->route('interns_attachees.index')->with('success', 'Intern/Attachee checked in successfully.');
    }

    public function show(InternsAttachee $internsAttachee)
    {
        return view('interns_attachees.show', compact('internsAttachee'));
    }

    public function edit(InternsAttachee $internsAttachee)
    {
        return view('interns_attachees.edit', compact('internsAttachee'));
    }

    public function update(Request $request, InternsAttachee $internsAttachee)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'id_number' => 'required|unique:interns_attachees,id_number,' . $internsAttachee->id,
            'phone' => 'nullable|string|max:20',
            'institution' => 'required|string|max:255',
            'purpose' => 'required|string',
            'department' => 'required|string|max:255',
            'status' => 'required|in:IN,OUT',
            'signature' => 'nullable|string|max:255',
        ]);

        if ($request->filled('status') && $request->status === 'OUT' && $internsAttachee->status === 'IN') {
            $validated['check_out_time'] = now();
        }

        $internsAttachee->update($validated);

        return redirect()->route('interns_attachees.index')->with('success', 'Intern/Attachee updated successfully.');
    }

    public function checkout(InternsAttachee $internsAttachee)
    {
        $internsAttachee->update([
            'status' => 'OUT',
            'check_out_time' => now(),
        ]);

        return redirect()->route('interns_attachees.index')->with('success', 'Intern/Attachee checked out successfully.');
    }

    public function destroy(InternsAttachee $internsAttachee)
    {
        $internsAttachee->delete();

        return redirect()->route('interns_attachees.index')->with('success', 'Intern/Attachee record deleted successfully.');
    }

    /**
     * API endpoint to retrieve intern/attachee details by ID for auto-fill
     */
    public function getInternsDetails(Request $request)
    {
        $idNumber = $request->query('id_number');
        
        if (!$idNumber) {
            return response()->json(['error' => 'ID number required'], 400);
        }

        $intern = InternsAttachee::where('id_number', $idNumber)
                                ->latest()
                                ->first();

        if (!$intern) {
            return response()->json(['error' => 'Intern/Attachee not found'], 404);
        }

        return response()->json([
            'full_name' => $intern->full_name,
            'phone' => $intern->phone,
            'institution' => $intern->institution,
            'department' => $intern->department,
        ]);
    }
}
