<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Branch;

class StockSeeder extends Seeder
{
    public function run()
    {
        $branch = Branch::find(1);
        $branch->stocks()->create(['product_id' => 1, 'quantity' => 100]);

        // $branch = Branch::find(2);
        // $branch->stocks()->create(['product_id' => 2, 'quantity' => 150]);

        // $branch = Branch::find(3);
        // $branch->stocks()->create(['product_id' => 3, 'quantity' => 200]);
    }
}
