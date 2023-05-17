<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => 'superadmin',
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'org_name' =>'ByteCipher Pvt.Ltd',
            'org_web'=>'bytecipher.net',
            'designation'=>'Developer',
            'department'=>'CS',
            'address'=>'Indore',
            'country'=>'101',
            'state'=>'21',
            'city'=>'2229',
            'pin'=>'482003',
            'status'=>'1'
        ]);

        User::create([
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'org_name' =>'ByteCipher Pvt.Ltd',
            'org_web'=>'bytecipher.net',
            'designation'=>'Developer',
            'department'=>'CS',
            'address'=>'Indore',
            'country'=>'101',
            'state'=>'21',
            'city'=>'2229',
            'pin'=>'482003',
            'status'=>'1'
        ]);
    }
}
