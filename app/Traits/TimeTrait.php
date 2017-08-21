<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/20
 * Time: 15:47
 */

namespace App\Traits;


use MongoDB\Driver\Exception\RuntimeException;

Trait TimeTrait
{
    protected $timezone;

    public function __construct()
    {
        $this->timezone = 'Asia/Shanghai';
    }

    /**
     * 根据时间选择器返回相应的时间范围,数据存的全部是UTC时间,所以需要转成UTC
     *
     * @param $date_range
     * @param bool $convert_to_utc
     * @return array
     */
    protected function get_time_range($date_range,$convert_to_utc = true)
    {
        if (!$date_range) {
            return [null, null];
        }
        try {
            $array = explode(' - ', $date_range);
            if(count($array)<2){
                throw new RuntimeException('get time range error, date_range'.$date_range);
            }
            list($start_at, $end_at) = $array;
            $timezone = $this->timezone;
            $start_at = new \Carbon\Carbon($start_at.' 00:00:00', $timezone);
            $end_at = new \Carbon\Carbon($end_at.' 23:59:59', $timezone);
            if ($convert_to_utc) {
                $start_at->setTimezone('UTC');
                $end_at->setTimezone('UTC');
            }
            return [$start_at->toDateTimeString(), $end_at->toDateTimeString()];
        }catch (\Exception $e){
            return [null, null];
        }
    }
}