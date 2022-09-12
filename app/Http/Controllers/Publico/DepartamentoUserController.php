<?php

namespace App\Http\Controllers\Publico;

use App\Http\Requests\Publico\UpdateCapitaniaUserRequest;
use App\Models\Publico\Departamento;
use App\Models\Publico\DepartamentoUser;
use App\Models\User;
use App\Models\SATIM\EstablecimientoNautico;
use App\Repositories\Publico\DepartamentoUserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Role;

class DepartamentoUserController extends AppBaseController
{
    /** @var  DepartamentoUserRepository */
    private $departamentoUserRepository;

    public function __construct(DepartamentoUserRepository $departamentoUserRepo)
    {
        $this->departamentoUserRepository = $departamentoUserRepo;
        $this->middleware('permission:listar-usuarios-departamentos', ['only' => ['index']]);
        $this->middleware('permission:crear-usuarios-departamentos', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-usuarios-departamentos', ['only' => ['edit', 'update']]);
        $this->middleware('permission:consultar-usuarios-departamentos', ['only' => ['show']]);
        $this->middleware('permission:eliminar-usuarios-departamentos', ['only' => ['destroy']]);

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
        $capitaniaUsers = $this->departamentoUserRepository->all();

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
        return view('publico.capitania_users.create')
            // ->with('users',$user2)
            ->with('capitania', $capitanias)
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
            $validated = $request->validate([
                'cargo_id' => 'required|string',
                'user_id' => 'required|string',
                'departamento_id' => 'required'
                ]);

                $input = $request->all();

                $capitaniaUser = $this->departamentoUserRepository->create($input);

                Flash::success('Usuario de Departamentos guardado satisfactoriamente.');

                return redirect(route('capitaniaUsers.index'));

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
        $capitaniaUser = $this->departamentoUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Usuario de departamento no encontrado');

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
        $capitaniaUser = $this->departamentoUserRepository->find($id);
        $capitanias = Departamento::pluck('nombre', 'id');
        $roles = Role::pluck('name', 'id');

        if (empty($capitaniaUser)) {
            Flash::error('Usuario de departamento no encontrado');

            return redirect(route('capitaniaUsers.index'));
        }

        return view('publico.capitania_users.edit')
            ->with('capitaniaUser', $capitaniaUser)
            ->with('capitania', $capitanias)
            ->with('roles', $roles);
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
            'cargo_id' => 'required|string',
            'user_id' => 'required|string',
            'departamento_id' => 'required',
            'habilitado'=>'required'
        ]);
        $capitaniaUser = $this->departamentoUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Usuario de departamento no encontrado');

            return redirect(route('capitaniaUsers.index'));
        }

                $capitaniaUser = $this->departamentoUserRepository->update($request->all(), $id);
                Flash::success('Usuario de departamento guardado satisfactoriamente.');
                return redirect(route('capitaniaUsers.index'));

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
        $capitaniaUser = $this->departamentoUserRepository->find($id);

        if (empty($capitaniaUser)) {
            Flash::error('Usuario de departamento no encontrado');

            return redirect(route('capitaniaUsers.index'));
        }

        $this->departamentoUserRepository->delete($id);

        Flash::success('Usuario de departamento eliminado satisfactoriamente.');

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

