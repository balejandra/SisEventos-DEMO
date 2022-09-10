<?php

namespace App\Http\Controllers\Publico;


use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Publico\CreateCapitaniaRequest;
use App\Http\Requests\Publico\UpdateCapitaniaRequest;
use App\Models\Publico\Departamento;
use App\Models\Publico\DepartamentoUser;
use App\Models\User;
use App\Repositories\Publico\CapitaniaRepository;
use Illuminate\Http\Request;
use App\Models\Publico\CoordenadasCapitania;
use Flash;
use Response;
use Spatie\Permission\Models\Role;

class CapitaniaController extends AppBaseController
{
    /** @var  CapitaniaRepository */
    private $capitaniaRepository;

    public function __construct(CapitaniaRepository $capitaniaRepo)
    {
        $this->capitaniaRepository = $capitaniaRepo;

        $this->middleware('permission:listar-capitania', ['only'=>['index'] ]);
        $this->middleware('permission:crear-capitania', ['only'=>['create','store']]);
        $this->middleware('permission:editar-capitania', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-capitania', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-capitania', ['only'=>['destroy'] ]);
    }

    /**
     * Display a listing of the Capitania.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $capitanias = $this->capitaniaRepository->all();

        return view('publico.capitanias.index')
            ->with('capitanias', $capitanias);
    }

    /**
     * Show the form for creating a new Capitania.
     *
     * @return Response
     */
    public function create()
    {
        $user=User::role('Capitán')->get();
        $user2=$user->pluck('email','id')->toArray();
        return view('publico.capitanias.create')->with('capitanes',$user2);
    }

