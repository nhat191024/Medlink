<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_settings')->insert([
            [
                'id' => '1',
                'tab' => 'app',
                'key' => 'app_logo',
                'value' => 'assets/site_logo.png',
            ],
            [
                'id' => '2',
                'tab' => 'app',
                'key' => 'app_dark_logo',
                'value' => 'assets/site_dark_logo.png',
            ],
            [
                'id' => '3',
                'tab' => 'app',
                'key' => 'app_favicon',
                'value' => 'assets/site_favicon.ico',
            ],
            [
                'id' => '4',
                'tab' => 'app',
                'key' => 'app_name',
                'value' => 'MedLink',
            ],
            [
                'id' => '5',
                'tab' => 'app',
                'key' => 'support_email',
                'value' => 'medlink@gmail.com',
            ],
            [
                'id' => '6',
                'tab' => 'app',
                'key' => 'support_phone_1',
                'value' => '+84793732392',
            ],
            [
                'id' => '7',
                'tab' => 'app',
                'key' => 'support_phone_2',
                'value' => '+84793732392',
            ],
        ]);
    }
}
