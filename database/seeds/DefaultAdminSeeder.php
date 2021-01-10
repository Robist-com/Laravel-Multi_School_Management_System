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

            
            // DB::table('users')->insert([
                $users = array(
            array(
                'name' => "superadmin",
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('superadmin'),
                'group' => 'Admin',
                'role_id' => 1,
                'teacher_id' => 0,
                'school_id' => 1,
                'is_online' => null,
                'ip_address' => null,
                'login_time' => null,
                'logout_time' => null,
                'email_verified_at' => null,
                ),
                array(
                'name' => "school",
                'email' => 'school@gmail.com',
                'password' => bcrypt('school'),
                'group' => 'Owner',
                'role_id' => 2,
                'school_id' => 1,
                'teacher_id' => 0,
                'is_online' => null,
                'ip_address' => null,
                'login_time' => null,
                'logout_time' => null,
                'email_verified_at' => null,
                ),
                array(
                'name' => "teacher",
                'email' => 'teacher@gmail.com',
                'password' => bcrypt('teacher'),
                'group' => 'Teacher',
                'role_id' => 3,
                'school_id' => 1,
                'teacher_id' => 1,
                'is_online' => null,
                'ip_address' => null,
                'login_time' => null,
                'logout_time' => null,
                'email_verified_at' => null,
                ),

                array(
                'name' => "staff",
                'email' => 'staff@gmail.com',
                'password' => bcrypt('staff'),
                'group' => 'Staff',
                'role_id' => 4,
                'school_id' => 1,
                'teacher_id' => 0,
                'is_online' => null,
                'ip_address' => null,
                'login_time' => null,
                'logout_time' => null,
                'email_verified_at' => null,
                ));
                DB::table('users')->insert($users);

                 $teacher = array(
                array('first_name' => "Alagie", 'last_name' => "Singhateh", 'email' => '3939919@gmail.com',
                'roll_no' => '089187273' , 'marital_status' => '0' , 'gender' => '0' ,
                'gender' => '0' , 'dob' => '1990-09-19' , 'phone' => '237844845858' , 'address' => 'fajikunda' ,
                 'nationality' => 'Gambian', 'passport' => 'Pc2020094',
                'status' =>  1, 'dateregistered' => date('y-m-d'),
                'user_id' => 3, 'class_code' => 'C-A-0001-GBS', 'department_id' => 8,'faculty_id' => 9,
                 'semester_id' => 1,            
                'school_id' => 1, 'image' => '',
                 ));
                  DB::table('teachers')->insert($teacher);


                DB::table('schools')->insert([
                'name' => "school Name",
                'email' => 'schoolemail@gmail.com',
                'user_id' => 2,
                'is_active' => 1,
                'description' => 'this is the sample school',
                ]);

                DB::table('institute')->insert([
                'name' => "Institute Name",
                'email' => 'institutemail@gmail.com',
                'establish' => 2021,
                'web' => 'school.com',
                'phoneNo' => '+62 081290348080',
                'address' => 'Banjul The Gambia',
                'image' => '8920.png',
                'school_id' => 1,
                'mark_type' => 0,
                'institute_number' => date('Y'),
                'template' => 0,
                ]);

                 $roles = array(
                array(
                'name' => "Owner",
                'school_id' => 1,
             ),
                
              array('name' => "Teacher",
                'school_id' => 1,
            ),
                array(
                'name' => "Student",
                'school_id' => 1,
                ),
                array(
                'name' => "Staff",
                'school_id' => 1,
                ),
                array(
                'name' => "Accountant",
                'school_id' => 1,
                 ));
            DB::table('roles')->insert($roles);

                DB::table('front_cms')->insert([
                "image_logo" => null,
                "image_fav" => null,
                "footer_text" => null,
                "meta_tags" => null,
                "google_analytics" => null,
                "facebook_link" => null,
                "instagram_link" => null,
                "twitter_link" => null,
                "whatsapp_link" => null,
                "youtube_link" => null,
                "theme_name" => "theme_blue",
                "head_background_color" => "#03A9F4",
                "head_fore_color" => "#ffffff",
                "footer_background_color" => "#03A9F4",
                "footer_fore_color" => "#ffffff",
                "theme_status" => "1",
                'school_id'=> '1'
                ]);

                $banners = array(
                    array(
                "name" => "Opening Banner",
                "status" => "1",
                "banner_image" => "1602925253.PNG",
                'school_id'=> '1'
                    ),
                          array(
                "name" => "Event Banner",
                "status" => "1",
                "banner_image" => "1602926727.PNG",
                'school_id'=> '1'
                          ),
                                array(
                "name" => "University Banner",
                "status" => "1",
                "banner_image" => "1602927629.PNG",
                'school_id'=> '1'
                                ),
                                      array(
                "name" => "Teacaher Banner",
                "status" => "1",
                "banner_image" => "1602927341.PNG",
                'school_id'=> '1'
                )
                );

                DB::table('school_banners')->insert($banners);

                // "theme_name" => "theme_blue"
                // "header_bg_color" => "#03A9F4"
                // "header_fg_color" => "#ffffff"
                // "footer_bg_color" => "#03A9F4"
                // "footer_fg_color" => "#ffffff"
                // "theme_status" => "1"
        }

         
    }


