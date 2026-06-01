<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * User bisa melihat daftar tugas
     */
    public function User_bisa_melihat_daftar_tugas()
    {
        //setup
        $daftartugas = Tugas::factory(10)->create();
        
        //execution
        $response = $this->get('/todo');
        
        //assert
        $response->assertOk();
        $response->assertSeeText($daftartugas->deskripsi);
    }

    /**
     * User bisa mengubah tugas
     */

    /**
     * Bisa membuat tugas yang belum selesai
     */

    /**
     * Bisa menghaput tugas
     */
}