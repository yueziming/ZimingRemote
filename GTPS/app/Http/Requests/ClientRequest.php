<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'   => 'required',
            'organization_id' => [
                'required',
                'integer',
            ],
            'mobile'  => [
                'required',
                'regex:/^1(3[0-9]|4[57]|5[0-35-9]|7[01678]|8[0-9])[0-9]{8}$/'
            ],
            'gender'  => 'required',
            'level'  => 'required',
            'type'  => 'required',
        ];
    }
}
