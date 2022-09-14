<?php

namespace App\Http\Controllers\Zarpes;


use App\Http\Controllers\Controller;
use App\Models\Publico\DepartamentoUser;
use App\Models\Renave\Renave_data;
use App\Models\User;
use App\Models\SATIM\CargoTablaMando;
use App\Models\SATIM\Equipo;
use App\Models\SATIM\EstablecimientoNautico;
use App\Models\SATIM\PermisoZarpe;
use App\Models\SATIM\Status;
use App\Models\SATIM\TablaMando;
use App\Models\SATIM\TripulanteInternacional;
use App\Models\SATIM\Pasajero;
use App\Models\SATIM\TipoZarpe;
use App\Models\SATIM\EquipoPermisoZarpe;

use App\Models\SATIM\ZarpeRevision;
use Illuminate\Http\Request;
use App\Models\Publico\Saime_cedula;
use App\Models\Gmar\LicenciasTitulosGmar;
use App\Models\Publico\CoordenadasCapitania;
use App\Models\Publico\Departamento;
use App\Models\Sgm\TiposCertificado;
use App\Models\SATIM\AutorizacionEvento;
use App\Models\SATIM\CoordenadasDependenciasFederales;
use App\Models\Publico\DependenciaFederal;
use App\Models\SATIM\DescripcionNavegacion;
use App\Models\Publico\Paise;


use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Zarpes\NotificacionesController;
use Carbon\Carbon;

