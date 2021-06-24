<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialReleaseRequest extends FormRequest
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
                        'for'           => 'required|unique:releases',
                        'description'   => 'required',
                        'pid'           => 'required|array|min:1'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'for'           => 'sometimes|required|unique:releases,for,' . $this->release['id'],
                        'pid'           => 'required|array|min:1'
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
            'for'           => 'No. Lot',
            'description'    => 'End Product'
        ];
    }
}
