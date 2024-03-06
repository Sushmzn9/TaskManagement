<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use PDO;

class TaskController extends Controller
{
    public function taskIndex()
    {
        return view("tasks.index");
    }

    public function getTask()
    {
        return response()->json(Task::with('department')->get());
    }

    public function storeTask(Request $request)
    {

        $request->validate([
            "title" => ["required"],
            "priority"  => ["required"],
            "start_date"  => ["required"],
            "end_date" => ["required"],
            "description" => ["required"],
            "assign_to" => ["required", "array"],
        ]);


        $task = Task::create([
            "user_id" => 7,
            "department_id" => 2,
            "title"  => $request->title,
            "priority" => $request->priority,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "description" => $request->description
        ]);
        $task->users()->sync($request->assign_to);
        return response()->json('success');
    }
}
