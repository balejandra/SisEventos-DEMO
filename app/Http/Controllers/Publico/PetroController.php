<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publico\CreatePetroRequest;
use App\Http\Requests\Publico\UpdatePetroRequest;
use App\Repositories\Publico\PetroRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class PetroController extends Controller
{
    /** @var  PetroRepository */
    private $petroRepository;

    public function __construct(PetroRepository $petroRepo)
    {
        $this->petroRepository = $petroRepo;
    }

    /**
     * Display a listing of the Petro.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $petros = $this->petroRepository->all();

        return view('publico.petros.index')
            ->with('petros', $petros);
    }

    /**
     * Show the form for creating a new Petro.
     *
     * @return Response
     */
    public function create()
    {
        return view('publico.petros.create');
    }

    /**
     * Store a newly created Petro in storage.
     *
     * @param CreatePetroRequest $request
     *
     * @return Response
     */
    public function store(CreatePetroRequest $request)
    {
        $input = $request->all();

        $petro = $this->petroRepository->create($input);

        Flash::success('Petro guardada satisfactoriamente.');

        return redirect(route('petros.index'));
    }

    /**
     * Display the specified Petro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $petro = $this->petroRepository->find($id);

        if (empty($petro)) {
            Flash::error('Petro no encontrada');

            return redirect(route('petros.index'));
        }

        return view('publico.petros.show')->with('petro', $petro);
    }

    /**
     * Show the form for editing the specified Petro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $petro = $this->petroRepository->find($id);

        if (empty($petro)) {
            Flash::error('Petro no encontrada');

            return redirect(route('petros.index'));
        }

        return view('publico.petros.edit')->with('petro', $petro);
    }

    /**
     * Update the specified Petro in storage.
     *
     * @param int $id
     * @param UpdatePetroRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetroRequest $request)
    {
        $petro = $this->petroRepository->find($id);

        if (empty($petro)) {
            Flash::error('Petro no encontrada');

            return redirect(route('petros.index'));
        }

        $petro = $this->petroRepository->update($request->all(), $id);

        Flash::success('Petro actualizada satisfactoriamente.');

        return redirect(route('petros.index'));
    }

    /**
     * Remove the specified Petro from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $petro = $this->petroRepository->find($id);

        if (empty($petro)) {
            Flash::error('Petro no encontrada');

            return redirect(route('petros.index'));
        }

        $this->petroRepository->delete($id);

        Flash::success('Petro eliminada satisfactoriamente.');

        return redirect(route('petros.index'));
    }
}
