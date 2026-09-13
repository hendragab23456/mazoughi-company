<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'budget' => ['required', 'numeric', 'min:0'],
            'total_expenses' => ['nullable', 'numeric', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'in:planning,active,completed,paused,cancelled'],
            'description' => ['nullable', 'string', 'max:3000'],
        ]);

        Project::create([
            ...$validated,
            'total_expenses' => $validated['total_expenses'] ?? 0,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'تم إضافة المشروع بنجاح.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'budget' => ['required', 'numeric', 'min:0'],
            'total_expenses' => ['nullable', 'numeric', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'in:planning,active,completed,paused,cancelled'],
            'description' => ['nullable', 'string', 'max:3000'],
        ]);

        $project->update([
            ...$validated,
            'total_expenses' => $validated['total_expenses'] ?? 0,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'تم تعديل المشروع بنجاح.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'تم حذف المشروع بنجاح.');
    }
}

