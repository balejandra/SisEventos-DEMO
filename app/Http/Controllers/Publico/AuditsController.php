<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:listar-auditoria', ['only'=>['index'] ]);
        $this->middleware('permission:consultar-auditoria', ['only'=>['show'] ]);
    }

    /**
     * Display a listing of the Auditable.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->hasPermissionTo('listar-auditoria')) {
            $auditables =Audit::all();

            return view('publico.audits.index')
                ->with('auditables', $auditables);
        }else{
            return view('unauthorized');
        }

    }

    /**
     * Display the specified Auditable.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $auditable = Audit::find($id);

        if (empty($auditable)) {
           // Flash::error('Auditable not found');

            return redirect(route('auditables.index'))->with('danger','Auditable not found');
        }

        return view('publico.audits.show')->with('auditable', $auditable);
    }
}
