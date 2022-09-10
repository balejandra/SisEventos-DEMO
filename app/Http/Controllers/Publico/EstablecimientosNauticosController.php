<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SATIM\EstablecimientoNautico;
use App\Models\Publico\Departamento;
use Flash;
use Response;
use Spatie\Permission\Models\Role;
use App\Models\Publico\DepartamentoUser;


class EstablecimientosNauticosController extends Controller
{
    private $titulo="Establecimientos Náuticos";

    public function __construct()
    {

        $this->middleware('permission:listar-establecimientoNautico', ['only'=>['index'] ]);
        $this->middleware('permission:crear-establecimientoNautico', ['only'=>['create','store']]);
        $this->middleware('permission:editar-establecimientoNautico', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-establecimientoNautico', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-establecimientoNautico', ['only'=>['destroy'] ]);
    }

    public function index(Request $request)
    {

        $estNautico = EstablecimientoNautico::select('establecimiento_nauticos.*', 'capitanias.nombre as capitania')
        ->Join('public.capitanias', 'capitanias.id', '=', 'capitania_id')->get();

        return view('publico.establecimientos_nauticos.index')
            ->with('estNautico', $estNautico)
            ->with('titulo',  $this->titulo);
    }



    public function show($id)
    {
        $estNautico = EstablecimientoNautico::select('establecimiento_nauticos.*', 'capitanias.nombre as capitania')
        ->Join('public.capitanias', 'capitanias.id', '=', 'capitania_id')->where('establecimiento_nauticos.id', '=', $id)->get();

        $user=DepartamentoUser::select('users.nombres', 'users.apellidos', 'users.email')->Join('public.users', 'users.id', '=', 'user_id')->where('capitania_user.establecimiento_nautico_id', '=', $id)->get();

        if (empty($estNautico)) {
            //Flash::error('Capitania no encontrada');

            return redirect(route('publico.establecimientos_nauticos.index'))->with('danger','Establecimiento Náutico no encontrado')->with('titulo', $this->titulo);
        }

        if(count($user)>0){
            $user=$user[0];
        }else{
            $user="";
        }

        return view('publico.establecimientos_nauticos.show')
            ->with('estNautico', $estNautico[0])
            ->with('user', $user)
            ->with('titulo',  $this->titulo);

    }

    public function create()
    {
        $capitanias=Departamento::pluck('nombre','id');

        return view('publico.establecimientos_nauticos.create')->with('capitanias',$capitanias)->with('titulo', $this->titulo);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'rif' => 'required|string',
            'prefijo'=>'required',
            "capitania_id"    => "required",
        ],
        [
            'nombre.required' => 'El campo Nombre es obligatorio',
            'prefijo.required' => 'El prefijo de su RIF es obligatorio',
            'rif.required' => 'El campo RIF es obligatorio',
            'capitania_id.required'=>'El campo Capitanía es obligatorio'
        ]
        );

        $input = [
            "nombre"=>$request->input('nombre'),
            "capitania_id"=>$request->input('capitania_id'),
            "RIF"=>$request->input('prefijo').$request->input('rif'),
        ];

        $rif=$request->input('prefijo').$request->input('rif');

        $existe = EstablecimientoNautico::select('*')->where('establecimiento_nauticos.RIF', '=', $rif)->get();

        if(count($existe)>0){
            Flash::error('El RIF del establecimiento náutico ya existe, por favor verifique.');
            return redirect(route('establecimientosNauticos.create')) ->with('error','El RIF del establecimiento náutico ya existe, por favor verifique.');
        }else{

            if($this->ValidarRIF($rif)){
                $estNautico=EstablecimientoNautico::create($input);
                $estNautico->save();
                Flash::success('Establecimiento náutico guardado con éxito.');
                return redirect(route('establecimientosNauticos.index'))->with('success','El Establecimiento náutico se ha guardado con éxito.');
            }else{
                Flash::error('El RIF del establecimiento náutico no es válido, por favor verifique.');
                return redirect(route('establecimientosNauticos.create'))->with('error','El RIF del establecimiento náutico no es válido, por favor verifique.');
            }
         }
    }


    public function edit($id)
    {
        $estNautico =  EstablecimientoNautico::where('id', $id)->first();
        $capitanias=Departamento::pluck('nombre','id');

        if (empty($estNautico)) {
            Flash::error('Establecimiento Náutico no encontrado');
            return redirect(route('establecimientosNauticos.index'));
        }

        return view('publico.establecimientos_nauticos.edit')
            ->with('capitanias', $capitanias)
            ->with('estNautico',$estNautico)
            ->with('titulo', $this->titulo);
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'rif' => 'required|string',
            'prefijo'=>'required',
            "capitania_id"    => "required",
        ],
        [
            'nombre.required' => 'El campo Nombre es obligatorio',
            'prefijo.required' => 'El prefijo de su RIF es obligatorio',
            'rif.required' => 'El campo RIF es obligatorio',
            'capitania_id.required'=>'El campo Capitanía es obligatorio'
        ]
        );

        $input = [
            "nombre"=>$request->input('nombre'),
            "capitania_id"=>$request->input('capitania_id'),
            "RIF"=>$request->input('prefijo').$request->input('rif'),
        ];

        $rif=$request->input('prefijo').$request->input('rif');

        $existe = EstablecimientoNautico::select('*')
        ->where('establecimiento_nauticos.RIF', '=', $rif)
        ->where('establecimiento_nauticos.id', '!=', $id)
        ->get();

        if(count($existe)>0){
            Flash::error('El RIF del establecimiento náutico ya existe, por favor verifique.');
            return redirect(route('establecimientosNauticos.edit', [$id])) ->with('error','El RIF del establecimiento náutico ya existe, por favor verifique.');
        }else{

            if($this->ValidarRIF($rif)){
                $estNautico=EstablecimientoNautico::find($id);
                $estNautico->update($input);

                Flash::success('Establecimiento náutico modificado con éxito.');
                return redirect(route('establecimientosNauticos.index'))->with('success','El Establecimiento náutico se ha guardado con éxito.');
            }else{
                Flash::error('El RIF del establecimiento náutico no es válido, por favor verifique.');
                return redirect(route('establecimientosNauticos.edit', [$id]))->with('error','El RIF del establecimiento náutico no es válido, por favor verifique.');
            }
         }
    }


    public function destroy($id)
    {
        $estNautico = EstablecimientoNautico::where('id', $id)->first();
        if (empty($estNautico)) {
            Flash::error('Establecimiento náutico no encontrado.');

            return redirect(route('establecimientosNauticos.index'))->with('danger',' Establecimiento náutico no encontrado'); ;
        }
        $estNautico->delete();
        Flash::success('Establecimiento náutico eliminado con éxito.');

        return redirect(route('establecimientosNauticos.index'))->with('success',' Establecimiento náutico eliminado con éxito'); ;
    }


    public function ValidarRIF($rif) {
       // $rif=$_REQUEST['rif'];
       // dd($rif);
        $retorno = preg_match("/^([VEJPG]{1})([0-9]{9}$)/",$rif);

            $digitos = str_split($rif);

            if(count($digitos)!=10){
                return false;
            }


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
               /* $retorno=response()->json([
                    'status'=>3,
                    'msg' => $exception->getMessage(),
                    'errors'=>[],
                ], 200);*/
                $retorno=false;
            }else{
                $retorno=true;
            }

        return $retorno;
    }

}
