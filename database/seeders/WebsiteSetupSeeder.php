<?php

namespace Database\Seeders;

use App\Models\WebsiteSetup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebsiteSetup::create([
            'admin_id' => 2,
            'website_address' => '55 Hamilton Ln Willingboro NJ 08046 United States',
        ]);
    }
}
