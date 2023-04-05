<?php

namespace Database\Seeders;

use App\Models\UserVendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserVendorTableSeeder extends Seeder
{
    
    public function run(): void
    {
        UserVendor::create([
            'user_id' => 1,
            'vendor_id' => 1,
            'sub_role' => 'admin' // Replace with your desired sub role
        ]);

        UserVendor::create([
            'user_id' => 2,
            'vendor_id' => 2,
            'sub_role' => 'manager' // Replace with your desired sub role
        ]);
    }
}
