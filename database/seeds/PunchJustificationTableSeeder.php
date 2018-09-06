<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PunchJustificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('punch_justifications')->insert(['name' => 'in',
                'in_out' => 1, 'grouping' => 1, 'visible' => 1]);
        DB::table('punch_justifications')->insert(['name' => 'out', 
                'in_out' => 0, 'grouping' => 1, 'visible' => 1]);
        
        DB::table('punch_justifications')->insert(['name' => 'business trip', 
                'in_out' => 1, 'grouping' => 2, 'visible' => 1]);
        DB::table('punch_justifications')->insert(['name' => 'out',
            'in_out' => 0, 'grouping' => 2, 'visible' => 0]);
        
        DB::table('punch_justifications')->insert(['name' => 'riposo',
            'in_out' => 0, 'grouping' => 0, 'visible' => 1]);
    }
}
