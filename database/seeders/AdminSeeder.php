<?php

namespace Database\Seeders;


use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecords = [
            ['id' => 2, 'name' => 'Bashar','type' =>'vendor','vendor_id' => 1,'mobile' => '09029991710',
            'email' => 'basharu@ymail.com','password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','image' => '','status' => 0 ],

        ];
        Admin::insert($adminRecords);
    }
}
