<?php

namespace App\Http\Requests\Publico;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Publico\CapitaniaUser;

class UpdateCapitaniaUserRequest extends FormRequest
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
        $rules = CapitaniaUser::$rules;

        return $rules;
    }
}
