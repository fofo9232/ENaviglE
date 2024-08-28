<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            
                   [
                    'name'=> 'USA Dollar',
                    'symbol'=>'$',
                    'exchange_rate'=>'1',
                    'code'=>'USD',
                ],
                [
                    'name'=> 'Sudaness pound',
                    'symbol'=>'SDG',
                    'exchange_rate'=>'200',
                    'code'=>'SDG',
                ]
             
            ]);
    }
}
