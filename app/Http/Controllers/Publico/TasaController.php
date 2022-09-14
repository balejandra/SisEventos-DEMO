<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publico\CreateTasaRequest;
use App\Http\Requests\Publico\UpdateTasaRequest;
use App\Repositories\Publico\TasaRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class TasaController extends Controller
{
    /** @var  TasaRepository */
    private $tasaRepository;

    public function __construct(TasaRepository $tasaRepo)
    {
        $this->tasaRepository = $tasaRepo;
        $this->middleware('permission:listar-tasas', ['only'=>['index'] ]);
        $this->middleware('permission:crear-tasas', ['only'=>['create','store']]);
        $this->middleware('permission:editar-tasas', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-tasas', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-tasas', ['only'=>['destroy'] ]);
    }

    /**
     * Display a listing of the Tasa.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tasas = $this->tasaRepository->all();

        return view('publico.tasas.index')
            ->with('tasas', $tasas);
    }

    /**
     * Show the form for creating a new Tasa.
     *
     * @return Response
     */
    public function create()
    {
        return view('publico.tasas.create');
    }

    /**
     * Store a newly created Tasa in storage.
     *
     * @param CreateTasaRequest $request
     *
     * @return Response
     */
    public function store(CreateTasaRequest $request)
    {
        $input = $request->all();

        $tasa = $this->tasaRepository->create($input);

        Flash::success('Tasa saved successfully.');

        return redirect(route('tasas.index'));
    }

    /**
     * Display the specified Tasa.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tasa = $this->tasaRepository->find($id);

        if (empty($tasa)) {
            Flash::error('Tasa not found');

            return redirect(route('tasas.index'));
        }

        return view('publico.tasas.show')->with('tasa', $tasa);
    }

    /**
     * Show the form for editing the specified Tasa.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tasa = $this->tasaRepository->find($id);

        if (empty($tasa)) {
            Flash::error('Tasa not found');

            return redirect(route('tasas.index'));
        }

        return view('publico.tasas.edit')->with('tasa', $tasa);
    }

    /**
     * Update the specified Tasa in storage.
     *
     * @param int $id
     * @param UpdateTasaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTasaRequest $request)
    {
        $tasa = $this->tasaRepository->find($id);

        if (empty($tasa)) {
            Flash::error('Tasa not found');

            return redirect(route('tasas.index'));
        }

        $tasa = $this->tasaRepository->update($request->all(), $id);

        Flash::success('Tasa updated successfully.');

        return redirect(route('tasas.index'));
    }

    /**
     * Remove the specified Tasa from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tasa = $this->tasaRepository->find($id);

        if (empty($tasa)) {
            Flash::error('Tasa not found');

            return redirect(route('tasas.index'));
        }

        $this->tasaRepository->delete($id);

        Flash::success('Tasa deleted successfully.');

        return redirect(route('tasas.index'));
    }
}
