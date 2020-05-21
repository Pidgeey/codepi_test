<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as IlluminateFormRequest;

class FormRequest extends IlluminateFormRequest
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
}
