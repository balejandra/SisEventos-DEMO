<?php

namespace App\Http\Requests\Zarpes;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SATIM\PermisoEstadia;

class CreatePermisoEstadiaRequest extends FormRequest
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
        return PermisoEstadia::$rules;
    }
}
