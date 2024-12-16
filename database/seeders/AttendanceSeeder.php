<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            Attendance::create([
                'user_id' => $user->id,
                'check_in' => now()->subHours(rand(1, 5)),
                'check_out' => now()->subHours(rand(0, 1)),
            ]);
        }
    }
}
