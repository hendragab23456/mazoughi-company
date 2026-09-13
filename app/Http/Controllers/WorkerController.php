<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::latest()->get();

        return view('workers.index', compact('workers'));
    }

    public function create()
    {
        return view('workers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],
            'job_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'type' => [
                'required',
                'in:worker,contractor',
            ],
            'total_due' => [
                'required',
                'numeric',
                'min:0',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        Worker::create([
            ...$validated,
            'total_paid' => 0,
        ]);

        return redirect()
            ->route('workers.index')
            ->with('success', 'تم إضافة العامل بنجاح.');
    }

    public function show(Worker $worker)
    {
        return view('workers.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {
        return view('workers.edit', compact('worker'));
    }

    public function update(Request $request, Worker $worker)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],
            'job_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'type' => [
                'required',
                'in:worker,contractor',
            ],
            'total_due' => [
                'required',
                'numeric',
                'min:0',
            ],
            'total_paid' => [
                'required',
                'numeric',
                'min:0',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $worker->update($validated);

        return redirect()
            ->route('workers.index')
            ->with('success', 'تم تعديل بيانات العامل بنجاح.');
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();

        return redirect()
            ->route('workers.index')
            ->with('success', 'تم حذف العامل بنجاح.');
    }
}