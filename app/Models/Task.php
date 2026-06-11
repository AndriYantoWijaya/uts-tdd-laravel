<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Tambahkan baris ini agar kolom ini diizinkan diisi melalui form
    protected $fillable = ['title', 'due_date', 'is_completed'];
}