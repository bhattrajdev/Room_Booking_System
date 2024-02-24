<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;



class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'roomnumber' => 'required',
            'slug' => 'required',
            'category' => 'required',
            'facilities' => 'required',
            'price' => 'required',
            'image.*' => 'nullable|mimes:jpeg,png,jpg,gif',
        ];
    }
}
