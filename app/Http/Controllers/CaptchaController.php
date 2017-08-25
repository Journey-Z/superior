<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/24
 * Time: 16:23
 */

namespace App\Http\Controllers;


use App\Http\Requests\CaptchaRequest;
use App\Models\Captcha;
use App\Traits\TimeTrait;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    use TimeTrait;
    public function getIndex(Request $request)
    {
        $title = '授权码列表';
        $page = $request->input('page', 1);
        $length = $request->input('length', 10);
        $id = $request->input('id');
        $start_at = $request->input('start_at');
        $end_at = $request->input('end_at');
        if($start_at) {
            $start_at = $this->get_time_range($start_at);
        }
        if($end_at) {
            $end_at = $this->get_time_range($end_at);
        }
        $captcha_input = $request->input('captcha');
        $status = $request->input('status');
        $captcha = Captcha::whereRaw('1=1');
        if($id) {
            $captcha = $captcha->where('id',$id);
        }
        if($start_at) {
            $captcha = $captcha->where("start_at", ">=", $start_at[0])->where("start_at", "<=", $start_at[1]);
        }
        if($end_at) {
            $captcha = $captcha->where("end_at", ">=", $end_at[0])->where("end_at", "<=", $end_at[1]);
        }
        if($captcha_input) {
            $captcha = $captcha->where('captcha','like',"%$captcha_input%");
        }
        if(isset($status)) {
            $captcha = $captcha->where('status',$status);
        }
        $captcha = $captcha->orderBy('id','desc')->paginate($length);
        $result = [
            'title' => $title,
            'captcha' => $captcha
        ];
        return view('admin.captchas.list',$result);
    }

    public function getGenerate(Request $request)
    {
        $id = $request->input('captcha_id');
        $captcha = null;
        if($id) {
            $title = '授权码详情';
            $captcha = Captcha::find($id);
        } else {
            $title = '生成授权码';
        }
        $result = [
            'title' => $title,
            'captcha_id' => $id,
            'captcha' => $captcha
        ];
        return view('admin.captchas.generate',$result);
    }

    public function generate(CaptchaRequest $captchaRequest)
    {
        $expiration_dates = $this->handleExpirationDate($captchaRequest->input('daterange'));
        $start_at = $expiration_dates['start_at'];
        $end_at = $expiration_dates['end_at'];

        if ($captchaRequest['id']) {
            $captcha = Captcha::find($captchaRequest['id']);
            $captcha_generate = $captchaRequest->input('captcha');
            if(!$captcha_generate) {
                $captcha_generate = $this->generateCaptcha($captchaRequest->input('captcha'));
            }
            $captcha->captcha = $captcha_generate;
            $captcha->start_at = $start_at;
            $captcha->end_at = $end_at;
            $captcha->status = $captchaRequest->input('captcha_status');
            $captcha->save();
        } else {
            $captcha_generate = $this->generateCaptcha($captchaRequest->input('captcha'));
            $captcha = [
                'captcha' => $captcha_generate,
                'start_at' => $start_at,
                'end_at' => $end_at,
                'status' => $captchaRequest->input('captcha_status'),
            ];
            $captcha = Captcha::firstOrCreate($captcha);
        }
        $captcha_id = $captcha ? $captcha->id : 0;
        return ['status' => true, 'id' => $captcha_id];
    }

    private function handleExpirationDate($date_range)
    {
        $date = explode(' - ',$date_range);
        //网站选择的是洛杉矶时间，转换成UTC再存数据库
        $timezone = 'UTC';
        $carbonAt = new \Carbon\Carbon($date[0], "Asia/Shanghai");
        $carbonAt->setTimezone($timezone);
        $startAt = $carbonAt->toDateTimeString();

        $carbonAt = new \Carbon\Carbon($date[1], "Asia/Shanghai");
        $carbonAt->setTimezone($timezone);
        $endAt = $carbonAt->toDateTimeString();
        return ['start_at' => $startAt,'end_at' => $endAt];
    }

    private function generateCaptcha($captcha)
    {
        while (true) {
            $is_exist = Captcha::where('captcha', $captcha)->first();
            if (!$is_exist) {
                break;
            }
            $captcha = $this->generateRandom();
        }
        return $captcha;
    }

    public function generateRandom($length = 6)
    {
        $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $code;
    }
}