<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class IncidentController extends Controller
{
    public function index()
{
    $incidents = auth()->user()->incidents()->latest()->get();
    return Inertia::render('Incidents/Index', compact('incidents'));
}

public function create()
{
    return Inertia::render('Incidents/Create');
}

public function store(Request $request)
{



    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        // 'status' => 'in:Pending, On Progress,Solved',
    ]);

    auth()->user()->incidents()->create([
        'title' => $request->title,
        'description' => $request->description,
        // 'status' => $request->status,
    ]);


    return redirect()->route('incidents.index');
}

public function adminDashboard()
{
    // Paginate incidents with user data
    $incidents = Incident::with('user')  // Eager load the user relationship
        ->latest()  // Order by the latest incidents
        ->paginate(10);  // Paginate the results

    return Inertia::render('Admin/Index', [
        'incidents' => $incidents  // Pass the paginated incidents to the Inertia view
    ]);
}

public function adminIndex()
{
    $incidents = Incident::with('user')->latest()->get();
    return Inertia::render('Admin/Reports', compact('incidents'));
}

public function markResolved(Request $request, Incident $incident)
{
    $request->validate([
        'status' => 'required|in:On Progress,Solved',
    ]);

    $incident->update([
        'status' => $request->status,
    ]);

    return back()->with('message', 'Incident status updated.');
}

public function show($id)
{
    $incident = Incident::findOrFail($id);

    return Inertia::render('Incidents/Show', [
        'incident' => $incident
    ]);
}

public function destroy($id)
{
    $incident = \App\Models\Incident::findOrFail($id);
    $incident->delete();

    return Redirect::route('incidents.index')->with('success', 'Incident deleted successfully.');
}



}
