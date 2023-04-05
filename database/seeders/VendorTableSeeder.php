<?php

namespace Database\Seeders;

use App\Models\Vendor;
use App\Models\UserVendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create([
            'name' => 'Vendor 1',
            'phone' => '1234567890',
            'contact_person' => 'John Doe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'address' => '123 Main Street, Anytown USA'
        ]);
        
        Vendor::create([
            'name' => 'Vendor 2',
            'phone' => '0987654321',
            'contact_person' => 'Jane Smith',
            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem.',
            'address' => '456 High Street, Othertown USA'
        ]);
        
    }
}
//php artisan db:seed --class=VendorTableSeeder

