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
            array('company_id' => 0,'title' => 'Company Logo','key' => 'logo', 'value' => "assets/admin/images/logo.png"),
            array('company_id' => 0,'title' => 'Primary Color','key' => 'primary_color', 'value' => "#5533FF"),
            array('company_id' => 0,'title' => 'Secondary Color','key' => 'secondry_color', 'value' => "#FFFFFF"),
            array('company_id' => 0,'title' => 'Button Text Color','key' => 'button_text_color', 'value' => "#FFFFFF"),
            array('company_id' => 0,'title' => 'Button Background Color','key' => 'button_background_color', 'value' => "#5533FF"),
            array('company_id' => 0,'title' => 'Link Color','key' => 'link_color', 'value' => "#5533FF"),
            array('company_id' => 2,'title' => 'Company Logo','key' => 'logo', 'value' => "assets/admin/images/logo.png"),
            array('company_id' => 2,'title' => 'Primary Color','key' => 'primary_color', 'value' => "#5533FF"),
            array('company_id' => 2,'title' => 'Secondary Color','key' => 'secondry_color', 'value' => "#FFFFFF"),
            array('company_id' => 2,'title' => 'Button Text Color','key' => 'button_text_color', 'value' => "#FFFFFF"),
            array('company_id' => 2,'title' => 'Button Background Color','key' => 'button_background_color', 'value' => "#5533FF"),
            array('company_id' => 2,'title' => 'Link Color','key' => 'link_color', 'value' => "#5533FF"),
        );
        ModelsThemeSetting::insert($themeSetting);
    }
}