    /**
     * Store a newly created Capitania in storage.
     *
     * @param CreateCapitaniaRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'sigla' => 'required|string',
            'capitanes'=>'required',
            "latitud"    => "required|array|min:1",
            "latitud.*"  => "required",
            "longitud"    => "required|array|min:1",
            "longitud.*"  => "required",
        ],

            [
                'nombre.required' => 'El campo Nombre es obligatorio',
                'sigla.required' => 'El campo Sigla es obligatorio',
                'capitanes.required' => 'El campo Capitán es obligatorio',
                'latitud.*.required'=>'El campo latitud es obligatorio',
                'longitud.*.required'=>'El campo Longitud es obligatorio',

            ]
        );

        $input = $request->all();

        $capitania = $this->capitaniaRepository->create($input);
        $rolecapitan= Role::find(4);
        $capitan_user=new DepartamentoUser();
        $capitan_user->cargo=$rolecapitan->name;
        $capitan_user->user_id=$request->capitanes;
        $capitan_user->capitania_id=$capitania['id'];
        $capitan_user->save();
        $lat=$request->input('latitud', []);
        $long=$request->input('longitud', []);
        $c = count($lat);
        $c2= count($long);

        if($c==$c2){
            for( $i=0;$i<$c;$i++ )
            {
                $coordenadas= [
                    'capitania_id' => $capitania['id'],
                    'latitud'      => $lat[$i],
                    'longitud'     => $long[$i],
                ];
                CoordenadasCapitania::create($coordenadas);
            }
        }

        Flash::success('Capitanía guardado con éxito.');

        return redirect(route('capitanias.index'))->with('success','Capitanía guardado con éxito.');
    }

    /**
     * Display the specified Capitania.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $capitania = $this->capitaniaRepository->find($id);

        $coords=CoordenadasCapitania::select(['id','capitania_id', 'latitud', 'longitud'])->where('coordenadas_capitanias.capitania_id', '=', $id)->get();

        $capitan=DepartamentoUser::where('capitania_id', $id)->join('users',  'users.id', '=','capitania_user.user_id')->get();
        if (empty($capitania)) {
            //Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'))->with('danger','Capitania no encontrada');
        }


        return view('publico.capitanias.show')
            ->with('capitania', $capitania)
            ->with('coords', $coords)
            ->with('capitan',$capitan);
    }

    /**
     * Show the form for editing the specified Capitania.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $capitania = $this->capitaniaRepository->find($id);
        //$coords=Coordenas_capitania::select(['id','capitania_id', 'latitud', 'longitud'])->where('coordenas_capitania.capitania_id', '=', $id)->get();
        $coords=CoordenadasCapitania::select(['id','capitania_id', 'latitud', 'longitud'])->where('coordenadas_capitanias.capitania_id', '=', $id)->get();
        $user=User::role('Capitán')->get();
        $noparent=['0' => 'Sin Capitán'];
        $parents2=$user->pluck('email','id')->toArray();
        $parent=$noparent+$parents2;
        $capitanes=$user->pluck('email','id')->toArray();
        //dd($capitanes);
        if (empty($capitania)) {
            Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'));
        }

        return view('publico.capitanias.edit')
            ->with('capitania', $capitania)
            ->with('coordenadas',$coords)
            ->with('user',$parent);
    }

    /**
     * Update the specified Capitania in storage.
     *
     * @param int $id
     * @param UpdateCapitaniaRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request, Departamento $cap)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'sigla' => 'required|string',
            "latitud"    => "required|array|min:1",
            "latitud.*"  => "required",
            "longitud"    => "required|array|min:1",
            "longitud.*"  => "required",
        ],

            [
                'nombre.required' => 'El campo Nombre es obligatorio',
                'sigla.required' => 'El campo Sigla es obligatorio',
                'latitud.*.required'=>'El campo latitud es obligatorio',
                'longitud.*.required'=>'El campo Longitud es obligatorio',

            ]);
        $capi = $this->capitaniaRepository->update($request->all(), $id);
        $rolecapitan=Role::find(4);
       if ($request->user==0) {
         $capitan=DepartamentoUser::where('capitania_id',$id)
             ->where('cargo',$rolecapitan->name)
             ->delete();
       } else{
           $capitan=DepartamentoUser::where('capitania_id',$id)
               ->where('cargo',$rolecapitan->name)
               ->first();
          // dd($capitan);
            if (is_null($capitan)) {
                $capitan= new DepartamentoUser();
                $capitan->cargo=$rolecapitan->name;
                $capitan->user_id=$request->user;
                $capitan->capitania_id=$id;
                $capitan->save();
            }else {
                $capitan->cargo=$rolecapitan->name;
                $capitan->user_id=$request->user;
                $capitan->capitania_id=$id;
                $capitan->update();
            }

       }

        $ids=$request->input('ids', []);
        $lat=$request->input('latitud', []);
        $long=$request->input('longitud', []);
        $deletes=$request->input('deletes', []);

        foreach ($deletes as $k => $val) {

           if($val!=""){
            $coorDel=CoordenadasCapitania::find($val);
            $coorDel->delete($val);
           }

        }

        if(count($lat)==count($long)){
            for( $i=0;$i<count($lat);$i++ )
            {
                $coordenadas[]= [
                    'capitania_id' => $id,
                    'latitud'      => $lat[$i],
                    'longitud'     => $long[$i],
                ];
            }

            foreach ($coordenadas as $key => $value) {
              //  echo $ids[$key];   echo "<br><br>---";  print_r($value); echo "<br><br>---";
                if($ids[$key]==""){
                    $coordenadas= [
                        'capitania_id' => $id,
                        'latitud'      => $lat[$key],
                        'longitud'     => $long[$key],
                    ];
                    CoordenadasCapitania::create($coordenadas);
                }else{
                    $coord=CoordenadasCapitania::find($ids[$key]);
                    $coord->update($value);
                }

              //  $capi->CoordenadasCapitania()->update($value,$ids[$key]);
            }
        }
        Flash::success('Capitanía modificada con éxito.');
       return redirect(route('capitanias.index'));

    }

    /**
     * Remove the specified Capitania from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Departamento $cap)
    {
        $capitania = $this->capitaniaRepository->find($id);

        if (empty($capitania)) {
           Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'));
        }

        $this->capitaniaRepository->delete($id);
        Flash::success('Capitania eliminada con éxito.');

        return redirect(route('capitanias.index'));
    }
}
