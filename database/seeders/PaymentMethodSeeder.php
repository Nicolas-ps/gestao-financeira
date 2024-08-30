<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Cartão de Crédito'],
            ['name' => 'Cartão de Débito'],
            ['name' => 'Boleto'],
            ['name' => 'Transferência Bancária'],
            ['name' => 'Dinheiro'],
            ['name' => 'Pix'],
        ];

        PaymentMethod::insert($methods);
    }
}
