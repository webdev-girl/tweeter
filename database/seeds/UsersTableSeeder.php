<?php

use Illuminate\Database\Seeder;

use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
      {
          // Empty all previous records out
          // DB::table('users')->delete();

          // User::create(array(
          //     'username'  => 'username1',
          //     'email'     => 'foo@bar.com',
          //     'password'  => 'password',
          //     'full_name' => 'User One'
          // ));
          //
          // User::create(array(
          //     'username'  => 'username2',
          //     'email'     => 'foo2@bar.com',
          //     'password'  => 'password',
          //     'full_name' => 'User Two'
          // ));
          //
          // User::create(array(
          //     'username'  => 'username3',
          //     'email'     => 'foo3@bar.com',
          //     'password'  => 'password',
          //     'full_name' => 'User Three'
          // ));
          //
          // User::create(array(
          //     'username'  => 'username4',
          //     'email'     => 'foo4@bar.com',
          //     'password'  => 'password',
          //     'full_name' => 'User Four'
          // ));

          factory(App\User::class, 5)->create();

      }
}
