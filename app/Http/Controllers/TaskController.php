<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'title' => $request->title,
            'due_date' => $request->due_date,
            'is_completed' => false,
        ]);

        return redirect('/tasks');
    }

    // FUNGSI BARU: Mengubah status tugas menjadi selesai
    public function complete(Task $task)
    {
        $task->update([
            'is_completed' => true
        ]);

        return redirect('/tasks');
    }

    // FUNGSI BARU: Menghapus tugas dari database
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }
}