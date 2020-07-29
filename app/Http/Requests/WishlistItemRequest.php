<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishlistItemRequest extends FormRequest
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
        $imgUrl = is_null($this->img_url) ? '' : 'url';
        $shopUrl = is_null($this->img_url) ? '' : 'url';
        return [
            'name' => 'required|',
            'price' => 'required',
            'img_url' => $imgUrl,
            'shop_url' => $shopUrl,
            'file' => 'image|mimes:jpg,png,gif,jpeg|max:2048'
        ];
    }
}
