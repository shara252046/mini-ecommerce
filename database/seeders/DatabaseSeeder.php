<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 1,
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 0,
        ]);

        // Grocery Categories
        $categories = [
            'Rice & Grains', 'Oil & Ghee', 'Vegetables', 'Fruits',
            'Dairy & Eggs', 'Meat & Fish', 'Spices', 'Bakery',
            'Beverages', 'Snacks', 'Frozen', 'Household'
        ];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat, 'slug' => Str::slug($cat)]);
        }

        // Grocery Products
        // [Category, Name, Price, Unit, Stock, IsFresh, Description]
        $products = [
            ['Rice & Grains', 'Miniket Rice', 75, 'kg', 500, 0, 'Premium quality Miniket rice.'],
            ['Rice & Grains', 'Basmati Rice', 180, 'kg', 300, 0, 'Imported Basmati rice.'],
            ['Rice & Grains', 'Sugar', 120, 'kg', 400, 0, 'Fresh white sugar.'],
            ['Rice & Grains', 'Masoor Dal', 140, 'kg', 250, 0, 'Premium red lentil.'],
            ['Oil & Ghee', 'Soybean Oil', 180, 'liter', 200, 0, 'Refined soybean oil.'],
            ['Oil & Ghee', 'Mustard Oil', 250, 'liter', 150, 0, 'Pure mustard oil.'],
            ['Oil & Ghee', 'Ghee', 850, 'kg', 80, 0, 'Pure cow ghee.'],
            ['Vegetables', 'Potato', 40, 'kg', 500, 1, 'Fresh potatoes.'],
            ['Vegetables', 'Onion', 60, 'kg', 400, 1, 'Fresh onions.'],
            ['Vegetables', 'Tomato', 80, 'kg', 200, 1, 'Ripe red tomatoes.'],
            ['Vegetables', 'Carrot', 70, 'kg', 150, 1, 'Fresh carrots.'],
            ['Fruits', 'Banana', 120, 'dozen', 100, 1, 'Fresh ripe bananas.'],
            ['Fruits', 'Apple', 180, 'kg', 80, 1, 'Fresh red apples.'],
            ['Fruits', 'Orange', 200, 'kg', 70, 1, 'Juicy oranges.'],
            ['Dairy & Eggs', 'Milk Powder', 450, 'packet', 120, 0, 'Full cream milk powder.'],
            ['Dairy & Eggs', 'Eggs', 140, 'dozen', 200, 1, 'Farm fresh eggs.'],
            ['Dairy & Eggs', 'Fresh Milk', 90, 'liter', 100, 1, 'Fresh cow milk.'],
            ['Meat & Fish', 'Rui Fish', 350, 'kg', 50, 1, 'Fresh Rui fish.'],
            ['Meat & Fish', 'Chicken', 220, 'kg', 80, 1, 'Fresh chicken.'],
            ['Meat & Fish', 'Beef', 750, 'kg', 40, 1, 'Premium beef.'],
            ['Spices', 'Turmeric Powder', 220, 'kg', 90, 0, 'Pure turmeric powder.'],
            ['Spices', 'Chili Powder', 280, 'kg', 80, 0, 'Hot chili powder.'],
            ['Bakery', 'Bread', 45, 'packet', 150, 0, 'Fresh bread.'],
            ['Bakery', 'Biscuits', 60, 'packet', 200, 0, 'Crunchy biscuits.'],
            ['Beverages', 'Tea Powder', 350, 'kg', 100, 0, 'Premium tea powder.'],
            ['Beverages', 'Coffee', 550, 'packet', 60, 0, 'Instant coffee.'],
            ['Snacks', 'Chips', 30, 'packet', 300, 0, 'Crispy potato chips.'],
            ['Snacks', 'Chocolate', 120, 'packet', 150, 0, 'Milk chocolate.'],
            ['Frozen', 'Frozen Peas', 90, 'packet', 100, 0, 'Frozen green peas.'],
            ['Frozen', 'Frozen Chicken', 280, 'packet', 70, 0, 'Frozen chicken nuggets.'],
            ['Household', 'Soap', 45, 'piece', 250, 0, 'Antibacterial soap.'],
            ['Household', 'Detergent', 220, 'packet', 100, 0, 'Washing powder.'],
        ];

        foreach ($products as $p) {
            $category = Category::where('name', $p[0])->first();
            Product::create([
                'category_id' => $category->id,
                'name' => $p[1],
                'slug' => Str::slug($p[1]),
                'price' => $p[2],
                'unit' => $p[3],
                'stock' => $p[4],
                'is_fresh' => $p[5],
                'description' => $p[6],
                'image' => null,
            ]);
        }

        // Coupons
        Coupon::create(['code' => 'GROCERY10', 'type' => 'percent', 'value' => 10, 'expiry_date' => now()->addYear()]);
        Coupon::create(['code' => 'SAVE100', 'type' => 'fixed', 'value' => 100, 'expiry_date' => now()->addYear()]);
        Coupon::create(['code' => 'FREEDEL', 'type' => 'fixed', 'value' => 60, 'expiry_date' => now()->addYear()]);
    }
}

?>