<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => 'freaktemplate@gmail.com',
            'address' => '202 New Hampshire Avenue, Northwest #100, New York-2573',
            'phone' => '+918200438788',

            'app_url' => 'https://www.apple.com/in/app-store/',
            'play_store_url' => 'https://play.google.com/store',
            'doctor_approved' => '0',

            'main_banner' => '737400.jpg',
            'favicon' => '767239.ico',
            'logo' => '688755.png',
        ];
    }
}
