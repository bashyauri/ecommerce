<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecords = [
            ['id' => 1,'name' => 'Bashar','address' => 'Yabo, Yauri','city' => 'Yauri',
             'state' => 'Delhi', 'country' => 'Nigeria','pincode' => '110001', 'mobile' => '09029991710',
             'email' => 'basharu@ymail.com','status' => 0],
        ];
        Vendor::insert($vendorRecords);
    }
}