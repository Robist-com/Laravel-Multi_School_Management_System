<?php

use Illuminate\Database\Seeder;
use App\User;
class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('users')->insert([
                'name' => "superadmin",
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('superadmin'),
                'roll_id' => 1,
                ]);
        }
    }


