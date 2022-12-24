<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (User::first()) {
            return;
        }

        User::factory()
            ->count(1)
            ->create()
            ->each(
                function (User $user) {
                    $user->marchant()->create([]);
                }
            );
    }
}