class ZarpeInternacionalController extends Controller
{
    private $step;
    private $titulo="Zarpe Internacional";
    public function __construct()
    {
        $this->step = 1;
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('listar-zarpes-todos')) {
            $data = PermisoZarpe::where('descripcion_navegacion_id', 4)->get();
            return view('zarpes.zarpe_internacional.index')->with('permisoZarpes', $data)->with('titulo', $this->titulo);

        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-generados')) {
            $user = auth()->id();
            $data = PermisoZarpe::where('user_id', $user)->where('descripcion_navegacion_id', 4)->get();
            return view('zarpes.zarpe_internacional.index')->with('permisoZarpes', $data)->with('titulo', $this->titulo);

        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-capitania-origen')) {
            $user = auth()->id();
            $capitania = DepartamentoUser::select('capitania_id')->where('user_id', $user)->where('habilitado',true)->get();
            $datazarpedestino = PermisoZarpe::whereIn('destino_capitania_id', $capitania)->where('descripcion_navegacion_id', 4)->get();
            $establecimiento = EstablecimientoNautico::select('id')->whereIn('capitania_id', $capitania)->get();
            $datazarpeorigen = PermisoZarpe::whereIn('establecimiento_nautico_id', $establecimiento)->where('descripcion_navegacion_id', 4)->get();
            return view('zarpes.zarpe_internacional.indexcapitan')
                ->with('permisoOrigenZarpes', $datazarpeorigen)
                ->with('permisoDestinoZarpes', $datazarpedestino)->with('titulo', $this->titulo);

        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-establecimiento-origen')) {
            $user = auth()->id();
            $establecimiento = DepartamentoUser::select('establecimiento_nautico_id')->where('user_id', $user)
                ->where('establecimiento_nautico_id','<>',null)
                ->where('habilitado',true)
                ->get();
            $datazarpeorigen = PermisoZarpe::whereIn('establecimiento_nautico_id', $establecimiento)->where('descripcion_navegacion_id', 4)->get();
            return view('zarpes.zarpe_internacional.indexcomodoro')
                ->with('permisoOrigenZarpes', $datazarpeorigen)->with('titulo', $this->titulo);

        } else {
            return view('unauthorized');
        }
    }

    public function createStepOne(Request $request)
    {
        $request->session()->put('stepName', "Matrícula");
        $request->session()->put('matriculasPermisadas', ['']);

        $request->session()->put('pasajeros',  '');
        $request->session()->put('tripulantes', '');
        $request->session()->put('validacion', '');
        $request->session()->put('validacionesSgm', '');
        $request->session()->put('coordGadriales', '');

        $solicitud = json_encode([
            "user_id" => auth()->id(),
            "nro_solicitud" => '',
            "bandera" => '',
            "matricula" => '',
            "tipo_zarpe_id" => '',
            "descripcion_navegacion_id" => 4,
            "establecimiento_nautico_id" => '',
            "establecimiento_nautico_destino_id" => 0,
            "coordenadas" => '[0,0]',
            "origen_capitania_id" => '',
            "destino_capitania_id" => 0,
            "fecha_hora_salida" => '',
            "fecha_hora_regreso" => '',
            "status_id" => 3,
            "permiso_estadia_id" => 0,
            "paises_id" => '',
            "establecimiento_nautico_destino_zi"=> '',
            "fecha_llegada_escala" => '',


        ]);

        $valida = [
            "UAB" => '',
            "cant_tripulantes" => 0,
            "cant_pasajeros" => 0,
            "cantPassAbordo"=> 0,
            "pasajerosRestantes"=>0,
            "potencia_kw" => '',
            "cargos" => [
                "cargo_desempena" => '',
                "titulacion_aceptada_minima" => '',
                "titulacion_aceptada_maxima" => ''
            ]
        ];

        $request->session()->put('validacion', json_encode($valida));

        $this->step = 1;

        $request->session()->put('solicitud', $solicitud);

        return view('zarpes.zarpe_internacional.create-step-one')->with('paso', $this->step)->with('titulo', $this->titulo);
    }


    public function permissionCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'bandera' => 'required',
        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['bandera'] = $request->input('bandera', []);

        if ($solicitud['bandera'] == 'nacional') {
            $request->session()->put('stepName', "Matrícula");
        } else {
            $request->session()->put('stepName', "Permiso de estadía");
        }

        $request->session()->put('solicitud', json_encode($solicitud));
        $this->step = 2;
        if ($solicitud['bandera'] == 'nacional') {
            return redirect()->route('zarpeInternacional.CreateStepTwo')->with('paso', $this->step);
        } else {
            return redirect()->route('zarpeInternacional.CreateStepTwoE')->with('paso', $this->step);

        }

    }


    public function createStepTwo(Request $request)
    {

        $this->step = 2;
        $solicitud= json_decode(session('solicitud'));
        $siglas=Departamento::all();
        if($solicitud->matricula==""){
            $matriculaActual=['','',''];
        }else{
            $matriculaActual=explode('-',$solicitud->matricula);
        }

        return view('zarpes.zarpe_internacional.nacional.create-step-two')->with('paso', $this->step)->with('stepName', "Matrícula")->with("siglas", $siglas)->with("matriculaActual", $matriculaActual)->with('titulo', $this->titulo);

    }

    public function validationStepTwo(Request $request)
    {
        $matricula = $_REQUEST['matricula'];

        $valida=explode('-',$matricula);
        if($valida[1]!='RE' && $valida[1]!='DE'){
            echo "NoDeportivaNorecreativa";
        }else{

                $user = User::find(auth()->id());
                $permisoZ = PermisoZarpe::select("matricula")->where('user_id', auth()->id())->where('matricula', $matricula)->whereIn('status_id', [1, 3, 5])->get();

                $data0 = Renave_data::where('matricula_actual', $matricula)->get();
                $data = Renave_data::where('matricula_actual', $matricula)->where('numero_identificacion', $user->numero_identificacion)->get();
                if(is_null($data0->first())){
                    echo "sinCoincidenciasMatricula";
                }else if (is_null($data->first())) {
                    echo "sinCoincidencias";
                } else {

                    if (count($permisoZ) > 0) {
                        echo 'permisoPorCerrar';
                    } else {


                        $validacionSgm = TiposCertificado::where('matricula', $matricula)->get();
                        $val1 = "LICENCIA DE NAVEGACIÓN no encontrada";
                        $val2 = "CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA no encontrado";
                        $val3 = "ASIGNACIÓN DE NÚMERO ISMM no encontrado";
                        $nroCorrelativos=["licenciaNavegacion" => '',
                                            "certificadoRadio"  => '',
                                            "numeroIsmm" => '',
                                            ];
                        $data2 = [
                            "data" => $data,
                            "validacionSgm" => [$val1, $val2, $val3],
                        ];

                        if (count($validacionSgm) > 0) {

                            $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
                            for ($i = 0; $i < count($validacionSgm); $i++) {

                                switch ($validacionSgm[$i]->nombre_certificado) {
                                    case "LICENCIA DE NAVEGACIÓN":
                                        $fecha = $validacionSgm[$i]->fecha_vencimiento;
                                        list($dia, $mes, $ano) = explode("/", $fecha);
                                        $fecha_vence = $ano . "-" . $mes . "-" . $dia . " 00:00:00";
                                        $fecha_vence1 = strtotime($fecha_vence);
                                        if (($fecha_actual > $fecha_vence1)) {
                                            $val1 = "LICENCIA DE NAVEGACIÓN vencida"; //encontrado pero vencido
                                        } else {
                                            $val1 = true;

                                            $valida = json_decode($request->session()->get('validacion'), true);
                                            // dd($valida);
                                            $valida['potencia_kw'] = $validacionSgm[$i]->potencia_kw;
                                            $valida["cant_pasajeros"] = $validacionSgm[$i]->capacidad_personas;
                                            $valida["pasajerosRestantes"] = $validacionSgm[$i]->capacidad_personas;

                                            $nroCorrelativos["licenciaNavegacion"]=$validacionSgm[$i]->nro_correlativo;
                                            $fechavenc["fecha_vencimientolic"]=$validacionSgm[$i]->fecha_vencimiento;
                                            $request->session()->put('validacion', json_encode($valida));
                                        }
                                        break;
                                    case "CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA":
                                        $fecha = $validacionSgm[$i]->fecha_vencimiento;
                                        list($dia, $mes, $ano) = explode("/", $fecha);
                                        $fecha_vence = $ano . "-" . $mes . "-" . $dia . " 00:00:00";
                                        $fecha_vence1 = strtotime($fecha_vence);

                                        if (($fecha_actual > $fecha_vence1)) {
                                            $val2 = "CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA vencido."; //encontrado pero vencido
                                        } else {
                                            $val2 = true;
                                            $nroCorrelativos["certificadoRadio"]=$validacionSgm[$i]->nro_correlativo;
                                            $fechavenc["fecha_vencimientocert"]=$validacionSgm[$i]->fecha_vencimiento;
                                        }
                                        break;
                                    case "ASIGNACIÓN DE NÚMERO ISMM":
                                        $val3 = true;
                                         $nroCorrelativos["numeroIsmm"]=$validacionSgm[$i]->nro_correlativo;
                                        $fechavenc["fecha_vencimientoismm"]=$validacionSgm[$i]->fecha_vencimiento;
                                        break;
                                }
                            }

                            $data2 = [
                                "data" => $data,
                                "validacionSgm" => [$val1, $val2, $val3,$nroCorrelativos,$fechavenc],
                            ];
                            echo json_encode($data2);
                        } else {
                            echo "noEncontradoSgm";
                        }

                    }
                }


        }

    }


    public function permissionCreateStepTwo(Request $request)
    {

        $validatedData = $request->validate([
            'matricula' => 'required',
            //  'UAB' => 'required',
        ],
        [
            'matricula.required'=>'El campo matrícula es obligatorio'
        ]);
        $validation = json_decode($request->session()->get('validacion'), true);
        $UAB = $request->input('UAB');
        $matricula = $request->input('matricula');
        $identificacion = $request->input('numero_identificacion');
        if ($identificacion != auth()->user()->numero_identificacion) {
            Flash::error('Su usuario no puede realizar solicitudes a nombre del Buque Matricula ' . $matricula);
            return view('zarpes.zarpe_internacional.nacional.create-step-two')->with('paso', 2);
        }

        $tabla = new TablaMando();
        $mando = $tabla->where([
            ['UAB_minimo', '<', $UAB],
            ['UAB_maximo', '>=', $UAB]
        ])->get()->toArray();
        if(count($mando)==0){
            Flash::error('No se ha podido comparar las especificaciones de la embarcación ('.$matricula.') respecto a la tabla de mandos actual, comuniquese con el administrador del sitema.');
            return view('zarpes.zarpe_internacional.nacional.create-step-two')->with('paso', 2);
        }else{
            $validation['UAB'] = $request->input('UAB', []);
            $validation['eslora'] = $request->input('eslora', []);
            $validation['cant_tripulantes'] = $mando[0]["cant_tripulantes"];

            $idtablamando = $mando[0]["id"];
            $cargos = CargoTablaMando::where('tabla_mando_id', $idtablamando)->get()->toArray();
            foreach ($cargos as $clave => $valor) {
                $cargo["cargo_desempena"] = $valor['cargo_desempena'];
                $cargo["titulacion_aceptada_minima"] = $valor['titulacion_aceptada_minima'];
                $cargo["titulacion_aceptada_maxima"] = $valor['titulacion_aceptada_maxima'];
                $validation[$clave] = $cargo;
            }


            $request->session()->put('validacion', json_encode($validation));
            // dd($request->session()->get('validacion'));

            $solicitud = json_decode($request->session()->get('solicitud'), true);
            $solicitud['matricula'] = $request->input('matricula', []);
            $solicitud['permiso_estadia_id'] = null;
            $request->session()->put('solicitud', json_encode($solicitud));
            // dd($solicitud);
            return redirect()->route('zarpeInternacional.createStepThree');
        }


    }


    public function createStepTwoE(Request $request)
    {
        // $this->SendMail(42,1);

        $this->step = 2;

        return view('zarpes.zarpe_internacional.extranjera.create-step-two')->with('paso', $this->step)->with('titulo', $this->titulo);

    }

    public function validationStepTwoE(Request $request)
    {
        $permiso = $_REQUEST['permiso'];

        $permisoEstadia = AutorizacionEvento::where('user_id', auth()->id())->where('nro_solicitud', $permiso)->where('status_id', 1)->get();

        if (is_null($permisoEstadia->first())) {

            echo json_encode("sinCoincidencias");
        } else {
            $permisoZ = PermisoZarpe::select("matricula")->where('user_id', auth()->id())->where('matricula', $permisoEstadia[0]->nro_registro)->whereIn('status_id', [1, 3, 5])->get();

            if (count($permisoZ) > 0) {
                echo json_encode('permisoPorCerrar');
            } else {
                echo json_encode($permisoEstadia);
            }

        }

    }


    public function permissionCreateSteptwoE(Request $request)
    {

        $permiso = $request->input('permiso');
        $validatedData = $request->validate([

            'permiso_de_estadia' => 'required',
            'numero_de_registro' => 'required',
        ],
        [
            'permiso_de_estadia.required'=>'El campo Permiso de estadía es obligatorio',
            'numero_de_registro.required'=>'Número de registro no encontrado'
        ]);
        $idpermiso = $_REQUEST['permiso_de_estadia'];
        $matricula = $_REQUEST['numero_de_registro'];

        $permisoEstadia = AutorizacionEvento::where('user_id', auth()->id())->where('nro_solicitud', $permiso)->where('status_id', 1)->get();

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['matricula'] = $matricula;
        $solicitud['permiso_estadia_id'] = $idpermiso;
        $request->session()->put('solicitud', json_encode($solicitud));

        $valida = json_decode($request->session()->get('validacion'), true);


        $valida["cant_tripulantes"] = $permisoEstadia[0]->cant_tripulantes;
        $valida["cant_pasajeros"] = $permisoEstadia[0]->cant_pasajeros;
        $valida["pasajerosRestantes"] = $permisoEstadia[0]->cant_pasajeros;
        $valida["potencia_kw"] = $permisoEstadia[0]->potencia_kw;
        $valida["UAB"] = $permisoEstadia[0]->arqueo_bruto;
        $request->session()->put('validacion', json_encode($valida));

        return redirect()->route('zarpeInternacional.createStepThree');

    }


    public function createStepThree(Request $request)
    {
        $solicitud= json_decode(session('solicitud'));

        $coordsCapsAsign = CoordenadasCapitania::select('coordenadas_capitanias.capitania_id' )->distinct()->get();
            $capitania = Departamento::whereIn('id', $coordsCapsAsign)->get();

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $bandera = $solicitud['bandera'];
        $TipoZarpes = TipoZarpe::all();
        //$capitania = Capitania::all();
       // $descripcionNavegacion = DescripcionNavegacion::all();
       $valida = json_decode($request->session()->get('validacion'), true);

        $this->step = 3;

        return view('zarpes.zarpe_internacional.create-step-three')->with('paso', $this->step)->with('TipoZarpes', $TipoZarpes)->with('capitanias', $capitania)->with('bandera', $bandera)->with('titulo', $this->titulo);

    }

    public function permissionCreateStepThree(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_de_navegacion' => 'required',
            'capitania' => 'required',

        ],
        [
            'tipo_de_navegacion.required'=>'El campo Tipo de Navegación es obligatorio',

            'capitania.required'=>'El campo Capitanía es obligatorio'
        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['tipo_zarpe_id'] = $request->input('tipo_de_navegacion', []);
        $solicitud['origen_capitania_id'] = $request->input('capitania', []);
        $solicitud['destino_capitania_id'] = $request->input('capitania', []);

        $request->session()->put('solicitud', json_encode($solicitud));
        // print_r($solicitud);
        $this->step = 4;

        return redirect()->route('zarpeInternacional.createStepFour');

    }

    public function createStepFour(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $EstNauticos = EstablecimientoNautico::where('capitania_id', $solicitud['origen_capitania_id'])->get();
        $paises= Paise::all();

        $this->step = 4;
        return view('zarpes.zarpe_internacional.create-step-four')->with('paso', $this->step)->with('EstNauticos', $EstNauticos)->with('paises', $paises)->with('titulo', $this->titulo);

    }

    public function permissionCreateStepFour(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);


            $validatedData = $request->validate([
                'establecimientoNáuticoOrigen' => 'required',
                'salida' => 'required',
                'llegada' => 'required',
                'país_de_destino' => 'required',
                'estNauticoDestinoZI'=>'required',
            ],
             [
                'estNauticoDestinoZI.required'=>'El campo Establecimiento naútico de destino es requerido'

            ]);


        $solicitud['establecimiento_nautico_id'] = $request->input('establecimientoNáuticoOrigen');
        $solicitud['establecimiento_nautico_destino_id'] =  $request->input('establecimientoNáuticoOrigen');
        $solicitud['fecha_hora_salida'] = $request->input('salida');
        $solicitud['fecha_hora_regreso'] = $request->input('llegada');
        $solicitud['paises_id'] = intval($request->input('país_de_destino'));
        $solicitud['establecimiento_nautico_destino_zi'] = $request->input('estNauticoDestinoZI');
         $solicitud['fecha_llegada_escala'] = $request->input('llegada');

        $request->session()->put('solicitud', json_encode($solicitud));
        $this->step = 5;
        return redirect()->route('zarpeInternacional.createStepFive');
    }


    public function createStepFive(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);

        $codigo = $this->codigo($solicitud);

        $validation = json_decode($request->session()->get('validacion'), true);
        $tripulantes = $request->session()->get('tripulantes');

        $this->step = 5;
        return view('zarpes.zarpe_internacional.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('codigo', $codigo)->with('titulo', $this->titulo);

    }

    public function permissionCreateStepFive(Request $request)
    {


        $validation = json_decode($request->session()->get('validacion'), true);

        $tripulantes = $request->session()->get('tripulantes');
        $validation = json_decode($request->session()->get('validacion'), true);

        if (is_array($tripulantes) && (count($tripulantes) >= $validation['cant_tripulantes']) && (count($tripulantes) <= $validation['cant_pasajeros'])) {
            $capitan=0;
            for ($i=0; $i < count($tripulantes); $i++) {
                $indice=array_search("Capitán",$tripulantes[$i],false);

                if($indice!=false){
                    $capitan++;
                }
            }

            if($capitan==1){
                $this->step = 6;
                return redirect()->route('zarpeInternacional.createStepSix');

            }elseif($capitan< 1){
                $this->step = 5;
                $mensj ="Debe asignar un capitán para esta embarcación, por favor verifique";
                return view('zarpes.zarpe_internacional.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('msj', $mensj)->with('titulo', $this->titulo);
            }else{
                $this->step = 5;
                $mensj ="No puede asignar más de un capitán para la embarcación";
                return view('zarpes.zarpe_internacional.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('msj', $mensj)->with('titulo', $this->titulo);
            }


        } else {

            $this->step = 5;
            if(!is_array($tripulantes)){
                $mensj = "El listado de tripulantes es requerido, por favor verifique.";
            }else if(count($tripulantes) < $validation['cant_tripulantes']){
                $mensj = "La embarcación requiere un mínimo de ".$validation['cant_tripulantes']." tripulantes para navegar, por favor verifique.";
            }else if($validation['pasajerosRestantes'] >= $validation['cant_pasajeros']){
                $mensj = "La embarcación requiere un máximo de ".$validation['cant_pasajeros']." personas a bordo que no debe ser excedido para navegar, por favor verifique.";
            }else{
                 $mensj ="Ha ocurrido un error al agregar a los tripulantes, contacte al administrador del sistema";
            }


            return view('zarpes.zarpe_internacional.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('msj', $mensj)->with('titulo', $this->titulo);

        }
    }

    public function createStepSix(Request $request)
    {

        $passengers = $request->session()->get('pasajeros');
        $validation = json_decode($request->session()->get('validacion'), true);
        $cantPasajeros =  $validation['pasajerosRestantes'] ;

        $this->step = 6;
        return view('zarpes.zarpe_internacional.create-step-six')->with('paso', $this->step)->with('passengers', $passengers)->with('validation', $validation)->with('titulo', $this->titulo);

    }

    public function permissionCreateStepSix(Request $request)
    {

        $this->step = 7;
        return redirect()->route('zarpeInternacional.createStepSeven');

    }


    public function createStepSeven(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $equipos = Equipo::all();
       // print_r($solicitud);
        //  dd($equipos);
        $this->step = 7;
        return view('zarpes.zarpe_internacional.create-step-seven')
            ->with('paso', $this->step)
            ->with('equipos', $equipos)->with('titulo', $this->titulo);

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'equipo' => 'required',
        ]);
        $equipos = Equipo::all();
        $equipo = $request->input('equipo', []);

        if (count($equipo) == 0) {
            Flash::error('Debe indicar los equipos que posee a bordo, por favor verifique.');
            return redirect()->route('permisoszarpes.createStepSeven');
        } else {

            $bandera=true;

            try {
                DB::beginTransaction();
                //SOlicitud de zarpe
                $solicitud = json_decode($request->session()->get('solicitud'), true);
                $codigo = $this->codigo($solicitud);
                $solicitud['nro_solicitud'] = $codigo;
                 $saveSolicitud = PermisoZarpe::create($solicitud);

                if($saveSolicitud==""){
                    $bandera=false;
                }


                //Tripulantes
                $tripulantes = $request->session()->get('tripulantes');

                for ($i = 0; $i < count($tripulantes); $i++) {
                    $tripulantes[$i]["permiso_zarpe_id"] = $saveSolicitud->id;

                    /*if (strpos($tripulantes[$i]["fecha_nacimiento"], "/") !== false) {
                        list($dia, $mes, $ano) = explode("/", $tripulantes[$i]["fecha_nacimiento"]);
                        $tripulantes[$i]["fecha_nacimiento"]=$ano.'-'.$mes.'-'.$dia;
                    }*/
                    $trip = TripulanteInternacional::create($tripulantes[$i]);

                }

                //Pasajeros
                $pasajeros = $request->session()->get('pasajeros');

                    if (is_array($pasajeros) && count($pasajeros)>0) {
                        for ($i = 0; $i < count($pasajeros); $i++) {
                            $pasajeros[$i]["permiso_zarpe_id"] = $saveSolicitud->id;
                            $pass = Pasajero::create($pasajeros[$i]);
                            // print_r($pasajeros[$i]); echo "<br>";
                        }
                    }


                //Equipos

                $listadoEquipos = ["permiso_zarpe_id" => '', "equipo_id" => '', "cantidad" => '', "otros" => '', "valores_otros" => ''];

                $otros = [];
                $valoresOtros = [];

                $listEq = [];
                $i = 0;
                $j = 0;

                foreach ($equipos as $equipoX) {
                    foreach ($equipo as $equip) {
                        if ($equipoX->id == $equip) {

                            if ($request->input($equip . 'selected') == true) {
                                $listadoEquipos["permiso_zarpe_id"] = $saveSolicitud->id;
                                $listadoEquipos["equipo_id"] = $equip;
                                if ($equipoX->cantidad == true) {
                                    $listadoEquipos["cantidad"] = $request->input($equip . 'cantidad');

                                } else {
                                    $listadoEquipos["cantidad"] = '';
                                }

                                if ($equipoX->otros != 'ninguno') {
                                    $listadoEquipos["otros"] = $request->input($equip . 'otros');
                                    $listadoEquipos["valores_otros"] = $request->input($equip . 'valores_otros');
                                } else {
                                    $listadoEquipos["otros"] = "";
                                    $listadoEquipos["valores_otros"] = "";

                                }

                                $listEq[$i] = $listadoEquipos;
                                $i++;
                                EquipoPermisoZarpe::create($listadoEquipos);

                                $listadoEquipos = ["permiso_zarpe_id" => '', "equipo_id" => '', "cantidad" => '', "otros" => '', "valores_otros" => ''];
                            }

                        }
                    }
                }

                 // printf('Bandera::'.$bandera);
                if($bandera==true){
                    DB::commit();
                }else{
                    DB::rollback();
                    Flash::error('Ha ocurrido un error al guardar la solicitud, algunos datos no se guardaron.');
                }


            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
                Flash::error('Ha ocurrido un error al guardar la solicitud, los datos no se guardaron.');

            }


            $capOrigin = $this->SendMail($saveSolicitud->id, 1, true);
            $caopDestino = $this->SendMail($saveSolicitud->id, 0, false);

            if ($capOrigin == true || $caopDestino == true) {
                Flash::success('Se ha generado la solicitud <b>
            ' . $codigo . '</b> exitosamente y se han enviado los correos de notificación correspondientes');
            } else {
                Flash::success('Se ha generado la solicitud <b> ' . $codigo . '</b> exitosamente.');

            }

            $this->limpiarVariablesSession();
            return redirect()->route('zarpeInternacional.index');
        }


    }

    public function consulta2(Request $request)
    {
        $cedula = $_REQUEST['cedula'];
        $fecha = $_REQUEST['fecha'];
        $sexo = $_REQUEST['sexo'];

        $newDate = date("d/m/Y", strtotime($fecha));
        $newDate2 = date("d-m-Y", strtotime($fecha));
        $newDate3 = date("Y-d-m", strtotime($fecha));
        $data = Saime_cedula::where('cedula', $cedula)
            ->whereIn('fecha_nacimiento', [$newDate,$newDate2,$newDate3])
           // ->where('sexo', $sexo)
            ->get();
        if (is_null($data->first())) {
            dd('error');
            $data = response()->json([
                'status' => 3,
                'msg' => $exception->getMessage(),
                'errors' => [],
            ], 200);
        }

        echo json_encode($data);
    }


    public function validarMarino(Request $request)
    {
        $cedula = $_REQUEST['cedula'];
       // $fecha = $_REQUEST['fecha'];
        $cap = $_REQUEST['cap'];

        $vj = [];
        /*$newDate = date("d/m/Y", strtotime($fecha));
        $newDate2 = date("d-m-Y", strtotime($fecha));
        $newDate3 = date("Y-d-m", strtotime($fecha));
        $data = Saime_cedula::where('cedula', $cedula)
            ->whereIn('fecha_nacimiento', [$newDate,$newDate2,$newDate3])
            ->get();

        if (is_null($data->first())) {
            $data2 = "saimeNotFound"; // no encontrado en saime
        } else {*/
            $fechav = LicenciasTitulosGmar::select(DB::raw('MAX(fecha_vencimiento) as fechav'))->where('ci', $cedula)->get();

            $data2 = LicenciasTitulosGmar::where('fecha_vencimiento', $fechav[0]->fechav)->where('ci', $cedula)->get();
            if (is_null($data2->first())) {
                $data2 = "gmarNotFound"; // no encontrado en Gmar
            } else {

                $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
                $fecha_vence = strtotime($data2[0]->fecha_vencimiento);

                if ($data2[0]->solicitud == 'Licencia' && ($fecha_actual > $fecha_vence)) {
                    $data2 = "FoundButDefeated"; //encontrado pero documento vencido
                } else {

                    $marinoAsignado = PermisoZarpe::select('zarpe_internacionals.status_id', 'ctrl_documento_id')
                        ->Join('tripulantes', 'zarpe_internacionals.id', '=', 'tripulantes.zarpe_internacional_id')
                        ->where('tripulantes.ctrl_documento_id', '=', $data2[0]->id)
                        ->whereIn('zarpe_internacionals.status_id', [1, 3, 5])
                        ->get();

                    if (count($marinoAsignado) > 0) {
                        $data2 = "FoundButAssigned";
                    } else {
                        $vj = $this->validacionJerarquizacion($data2[0]->documento, $cap);

                    }
                }
            }

//        }
        $return = [$data2, $vj];
        echo json_encode($return);
    }

     public function validacionMarinoZI(Request $request){
        $cedula=$_REQUEST['nrodoc'];
        $funcion=$_REQUEST['funcion'];
        $doc=$_REQUEST['doc'];
        $nrodoc=$_REQUEST['nrodoc'];
        $docAcreditacion=$_REQUEST['docAcreditacion'];



        $vj = [];
        $indice=false;
        $tripulantes = $request->session()->get('tripulantes');
        $capitanExiste=false;
        $pasajeros = $request->session()->get('pasajeros');
        if(!is_array($pasajeros)){
            $pasajeros=[];
        }


        switch ($funcion) {
            case 'Capitán':
                 $cap="SI";
                 if(is_array($tripulantes) && count($tripulantes)>0){
                    foreach ($tripulantes as $value) {

                        if($value['funcion']=='Capitán'){
                           $capitanExiste=true;
                        }
                    }
                 }

            break;
            case 'Motorista':
                 $cap="NO";
            break;
            case 'Marino':
                 $cap="NO";
            break;
        }


        if($capitanExiste){
            $return = [$tripulantes, "", "",'capitanExiste',""];
            echo json_encode($return);
        }else{
            $validation = json_decode($request->session()->get('validacion'), true);
        $fechav = LicenciasTitulosGmar::select(DB::raw('MAX(fecha_vencimiento) as fechav'))->where('ci', $cedula)->get();
         $InfoMarino = LicenciasTitulosGmar::where('fecha_vencimiento', $fechav[0]->fechav)->where('ci', $cedula)->get();
         $infoSaime = Saime_cedula::where('cedula', $cedula)->get();
       //  $request->session()->put('tripulantes', '');
        if (is_null($InfoMarino->first())) {
            $InfoMarino = "gmarNotFound"; // no encontrado en Gmar
            $marinoAsignado2="";
            $marinoAsignado="";
        } else {
            $emision=explode(' ',$InfoMarino[0]->fecha_emision);
            list($ano, $mes, $dia) = explode("-", $emision[0]);
            $emision[0]=$dia.'/'.$mes.'/'.$ano;
            if(!is_null($infoSaime->first())){
                $fechaNacV=$infoSaime[0]->fecha_nacimiento;
                $sexoV=$infoSaime[0]->sexo ;
            }else{
                $fechaNacV='';
                $sexoV="";
            }
            /*$trip = [
            "permiso_zarpe_id" => '',
            "ctrl_documento_id" => $InfoMarino[0]->id,
            "capitan" => $cap,
            "nombre" => $InfoMarino[0]->nombre." ".$InfoMarino[0]->apellido,
            "cedula" => $InfoMarino[0]->ci,
            "fecha_vencimiento" => $InfoMarino[0]->fecha_vencimiento,
            "fecha_emision" =>$emision[0],
            "documento" => $InfoMarino[0]->documento,
            "funcion"  => $funcion,
            "solicitud"  => $InfoMarino[0]->solicitud,
            ];*/

            $trip=[
                "permiso_zarpe_id" => '',
                "nombres" => $InfoMarino[0]->nombre,
                "apellidos" =>  $InfoMarino[0]->apellido,
                "tipo_doc" => 'V',
                "nro_doc" => $InfoMarino[0]->ci,
                "funcion" => $funcion,
                "rango" =>$InfoMarino[0]->documento,
                "doc" => $doc,
                "documento_acreditacion"=>$docAcreditacion,
                "fecha_emision" =>$emision[0],
                "solicitud"=>$InfoMarino[0]->solicitud,
                "fecha_nacimiento"=> $fechaNacV,
                "sexo"=> $sexoV,
                "nro_ctrl"=>$InfoMarino[0]->nro_ctrl,
            ];

            if(is_array($tripulantes)){

                $indice=true;
                foreach ($tripulantes as $value) {

                    if($value['nro_doc']==$cedula){
                        $indice=false;
                    }
                }


            }else{
                $indice=true;
                $tripulantes=[];
            }

            $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
            $fecha_vence = strtotime($InfoMarino[0]->fecha_vencimiento);

            if ($InfoMarino[0]->solicitud == 'Licencia' && ($fecha_actual > $fecha_vence)) {
                    $InfoMarino = "FoundButDefeated"; //encontrado pero documento vencido
                } else {

                    $marinoAsignado = PermisoZarpe::select('permiso_zarpes.status_id', 'ctrl_documento_id')
                        ->Join('tripulantes', 'permiso_zarpes.id', '=', 'tripulantes.permiso_zarpe_id')
                        ->where('tripulantes.nro_doc', $cedula)
                        ->whereIn('permiso_zarpes.status_id', [1, 3, 5])
                        ->get();

                    $marinoAsignado2 = PermisoZarpe::select('permiso_zarpes.status_id')
                        ->Join('tripulante_internacionals', 'permiso_zarpes.id', '=','tripulante_internacionals.permiso_zarpe_id')
                        ->where('tripulante_internacionals.nro_doc', $cedula)
                        ->whereIn('permiso_zarpes.status_id', [1, 3, 5])
                        ->get();

                    if (count($marinoAsignado) > 0 || count($marinoAsignado2)>0 ) {
                        $InfoMarino = "FoundButAssigned"; //encontrado pero asignado a otro barco
                    } else {
                        $vj = $this->validacionJerarquizacion($InfoMarino[0]->documento, $cap);

                        if($vj[0]==true){

                            if(!$indice){
                                $InfoMarino = "TripulanteExiste";
                            }else{


                                if($validation['pasajerosRestantes']>0){
                                array_push($tripulantes, $trip);
                                $request->session()->put('tripulantes', $tripulantes);
                                $validation['cantPassAbordo']=abs(count($tripulantes)+count($pasajeros));
                                $validation['pasajerosRestantes']=$validation['cant_pasajeros']-abs(count($tripulantes)+count($pasajeros));
                                $request->session()->put('validacion', json_encode($validation));

                                $InfoMarino='OK';
                                }else{
                                    $InfoMarino = "FoundButMaxTripulationLimit";
                                }
                             }

                        }else{
                             $InfoMarino = "TripulanteNoAutorizado";
                        }

                    }
                }
        }

        $return = [$tripulantes, $vj, $indice,$InfoMarino,$validation['cant_pasajeros'],$validation['pasajerosRestantes'],$validation['cantPassAbordo'],$marinoAsignado2,$marinoAsignado];
        echo json_encode($return);
        }

    }


    public function marinoExtranjeroZI(Request $request){
        $cedula=$_REQUEST['nrodoc'];
        $funcion=$_REQUEST['funcion'];
        $vj = [];
        $indice=false;
        $tripulantes = $request->session()->get('tripulantes');
        $pasajeros = $request->session()->get('pasajeros');
        if(!is_array($pasajeros)){
            $pasajeros=[];
        }

        $validation = json_decode($request->session()->get('validacion'), true);
        $capitanExiste=false;
        switch ($funcion) {
            case 'Capitán':
                 $cap="SI";
                 if(is_array($tripulantes) && count($tripulantes)>0){
                    foreach ($tripulantes as $value) {
                     //   print_r($value);
                        if($value['funcion']=='Capitán'){
                           $capitanExiste=true;
                        }
                    }
                 }

            break;
            case 'Motorista':
                 $cap="NO";
            break;
            case 'Marino':
                 $cap="NO";
            break;
        }

        if($capitanExiste){
            $return = [$tripulantes, "", "",'capitanExiste',""];
            echo json_encode($return);
        }else{

            $nrodoc=$_REQUEST['nrodoc'];
            $tipodoc=$_REQUEST['tipodoc'];
            $nombres=$_REQUEST['nombres'];
            $apellidos=$_REQUEST['apellidos'];
            $funcion=$_REQUEST['funcion'];
            $rango=$_REQUEST['rango'];
            $doc=$_REQUEST['doc'];
            $docAcreditacion=$_REQUEST['docAcreditacion'];
            $sexo=$_REQUEST['sexo'];
            $fecha_nacimiento=$_REQUEST['fecha_nacimiento'];


                $trip=[
                "permiso_zarpe_id" => '',
                "nombres" =>$nombres,
                "apellidos" =>$apellidos,
                "tipo_doc" => 'P',
                "nro_doc" =>  $nrodoc,
                "funcion" => $funcion,
                "rango" =>$rango,
                "doc" => $doc,
                "documento_acreditacion" => $docAcreditacion,
                "fecha_emision" => "",
                "solicitud"=> "",
                "fecha_nacimiento"=> $fecha_nacimiento,
                "sexo"=> $sexo,
                    "nro_ctrl"=>""
                ];


                $marinoAsignado = PermisoZarpe::select('permiso_zarpes.status_id', 'ctrl_documento_id')
                ->Join('tripulantes', 'permiso_zarpes.id', '=', 'tripulantes.permiso_zarpe_id')
                ->where('tripulantes.nro_doc', $cedula)
                ->whereIn('permiso_zarpes.status_id', [1, 3, 5])
                ->get();

            $marinoAsignado2 = PermisoZarpe::select('permiso_zarpes.status_id')
                ->Join('tripulante_internacionals', 'permiso_zarpes.id', '=','tripulante_internacionals.permiso_zarpe_id')
                ->where('tripulante_internacionals.nro_doc', $cedula)
                ->whereIn('permiso_zarpes.status_id', [1, 3, 5])
                ->get();

            if (count($marinoAsignado) > 0 || count($marinoAsignado2)>0 ) {
                $InfoMarino="FoundButAssigned";
            }else{


            $tripExiste=false;
            $vj=[false];
            if(is_array($tripulantes)){
                foreach ($tripulantes as $value) {

                    if($value['nro_doc']==$nrodoc){
                       $tripExiste=true;
                    }
                }
                if ($tripExiste) {
                    $InfoMarino = "TripulanteExiste";
                }else{

                        if($validation['pasajerosRestantes']>0){
                            array_push($tripulantes, $trip);
                            $request->session()->put('tripulantes', $tripulantes);
                            $validation['cantPassAbordo']=abs(count($tripulantes)+count($pasajeros));
                            $validation['pasajerosRestantes']=$validation['cant_pasajeros']-abs(count($tripulantes)+count($pasajeros));
                            $request->session()->put('validacion', json_encode($validation));

                            $InfoMarino = "OK";
                             $vj=[true];
                        }else{
                            $InfoMarino = "FoundButMaxTripulationLimit";
                        }

                }

            }else{
                $tripulantes=[];
                array_push($tripulantes, $trip);
                $request->session()->put('tripulantes', $tripulantes);
                $validation['cantPassAbordo']=abs(count($tripulantes)+count($pasajeros));
                $validation['pasajerosRestantes']=$validation['cant_pasajeros']-abs(count($tripulantes)+count($pasajeros));
                $request->session()->put('validacion', json_encode($validation));

                $InfoMarino = "OK";
                 $vj=[true];
            }



            }



             $return = [$tripulantes, $vj, '',$InfoMarino, $validation['cant_pasajeros'], count($tripulantes),$validation['pasajerosRestantes'],$validation['cantPassAbordo'],$marinoAsignado,$marinoAsignado2];
            echo json_encode($return);

        }


    }

    public function deleteTripulanteZI(Request $request){
        $cedula=$_REQUEST['index'];
        $borrado=false;
        $tripulantes = $request->session()->get('tripulantes');
        $pasajeros = $request->session()->get('pasajeros');
        if(!is_array($pasajeros)){
            $pasajeros=[];
        }

        $validation = json_decode($request->session()->get('validacion'), true);
        if(count($tripulantes)==1){
                $tripulantes=[];
                $request->session()->put('tripulantes', $tripulantes);
                $validation['cantPassAbordo']=abs(count($tripulantes)+count($pasajeros));
                $validation['pasajerosRestantes']=$validation['cant_pasajeros']-abs(count($tripulantes)+count($pasajeros));
                $request->session()->put('validacion', json_encode($validation));
                $borrado =[true, $validation['cantPassAbordo']];
        }else{
            if(is_array($tripulantes)){


                foreach ($tripulantes as $key=> $value) {
                    if($value['nro_doc']==$cedula){

                        array_splice($tripulantes, $key, 1);
                        $request->session()->put('tripulantes', $tripulantes);

                        $validation['cantPassAbordo']=abs(count($tripulantes)+count($pasajeros));
                        $validation['pasajerosRestantes']=$validation['cant_pasajeros']-abs(count($tripulantes)+count($pasajeros));
                        $request->session()->put('validacion', json_encode($validation));
                        $borrado =[true, $validation['pasajerosRestantes'],$tripulantes];


                    }
                }
            }

        }

        echo json_encode($borrado);
    }

    private function codigo($solicitud)
    {
        $ano = date('Y');
        $mes = date('m');
        $internacional="I";
        $estNautico = EstablecimientoNautico::find($solicitud['establecimiento_nautico_id']);
        $capitania = Departamento::find($estNautico->capitania_id);
        $idcap=$capitania->id;

        $cantidadActual = PermisoZarpe::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where(DB::raw("(SUBSTR(nro_solicitud, 8, 4) = '" . $ano . "')"), '=', true)
            ->where("permiso_zarpes.descripcion_navegacion_id", '=', 4)
            ->Join('establecimiento_nauticos', function ($join) use ($idcap) {
                $join->on('permiso_zarpes.establecimiento_nautico_id', '=', 'establecimiento_nauticos.id')
                    ->where('establecimiento_nauticos.capitania_id', '=',  $idcap);
            })
            ->get();

        $correlativo = $cantidadActual[0]->cantidad + 1;
        $codigo = $capitania->sigla . "-" .$internacional. "-" . $ano . $mes . "-" . $correlativo;

        return $codigo;
    }


    public function updateStatus($id, $status, $establecimiento)
    {
        $transaccion = PermisoZarpe::find($id);
        $capitania= Departamento::where('id',$transaccion->establecimiento_nautico->capitania_id)->first();
        //$estnauticoDestino=EstablecimientoNautico::find($transaccion->establecimiento_nautico_destino_id);
        $pais=Paise::find($transaccion->paises_id);
        $notificacion = new NotificacioneController();

        if ($status === 'aprobado') {
            if ($transaccion->bandera=='extranjera') {
                $buqueconsex=AutorizacionEvento::where('id',$transaccion->permiso_estadia_id)->first();
                $buque=$buqueconsex->nombre_buque;
            }else {
                $buqueconsnac= Renave_data::where('matricula_actual',$transaccion->matricula)->first();
                $buque=$buqueconsnac->nombrebuque_actual;
            }
            $idstatus = Status::find(1);
            $solicitante = User::find($transaccion->user_id);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();

            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Aprobado'
            ]);
            $email = new MailController();
            $mensaje='Estimado ciudadano, La notificación de zarpe N°:'. $transaccion->nro_solicitud.' registrada en el Sistema para el Control de Zarpes
    para Embarcaciones Recreativas ha sido Aprobada. Puede verificar su documento de autorización de zarpe en el
    archivo adjunto a este correo.

    Por favor realice la notificación de arribo en el sistema cuando llegue a su destino para cerrar el ciclo de la
    solicitud.';
            $data = [
                'id' => $id,
                'idstatus' => $idstatus->id,
                'status' => $idstatus->nombre,
                'nombre_buque' => $buque,
                'origen' => $capitania->nombre,
                'destino' => $pais->name,
                'matricula' => $transaccion->matricula,
                'mensaje'=>$mensaje,
            ];
            $view = 'emails.zarpes.revision';
            $subject = 'Solicitud de permiso de Zarpe ' . $transaccion->nro_solicitud;
            $email->mailZarpePDFZI($solicitante->email, $subject, $data, $view);
            $notificacion->storeNotificaciones($transaccion->user_id, $subject,  $mensaje, "Zarpe Internacional");

            Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
            return redirect(route('zarpeInternacional.index'));

        } elseif ($status === 'rechazado') {
            $motivo = $_GET['motivo'];
            if ($transaccion->bandera=='extranjera') {
                $buqueconsex=AutorizacionEvento::where('id',$transaccion->permiso_estadia_id)->first();
                $buque=$buqueconsex->nombre_buque;
            }else {
                $buqueconsnac= Renave_data::where('matricula_actual',$transaccion->matricula)->first();
                $buque=$buqueconsnac->nombrebuque_actual;
            }
            $idstatus = Status::find(2);
            $solicitante = User::find($transaccion->user_id);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();
            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => $motivo
            ]);
            $email = new MailController();
            $mensaje='Estimado ciudadano, La notificación de zarpe N°:'. $transaccion->nro_solicitud.' registrada en el Sistema para el Control de Zarpes
    para Embarcaciones Recreativas ha sido Rechazada.';
            $data = [
                'id' => $id,
                'idstatus' => $idstatus->id,
                'status' => $idstatus->nombre,
                'nombre_buque' => $buque,
                'origen' => $capitania->nombre,
                'destino' => $pais->name,
                'matricula' => $transaccion->matricula,
                'motivo'=>$motivo,
                'mensaje'=>$mensaje
            ];
            $view = 'emails.zarpes.revision';
            $subject = 'Solicitud de Zarpe Internacional ' . $transaccion->nro_solicitud;
            $email->mailZarpe($solicitante->email, $subject, $data, $view);
            $notificacion->storeNotificaciones($transaccion->user_id, $subject,  $mensaje, "Zarpe Internacional");

            Flash::error('Solicitud rechazada y correo enviado al usuario solicitante.');
            return redirect(route('zarpeInternacional.index'));

        } elseif ($status === 'navegando') {
            $zarpe = PermisoZarpe::find($id);
            $idstatus = Status::find(5);
            $zarpe->status_id = $idstatus->id;
            $zarpe->update();

            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Navegando'
            ]);
            Flash::warning('Solicitud informada con el estatus de Navegando.');
            return redirect(route('zarpeInternacional.index'));

        } elseif ($status === 'anulado_sar') {
            $zarpe = PermisoZarpe::find($id);
            $idstatus = Status::find(8);
            $zarpe->status_id = $idstatus->id;
            $zarpe->update();

            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Anulado por SAR'
            ]);
            Flash::error('Solicitud Anulada por SAR.');
            return redirect(route('zarpeInternacional.index'));

        } elseif ($status === 'cerrado') {
            $transaccion = PermisoZarpe::find($id);
            $idstatus = Status::find(4);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();

            Flash::info('Solicitud de Zarpe Cerrada.');
            return redirect(route('zarpeInternacional.index'));

        } elseif ($status === 'anular-usuario') {
            $zarpe = PermisoZarpe::find($id);
            $idstatus = Status::find(6);
            $zarpe->status_id = $idstatus->id;
            $zarpe->update();

            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Anulada por el Usuario Solicitante'
            ]);
            Flash::error('Solicitud Anulada.');
            return redirect(route('zarpeInternacional.index'));
        }
    }

    /**
     * Display the specified PermisoZarpe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permisoZarpe = PermisoZarpe::find($id);
        if ($permisoZarpe->bandera=='extranjera') {
            $buque=AutorizacionEvento::where('id',$permisoZarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$permisoZarpe->matricula)->first();
        }
        $tripulantes2 = TripulanteInternacional::select('*')->where('permiso_zarpe_id', $id)->get();
        $trp=$tripulantes2;

        foreach ($trp as $value) {

            if($value->tipo_doc=='V'){
                $tripV=Saime_cedula::select('saime_cedula.fecha_nacimiento','saime_cedula.sexo','licencias_titulos_gmar.nombre','licencias_titulos_gmar.apellido','licencias_titulos_gmar.solicitud','licencias_titulos_gmar.documento','licencias_titulos_gmar.fecha_emision', 'licencias_titulos_gmar.nro_ctrl')
                ->rightJoin('gmar.licencias_titulos_gmar','saime_cedula.cedula','=','licencias_titulos_gmar.ci')
                ->where('licencias_titulos_gmar.ci',$value->nro_doc)
               ->get();

               $value->nombres=$tripV[0]->nombre;
               $value->apellidos=$tripV[0]->apellido;
               $value->sexo=$tripV[0]->sexo;


                $value->fecha_nacimiento=  $tripV[0]->fecha_nacimiento;
               $value->rango=$tripV[0]->documento;
               $emision=explode(' ',$tripV[0]->fecha_emision);
                list($ano, $mes, $dia) = explode("-", $emision[0]);
                $emision[0]=$dia.'/'.$mes.'/'.$ano;
               $value->fecha_emision=$emision[0];
               $value->solicitud=$tripV[0]->solicitud;
                $value->nro_ctrl=$tripV[0]->nro_ctrl;



            }else{
                $value->fecha_emision='';
                $value->solicitud='';

            }
        }



        $pasajeros = $permisoZarpe->pasajeros()->where('permiso_zarpe_id', $id)->get();
        //$tripulantes2 = LicenciasTitulosGmar::whereIn('id', $tripulantes)->get();
        $validacionSgm = TiposCertificado::where('matricula', $permisoZarpe->matricula)->get();
        $equipos = EquipoPermisoZarpe::where('permiso_zarpe_id', $id)->get();
        $revisiones = ZarpeRevision::where('permiso_zarpe_id', $id)->get();
        $paises= Paise::where('id', $permisoZarpe->paises_id)->get();

        $establecimiento = EstablecimientoNautico::select('capitania_id')->where('id', $permisoZarpe->establecimiento_nautico_id)->get();
        $establecimiento_user = DepartamentoUser::select('user_id')
            ->where('establecimiento_nautico_id', $permisoZarpe->establecimiento_nautico_id)
            ->get();
        $establecimiento_destino = EstablecimientoNautico::find($permisoZarpe->establecimiento_nautico_destino_id);
        $capitania_user = DepartamentoUser::select('user_id')->whereIn('capitania_id', $establecimiento)->get();
        $descipcionNavegacion=DescripcionNavegacion::find($permisoZarpe->descripcion_navegacion_id);
        $capitaniaOrigen=Departamento::find($establecimiento);
        if (empty($permisoZarpe)) {
            Flash::error('Permiso Zarpe not found');
            return redirect(route('zarpeInternacional.index'));
        }

        return view('zarpes.zarpe_internacional.show')
            ->with('permisoZarpe', $permisoZarpe)
            ->with('buque',$buque)
            ->with('certificados', $validacionSgm)
            ->with('tripulantes', $trp)
            ->with('pasajeros', $pasajeros)
            ->with('equipos', $equipos)
            ->with('revisiones', $revisiones)
            ->with('capitania', $capitania_user)
            ->with('comodoro', $establecimiento_user)
            ->with('descripcionNavegacion', $descipcionNavegacion)
            ->with('establecimientoDestino', $establecimiento_destino)
            ->with('capitaniaOrigen', $capitaniaOrigen[0])
            ->with('pais',$paises)->with('titulo', $this->titulo);
    }

    public function SendMail($idsolicitud, $tipo, $mailUser)
    {
        $solicitud = PermisoZarpe::find($idsolicitud);
        $solicitante = User::find($solicitud->user_id);

        $capitanDestino = DepartamentoUser::select('capitania_id', 'email', 'user_id')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->destino_capitania_id)
            ->where('cargo', '=', 4)
            ->where('habilitado', '=', true)
            ->get();

        $estNautico = EstablecimientoNautico::find($solicitud->establecimiento_nautico_id);


        $capitanOrigen = DepartamentoUser::select('capitania_id', 'email','user_id')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $estNautico->capitania_id)
            ->where('cargo', '=', 4)
            ->where('habilitado', '=', true)
            ->get();

            $notificacion = new NotificacioneController();


        if ($tipo == 1 && count($capitanOrigen) > 0) {
            //mensaje para caitania origen
            $mensaje = "El Sistema de control y Gestión de Zarpes del INEA le notifica que ha recibido una
    nueva solicitud de permiso de zarpe en su jurisdicción que espera por su aprobación.";
            $mailTo = $capitanOrigen[0]->email;
            $subject = 'Nueva solicitud de permiso de Zarpe Internacional ' . $solicitud->nro_solicitud;

            $email = new MailController();
            $data = [
                'solicitud' => $solicitud->nro_solicitud,
                'matricula' => $solicitud->matricula,
                'nombres_solic' => $solicitante->nombres,
                'apellidos_solic' => $solicitante->apellidos,
                'fecha_salida' => $solicitud->fecha_hora_salida,
                'fecha_regreso' => $solicitud->fecha_hora_regreso,
                'mensaje' => $mensaje,

            ];
            $view = 'emails.zarpes.solicitudPermisoZarpe';

            $email->mailZarpe($mailTo, $subject, $data, $view);

            $notificacion->storeNotificaciones($capitanOrigen[0]->user_id, $subject,  $mensaje, "Zarpe Internacional");

            $return = true;

        } else if (count($capitanDestino) > 0) {
            //mensaje para capitania destino
            $mensaje = "El Sistema de Control y Gestión de Zarpes del INEA le notifica que
    la siguiente embarcación está próxima a arribar a su jurisdicción.";
            $mailTo = $capitanDestino[0]->email;
            $subject = 'Notificación de arribo de embarcación ' . $solicitud->matricula;

            $email = new MailController();
            $data = [
                'solicitud' => $solicitud->nro_solicitud,
                'matricula' => $solicitud->matricula,
                'nombres_solic' => $solicitante->nombres,
                'apellidos_solic' => $solicitante->apellidos,
                'fecha_salida' => $solicitud->fecha_hora_salida,
                'fecha_regreso' => $solicitud->fecha_hora_regreso,
                'mensaje' => $mensaje,

            ];
            $view = 'emails.zarpes.solicitudPermisoZarpe';

            $email->mailZarpe($mailTo, $subject, $data, $view);
            $notificacion->storeNotificaciones($capitanDestino[0]->user_id, $subject,  $mensaje, "Zarpe Internacional");

            $return = true;
        } else {
            $return = false;

        }

        if( $mailUser==true){
        $emailUser = new MailController();
        $mensajeUser = "El Sistema de control y Gestión de Zarpes del INEA le notifica que ha generado una
        nueva solicitud de permiso de zarpe Internacional con su usuario y se encuentra en espera de aprobación.";
        $dataUser = [
                'solicitud' => $solicitud->nro_solicitud,
                'matricula' => $solicitud->matricula,
                'nombres_solic' => $solicitante->nombres,
                'apellidos_solic' => $solicitante->apellidos,
                'fecha_salida' => $solicitud->fecha_hora_salida,
                'fecha_regreso' => $solicitud->fecha_hora_regreso,
                'mensaje' => $mensajeUser,
        ];
        $view = 'emails.zarpes.solicitudPermisoZarpe';
        $subject = 'Nueva solicitud de permiso de Zarpe Internacional ' . $solicitud->nro_solicitud;
        $emailUser->mailZarpe($solicitante->email, $subject, $dataUser, $view);
        $notificacion->storeNotificaciones($solicitud->user_id, $subject, $mensajeUser, "Zarpe Internacional");
        }
        return $return;
    }


    public function validacionJerarquizacion($doc, $cap)
    {
        $capitan = $cap;
        $documento = $doc;
        $return = false;
        $validacion = json_decode(session('validacion'), true);

        switch ($documento) {
            case 'Capitán de Altura':
                $return = [true, $documento];

                break;
            case 'Primer Oficial de Navegación':
                if ($validacion['UAB'] <= 3000) {
                    $return = [true];
                } else {
                    $return = [false];
                }

                break;
            case 'Segundo Oficial de Navegación':
                if ($validacion['UAB'] <= 500) {
                    $return = [true];
                } else {
                    $return = [false];
                }
                break;
            case 'Capitán de Yate':
                if ($validacion['UAB'] <= 300) {
                    $return = [true];
                } else {
                    $return = [false];
                }
                break;
            case 'Capitán Costanero':
                $coordenadas = [];
                if ($validacion['UAB'] <= 3000) {
                    $return = [true, $coordenadas];
                } else {
                    $return = [false, $coordenadas];
                }
                break;
            case 'Patrón de Primera':
                $coordenadas = [];
                if ($validacion['UAB'] <= 500) {
                    $return = [true, $coordenadas];
                } else {
                    $return = [false, $coordenadas];
                }
                break;
            case 'Patrón Deportivo de Primera':
                $coordenadas = [];
                if ($validacion['UAB'] <= 150) {
                    $return = [true, $coordenadas];
                } else {
                    $return = [false, $coordenadas];
                }
                break;
            case 'Patrón de Segunda':
                $coordenadas = [];
                if ($validacion['UAB'] <= 500 && $validacion['eslora'] < 24) {
                    $return = [true, $coordenadas, 1];//validacion, coordenadas, cantidad de jurisdicciones que puede visitar
                } else {
                    $return = [false, $coordenadas, 1];
                }
                break;
            case 'Patrón Deportivo de Segunda':
                if ($validacion['UAB'] <= 40) {
                    $return = [true];
                } else {
                    $return = [false];
                }
                break;
            case 'Patrón Deportivo de Tercera':
                if ($validacion['UAB'] <= 10) {
                    $return = [true];
                } else {
                    $return = [false];
                }
                break;
            case 'Tercer Oficial de Navegación':

                if ($capitan == "SI") {
                    $return = [false];
                } else {

                    $return = [true];

                }

                break;
            case 'Capitán de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {

                    $return = [true];

                }
                break;
            case 'Oficial de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    $return = [true];
                }
                break;
            case 'Patrón Artesanal':
                if ($capitan == "NO") {
                    if ($validacion['eslora'] <= 24) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                } else {
                    $return = [false];
                }


                break;
            case 'Jefe de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    $return = [true];
                }

                break;
            case 'Primer Oficial de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 3000) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;
            case 'Segundo Oficial de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 3000) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;
            case 'Motorista de Primera':
                $coordenadas = [];
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 2237) {
                        $return = [true, $coordenadas];
                    } else {
                        $return = [false, $coordenadas];
                    }
                    $return = [true];

                }

                break;
            case 'Motorista de Segunda':
                $coordenadas = [];
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 560) {
                        $return = [true, $coordenadas];
                    } else {
                        $return = [false, $coordenadas];
                    }
                    $return = [true];

                }

                break;
            case 'Jefe de Máquinas de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 560) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;
            case 'Tercer Oficial de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 350) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;
            case 'Oficial de Máquinas de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 560) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;

            default:
                $return = [false];
                break;
        }
        return $return;
    }


    public function limpiarVariablesSession()
    {
        Session::forget('pasajeros');
        Session::forget('tripulantes');
        Session::forget('validacion');
        Session::forget('solicitud');
        $this->step = 1;
    }


    public function BuscaEstablecimientosNauticos(Request $request)
    {
        $idcap = $_REQUEST['idcap'];
        $EstNauticos = EstablecimientoNautico::where('capitania_id', $idcap)->get();
        $cap = Departamento::find($idcap);
        $resp = [$cap, $EstNauticos];
        echo json_encode($resp);
    }

    public function FindCapitania(Request $request)
    {
        $descripcion = $_REQUEST['descripcion_de_navegacion'];

        if ($descripcion == 2) {
            $CapDependencias = DependenciaFederal::selectRaw('distinct(capitania_id)')->get();
            $capitania = Departamento::whereIn('id', $CapDependencias)->get();
        } else {
            $coordsCapsAsign = CoordenadasCapitania::select('coordenadas_capitanias.capitania_id' )->distinct()->get();
            $capitania = Departamento::whereIn('id', $coordsCapsAsign)->get();
        }
        echo json_encode($capitania);
    }

    public function AddDocumentosMarinosZI(Request $request){


        $pasaporte='';
        if ($request->hasFile('doc')) {

            $pasaporte = $request->file('doc');
            $fileNamePass= date('dmYGi') . $pasaporte->getClientOriginalName();
            $filenamepaspnew = str_replace(' ','',$fileNamePass);
            $avatar1 = $pasaporte->move(public_path() . '/documentos/zarpeinternacional', $filenamepaspnew);
            $pasaporte=$filenamepaspnew;
            $resp1= ['OK',$filenamepaspnew];
        }else{
            $resp1= ['errorFile',''];
        }

        $docAcreditacion="";
        if ($request->hasFile('documentoAcreditacion')) {

            $docAcreditacion = $request->file('documentoAcreditacion');
            $fileNameDocAc= date('dmYGi') . $docAcreditacion->getClientOriginalName();
            $filenameDocAcnew = str_replace(' ','',$fileNameDocAc);
            $avatar2 = $docAcreditacion->move(public_path() . '/documentos/zarpeinternacional', $filenameDocAcnew);
            $docAcreditacion=$filenameDocAcnew;
            $resp2= ['OK',$filenameDocAcnew];
        }else{
            $resp2= ['errorFile',''];
        }
        echo json_encode([$resp1,$resp2]);

    }


}
