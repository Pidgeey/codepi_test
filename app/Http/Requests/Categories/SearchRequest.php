<?php

namespace App\Http\Requests\Categories;

use App\Http\Requests\FormRequest;

/**
 * Class SearchRequest
 * @package App\Http\Requests\Categories
 */
class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categories_id' => ['array'],
            'categories_id.*' => ['integer']
        ];
    }
}
