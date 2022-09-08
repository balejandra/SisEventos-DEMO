<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Models\SATIM\Status;
use Illuminate\Http\Request;
use Flash;
use Response;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:listar-status', ['only'=>['index'] ]);
        $this->middleware('permission:crear-status', ['only'=>['create','store']]);
        $this->middleware('permission:editar-status', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-status', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-status', ['only'=>['destroy'] ]);
    }
    /**
     * Display a listing of the Status.
     *
     *
     * @return Response
     */
    public function index()
    {
        $statuses = Status::all();

        return view('zarpes.status.index')
            ->with('statuses', $statuses);
    }

    /**
     * Show the form for creating a new Status.
     *
     * @return Response
     */
    public function create()
    {
        return view('zarpes.status.create');
    }

    /**
     * Store a newly created Status in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255'
        ]);
        $input = $request->all();

        $status = Status::create($input);

        Flash::success('Status guardado satisfactoriamente.');

        return redirect(route('status.index'));
    }

    /**
     * Display the specified Status.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $status = Status::find($id);

        if (empty($status)) {
            Flash::error('Status no encontrado');

            return redirect(route('status.index'));
        }

        return view('zarpes.status.show')->with('status', $status);
    }

    /**
     * Show the form for editing the specified Status.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $status = Status::find($id);

        if (empty($status)) {
            Flash::error('Status no encontrado');

            return redirect(route('status.index'));
        }

        return view('zarpes.status.edit')->with('status', $status);
    }

    /**
     * Update the specified Status in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255'
        ]);
        $status = Status::find($id);

        if (empty($status)) {
            Flash::error('Status no encontrado');

            return redirect(route('status.index'));
        }

        $status->nombre=$request->input('nombre');
        $status->save();

        Flash::success('Status actualizado satisfactoriamente.');

        return redirect(route('status.index'));
    }

    /**
     * Remove the specified Status from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);

        if (empty($status)) {
            Flash::error('Status no encontrado');

            return redirect(route('status.index'));
        }

        $status->delete($id);

        Flash::success('Status eliminado satisfactoriamente.');

        return redirect(route('status.index'));
    }
}
