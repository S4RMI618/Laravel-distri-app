<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Crear 4 productos aleatorios
        Product::create([
            'name' => 'Producto 1',
            'code' => strtoupper($faker->lexify('???-???')),
            'base_price_1' => $faker->randomFloat(2, 10000, 50000), // Precio base entre 10000 y 500000
            'base_price_2' => $faker->randomFloat(2, 10000, 50000),
            'base_price_3' => $faker->randomFloat(2, 10000, 50000),
            'tax_rate' => 19.00, // Tasa de impuesto entre 0% y 25%
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'name' => 'Producto 2',
            'code' => strtoupper($faker->lexify('???-???')),
            'base_price_1' => $faker->randomFloat(2, 10000, 50000),
            'base_price_2' => $faker->randomFloat(2, 10000, 50000),
            'base_price_3' => $faker->randomFloat(2, 10000, 50000),
            'tax_rate' => 19.00, 
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'name' => 'Producto 3',
            'code' => strtoupper($faker->lexify('???-???')),
            'base_price_1' => $faker->randomFloat(2, 10000, 50000),
            'base_price_2' => $faker->randomFloat(2, 10000, 50000),
            'base_price_3' => $faker->randomFloat(2, 10000, 50000),
            'tax_rate' => 19.00, 
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'name' => 'Producto 4',
            'code' => strtoupper($faker->lexify('???-???')),
            'base_price_1' => $faker->randomFloat(2, 10000, 50000),
            'base_price_2' => $faker->randomFloat(2, 10000, 50000),
            'base_price_3' => $faker->randomFloat(2, 10000, 50000), 
            'tax_rate' => 19.00, 
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'name' => 'Producto 5',
            'code' => strtoupper($faker->lexify('???-???')),
            'base_price_1' => $faker->randomFloat(2, 10000, 50000),
            'base_price_2' => $faker->randomFloat(2, 10000, 50000),
            'base_price_3' => $faker->randomFloat(2, 10000, 50000), 
            'tax_rate' => 19.00, 
            'company_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
