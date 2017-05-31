<?php

namespace App\Http\Requests\Manage\Service;

use App\Models\Rental;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        ];
        return get_request_rules($this, $commons);
    }

    public function auditRules()
    {
        return [
            'remark' => 'max:255',
            'type' => 'required|' . Rule::in([1, 2, 3]),
            'url' => 'required'
        ];
    }

    public function updateRules()
    {
        return [
            'name' => 'required|max:255',
            'phone' => 'required|digits_between:1,11',
            'remark' => 'max:255',
            'address' => 'required|max:255',
            'longitude' => 'required',
            'latitude' => 'required',
            'form' => 'required|' . Rule::in(array_keys(app(Rental::class)->formText)),
            'require' => 'required|' . Rule::in(array_keys(app(Rental::class)->requireText)),
            'size' => 'required',
            'price' => 'required|numeric',
        ];
    }

}
