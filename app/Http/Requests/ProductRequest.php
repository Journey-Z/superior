<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends Request
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
            'cn_desc' => 'required',
            'eng_desc' => 'required',
            'banner' => 'required',
            'product_status' => 'required'
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
            'name.required' => '商品名称为必填的',
            'banner.required' => '必须上传商品的图片',
            'product_status.required' => '必须选择商品的状态',
            'cn_desc.required' => '商品中文描述为必填的',
            'eng_desc.required' => '商品英文描述为必填的',
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
