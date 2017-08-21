<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/20
 * Time: 22:58
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const VALID = 1;
    const INVALID = 0;
    protected $table = 'products';
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['name','image','status','title','cn_description','eng_description'];

    public static $status = [
        self::VALID => '上线',
        self::INVALID => '下线'
    ];

    public static function displayStatus($status)
    {
        return self::$status[$status];
    }

    public static function changeTimeToLocal($time)
    {
        $time = $time->setTimezone('Asia/Shanghai')->toDateTimeString();
        return $time;
    }
}