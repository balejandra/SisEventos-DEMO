<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Models\Publico\DependenciaFederal;
use Illuminate\Http\Request;
use App\Models\Publico\Departamento;
use App\Models\Publico\CoordenadasDependenciasFederales;
use Flash;
use Response;

class DependenciaFederalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:listar-dependencia', ['only'=>['index'] ]);
        $this->middleware('permission:crear-dependencia', ['only'=>['create','store']]);
        $this->middleware('permission:editar-dependencia', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-dependencia', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-dependencia', ['only'=>['destroy'] ]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependenciaFederals = DependenciaFederal::select("dependencias_federales.*", "capitanias.nombre as capitania")->join('capitanias','capitanias.id','=', 'dependencias_federales.capitania_id')->get();



       return view('publico.dependencias_federales.index')->with('dependenciaFederals', $dependenciaFederals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $capitania=Departamento::all();
                $capitania=$capitania->pluck('nombre','id')->toArray();

        $coords=[];

        return view('publico.dependencias_federales.create')->with('capitanias', $capitania)->with('coordenadas',$coords);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'capitania' => 'required|string',
            "latitud"    => "required|array|min:1",
            "latitud.*"  => "required",
            "longitud"    => "required|array|min:1",
            "longitud.*"  => "required",
        ],

            [
                'nombre.required' => 'El campo Nombre es obligatorio',
                'capitania.required' => 'El campo Sigla es obligatorio',
                'latitud.*.required'=>'El campo latitud es obligatorio',
                'longitud.*.required'=>'El campo Longitud es obligatorio',

            ]);


        $input = [
            'nombre' => $request->input('nombre'),
            'capitania_id' => $request->input('capitania'),
        ];

        $dependenciaFederal = DependenciaFederal::create($input);

        $lat=$request->input('latitud', []);
        $long=$request->input('longitud', []);
        $c = count($lat);
        $c2= count($long);

        if($c==$c2){
            for( $i=0;$i<$c;$i++ )
            {
                $coordenadas= [
                    'dependencias_federales_id' => $dependenciaFederal->id,
                    'latitud'      => $lat[$i],
                    'longitud'     => $long[$i],
                ];


                CoordenadasDependenciasFederales::create($coordenadas);
            }
        }

        Flash::success('Dependencia Federal guardada satisfactoriamente.');

        return redirect(route('dependenciasfederales.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dependenciaFederal = DependenciaFederal::find($id);
        $capitania=Departamento::find($dependenciaFederal['capitania_id']);

        if (empty($dependenciaFederal)) {
            Flash::error('Dependencia Federal no encontrada');

            return redirect(route('dependenciasfederales.index'));
        }
        $coords=CoordenadasDependenciasFederales::select(['id','dependencias_federales_id', 'latitud', 'longitud'])->where('coordenadas_dependencias_federales.dependencias_federales_id', '=', $id)->get();
        if(!count($coords)>0){
            $coords="";
        }
        return view('publico.dependencias_federales.show')->with('dependenciaFederal', $dependenciaFederal)->with('capitania',  $capitania['nombre'])->with('coordenadas',$coords);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dependenciaFederal = DependenciaFederal::find($id);
                $capitania=Departamento::all();
                $capitania=$capitania->pluck('nombre','id')->toArray();

        $coords=CoordenadasDependenciasFederales::select(['id','dependencias_federales_id', 'latitud', 'longitud'])->where('coordenadas_dependencias_federales.dependencias_federales_id', '=', $id)->get();


        if (empty($dependenciaFederal)) {
            Flash::error('Dependencia Federal no encontrada');

            return redirect(route('dependenciasfederales.index'));
        }else{
            $IDdependenciaFederal=$dependenciaFederal->capitania_id;
        }
       return view('publico.dependencias_federales.edit')->with('dependenciaFederal', $dependenciaFederal)->with('capitanias',  $capitania)->with('coordenadas',$coords)->with('IDdependenciaFederal', $IDdependenciaFederal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $validated = $request->validate([
            'nombre' => 'required|string',
            'capitania' => 'required|string',
            "latitud"    => "required|array|min:1",
            "latitud.*"  => "required",
            "longitud"    => "required|array|min:1",
            "longitud.*"  => "required",
        ],

            [
                'nombre.required' => 'El campo Nombre es obligatorio',
                'capitania.required' => 'El campo Sigla es obligatorio',
                'latitud.*.required'=>'El campo latitud es obligatorio',
                'longitud.*.required'=>'El campo Longitud es obligatorio',

            ]);

        $dependenciaFederal = DependenciaFederal::find($id);

        if (empty($dependenciaFederal)) {
            Flash::error('Dependencia Federal no encontrada');
            return redirect(route('dependenciasfederales.index'));
        }

        $dependenciaFederal->nombre=$request->input('nombre');
        $dependenciaFederal->capitania_id=$request->input('capitania');
        $dependenciaFederal->save();


        $ids=$request->input('ids', []);
        $lat=$request->input('latitud', []);
        $long=$request->input('longitud', []);
        $deletes=$request->input('deletes', []);

        foreach ($deletes as $k => $val) {

           if($val!=""){
            $coorDel=CoordenadasDependenciasFederales::find($val);
            $coorDel->delete($val);
           }

        }

        if(count($lat)==count($long)){
            for( $i=0;$i<count($lat);$i++ )
            {
                $coordenadas[]= [
                    'dependencias_federales_id' => $id,
                    'latitud'      => $lat[$i],
                    'longitud'     => $long[$i],
                ];
            }

            foreach ($coordenadas as $key => $value) {

                if($ids[$key]==""){
                    $coordenadas= [
                        'dependencias_federales_id' => $id,
                        'latitud'      => $lat[$key],
                        'longitud'     => $long[$key],
                    ];

                    CoordenadasDependenciasFederales::create($coordenadas);
                }else{
                    $coord=CoordenadasDependenciasFederales::find($ids[$key]);
                    $coord->update($value);
                }
            }
        }

        Flash::success('Dependencia Federal actualizada satisfactoriamente.');

        return redirect(route('dependenciasfederales.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dependenciaFederal = DependenciaFederal::find($id);

        if (empty($dependenciaFederal)) {
            Flash::error('Dependencia Federal no encontrada');

            return redirect(route('dependenciasfederales.index'));
        }

        $dependenciaFederal->delete($id);

        Flash::success('Dependencia Federal eliminada.');

        return redirect(route('dependenciasfederales.index'));
    }
}
