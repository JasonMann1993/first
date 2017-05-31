<?php

namespace App\Api\Requests;


use App\Models\User;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        ];
        return get_request_rules($this, $commons);
    }

    public function handleUserRules()
    {
        return [
            'openid' => 'required',  # openid
            'name' => 'required', # 昵称
            'avatar' => 'required',  # 头像
            'gender' => 'required|' . Rule::in(array_keys(app(User::class)->sexText)),  # 用户性别
            'info' => 'required', # 用户JSON
        ];
    }

    public function getOpenidRules()
    {
        return [
            'code' => 'required',
        ];
    }
}
