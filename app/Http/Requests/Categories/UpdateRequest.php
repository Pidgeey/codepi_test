<?php

namespace App\Http\Requests\Categories;

use App\Http\Requests\FormRequest;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Categories
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
            'name' => ['required', 'min:6', 'max:80']
        ];
    }
}
