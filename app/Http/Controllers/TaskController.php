<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function taskIndex()
    {
        return view("tasks.index");
    }
}
