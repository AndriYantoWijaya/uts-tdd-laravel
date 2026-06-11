<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tes untuk memastikan halaman daftar tugas dapat diakses.
     */
    public function test_user_can_see_task_list()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    /**
     * Tes untuk memastikan user dapat membuat tugas baru.
     */
    public function test_user_can_create_a_task()
    {
        $response = $this->post('/tasks', [
            'title' => 'Belajar TDD Laravel',
            'due_date' => '2026-06-12',
        ]);

        $response->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'title' => 'Belajar TDD Laravel',
            'due_date' => '2026-06-12',
        ]);
    }

    /**
     * Tes untuk memastikan user dapat menandai tugas sebagai selesai.
     */
    public function test_user_can_complete_a_task()
    {
        // 1. Buat satu data tugas tiruan di database
        $task = Task::create([
            'title' => 'Tugas UTS yang Belum Selesai',
            'due_date' => '2026-06-20',
            'is_completed' => false,
        ]);

        // 2. Simulasikan user menekan tombol selesai (mengirim request PATCH)
        $response = $this->patch("/tasks/{$task->id}/complete");

        // 3. Pastikan setelah sukses, halaman dialihkan kembali ke /tasks
        $response->assertRedirect('/tasks');

        // 4. Pastikan status 'is_completed' di database sudah berubah jadi true (1)
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'is_completed' => true,
        ]);
    }

    /**
     * Tes untuk memastikan user dapat menghapus tugas.
     */
    public function test_user_can_delete_a_task()
    {
        // 1. Buat satu data tugas tiruan di database
        $task = Task::create([
            'title' => 'Tugas Salah Input',
            'due_date' => '2026-06-25',
            'is_completed' => false,
        ]);

        // 2. Simulasikan user menekan tombol hapus (mengirim request DELETE)
        $response = $this->delete("/tasks/{$task->id}");

        // 3. Pastikan dialihkan kembali ke /tasks
        $response->assertRedirect('/tasks');

        // 4. Pastikan datanya sudah hilang dari database
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}