<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactListRequest extends FormRequest
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

    public function sanitize()
    {
        return [
            'name' => ['trim', 'ucwords'],
            'address' => ['trim', 'ucwords'],
            'phone' => ['trim'],
            'fb_username' => ['trim']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/'],
            'fb_username' => ['required', 'string']
        ];
    }
}
