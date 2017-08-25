<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/22
 * Time: 20:32
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CategoryMap extends Model
{
    protected $table = 'category_product_map';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['category_id','product_id'];
}