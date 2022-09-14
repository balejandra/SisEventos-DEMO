<?php

namespace App\Http\Requests\SATIM;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SATIM\AutorizacionEvento;

class CreateAutorizacionEventoRequest extends FormRequest
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
        return AutorizacionEvento::$rules;
    }
}
