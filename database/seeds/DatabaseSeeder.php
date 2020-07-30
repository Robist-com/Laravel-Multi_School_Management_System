<?php

use Illuminate\Database\Seeder;
// use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => "superadmin",
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
            'role_id' => 1,
            'teacher_id' => 0,
            ]);
    }
}
