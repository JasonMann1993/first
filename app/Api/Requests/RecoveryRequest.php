<?php

namespace App\Api\Requests;


use Dingo\Api\Http\FormRequest;

class RecoveryRequest extends FormRequest
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
        $commons = [
            'longitude' => 'required',
            'latitude' => 'required'
        ];
        return get_request_rules($this, $commons);
    }

    public function indexRules()
    {
        return [
        ];
    }

    public function publishRules()
    {
        return [
            'id' => 'required|exists:users,openid',
            'address' => 'required',
            'name' => 'required|unique:recoveries,name',
            'phone' => 'required',
            'img' => 'required|exists:imgs,id'
        ];
    }

    /**
     * 错误信息
     */
    public function messages()
    {
        return [
            'id.*' => '获取信息失败,请重试',
            'name.required' => '请输入名称',
            'name.unique' => '名称已存在，请重新输入',
            'address.required' => '请填写地址',
            'phone.required' => '请输入手机号',
            'longitude.required' => '地址信息错误，请重试',
            'latitude.required' => '地址信息错误，请重试',
            'img.*' => '请上传图片'
        ];
    }
}
