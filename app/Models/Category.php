<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_id'];

    // Main Category → Many Sub-Categories
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Sub-Category → Belongs to Main Category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Category → Many Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Sub-Category → Many Products
    public function subCategoryProducts()
    {
        return $this->hasMany(Product::class, 'sub_category_id');
    }

    // only Main Categories
    public static function mainCategories()
    {
        return self::whereNull('parent_id')->get();
    }

    // Main Category all product
    public function allProducts()
    {
        $subCategoryIds = $this->subCategories->pluck('id')->toArray();
        return Product::where('category_id', $this->id)
            ->orWhereIn('sub_category_id', $subCategoryIds)
            ->get();
    }
}
?>