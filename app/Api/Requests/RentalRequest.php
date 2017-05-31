<?php

namespace App\Api\Requests;


use Dingo\Api\Http\FormRequest;

class RentalRequest extends FormRequest
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
            'id' => 'required|exists:users,openid',
        ];
    }

    public function publishRules()
    {
        return [
            'id' => 'required|exists:users,openid',
            //'name' => 'required|unique:rentals,name',
            'cell_name' => 'required',
            'size' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'form' => 'required',
            'price' => 'required',
            'require' => 'required',
            'img' => 'required|array',
        ];
    }

    /**
     * 错误信息
     */
    public function messages()
    {
        return [
            'id.*' => '获取信息失败,请重试',
            //'name.required' => '请输入名称',
            //'name.unique' => '名称已存在，请重新输入',
            'cell_name.required' => '请选择小区',
            'size.required' => '请填写房屋大小',
            'address.required' => '请填写地址',
            'phone.required' => '请输入手机号',
            'longitude.required' => '地址信息错误，请重试',
            'latitude.required' => '地址信息错误，请重试',
            'form.required' => '请选择房屋类型',
            'price.required' => '请填写房屋价格',
            'require.required' => '请选择出租要求',
            'img.*' => '请上传图片'
        ];
    }
}
