<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'email' => 'required|email',
            'shipping_address_1' => 'required|string',
            'shipping_address_2' => 'string',
            'shipping_address_3' => 'string',
            'city' => 'required|string',
            'country_code' => 'required',
            'zip_postal_code' => 'required',
            'phone_number' => 'required',
            'products' => 'required'
        ];
    }
}
