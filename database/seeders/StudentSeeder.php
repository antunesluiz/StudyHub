<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(100)->create([
            'created_at' => fake()->dateTimeBetween('2023-05-01', 'now')
        ]);

        foreach($users as $user) {
            $user->assignRole('student');
        }
    }
}
