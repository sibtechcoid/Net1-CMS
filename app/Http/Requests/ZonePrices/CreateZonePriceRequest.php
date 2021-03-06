<?php

namespace App\Http\Requests\ZonePrices;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ZonePrices\ZonePrice;

class CreateZonePriceRequest extends FormRequest
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
        return ZonePrice::$rules;
    }
}
