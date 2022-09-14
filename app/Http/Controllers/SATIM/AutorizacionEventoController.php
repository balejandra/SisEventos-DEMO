<?php

namespace App\Http\Controllers\SATIM;

use App\Http\Controllers\Controller;
use App\Http\Requests\SATIM\CreateAutorizacionEventoRequest;
use App\Http\Requests\SATIM\UpdateAutorizacionEventoRequest;
use App\Repositories\SATIM\AutorizacionEventoRepository;
use Illuminate\Http\Request;

class AutorizacionEventoController extends Controller{

    /** @var AutorizacionEventoRepository */
    private $autorizacionEventoRepository;

    public function __construct(AutorizacionEventoRepository $autorizacionEventoRepo)
    {
        $this->autorizacionEventoRepository = $autorizacionEventoRepo;
    }

    /**
     * Display a listing of the AutorizacionEvento.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $autorizacionEventos = $this->autorizacionEventoRepository->all();

        return view('autorizacion_eventos.index')
            ->with('autorizacionEventos', $autorizacionEventos);
    }

    /**
     * Show the form for creating a new AutorizacionEvento.
     *
     * @return Response
     */
    public function create()
    {
        return view('autorizacion_eventos.create');
    }

    /**
     * Store a newly created AutorizacionEvento in storage.
     *
     * @param CreateAutorizacionEventoRequest $request
     *
     * @return Response
     */
    public function store(CreateAutorizacionEventoRequest $request)
    {
        $input = $request->all();

        $autorizacionEvento = $this->autorizacionEventoRepository->create($input);

        Flash::success('Autorizacion Evento saved successfully.');

        return redirect(route('autorizacionEventos.index'));
    }

    /**
     * Display the specified AutorizacionEvento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $autorizacionEvento = $this->autorizacionEventoRepository->find($id);

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('autorizacionEventos.index'));
        }

        return view('autorizacion_eventos.show')->with('autorizacionEvento', $autorizacionEvento);
    }

    /**
     * Show the form for editing the specified AutorizacionEvento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $autorizacionEvento = $this->autorizacionEventoRepository->find($id);

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('autorizacionEventos.index'));
        }

        return view('autorizacion_eventos.edit')->with('autorizacionEvento', $autorizacionEvento);
    }

    /**
     * Update the specified AutorizacionEvento in storage.
     *
     * @param int $id
     * @param UpdateAutorizacionEventoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAutorizacionEventoRequest $request)
    {
        $autorizacionEvento = $this->autorizacionEventoRepository->find($id);

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('autorizacionEventos.index'));
        }

        $autorizacionEvento = $this->autorizacionEventoRepository->update($request->all(), $id);

        Flash::success('Autorizacion Evento updated successfully.');

        return redirect(route('autorizacionEventos.index'));
    }

    /**
     * Remove the specified AutorizacionEvento from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $autorizacionEvento = $this->autorizacionEventoRepository->find($id);

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('autorizacionEventos.index'));
        }

        $this->autorizacionEventoRepository->delete($id);

        Flash::success('Autorizacion Evento deleted successfully.');

        return redirect(route('autorizacionEventos.index'));
    }
}
