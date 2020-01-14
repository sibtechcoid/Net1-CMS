<?php

namespace App\Http\Requests\ProductTypes;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ProductTypes\ProductType;

class UpdateProductTypeRequest extends FormRequest
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
        return ProductType::$rules;
    }
}
