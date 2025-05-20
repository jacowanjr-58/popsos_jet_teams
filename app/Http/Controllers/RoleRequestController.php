<?php

namespace App\Http\Controllers;

use App\Models\RoleRequest;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RoleRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('canApproveRoles', User::class);
        $user = Auth::user();

        if ($user->hasRole('super_user')) {
            // Super Admin sees all pending requests grouped by role
            $roleRequests = RoleRequest::with('user')->where('status', 'pending')->get()->groupBy('desired_role');
        } else {
            // Others see a flat list (filtered by policy logic inside view/controller)
            $roleRequests = RoleRequest::with('user')->where('status', 'pending')->get();
        }

        return view('auth.role-approvals', compact('roleRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $franchisees = Team::all();
        return view('auth.request-role', compact('franchisees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'desired_role' => 'required|in:super_user,corporate_admin,franchise_admin,franchise_manager,franchise_staff',
            'franchisee_ids' => 'required|array|min:1'
        ]);

        $user = Auth::user();

        // Only allow resubmission if rejected or no existing request
        $existing = RoleRequest::where('user_id', $user->id)->latest()->first();

        if ($existing && $existing->status === 'pending') {
            return back()->withErrors(['msg' => 'You already have a pending request.']);
        }

        RoleRequest::create([
            'user_id' => $user->id,
            'desired_role' => $request->desired_role,
            'franchisee_ids' => $request->franchisee_ids,
        ]);

        return redirect()->route('dashboard')->with('success', 'Role request submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleRequest $roleRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleRequest $roleRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoleRequest $roleRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleRequest $roleRequest)
    {
        //
    }

    public function approve(RoleRequest $request)
    {
        $this->authorize('canApproveRoles', User::class);
        $request->update(['status' => 'approved']);
        $request->user->assignRole($request->desired_role);
        foreach ($request->franchisee_ids as $fid) {
            $request->user->teams()->attach($fid);
        }
        return back()->with('success', 'Role approved');
    }

    public function reject(RoleRequest $request)
    {
        $this->authorize('canApproveRoles', User::class);
        $request->update(['status' => 'rejected']);
        return back()->with('error', 'Role rejected');
    }
}
