<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/21
 * Time: 0:34
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    protected $table = 'categories';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['name','parent_id','eng_name'];

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getParentCategory($category,$category_names)
    {
        if($category->parent){
            $category_names[] = $category->parent->name;
            $category = $category->parent;
            $category_names = $this->getParentCategory($category,$category_names);
        }
        return $category_names;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product_map', 'category_id', 'product_id');
    }

    public function canChooseProducts()
    {
        $chosen_product_ids = $this->products->lists('id')->toArray();
        $can_chosen_products = Product::whereNotIn('id',$chosen_product_ids)->where('status',1)->orderBy('id','desc');
        return $can_chosen_products;
    }
}