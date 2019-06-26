<?php

use App\User;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call('UsersTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('FollowersTableSeeder');
        $this->command->info('Follower table seeded!');
    }
}
