<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 21:06
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'Slides';
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['name','image','status'];
}