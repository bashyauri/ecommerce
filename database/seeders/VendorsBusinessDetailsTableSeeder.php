<?php

namespace Database\Seeders;

use App\Models\VendorsBusinessDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecords = [
            ['id' => 1,'vendor_id' => 1,'shop_name' =>'Mudal Pharmacy','shop_address' => 'Yabo, yauri','shop_city' =>'Yauri',
            'shop_state' => 'Kebbi','shop_country' => 'Nigeria','shop_pincode' => '110001','shop_mobile'=> '09029991710',
            'shop_website' => 'https://www.example.com','shop_email' => 'email@example.com','address_proof' => 'Passport',
            'address_proof_image' => 'test.jpg',
            'business_license_number' => '1111777888','gst_number' => '444111555','pan_number' => '118822211'],
        ];
        VendorsBusinessDetail::insert($vendorRecords);
    }
}