<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\FormRequest;

/**
 * Class SearchRequest
 * @package App\Http\Requests\Products
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
            'with_soft_deletes' => ['bool'],
            'categories' => ['array'],
            'categories.*' => ['integer'],
            'characteristics' => ['array'],
            'characteristics.*' => ['integer']
        ];
    }
}
