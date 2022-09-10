<?php

namespace App\Http\Controllers\Publico;

use App\Http\Requests\Publico\UpdateCapitaniaUserRequest;
use App\Models\Publico\Departamento;
use App\Models\Publico\DepartamentoUser;
use App\Models\User;
use App\Models\SATIM\EstablecimientoNautico;
use App\Repositories\Publico\CapitaniaUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Role;

class CapitaniaUserController extends AppBaseController
{
    /** @var  CapitaniaUserRepository */
    private $capitaniaUserRepository;

    public function __construct(CapitaniaUserRepository $capitaniaUserRepo)
    {
        $this->capitaniaUserRepository = $capitaniaUserRepo;
        $this->middleware('permission:listar-usuarios-capitanias', ['only' => ['index']]);
        $this->middleware('permission:crear-usuarios-capitanias', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-usuarios-capitanias', ['only' => ['edit', 'update']]);
        $this->middleware('permission:consultar-usuarios-capitanias', ['only' => ['show']]);
        $this->middleware('permission:eliminar-usuarios-capitanias', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the CapitaniaUser.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $capitaniaUsers = $this->capitaniaUserRepository->all();

        return view('publico.capitania_users.index')
            ->with('capitaniaUsers', $capitaniaUsers);
    }

    /**
     * Show the form for creating a new CapitaniaUser.
     *
     * @return Response
     */
    public function create()
    {
        // $user2=User::pluck('email','id');
        $capitanias = Departamento::pluck('nombre', 'id');
        $roles = Role::pluck('name', 'id');
        $estable = EstablecimientoNautico::pluck('nombre', 'id');
        return view('publico.capitania_users.create')
            // ->with('users',$user2)
            ->with('capitania', $capitanias)
            ->with('establecimientos', $estable)
            ->with('roles', $roles);
    }

    /**
     * Store a newly created CapitaniaUser in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

        if (($request->cargo == 5) || ($request->cargo == 6)) {
            $validated = $request->validate([
                'cargo' => 'required|string',
                'user_id' => 'required|string',
                'capitania_id' => 'required',
                'establecimiento_nautico_id' => 'required'
            ],

                [
                    'cargo.required' => 'El campo Cargo es obligatorio.',
                    'user_id.required' => 'El campo Email del Usuario es obligatorio.',
                    'capitania_id.required' => 'El campo Capitanía es obligatorio.',
                    'establecimiento_nautico_id.required' => 'El campo  Establecimiento Náutico Asignado es obligatorio.'

                ]);
        } else {
            $validated = $request->validate([
                'cargo' => 'required|string',
                'user_id' => 'required|string',
                'capitania_id' => 'required',
                'habilitado' => 'required'
            ],
                [
                    'cargo.required' => 'El campo Cargo es obligatorio.',
                    'user_id.required' => 'El campo Email del Usuario es obligatorio.',
                    'capitania_id.required' => 'El campo Capitanía es obligatorio.',
                ]);

        }

        if ($request->habilitado == 1) {
            if (($request->cargo == 5) || ($request->cargo == 6)) {
                $verification = DepartamentoUser::where('cargo', $request->cargo)->where('establecimiento_nautico_id', $request->establecimiento_nautico_id)
                    ->where('habilitado', true)->get();
                if (isset($verification[0])) {
                    Flash::error('El Establecimiento Náutico ya tiene asignado este Rol.');
                    return redirect()->back();

                } else {
                    $input = $request->all();
                    $capitaniaUser = $this->capitaniaUserRepository->create($input);
                    Flash::success('Usuario de Capitanía guardado satisfactoriamente.');

                    return redirect(route('capitaniaUsers.index'));
                }
            }
            if ($request->cargo==='4') {
                $verification = DepartamentoUser::where('cargo', $request->cargo)->where('capitania_id', $request->capitania_id)->get();
                if (isset($verification[0])) {
                    Flash::error('La Capitanía ya tiene asignado este Rol.');
                    return redirect()->back();
                } else {

                    $input = $request->all();

                    $capitaniaUser = $this->capitaniaUserRepository->create($input);

                    Flash::success('Usuario de Capitanía guardado satisfactoriamente.');

                    return redirect(route('capitaniaUsers.index'));
                }
            }else{


                $input = $request->all();

                $capitaniaUser = $this->capitaniaUserRepository->create($input);

                Flash::success('Usuario de Capitanía guardado satisfactoriamente.');

                return redirect(route('capitaniaUsers.index'));
            }
        } else {
            $input = $request->all();
            $capitaniaUser = $this->capitaniaUserRepository->create($input);
            Flash::success('Usuario de Capitanía guardado satisfactoriamente.');

            return redirect(route('capitaniaUsers.index'));
        }

    }

    /**
     * Display the specified CapitaniaUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $capitaniaUser = $this->capitaniaUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Usuario de Capitanía no encontrado');

            return redirect(route('capitaniaUsers.index'));
        }

        return view('publico.capitania_users.show')->with('capitaniaUser', $capitaniaUser);
    }

    /**
     * Show the form for editing the specified CapitaniaUser.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $capitaniaUser = $this->capitaniaUserRepository->find($id);
        $capitanias = Departamento::pluck('nombre', 'id');
        $roles = Role::pluck('name', 'id');
        $establecimientos = EstablecimientoNautico::where('capitania_id', $capitaniaUser->capitania_id)->pluck('nombre', 'id');

        if (empty($capitaniaUser)) {
            Flash::error('Usuario de Capitanía no encontrado');

            return redirect(route('capitaniaUsers.index'));
        }

        return view('publico.capitania_users.edit')
            ->with('capitaniaUser', $capitaniaUser)
            ->with('capitania', $capitanias)
            ->with('roles', $roles)
            ->with('establecimientos', $establecimientos);
    }

    /**
     * Update the specified CapitaniaUser in storage.
     *
     * @param int $id
     * @param UpdateCapitaniaUserRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'cargo' => 'required|string',
            'user_id' => 'required|string',
            'capitania_id' => 'required',
            'habilitado'=>'required'
        ],

            [
                'cargo.required' => 'El campo Cargo es obligatorio.',
                'user_id.required' => 'El campo Email del Usuario es obligatorio.',
                'capitania_id.required' => 'El campo Capitanía es obligatorio.',

            ]);
        $capitaniaUser = $this->capitaniaUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Usuario de Capitanía no encontrado');

            return redirect(route('capitaniaUsers.index'));
        }
       // dd($request);
        if ($request->habilitado == 1) {
          //  dd('aqio');
            if (($request->cargo == 5) || ($request->cargo == 6)) {

                $verification = DepartamentoUser::where('cargo', $request->cargo)->where('establecimiento_nautico_id', $request->establecimiento_nautico_id)
                    ->where('habilitado', true)->get();
                $ver = $verification->except([$id]);

                if (isset($ver[0])) {
                    Flash::error('El Establecimiento Náutico ya tiene asignado este Rol.');
                    return redirect()->back();

                } else {

                    $capitaniaUser = $this->capitaniaUserRepository->update($request->all(), $id);
                    Flash::success('Usuario de Capitanía guardado satisfactoriamente.');
                    return redirect(route('capitaniaUsers.index'));
                }
            }
            if ($request->cargo==='4') {
                $verification = DepartamentoUser::where('cargo', $request->cargo)->where('capitania_id', $request->capitania_id)->get();
                //   dd($verification);
                $ver = $verification->except([$id]);
                if (isset($ver[0])) {
                    Flash::error('La Capitanía ya tiene asignado este Rol.');
                    return redirect()->back();
                } else {
                    $capitaniaUser = $this->capitaniaUserRepository->update($request->all(), $id);
                    Flash::success('Usuario de Capitanía guardado satisfactoriamente.');
                    return redirect(route('capitaniaUsers.index'));

                }
            }else{

                $capitaniaUser = $this->capitaniaUserRepository->update($request->all(), $id);
                Flash::success('Usuario de Capitanía guardado satisfactoriamente.');
                return redirect(route('capitaniaUsers.index'));

            }
        } else {
            $capitaniaUser = $this->capitaniaUserRepository->update($request->all(), $id);
            Flash::success('Usuario de Capitanía guardado satisfactoriamente.');
            return redirect(route('capitaniaUsers.index'));
        }
    }

    /**
     * Remove the specified CapitaniaUser from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $capitaniaUser = $this->capitaniaUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Usuario de Capitanía no encontrado');

            return redirect(route('capitaniaUsers.index'));
        }

        $this->capitaniaUserRepository->delete($id);

        Flash::success('Usuario de Capitanía eliminado satisfactoriamente.');

        return redirect(route('capitaniaUsers.index'));
    }

    public function EstablecimientoUser(Request $request)
    {
        $idcap = $_REQUEST['idcap'];
        $EstNauticos = EstablecimientoNautico::where('capitania_id', $idcap)->get();
        $resp = [$EstNauticos];
        echo json_encode($resp);
    }

    public function search(Request $request)
    {
        //  dd($request->search);
        $user = User::where('email', 'LIKE', '%' . $request->search . '%')
            ->where('tipo_usuario', 'Usuario Interno')->get();
        return \response()->json($user);
    }
}

