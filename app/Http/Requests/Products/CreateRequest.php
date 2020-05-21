<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Products
 */
class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:6', 'max:80'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['integer'],
            'characteristics' => ['required', 'array', 'min:3'],
            'characteristics.*' => ['integer']
        ];
    }
}
