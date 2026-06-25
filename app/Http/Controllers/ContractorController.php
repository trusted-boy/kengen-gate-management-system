<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function index()
    {
        $search = request('search', '');
        $perPage = request('per_page', 10);

        $contractors = Contractor::when($search, function ($query) use ($search) {
            return $query->where('company_name', 'like', "%{$search}%")
                        ->orWhere('contact_person', 'like', "%{$search}%")
                        ->orWhere('license_number', 'like', "%{$search}%");
        })->paginate($perPage);

        return view('contractors.index', compact('contractors', 'search', 'perPage'));
    }

    public function create()
    {
        return view('contractors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|unique:contractors',
            'contact_person' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'license_number' => 'required|unique:contractors',
            'license_expiry' => 'required|date',
            'services_offered' => 'required',
            'status' => 'required|in:Active,Inactive,Expired',
            'remarks' => 'nullable',
        ]);

        Contractor::create($validated);

        return redirect()->route('contractors.index')->with('success', 'Contractor added successfully.');
    }

    public function show(Contractor $contractor)
    {
        return view('contractors.show', compact('contractor'));
    }

    public function edit(Contractor $contractor)
    {
        return view('contractors.edit', compact('contractor'));
    }

    public function update(Request $request, Contractor $contractor)
    {
        $validated = $request->validate([
            'company_name' => 'required|unique:contractors,company_name,' . $contractor->id,
            'contact_person' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'license_number' => 'required|unique:contractors,license_number,' . $contractor->id,
            'license_expiry' => 'required|date',
            'services_offered' => 'required',
            'status' => 'required|in:Active,Inactive,Expired',
            'remarks' => 'nullable',
        ]);

        $contractor->update($validated);

        return redirect()->route('contractors.index')->with('success', 'Contractor updated successfully.');
    }

    public function destroy(Contractor $contractor)
    {
        $contractor->delete();

        return redirect()->route('contractors.index')->with('success', 'Contractor deleted successfully.');
    }
}
