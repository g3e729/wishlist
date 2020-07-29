<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishlistInviteRequest extends FormRequest
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
        session(['lastAction' => $this->fullUrl()]);
        return [
            'emails.*' => 'email'
        ];
    }

    public function messages()
    {
        return [
            'emails.*.email' => 'Make sure you provide valid email addresses.'
        ];
    }
}
