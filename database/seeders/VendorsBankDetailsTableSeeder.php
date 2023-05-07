<?php

namespace Database\Seeders;

use App\Models\VendorsBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecords = [
            ['id' => 1,'account_holder_name' => 'Bashar Umar','bank_name' => 'first Bank','account_number' => '1234567890'],
        ];
        VendorsBankDetail::insert($vendorRecords);
    }
}
