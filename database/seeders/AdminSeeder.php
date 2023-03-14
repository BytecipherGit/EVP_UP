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
            'name' => 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('123456'),
            'org_name' =>'ByteCipher',
            'org_web'=>'bytecipher.net',
            'designation'=>'Developer',
            'department'=>'CS',
            'address'=>'Indore',
            'country'=>'India',
            'state'=>'Madhya Pradesh',
            'city'=>'Indore',
            'pin'=>'482003'
        ]);

        User::create([
            'role' => 'admin',
            'name' => 'admin',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('123456'),
            'org_name' =>'ByteCipher',
            'org_web'=>'bytecipher.net',
            'designation'=>'Developer',
            'department'=>'CS',
            'address'=>'Indore',
            'country'=>'India',
            'state'=>'Madhya Pradesh',
            'city'=>'Indore',
            'pin'=>'482003'
        ]);
    }
}
