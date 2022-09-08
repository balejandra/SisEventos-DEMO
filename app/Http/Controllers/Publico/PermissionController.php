<?php

namespace App\Http\Controllers\Publico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Flash;


class PermissionController extends Controller
{

     public function __construct()
    {

        $this->middleware('permission:listar-permiso', ['only'=>['index'] ]);
        $this->middleware('permission:crear-permiso', ['only'=>['create','store']]);
        $this->middleware('permission:editar-permiso', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-permiso', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-permiso', ['only'=>['destroy'] ]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('id', 'DESC')->get();

        return view('publico.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('publico.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ],
            [
                'name.unique'=>'Permiso ya registrado',
                'name.required'=>'El campo Nombre es obligatorio',
            ]
        );

        ($permission=new Permission($request->input()))->saveOrFail();

         return redirect()->route('permissions')->with('success','Permiso creado con exito.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('publico.permissions.edit',compact('permission'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validated = $request->validate([
        'name' =>  ['required', 'max:255', Rule::unique('permissions')->ignore($id)],
    ],
        [
            'name.required'=>'El campo Nombre es obligatorio',

        ]
    );

        $permission=Permission::findOrFail($id);
        $permission->name=$request->input('name');
        $permission->save();
        return redirect()->route('permissions')->with('success','Información actualizada con exito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission=Permission::findOrFail($id);
        $permission->delete();
        return back()->with('success','El registro se ha eliminado con éxito.');
    }

    public function indexPermissionDeleted(){
        $permission =Permission::onlyTrashed()->get();
        //dd($users);

        return view('publico.permissions.permission_delete')
            ->with('permissions', $permission);
    }

    public function restorePermissionDeleted($id){
        $permission_deleted=Permission::where('id',$id);
        $permission_deleted->restore();
        Flash::success('Permiso restaurado exitosamente.');

        return redirect(route('permissionDelete.index'));
    }
}
