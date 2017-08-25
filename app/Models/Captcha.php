<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/24
 * Time: 15:55
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Captcha extends Model
{
    const VALID = 1;
    const INVALID = 0;
    protected $table = 'captcha';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['captcha','status','start_at','end_at'];

    public static $status = [
        self::VALID => '有效',
        self::INVALID => '无效'
    ];

    public static function displayStatus($status)
    {
        return self::$status[$status];
    }

    public static function changeTimeToLocal($time)
    {
        if (is_string($time)) {
            $time = new \Carbon\Carbon($time);
        }
        $time = $time->setTimezone('Asia/Shanghai')->toDateTimeString();
        return $time;
    }
}