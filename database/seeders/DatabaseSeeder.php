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
        // ============ USERS ============
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
user::create([
    'name'=> 'dipty',
    'email'=> 'dipty@gmail.com',
    'password' => Hash::make('12345678'),
    'is_admin' =>0,
]);
        // ============ MAIN CATEGORIES ============
        $mainCategories = [
            'Rice & Grains', 'Oil & Ghee', 'Vegetables', 'Fruits',
            'Dairy & Eggs', 'Meat & Fish', 'Spices', 'Bakery',
            'Beverages', 'Snacks', 'Frozen', 'Household'
        ];

        $categoryModels = [];
        foreach ($mainCategories as $cat) {
            $categoryModels[$cat] = Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'parent_id' => null,
            ]);
        }

        // ============ SUB-CATEGORIES ============
        $subCategories = [
            'Rice & Grains' => ['Miniket', 'Basmati', 'Najirshail', 'Chinigura', 'Sugar', 'Dal'],
            'Oil & Ghee' => ['Soybean Oil', 'Mustard Oil', 'Olive Oil', 'Sunflower Oil', 'Ghee'],
            'Vegetables' => ['Potato', 'Onion', 'Tomato', 'Carrot', 'Brinjal'],
            'Fruits' => ['Apple', 'Banana', 'Orange', 'Mango', 'Grapes'],
            'Dairy & Eggs' => ['Milk', 'Eggs', 'Butter', 'Cheese', 'Yogurt'],
            'Meat & Fish' => ['Chicken', 'Beef', 'Mutton', 'Fish'],
            'Spices' => ['Turmeric', 'Chili', 'Cumin', 'Coriander'],
            'Bakery' => ['Bread', 'Biscuits', 'Cake'],
            'Beverages' => ['Tea', 'Coffee', 'Juice'],
            'Snacks' => ['Chips', 'Chocolate', 'Nuts'],
            'Frozen' => ['Frozen Vegetables', 'Frozen Meat'],
            'Household' => ['Soap', 'Detergent', 'Cleaners'],
        ];

        $subCategoryModels = [];
        foreach ($subCategories as $parentName => $subs) {
            foreach ($subs as $sub) {
                $subCategoryModels[$parentName][$sub] = Category::create([
                    'name' => $sub,
                    'slug' => Str::slug($parentName . '-' . $sub),
                    'parent_id' => $categoryModels[$parentName]->id,
                ]);
            }
        }

        // ============ PRODUCTS ============
        // Format: [Main Category, Sub Category, Name, Price, Unit, Stock, Is Fresh, Description]
        $products = [
            // Rice & Grains
            ['Rice & Grains', 'Miniket', 'Miniket Rice Premium', 75, 'kg', 500, 0, 'Premium quality Miniket rice.'],
            ['Rice & Grains', 'Miniket', 'Miniket Rice 5kg Pack', 360, 'packet', 100, 0, 'Value pack of 5kg Miniket rice.'],
            ['Rice & Grains', 'Basmati', 'Basmati Rice Imported', 180, 'kg', 300, 0, 'Imported premium Basmati rice.'],
            ['Rice & Grains', 'Najirshail', 'Najirshail Rice', 85, 'kg', 400, 0, 'Aromatic Najirshail rice.'],
            ['Rice & Grains', 'Chinigura', 'Chinigura Rice Premium', 130, 'kg', 200, 0, 'Premium Chinigura aromatic rice.'],
            ['Rice & Grains', 'Sugar', 'White Sugar', 120, 'kg', 400, 0, 'Fresh white sugar.'],
            ['Rice & Grains', 'Dal', 'Masoor Dal Premium', 140, 'kg', 250, 0, 'Premium quality red lentil.'],

            // Oil & Ghee
            ['Oil & Ghee', 'Soybean Oil', 'Soybean Oil 1L', 180, 'liter', 200, 0, 'Refined soybean oil.'],
            ['Oil & Ghee', 'Soybean Oil', 'Soybean Oil 5L', 880, 'packet', 50, 0, 'Soybean oil 5 liter pack.'],
            ['Oil & Ghee', 'Mustard Oil', 'Mustard Oil 1L', 250, 'liter', 150, 0, 'Pure mustard oil.'],
            ['Oil & Ghee', 'Olive Oil', 'Olive Oil 500ml', 550, 'liter', 80, 0, 'Extra virgin olive oil.'],
            ['Oil & Ghee', 'Sunflower Oil', 'Sunflower Oil 1L', 220, 'liter', 100, 0, 'Healthy sunflower oil.'],
            ['Oil & Ghee', 'Ghee', 'Pure Cow Ghee 500g', 850, 'kg', 50, 0, 'Pure cow ghee.'],

            // Vegetables
            ['Vegetables', 'Potato', 'Fresh Potato', 40, 'kg', 500, 1, 'Fresh potatoes.'],
            ['Vegetables', 'Onion', 'Fresh Onion', 60, 'kg', 400, 1, 'Fresh onions.'],
            ['Vegetables', 'Tomato', 'Ripe Tomato', 80, 'kg', 200, 1, 'Ripe red tomatoes.'],
            ['Vegetables', 'Carrot', 'Fresh Carrot', 70, 'kg', 150, 1, 'Fresh carrots.'],
            ['Vegetables', 'Brinjal', 'Fresh Brinjal', 55, 'kg', 180, 1, 'Fresh brinjals.'],

            // Fruits
            ['Fruits', 'Apple', 'Red Apple', 180, 'kg', 80, 1, 'Fresh red apples.'],
            ['Fruits', 'Banana', 'Ripe Banana', 120, 'dozen', 100, 1, 'Fresh ripe bananas.'],
            ['Fruits', 'Orange', 'Juicy Orange', 200, 'kg', 70, 1, 'Juicy oranges.'],
            ['Fruits', 'Mango', 'Himsagar Mango', 220, 'kg', 60, 1, 'Sweet Himsagar mangoes.'],
            ['Fruits', 'Grapes', 'Green Grapes', 250, 'kg', 40, 1, 'Fresh green grapes.'],

            // Dairy & Eggs
            ['Dairy & Eggs', 'Milk', 'Fresh Cow Milk 1L', 90, 'liter', 100, 1, 'Fresh cow milk.'],
            ['Dairy & Eggs', 'Eggs', 'Farm Fresh Eggs', 140, 'dozen', 200, 1, 'Farm fresh eggs.'],
            ['Dairy & Eggs', 'Butter', 'Premium Butter 200g', 320, 'packet', 80, 0, 'Premium quality butter.'],
            ['Dairy & Eggs', 'Cheese', 'Cheddar Cheese 200g', 450, 'packet', 60, 0, 'Imported cheddar cheese.'],
            ['Dairy & Eggs', 'Yogurt', 'Fresh Yogurt 500g', 120, 'packet', 100, 1, 'Fresh homemade yogurt.'],

            // Meat & Fish
            ['Meat & Fish', 'Chicken', 'Fresh Chicken 1kg', 220, 'kg', 80, 1, 'Fresh chicken.'],
            ['Meat & Fish', 'Beef', 'Premium Beef 1kg', 750, 'kg', 40, 1, 'Premium quality beef.'],
            ['Meat & Fish', 'Mutton', 'Fresh Mutton 1kg', 950, 'kg', 25, 1, 'Fresh mutton.'],
            ['Meat & Fish', 'Fish', 'Rui Fish 1kg', 350, 'kg', 50, 1, 'Fresh Rui fish.'],

            // Spices
            ['Spices', 'Turmeric', 'Turmeric Powder 200g', 220, 'packet', 90, 0, 'Pure turmeric powder.'],
            ['Spices', 'Chili', 'Chili Powder 200g', 280, 'packet', 80, 0, 'Hot chili powder.'],
            ['Spices', 'Cumin', 'Cumin Seeds 100g', 180, 'packet', 100, 0, 'Premium cumin seeds.'],
            ['Spices', 'Coriander', 'Coriander Powder 100g', 150, 'packet', 110, 0, 'Fresh coriander powder.'],

            // Bakery
            ['Bakery', 'Bread', 'Fresh Bread 400g', 45, 'packet', 150, 0, 'Fresh bread.'],
            ['Bakery', 'Biscuits', 'Premium Biscuits', 60, 'packet', 200, 0, 'Crunchy biscuits.'],
            ['Bakery', 'Cake', 'Chocolate Cake 500g', 350, 'piece', 30, 0, 'Delicious chocolate cake.'],

            // Beverages
            ['Beverages', 'Tea', 'Premium Tea 400g', 350, 'packet', 100, 0, 'Premium tea powder.'],
            ['Beverages', 'Coffee', 'Instant Coffee 100g', 550, 'packet', 60, 0, 'Instant coffee.'],
            ['Beverages', 'Juice', 'Orange Juice 1L', 180, 'liter', 80, 0, 'Fresh orange juice.'],

            // Snacks
            ['Snacks', 'Chips', 'Potato Chips 100g', 30, 'packet', 300, 0, 'Crispy potato chips.'],
            ['Snacks', 'Chocolate', 'Milk Chocolate 100g', 120, 'packet', 150, 0, 'Delicious milk chocolate.'],
            ['Snacks', 'Nuts', 'Mixed Nuts 200g', 450, 'packet', 70, 0, 'Premium mixed nuts.'],

            // Frozen
            ['Frozen', 'Frozen Vegetables', 'Frozen Mixed Vegetables', 120, 'packet', 100, 0, 'Frozen mixed vegetables.'],
            ['Frozen', 'Frozen Meat', 'Frozen Chicken Nuggets', 280, 'packet', 70, 0, 'Frozen chicken nuggets.'],

            // Household
            ['Household', 'Soap', 'Antibacterial Soap', 45, 'piece', 250, 0, 'Antibacterial soap.'],
            ['Household', 'Detergent', 'Washing Powder 1kg', 220, 'packet', 100, 0, 'Washing powder.'],
            ['Household', 'Cleaners', 'Floor Cleaner 1L', 180, 'liter', 80, 0, 'Floor cleaner.'],
        ];

        foreach ($products as $p) {
            $mainCategory = $categoryModels[$p[0]] ?? null;
            $subCategory = $subCategoryModels[$p[0]][$p[1]] ?? null;

            if ($mainCategory) {
                Product::create([
                    'category_id' => $mainCategory->id,
                    'sub_category_id' => $subCategory ? $subCategory->id : null,
                    'name' => $p[2],
                    'slug' => Str::slug($p[2]),
                    'price' => $p[3],
                    'unit' => $p[4],
                    'stock' => $p[5],
                    'is_fresh' => $p[6],
                    'description' => $p[7],
                    'image' => null,
                ]);
            }
        }

        // ============ COUPONS ============
        Coupon::create(['code' => 'GROCERY10', 'type' => 'percent', 'value' => 10, 'expiry_date' => now()->addYear()]);
        Coupon::create(['code' => 'SAVE100', 'type' => 'fixed', 'value' => 100, 'expiry_date' => now()->addYear()]);
        Coupon::create(['code' => 'FREEDEL', 'type' => 'fixed', 'value' => 60, 'expiry_date' => now()->addYear()]);

        $this->command->info('✅ Seeder completed!');
        $this->command->info('📁 Main Categories: ' . count($mainCategories));
        $this->command->info('📂 Sub-Categories: ' . collect($subCategories)->sum(fn($s) => count($s)));
        $this->command->info('🛍️ Products: ' . count($products));
    }
}

?>