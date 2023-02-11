<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'So Klin Pewangi',
                'price' => '15000',
                'currency' => 'IDR',
                'discount' => '10',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'So klin Softener',
                'price' => '25000',
                'currency' => 'IDR',
                'discount' => '0',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'So klin Liquid',
                'price' => '27000',
                'currency' => 'IDR',
                'discount' => '0',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'Super Sol',
                'price' => '20000',
                'currency' => 'IDR',
                'discount' => '5',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'GIV barsoap and body wash',
                'price' => '8000',
                'currency' => 'IDR',
                'discount' => '0',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'NUVO Health barsoap',
                'price' => '7500',
                'currency' => 'IDR',
                'discount' => '0',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'ProGuard',
                'price' => '17500',
                'currency' => 'IDR',
                'discount' => '15',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'Boom Detergent',
                'price' => '18000',
                'currency' => 'IDR',
                'discount' => '0',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'Daia Detergent',
                'price' => '18500',
                'currency' => 'IDR',
                'discount' => '0',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'So Klin Detergent',
                'price' => '19000',
                'currency' => 'IDR',
                'discount' => '0',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'Rapika',
                'price' => '5000',
                'currency' => 'IDR',
                'discount' => '0',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'WPC Porcelain',
                'price' => '21000',
                'currency' => 'IDR',
                'discount' => '10',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'Shampo Zinc',
                'price' => '28000',
                'currency' => 'IDR',
                'discount' => '15',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'Emeron Lovely',
                'price' => '29000',
                'currency' => 'IDR',
                'discount' => '10',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ],[
                'product_code' => strtoupper(Str::random(18)),
                'product_name' => 'Ciptadent',
                'price' => '25000',
                'currency' => 'IDR',
                'discount' => '10',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS'
            ]
        ];

        foreach ($data as $d) {
            DB::table('products')->insert($d);
        }
    }
}
