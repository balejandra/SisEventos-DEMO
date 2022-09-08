<?php

namespace App\Http\Requests\Publico;

use App\Models\Publico\Menu_rol;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenu_rolRequest extends FormRequest
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
        $rules = Menu_rol::$rules;

        return $rules;
    }
}
