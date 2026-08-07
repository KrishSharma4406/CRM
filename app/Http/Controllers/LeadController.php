<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of leads.
     */
    public function index()
    {
        $leads = Lead::with('assignedTo')->latest()->get();
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new lead.
     */
    public function create()
    {
        $users = User::all();
        $statuses = Lead::STATUSES;
        return view('leads.create', compact('users', 'statuses'));
    }

    /**
     * Store a newly created lead.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'status' => 'required|in:' . implode(',', Lead::STATUSES),
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        Lead::create($request->only(['name', 'email', 'phone', 'status', 'assigned_to']));

        return redirect()->route('leads.index')
            ->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified lead.
     */
    public function show(Lead $lead)
    {
        $lead->load('assignedTo');
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified lead.
     */
    public function edit(Lead $lead)
    {
        $users = User::all();
        $statuses = Lead::STATUSES;
        return view('leads.edit', compact('lead', 'users', 'statuses'));
    }

    /**
     * Update the specified lead.
     */
    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'status' => 'required|in:' . implode(',', Lead::STATUSES),
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $lead->update($request->only(['name', 'email', 'phone', 'status', 'assigned_to']));

        return redirect()->route('leads.index')
            ->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified lead.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}
