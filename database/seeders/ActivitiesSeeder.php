<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::where('role', 'user')->get(); // Hanya untuk user dengan role 'user'

        foreach ($users as $user) {
            Activity::create([
                'user_id' => $user->id,
                'activity_text' => 'Melakukan pekerjaan pada proyek ' . fake()->sentence(),
                'status' => ['pending', 'approved', 'rejected'][rand(0, 2)], // Random status
                'name' => fake()->sentence(),
            ]);
        }
    }
}
