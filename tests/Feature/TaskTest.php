<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // Pastikan baris ini ada
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase; // SAKTI: Baris ini yang akan otomatis membuat tabel saat tes dijalankan

    /**
     * A basic feature test example.
     */
    public function test_user_can_see_task_list()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }
}