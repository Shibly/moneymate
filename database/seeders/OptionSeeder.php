<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::create([
            'key' => 'company_name',
            'value' => 'Moneymate'
        ]);

        Option::create([
            'key' => 'web_site',
            'value' => url('/')
        ]);

        Option::create([
            'key' => 'default_currency',
            'value' => 'USD'
        ]);

        Option::create([
            'key' => 'num_data_per_page',
            'value' => 10
        ]);

        Option::create([
            'key' => 'application_name',
            'value' => 'Moneymate'
        ]);

    }
}
