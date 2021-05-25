<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'username' => 'required|unique:users',
                        'password' => 'required|confirmed|min:4',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'username'  => 'sometimes|required|unique:users, username,' . $this->user['id'],
                        'password'  => 'sometimes|required|confirmed|min:4',
                        'role'      => 'sometimes|required',
                    ];
                }
            default:
                break;
        }
    }
}
