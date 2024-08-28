<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'description'=>'Navigly online shooping',
            'short_des'=>'Navigly online shopping',
            'logo'=>'assets\images\logo.png',
            'photo'=>'assets\images\logo.png',
            'address'=>'Sudan',
            'phone'=>'0024913820891',
            'email'=>'navigly.gmail.com'
        ]);
    
        }
    }
