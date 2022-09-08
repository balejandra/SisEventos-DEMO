<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Zarpes\CreateTablaMandoRequest;
use App\Http\Requests\Zarpes\UpdateTablaMandoRequest;
use App\Models\SATIM\CargoTablaMando;
use App\Repositories\Zarpes\TablaMandoRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class TablaMandoController extends Controller
{
    /** @var  TablaMandoRepository */
    private $tablaMandoRepository;

    public function __construct(TablaMandoRepository $tablaMandoRepo)
    {
        $this->tablaMandoRepository = $tablaMandoRepo;
        $this->middleware('permission:listar-mando', ['only'=>['index'] ]);
        $this->middleware('permission:crear-mando', ['only'=>['create','store']]);
        $this->middleware('permission:editar-mando', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-mando', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-mando', ['only'=>['destroy'] ]);
    }

    /**
     * Display a listing of the TablaMando.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tablaMandos = $this->tablaMandoRepository->all();

        return view('zarpes.tabla_mando.index')
            ->with('tablaMandos', $tablaMandos);
    }

    /**
     * Show the form for creating a new TablaMando.
     *
     * @return Response
     */
    public function create()
    {
        $cargos=[];
        return view('zarpes.tabla_mando.create')->with('cargos',$cargos);
    }

    /**
     * Store a newly created TablaMando in storage.
     *
     * @param CreateTablaMandoRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'UAB_minimo' => 'required|numeric',
            'UAB_maximo' => 'required|numeric',
            'cant_tripulantes' => 'required|numeric',
            "titulacion_minima"    => "required|array|min:1",
            "titulacion_minima.*"  => "required",
            "cargo"    => "required|array|min:1",
            "cargo.*"  => "required",
            "titulacion_maxima"    => "required|array|min:1",
            "titulacion_maxima.*"  => "required",
        ],

            [
                'UAB_minimo.required' => 'El campo UAB mínimo es obligatorio',
                'UAB_maximo.required' => 'El campo UAB máximo es obligatorio',
                'cant_tripulantes.required' => 'El campo Cantidad de Tripulantes es obligatorio',
                'titulacion_maxima.*.required' => 'El campo Titulación Máxima es obligatorio',
                'cargo.*.required'=>'El campo Cargo es obligatorio',
                'titulacion_minima.*.required'=>'El campo Titulación Minima es obligatorio',

            ]
        );

        $input = $request->all();

        $tablaMando = $this->tablaMandoRepository->create($input);
        $lat=$request->input('cargo', []);
        $long=$request->input('titulacion_minima', []);
        $titmax=$request->input('titulacion_maxima', []);
        $c = count($lat);
        $c2= count($long);

        if($c==$c2){
            for( $i=0;$i<$c;$i++ )
            {
                $coordenadas= [
                    'tabla_mando_id' => $tablaMando->id,
                    'cargo_desempena'      => $lat[$i],
                    'titulacion_aceptada_minima'     => $long[$i],
                    'titulacion_aceptada_maxima'     => $titmax[$i],
                ];


                CargoTablaMando::create($coordenadas);
            }
        }

        Flash::success('Tabla Mando saved successfully.');

        return redirect(route('tablaMandos.index'));
    }

    /**
     * Display the specified TablaMando.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tablaMando = $this->tablaMandoRepository->find($id);

        if (empty($tablaMando)) {
            Flash::error('Tabla Mando not found');

            return redirect(route('tablaMandos.index'));
        }

        return view('zarpes.tabla_mando.show')->with('tablaMando', $tablaMando);
    }

    /**
     * Show the form for editing the specified TablaMando.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tablaMando = $this->tablaMandoRepository->find($id);
        $coords=CargoTablaMando::select(['id','tabla_mando_id', 'titulacion_aceptada_minima', 'cargo_desempena','titulacion_aceptada_maxima'])
            ->where('cargo_tabla_mandos.tabla_mando_id', '=', $id)->get();

        if (empty($tablaMando)) {
            Flash::error('Tabla Mando not found');

            return redirect(route('tablaMandos.index'));
        }

        return view('zarpes.tabla_mando.edit')
            ->with('tablaMando', $tablaMando)
            ->with('cargos',$coords);
    }

    /**
     * Update the specified TablaMando in storage.
     *
     * @param int $id
     * @param UpdateTablaMandoRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'UAB_minimo' => 'required|numeric',
            'UAB_maximo' => 'required|numeric',
            'cant_tripulantes' => 'required|numeric',
            "titulacion_minima"    => "required|array|min:1",
            "titulacion_minima.*"  => "required",
            "cargo"    => "required|array|min:1",
            "cargo.*"  => "required",
            "titulacion_maxima"    => "required|array|min:1",
            "titulacion_maxima.*"  => "required",
        ],

            [
                'UAB_minimo.required' => 'El campo UAB mínimo es obligatorio',
                'UAB_maximo.required' => 'El campo UAB máximo es obligatorio',
                'cant_tripulantes.required' => 'El campo Cantidad de Tripulantes es obligatorio',
                'titulacion_maxima.*.required' => 'El campo Titulación Máxima es obligatorio',
                'cargo.*.required'=>'El campo Cargo es obligatorio',
                'titulacion_minima.*.required'=>'El campo Titulación Mínima es obligatorio',

            ]
        );

        $tablaMando = $this->tablaMandoRepository->find($id);

        if (empty($tablaMando)) {
            Flash::error('Tabla Mando no encontrada');

            return redirect(route('tablaMandos.index'));
        }

        $tablaMando = $this->tablaMandoRepository->update($request->all(), $id);

        $ids=$request->input('ids', []);
        $lat=$request->input('cargo', []);
        $long=$request->input('titulacion_minima', []);
        $titmax=$request->input('titulacion_maxima', []);
        $deletes=$request->input('deletes', []);

        foreach ($deletes as $k => $val) {

            if($val!=""){
                $coorDel=CargoTablaMando::find($val);
                $coorDel->delete($val);
            }

        }

        if(count($lat)==count($long)){
            for( $i=0;$i<count($lat);$i++ )
            {
                $coordenadas[]= [
                    'tabla_mando_id' => $id,
                    'cargo_desempena'      => $lat[$i],
                    'titulacion_aceptada_minima'     => $long[$i],
                    'titulacion_aceptada_maxima'     => $titmax[$i],
                ];
            }

            foreach ($coordenadas as $key => $value) {

                if($ids[$key]==""){
                    $coordenadas= [
                        'tabla_mando_id' => $id,
                        'cargo_desempena' => $lat[$key],
                        'titulacion_aceptada_minima'     => $long[$key],
                        'titulacion_aceptada_maxima'     => $titmax[$key],
                    ];

                    CargoTablaMando::create($coordenadas);
                }else{
                    $coord=CargoTablaMando::find($ids[$key]);
                    $coord->update($value);
                }
            }
        }

        Flash::success('Tabla Mando actualizada satisfactoriamente.');

        return redirect(route('tablaMandos.index'));
    }

    /**
     * Remove the specified TablaMando from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tablaMando = $this->tablaMandoRepository->find($id);


        if (empty($tablaMando)) {
            Flash::error('Tabla Mando no encontrada');

            return redirect(route('tablaMandos.index'));
        }

        $this->tablaMandoRepository->delete($id);
        $cargos=CargoTablaMando::where('tabla_mando_id',$id)->delete();

        Flash::success('Tabla Mando eliminada satisfactoriamente.');

        return redirect(route('tablaMandos.index'));
    }
}
