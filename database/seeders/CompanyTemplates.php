<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTemplates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qualifiedTemplate = array(
            array('email_type' => 'Qualified','content' => '<p>Congratulations #candidate</p>
            <p>We would like to inform you that, you have been qualified for 2nd round of interview which is a machine test.</p> 
            <p>Please find machine test in attachment and try to submit it in next two working days via-Google drive link. If you found any query/question please feel free to ask.
            PFA,</p>'),    
            array('email_type' => 'NotQualified','content' => '<p>Dear #candidate</p>
            <p>Thank you for showing your interest and applying at ByteCipher Pvt Ltd.</p>
            <p>We carefully reviewed your skills and qualifications and have decided to move forward with another candidate for the position.</p>
            <p>We appreciate the time you invested to apply for this position at ByteCipher Pvt Ltd, and we encourage you to pursue future openings.</p>
            <p>Best wishes for a successful job search. Thank you, again, for your interest in our company.</p>
            <p>Note: You can re-apply for same position after 6 month if you will be interested to join in near future to ByteCipher Pvt Ltd.</p>'),  
        );
        DB::table('company_templates')->insert($qualifiedTemplate);
    }
}
