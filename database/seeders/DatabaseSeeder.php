<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=DatabaseSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Schema::disableForeignKeyConstraints();
        // DB::table('categories')->truncate();
        // Schema::enableForeignKeyConstraints();
        
        // Insert sample data
        DB::table('categories')->insert([
            [
                'name' => 'Technology', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Health', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Education', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Business', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Entertainment', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ]);

        DB::table('products')->insert([
            [
                'productName' => 'Laptop',
                'price' => 1200.99,
                'category_id' => 1,
                'stockQuantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Smartphone',
                'price' => 699.99,
                'category_id' => 1,
                'stockQuantity' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'productName' => 'Headphones',
                'price' => 199.99,
                'category_id' => 1,
                'stockQuantity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('sales')->insert([
            [
                'totalQuantity' => 3,
                'totalPrice' => 1900.90,
                'payMethod' => 'Debit or Credit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'totalQuantity' => 1,
                'totalPrice' => 199.99,
                'payMethod' => 'M-PESA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'totalQuantity' => 3,
                'totalPrice' => 199.99,
                'payMethod' => 'Cash',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('salesDetail')->insert([
            [
                'sale_id' => 1,
                'product_id' => 1,
                'productName' => 'Laptop',
                'price' => 1200.99,
                'quantity' => 1,
            ],
            [
                'sale_id' => 1,
                'product_id' => 2,
                'productName' => 'Smartphone',
                'price' => 699.99,
                'quantity' => 2,
            ],
            [
                'sale_id' => 2,
                'product_id' => 3,
                'productName' => 'Headphones',
                'price' => 199.99,
                'quantity' => 1,
            ],
                                         [
                'sale_id' => 3,
                'product_id' => 3,
                'productName' => 'Headphones',
                'price' => 199.99,
                'quantity' => 3,
            ],
        ]);
    }
}
