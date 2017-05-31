<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class ShopDetailRequest extends FormRequest
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
            //
            'name' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required'
        ];
    }

    /**
     * 错误信息
     */
    public function messages()
    {
        return [
            'name.required' => '名称不能为空',
            'lat.required' => '请选择位置',
            'lng.required' => '请选择位置',
            'address.required' => '请选择位置',
        ];
    }
}
