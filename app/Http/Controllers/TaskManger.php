<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskManger extends Controller
{
    function listTask (){
        $tasks = Tasks::where('user_id',auth()->user()->id)
            ->where('status',NULL)->paginate(3);
        return view("welcome",compact("tasks"));
    }

    function addTask(){
        return view("tasks.add");
    }

    function addTaskPost(Request $request){
        $request->validate([
            'title' => 'required',
            'description'=> 'required',
            'deadline'=> 'required',
        ]);

        $task = new Tasks();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->user_id = auth()->user()->id;
        if($task->save()){
            return redirect(route('home'))
                ->with('success','Task added successfully');
        }
        return redirect(route('task.add'))
            ->with('error','Task not added');
    }

    function updaTaskStatus($id){
        if(Tasks::where('user_id',auth()->user()
                ->id)->where('id',$id)->update(['status'=> 'completed'])){
            return redirect(route('home'))->with('success','Task completed successfully');
        }
        return redirect(route('home'))->with('error','Error occurred while updating, try again');
    }

    function deleteTask($id){
        if(Tasks::where('user_id',auth()->user()->id)
                ->where('id',$id)->delete()){
            return redirect(route('home'))->with('success','Task deleted');
        }
        return redirect(route('home'))->with('error','Error occurred while deleting, try again');
    }

    function completedTask()
    {
        $tasks = Tasks::where('user_id', auth()->user()->id)
                    ->where('status', 'completed')
                    ->paginate(3);

        return view('completed', compact('tasks'));
    }

    function editTask($id){
        $task = Tasks::where('user_id', auth()->id())->findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    function updateTask($id, Request $request){
        if(Tasks::where('user_id',auth()->user()->id)
            ->where('id',$id)->update([
            'title'=> $request->title,
            'description'=> $request->description,
            'deadline'=> $request->deadline,
        ])){
            return redirect(route('home'))->with('success','Task updated successfully');
        }
    }
}
