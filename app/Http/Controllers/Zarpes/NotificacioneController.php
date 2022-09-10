<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SATIM\Notificacion;

class NotificacioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:listar-notificaciones', ['only'=>['index'] ]);
        $this->middleware('permission:consultar-notificaciones', ['only'=>['show'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $userid = auth()->id();
        $notificacionesNacional = Notificacion::where('user_id', $userid)->where('tipo', 'Zarpe Nacional')->get();
        $notificacionesInternacional = Notificacion::where('user_id', $userid)->where('tipo', 'Zarpe Internacional')->get();
        $notificacionesEstadia = Notificacion::where('user_id', $userid)->where('tipo', 'Permiso de Estadía')->get();
        $notificacionGeneral = Notificacion::where('user_id', $userid)->where('tipo', 'General')->get();


        $this->statusNotificaciones();
        return view('zarpes/notificaciones/index')
        ->with('notificacionesNacional', $notificacionesNacional)
        ->with('notificacionesInternacional', $notificacionesInternacional)
        ->with('notificacionesEstadia', $notificacionesEstadia)
        ->with('ng', $notificacionGeneral);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNotificaciones($userID, $titulo, $texto, $tipo)
    {
        $notificacion= new Notificacion;
        $notificacion->user_id=$userID;
        $notificacion->titulo=$titulo;
        $notificacion->texto=$texto;
        $notificacion->tipo=$tipo;
        $notificacion->visto=false;
        $resp=$notificacion->save();
        $this->statusNotificaciones();
        return $resp;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->statusNotificaciones();

        $userid = auth()->id();
        $notificacion = Notificacion::where('user_id', $userid)->where('id', $id)->get();
        if (empty($notificacion)) {
            Flash::error('Notificacion no encontrado');
            return redirect(route('notificaciones.index'));
        }else if($notificacion[0]->visto==false){
            $notificacion[0]->visto = true;
            $notificacion[0]->save();
        }
        return view('zarpes/notificaciones/show')
        ->with('notificacion', $notificacion[0]);
    }

    public function statusNotificaciones()
    {
        $userid = auth()->id();
        $notificaciones = Notificacion::where('user_id', $userid)->where('visto', false)->get();
        if(count($notificaciones)>0){
            session(['notificaciones' => count($notificaciones)]);
        }else{
            session(['notificaciones' =>0]);
        }
    }


}
