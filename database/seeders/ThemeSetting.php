<?php

namespace Database\Seeders;

use App\Models\ThemeSetting as ModelsThemeSetting;
use Illuminate\Database\Seeder;

class ThemeSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsThemeSetting::truncate();
        $themeSetting = array(
            array('company_id' => 0,'key' => 'logo', 'value' => "assets/admin/images/logo.png"),
            array('company_id' => 0,'key' => 'primary_color', 'value' => "#5533FF"),
            array('company_id' => 0,'key' => 'secondry_color', 'value' => "#FFFFFF"),
            array('company_id' => 0,'key' => 'button_text_color', 'value' => "#FFFFFF"),
            array('company_id' => 0,'key' => 'button_background_color', 'value' => "#5533FF"),
            array('company_id' => 0,'key' => 'link_color', 'value' => "#5533FF"),
            array('company_id' => 2,'key' => 'logo', 'value' => "assets/admin/images/logo.png"),
            array('company_id' => 2,'key' => 'primary_color', 'value' => "#5533FF"),
            array('company_id' => 2,'key' => 'secondry_color', 'value' => "#FFFFFF"),
            array('company_id' => 2,'key' => 'button_text_color', 'value' => "#FFFFFF"),
            array('company_id' => 2,'key' => 'button_background_color', 'value' => "#5533FF"),
            array('company_id' => 2,'key' => 'link_color', 'value' => "#5533FF"),
        );
        ModelsThemeSetting::insert($themeSetting);
    }
}
