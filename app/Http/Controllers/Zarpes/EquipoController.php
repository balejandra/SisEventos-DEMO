<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Models\SATIM\Equipo;
use Illuminate\Http\Request;
use Flash;
use Response;

class EquipoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:listar-equipo', ['only'=>['index'] ]);
        $this->middleware('permission:crear-equipo', ['only'=>['create','store']]);
        $this->middleware('permission:editar-equipo', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-equipo', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-equipo', ['only'=>['destroy'] ]);
    }
    /**
     * Display a listing of the Equipo.
     *
     *
     * @return Response
     */
    public function index()
    {
        $equipos = Equipo::all();

        return view('zarpes.equipos.index')
            ->with('equipos', $equipos);
    }

    /**
     * Show the form for creating a new Equipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('zarpes.equipos.create');
    }

    /**
     * Store a newly created Equipo in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipo' => 'required|max:255'
        ]);
        $cantidad=false;
        if ($request->cantidad) {
           $cantidad=true;
        }else {
            $cantidad=false;
        }
        if ($request->otros==null) {
            $request->otros='ninguno';
        }
        $equipo=new Equipo();
        $equipo->equipo = $request->equipo;
        $equipo->cantidad = $cantidad;
        $equipo->otros = $request->otros;
        $equipo->save();

        Flash::success('Equipo guardado satisfactoriamente.');

        return redirect(route('equipos.index'));
    }

    /**
     * Display the specified Equipo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $equipo = Equipo::find($id);

        if (empty($equipo)) {
            Flash::error('Equipo no encontrado');

            return redirect(route('equipos.index'));
        }

        return view('zarpes.equipos.show')->with('equipo', $equipo);
    }

    /**
     * Show the form for editing the specified Equipo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $equipo = Equipo::find($id);

        if (empty($equipo)) {
            Flash::error('Equipo no encontrado');

            return redirect(route('equipos.index'));
        }

        return view('zarpes.equipos.edit')->with('equipo', $equipo);
    }

    /**
     * Update the specified Equipo in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $equipo = Equipo::find($id);

        if (empty($equipo)) {
            Flash::error('Equipo no encontrado');

            return redirect(route('equipos.index'));
        }
        //dd($request);
        $validated = $request->validate([
            'equipo' => 'required|max:255'
        ]);
        $cantidad=false;
        if ($request->cantidad) {
            $cantidad=true;
        }else {
            $cantidad=false;
        }
        if ($request->otros==null) {
            $request->otros='ninguno';
        }
        $equipo->equipo = $request->equipo;
        $equipo->cantidad = $cantidad;
        $equipo->otros = $request->otros;
        $equipo->save();


        Flash::success('Equipo actualizado satisfactoriamente.');

        return redirect(route('equipos.index'));
    }

    /**
     * Remove the specified Equipo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $equipo = Equipo::find($id);

        if (empty($equipo)) {
            Flash::error('Equipo no encontrado');

            return redirect(route('equipos.index'));
        }

        $equipo->delete($id);

        Flash::success('Equipo eliminado satisfactoriamente.');

        return redirect(route('equipos.index'));
    }
}
