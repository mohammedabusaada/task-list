<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB; We Don't Need This Anymore!
use App\Models\Task;
class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    public function create(){
        $task_name = $_POST['name'];
        $task = new Task;
        $task->name = $task_name;
        $task->save();
        return redirect()->back();
    }

    public function destroy($id){
        Task::findOrFail($id)->delete();
        return redirect()->back();
    }
    

    public function edit($id){
        $task = Task::findOrFail($id);
        $tasks = Task::all();
        return view('tasks', compact('task', 'tasks'));

    }

    public function update(){
        $id = $_POST['id'];
        $task = Task::findOrFail($id);
        $task->name = $_POST['name'];
        $task->save();
        return redirect('tasks');
    }
}
