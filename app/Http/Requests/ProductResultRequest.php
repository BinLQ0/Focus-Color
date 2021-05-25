<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductResultRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'for'                   => 'required|exists:releases,id|unique:releases',
                        'product_location.*'    => 'required|gte:0'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'for'                   => 'sometimes|required|exists:releases,id|unique:releases,for,' . $this->release['id'],
                        'product_location.*'    => 'required|gte:0'
                    ];
                }
            default:
                break;
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'for' => 'No. Lot Material Release',
        ];
    }
}
