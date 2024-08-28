<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        //customer
            [
                'full_name'=> 'Wafa customer',
                'username'=>'customer',
                'email'=>'customer@navgily.com',
                'password'=>Hash::make(12345),
                'status'=>'active'
            ],
            
        ]);

        //admin

        DB::table('admins')->insert([
            
                [
                    'full_name'=> 'Wafa Admin',
                    'username'=>'Admin',
                    'email'=>'admin@navgily.com',
                    'password'=>Hash::make(12345),
                    'status'=>'active'
                ],
                
            ]);

            //seller

            DB::table('sellers')->insert([
                
                    [
                        'full_name'=> 'Wafa seller',
                        'username'=>'seller',
                        'email'=>'seller@navgily.com',
                        'password'=>Hash::make(12345),
                        'status'=>'active'
                    ],
                    
                ]);
    }
}
