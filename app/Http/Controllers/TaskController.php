<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function fetchAll() {
        $tasks = Task::all();
        return $tasks;
    }

    public function store(Request $request) {
        $task = Task::create($request->all());
        broadcast(new TaskCreated($task));
        return response()->json('added');
    }

    public function delete($id) {
        $task = Task::findOrFail($id);
        broadcast(new TaskRemoved($task));
        Task::destroy($id);
        return response()->json('deleted');
    }
}
