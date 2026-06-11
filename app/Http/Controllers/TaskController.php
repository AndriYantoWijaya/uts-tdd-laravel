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

    // TAMBAHKAN FUNGSI INI
    public function store(Request $request)
    {
        // 1. Validasi data yang dikirim dari form
        $request->validate([
            'title' => 'required',
            'due_date' => 'required|date',
        ]);

        // 2. Simpan data baru ke dalam database
        Task::create([
            'title' => $request->title,
            'due_date' => $request->due_date,
            'is_completed' => false,
        ]);

        // 3. Kembalikan halaman ke daftar tugas
        return redirect('/tasks');
    }
}