<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_task_list()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    // TAMBAHKAN FUNGSI BARU INI
    public function test_user_can_create_a_task()
    {
        // 1. Simulasikan user mengirim data tugas baru lewat POST
        $response = $this->post('/tasks', [
            'title' => 'Belajar TDD Laravel',
            'due_date' => '2026-06-12',
        ]);

        // 2. Pastikan setelah sukses, halaman dialihkan (redirect) kembali ke /tasks
        $response->assertRedirect('/tasks');

        // 3. Pastikan datanya benar-benar masuk ke dalam database
        $this->assertDatabaseHas('tasks', [
            'title' => 'Belajar TDD Laravel',
            'due_date' => '2026-06-12',
        ]);
    }
}