<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'place' => 'required',
            'datetime' => 'required|date_format:Y-m-d\TH:i',
            'duration' => 'required',
            'description' => 'required',
        ]);
        $validatedData['status'] = 'Текущее';
        Task::create($validatedData);
        return redirect()->route('home')->with('success', 'Task created successfully.');
    }

    public function edit($id) {
        $task = Task::find($id);
        return view('task', ['task' => $task]);
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'place' => 'required',
            'datetime' => 'required|date_format:Y-m-d\TH:i',
            'duration' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $task = Task::find($id);
        $task->title = $validatedData['title'];
        $task->type = $validatedData['type'];
        $task->place = $validatedData['place'];
        $task->datetime = $validatedData['datetime'];
        $task->duration = $validatedData['duration'];
        $task->description = $validatedData['description'];
        $task->status = $validatedData['status'];
        $task->save();
        return redirect()->route('home')->with('success', 'Task changed successfully.');
    }

    public function findbydate(Request $request) {
        $validatedData = $request->validate([
            'date' => 'required|date'
        ]);
        $tasks = Task::whereDate('datetime', $request['date']);
        return view('home', $tasks);
    }    
}
