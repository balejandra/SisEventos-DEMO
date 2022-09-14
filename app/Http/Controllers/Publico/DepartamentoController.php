<?php

namespace App\Http\Controllers\Publico;


use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Publico\CreateDepartamentoRequest;
use App\Http\Requests\Publico\UpdateCapitaniaRequest;
use App\Models\Publico\Departamento;
use App\Models\Publico\DepartamentoUser;
use App\Models\User;
use App\Repositories\Publico\DepartamentoRepository;
use Illuminate\Http\Request;
use App\Models\Publico\CoordenadasCapitania;
use Flash;
use Response;
use Spatie\Permission\Models\Role;

class DepartamentoController extends AppBaseController
{
    /** @var  DepartamentoRepository */
    private $departamentoRepository;

    public function __construct(DepartamentoRepository $departamentoRepo)
    {
        $this->departamentoRepository = $departamentoRepo;

        $this->middleware('permission:listar-departamento', ['only'=>['index'] ]);
        $this->middleware('permission:crear-departamento', ['only'=>['create','store']]);
        $this->middleware('permission:editar-departamento', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-departamento', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-departamento', ['only'=>['destroy'] ]);
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
        $capitanias = $this->departamentoRepository->all();

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

        return view('publico.capitanias.create');
    }

    /**
     * Store a newly created Capitania in storage.
     *
     * @param CreateDepartamentoRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartamentoRequest $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'sigla' => 'required|string',

        ],

            [
                'nombre.required' => 'El campo Nombre es obligatorio',
                'sigla.required' => 'El campo Sigla es obligatorio',


            ]
        );

        $input = $request->all();

        $departamento = $this->departamentoRepository->create($input);

        Flash::success('Departamento guardado con éxito.');
        return redirect(route('capitanias.index'));
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
        $capitania = $this->departamentoRepository->find($id);

        if (empty($capitania)) {
            Flash::error('Departamento no encontrada');

            return redirect(route('capitanias.index'));
        }

        return view('publico.capitanias.show')
            ->with('capitania', $capitania);
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
        $capitania = $this->departamentoRepository->find($id);

        if (empty($capitania)) {
            Flash::error('Departamento no encontrada');

            return redirect(route('capitanias.index'));
        }

        return view('publico.capitanias.edit')
            ->with('capitania', $capitania);
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
        ],

            [
                'nombre.required' => 'El campo Nombre es obligatorio',
                'sigla.required' => 'El campo Sigla es obligatorio',

            ]);
        $petro = $this->departamentoRepository->find($id);

        if (empty($petro)) {
            Flash::error('Departamento no encontrado');

            return redirect(route('capitanias.index'));
        }

        $petro = $this->departamentoRepository->update($request->all(), $id);
        Flash::success('Departamento modificada con éxito.');
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
        $capitania = $this->departamentoRepository->find($id);

        if (empty($capitania)) {
           Flash::error('Departamento no encontrada');

            return redirect(route('capitanias.index'));
        }

        $this->departamentoRepository->delete($id);
        Flash::success('Departamento eliminada con éxito.');

        return redirect(route('capitanias.index'));
    }
}
