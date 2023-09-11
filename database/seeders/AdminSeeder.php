<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name'  => 'admin',
            'email' => 'admin@example.com'
        ]);

        $user->assignRole('admin', 'teacher', 'student');
        $user->givePermissionTo('create user');
    }
}
