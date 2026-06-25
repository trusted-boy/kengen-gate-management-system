<?php

namespace App\Http\Controllers;

use App\Models\EquipmentMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentMovementController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = request('per_page', 10);

        $movements = EquipmentMovement::when($search, function ($query) use ($search) {
            return $query->where('equipment_name', 'like', "%{$search}%")
                        ->orWhere('owner_name', 'like', "%{$search}%")
                        ->orWhere('recipient_name', 'like', "%{$search}%");
        })->latest()->paginate($perPage);

        return view('equipment_movements.index', compact('movements', 'search', 'perPage'));
    }

    public function create()
    {
        return view('equipment_movements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_name' => 'required',
            'description' => 'nullable',
            'equipment_type' => 'required',
            'owner_name' => 'required',
            'recipient_name' => 'required',
            'check_out_time' => 'required|date_format:Y-m-d H:i',
            'purpose' => 'required',
            'remarks' => 'nullable',
        ]);

        $validated['status'] = 'Out';
        $validated['authorized_by_user_id'] = Auth::id();

        EquipmentMovement::create($validated);

        return redirect()->route('equipment_movements.index')->with('success', 'Equipment checked out successfully.');
    }

    public function show(EquipmentMovement $equipmentMovement)
    {
        return view('equipment_movements.show', compact('equipmentMovement'));
    }

    public function edit(EquipmentMovement $equipmentMovement)
    {
        return view('equipment_movements.edit', compact('equipmentMovement'));
    }

    public function update(Request $request, EquipmentMovement $equipmentMovement)
    {
        $validated = $request->validate([
            'equipment_name' => 'required',
            'description' => 'nullable',
            'equipment_type' => 'required',
            'owner_name' => 'required',
            'recipient_name' => 'required',
            'check_in_time' => 'nullable|date_format:Y-m-d H:i',
            'purpose' => 'required',
            'remarks' => 'nullable',
        ]);

        if ($request->filled('check_in_time')) {
            $validated['status'] = 'In';
        }

        $equipmentMovement->update($validated);

        return redirect()->route('equipment_movements.index')->with('success', 'Equipment movement updated successfully.');
    }

    public function destroy(EquipmentMovement $equipmentMovement)
    {
        $equipmentMovement->delete();

        return redirect()->route('equipment_movements.index')->with('success', 'Equipment movement deleted successfully.');
    }
}
