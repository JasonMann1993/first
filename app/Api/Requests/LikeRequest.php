<?php
namespace App\Api\Requests;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;
class LikeRequest extends FormRequest
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

    public function indexRules()
    {
        return [
        ];
    }
    public function auditRules()
    {
        return [
            'id' => 'required|exists:users,openid',
            'common_id' => 'required',
        ];
    }

    /**
     * 错误信息
     */
    public function messages()
    {
        return [
            'id.*' => '获取信息失败,请重试',
            'common_id.required' => '请输入关联表 ID',
        ];
    }


}
