<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class SlideRequest extends Request
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
            'name' => 'required',
            'title' => 'required',
            'cn_desc' => 'required',
            'eng_desc' => 'required',
            'banner' => 'required',
            'slide_status' => 'required'
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
            'name.required' => 'Slide名称为必填的',
            'banner.required' => '必须上传Slide的图片',
            'slide_status.required' => '必须选择Slide的状态',
            'title.required' => 'Slide标题为必填的',
            'cn_desc.required' => 'Slide中文描述为必填的',
            'eng_desc.required' => 'Slide英文描述为必填的',
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
