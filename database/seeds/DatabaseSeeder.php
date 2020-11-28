<?php

use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('transactions')->truncate();
        DB::table('category_product')->truncate();

        $usersQuantity = 20;
        $categoriesQuantity = 10;
        $productsQuantity = 100;
        $transactionsQuantity = 100;

        factory(User::class, $usersQuantity)->create();
        factory(Category::class, $categoriesQuantity)->create();
        factory(Product::class, $productsQuantity)->create()->each(
            function ($product) {
                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $product->categories()->attach($categories);
            }
        );
        factory(Transaction::class, $transactionsQuantity)->create();
    }
}
