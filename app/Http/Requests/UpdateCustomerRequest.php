<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'username' => 'string',
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email:rfc',
            'phone' => 'numeric',
            'active' => 'integer|min:0|max:1',
            'group_ids.*' => 'exists:App\Models\CustomerGroup,id'
        ];
    }
}
