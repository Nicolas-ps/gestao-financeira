<?php

namespace Database\Seeders;

use App\Models\DebtStatus;
use Illuminate\Database\Seeder;

class DebtStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['title' => 'Pendente'],
            ['title' => 'Pago'],
            ['title' => 'Atrasado'],
        ];

       DebtStatus::insert($statuses);
    }
}
