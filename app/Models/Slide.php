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
    const VALID = 1;
    const INVALID = 0;
    protected $table = 'Slides';
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['name','image','status'];

    public static $status = [
        self::VALID => '有效',
        self::INVALID => '无效'
    ];

    public static function displayStatus($status)
    {
        return self::$status[$status];
    }
}