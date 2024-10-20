<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionPlan::create(['name' => 'Utilisation unique', 'duration_in_days' => 1, 'price' => 1000]);
        SubscriptionPlan::create(['name' => '3 mois', 'duration_in_days' => 90, 'price' => 6000]);
        SubscriptionPlan::create(['name' => '6 mois', 'duration_in_days' => 180, 'price' => 10000]);
        SubscriptionPlan::create(['name' => '12 mois', 'duration_in_days' => 365, 'price' => 16000]);
    }
}
