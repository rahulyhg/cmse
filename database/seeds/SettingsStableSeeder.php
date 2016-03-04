<?php

use Illuminate\Database\Seeder;
use DB;

class SettingsStableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            ['name' => 'notify_email_on_new_request', 'value' => ''],
            ['name' => 'notify_email_on_high_usage', 'value' => ''],
            ['name' => 'notify_email_on_low_stock_hq', 'value' => '0'],
            ['name' => 'notify_email_on_low_stock_hospital', 'value' => '0'],
            ['name' => 'notify_when_stock_lower_than', 'value' => '0'],
        ]);
    }
}
