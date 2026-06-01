<?php

namespace App\Http\Controllers;

use App\Models\Task; // BARIS 5: Pastikan ini tertulis dengan benar
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Mengambil semua data tugas dari database
        $tasks = Task::all();

        // Mengirim data tersebut ke view
        return view('tasks.index', compact('tasks'));
    }
}