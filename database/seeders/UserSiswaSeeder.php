<?php

namespace Database\Seeders;

use App\Models\siswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dapatkan semua user
        $users = User::all();

        foreach ($users as $user) {
            // Cari siswa dengan nama yang sama dengan user
            $siswa = siswa::where('nama', $user->name)->first();

            // Jika siswa ditemukan, kaitkan dengan user
            if ($siswa) {
                $siswa->user_id = $user->id;
                $siswa->save();
            }
        }
    }
}
