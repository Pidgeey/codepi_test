<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Products
 */
class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:80', 'min:6'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['integer'],
            'characteristics' => ['required', 'array', 'min:3'],
            'characteristics.*' => ['integer']
        ];
    }
}
