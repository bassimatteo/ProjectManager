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
        // Clocks in for work 
        DB::table('punch_justifications')->insert(['name' => 'in',
            'in_out' => 1, 'grouping' => 1, 'visible' => 1, 'visibleDashboard' => 1]);
        // Generic clocks out 
        DB::table('punch_justifications')->insert(['name' => 'out',
            'in_out' => 0, 'grouping' => 0, 'visible' => 1, 'visibleDashboard' => 1]);
        
        // Clocks out for work 
        DB::table('punch_justifications')->insert(['name' => 'out',
            'in_out' => 0, 'grouping' => 1, 'visible' => 0, 'visibleDashboard' => 1]);
        
        // Clocks in for business trip
        DB::table('punch_justifications')->insert(['name' => 'business trip', 
            'in_out' => 1, 'grouping' => 2, 'visible' => 1, 'visibleDashboard' => 1]);
        // Clocks out for business trip
        DB::table('punch_justifications')->insert(['name' => 'out',
            'in_out' => 0, 'grouping' => 2, 'visible' => 0, 'visibleDashboard' => 0]);
       
        // Day off 
        DB::table('punch_justifications')->insert(['name' => 'riposo',
            'in_out' => 0, 'grouping' => -1, 'visible' => 0, 'visibleDashboard' => 1]);
        // Holiday
        DB::table('punch_justifications')->insert(['name' => 'ferie',
            'in_out' => 0, 'grouping' => -1, 'visible' => 0, 'visibleDashboard' => 1]);
    }
}
