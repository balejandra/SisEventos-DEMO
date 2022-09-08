<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Vageneral\AgenciaNavieraVigente;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use Flash;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('verifiedRole');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['tipo_persona']=="natural"){
            return Validator::make($data, [
                'nombres' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255','unique:users'],
                'apellidos' => ['string', 'max:255'],
                'tipo_identificacion' => ['required','string', 'max:20'],
                'numero_identificacion' => ['required','string', 'max:20','unique:users'],
                'fecha_nacimiento' => ['date', 'max:50'],
                'telefono' => ['required', 'string', 'max:20'],
                'direccion' => ['required', 'string', 'max:255'],
                'password' => [
                    'required',
                    'max:50',
                    'confirmed',
                    Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->uncompromised(),
                ],
                'tipo_usuario' => ['string', 'max:20'],
            ],
                [
                    'email.unique'=>'Email ya registrado',
                    'numero_identificacion.unique'=>'Numero de Identificacion ya registrado',
                ]);
         }else if($data['tipo_persona']=="juridica"){
            return Validator::make($data, [
                'numero_identificacion' => ['required','string','min:9', 'max:20','unique:users'],
                'nombres' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255','unique:users'],
                'tipo_identificacion' => ['required','string', 'max:20'],
                'prefijo' => ['required','string', 'max:20'],
                'telefono' => ['required', 'string', 'max:20'],
                'direccion' => ['required', 'string', 'max:20'],
                'password' => [
                    'required',
                    'max:50',
                    'confirmed',
                    Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->uncompromised(),
                ],
                'tipo_usuario' => ['string', 'max:20'],
            ],
                [
                    'email.unique'=>'Email ya registrado',
                    'numero_identificacion.unique'=>'Numero de Identificacion ya registrado',
                    'password.'
                ]);
        }


    }


    public function ValidarRIF(Request $request) {
        $rif=$_REQUEST['rif'];
       // dd($rif);
        $retorno = preg_match("/^([VEJPG]{1})([0-9]{9}$)/",$rif);

            $digitos = str_split($rif);
            $digitos[8] *= 2;
            $digitos[7] *= 3;
            $digitos[6] *= 4;
            $digitos[5] *= 5;
            $digitos[4] *= 6;
            $digitos[3] *= 7;
            $digitos[2] *= 2;
            $digitos[1] *= 3;

            // Determinar dígito especial según la inicial del RIF
            // Regla introducida por el SENIAT
            switch ($digitos[0]) {
                case 'V':
                    $digitoEspecial = 1;
                    break;
                case 'E':
                    $digitoEspecial = 2;
                    break;
                case 'C':
                case 'J':
                    $digitoEspecial = 3;
                    break;
                case 'P':
                    $digitoEspecial = 4;
                    break;
                case 'G':
                    $digitoEspecial = 5;
                    break;
            }

            $suma = (array_sum($digitos) - $digitos[9]) + ($digitoEspecial*4);
            $residuo = $suma % 11;
            $resta = 11 - $residuo;

            $digitoVerificador = ($resta >= 10) ? 0 : $resta;

            if ($digitoVerificador != $digitos[9]) {
                $retorno=response()->json([
                    'status'=>3,
                    'msg' => $exception->getMessage(),
                    'errors'=>[],
                ], 200);
            }

        echo json_encode($retorno);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $input
     * @return \App\Models\User
     */
    protected function create(array $input)
    {

        if ($input['tipo_persona']=="natural"){
        $user = User::create([
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'tipo_identificacion' => $input['tipo_identificacion'],
            'numero_identificacion' => $input['numero_identificacion'],
            'fecha_nacimiento' => $input['fecha_nacimiento'],
            'telefono' => $input['telefono'],
            'direccion' => $input['direccion'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'tipo_usuario' => 'Usuario Web'
        ]);
        $role = Role::where('id', 2)->first();
        $user->roles()->sync($role->id);
        event(new Registered($user));
        return $user;
        }else if($input['tipo_persona']=="juridica"){
            $rif=$input['prefijo']."-".$input['numero_identificacion'];
            $naviera=AgenciaNavieraVigente::where('rifemp',$rif)->get()->last();
           // $naviera=AgenciaNavieraVigente::all();
           // dd($naviera);
                if (is_null($naviera)) {
                    $user = User::create([
                        'nombres' => $input['nombres'],
                        'tipo_identificacion' => $input['tipo_identificacion'],
                        'numero_identificacion' => $input['prefijo']."-".$input['numero_identificacion'],
                        'telefono' => $input['telefono'],
                        'direccion' => $input['direccion'],
                        'email' => $input['email'],
                        'password' => Hash::make($input['password']),
                        'tipo_usuario' => 'Usuario Web'
                    ]);
                    $role = Role::where('id', 2)->first();
                    $user->roles()->sync($role->id);
                    event(new Registered($user));
                    return $user;
                }else {
                    $user = User::create([
                        'nombres' => $input['nombres'],
                        'tipo_identificacion' => $input['tipo_identificacion'],
                        'numero_identificacion' => $input['prefijo']."-".$input['numero_identificacion'],
                        'telefono' => $input['telefono'],
                        'direccion' => $input['direccion'],
                        'email' => $input['email'],
                        'password' => Hash::make($input['password']),
                        'tipo_usuario' => 'Usuario Web'
                    ]);
                    $role = Role::where('id', 8)->first();
                    $user->roles()->sync($role->id);
                    event(new Registered($user));
                    return $user;
                }


        }
    }


}
