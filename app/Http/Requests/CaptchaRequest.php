<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class CaptchaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'captcha' => 'required',
            'daterange' => 'required',
            'captcha_status' => 'required',
        ];
    }

    /**
     * 自定义验证信息
     *
     * @return array
     */
    public function messages()
    {
        return [
//            'captcha.required' => '授权码为必填的',
            'daterange.required' => '有效期为必填的',
            'captcha_status.required' => '状态为必填的',
        ];
    }

    /**
     * 自定义错误数组
     *
     * @return array
     */
    public function formatErrors(Validator $validator)
    {
        $errors = $validator->errors()->first();
        $result['error'] = $errors;
        return $result;
    }
}
