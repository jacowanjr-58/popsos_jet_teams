<?php

namespace App\Http\Controllers;

use App\Models\Franchise;
use Illuminate\Http\Request;

class FranchiseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:franchise.create'])->only(['create', 'store']);
        $this->middleware('can:franchise.view')->only(['index', 'show']);
        $this->middleware('can:franchise.update')->only(['edit', 'update']);
        $this->middleware('can:franchise.delete')->only(['destroy']);
    }

    public function index()
    {
        $franchises = Franchise::all();
        return view('franchise.index', compact('franchises'));
    }

    public function create()
    {
        return view('franchise.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'taxID' => 'required|string|max:255',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'territory_zip_codes' => 'required|array',
            'stripeAPI' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Franchise::create($data);
        return redirect()->route('franchise.index')->with('success', 'Franchise created successfully.');
    }

    public function show(Franchise $franchise)
    {
        return view('franchise.show', compact('franchise'));
    }

    public function edit(Franchise $franchise)
    {
        return view('franchise.edit', compact('franchise'));
    }

    public function update(Request $request, Franchise $franchise)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'taxID' => 'required|string|max:255',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'territory_zip_codes' => 'required|array',
            'stripeAPI' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $franchise->update($data);
        return redirect()->route('franchise.index')->with('success', 'Franchise updated successfully.');
    }

    public function destroy(Franchise $franchise)
    {
        $franchise->delete();
        return redirect()->route('franchise.index')->with('success', 'Franchise deleted.');
    }
}
