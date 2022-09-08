<?php

namespace App\Http\Controllers\Publico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Flash;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('permission:listar-rol', ['only'=>['index'] ]);
        $this->middleware('permission:crear-rol', ['only'=>['create','store']]);
        $this->middleware('permission:editar-rol', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-rol', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-rol', ['only'=>['destroy'] ]);

    }

   public function index()
    {
        $roles= Role::all();
        return view('publico.roles.index', compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all()->pluck('name','id');
        //dd($permissions);
        return view('publico.roles.create', compact('permissions'));

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
            'name' => 'required|unique:roles|max:255',
            'permissions'=>'required'
        ],
            [
                'name.unique'=>'Rol ya registrado',
                'permissions.required'=>'Es obligatorio asignar permisos al Rol'

            ]
    );

        $role= Role::create($request->only('name'));
        $role->permissions()->sync($request->input('permissions', [] ));
        return redirect()->route('roles')->with('success','Rol creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role=Role::find($id);
        return view('publico.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions=Permission::all()->pluck('name','id');
        $role->load('permissions');
        //dd($role);
        return view('publico.roles.edit',compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $validated = $request->validate([
            'name' =>  ['required', 'max:255', Rule::unique('roles')->ignore($role['id'])],
            'permissions'=>'required'
        ],
            [
                'name.unique'=>'Rol ya registrado',
                'permissions.required'=>'Es obligatorio asignar permisos al Rol'

            ]
        );

        $role->update($request->only('name'));
        $role->permissions()->sync($request->input('permissions', [] ));

       /*$role=Role::findOrFail($id);
        $role->name=$request->input('name');
        $role->save();*/
        return redirect()->route('roles')->with('success','Información actualizada con exito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::findOrFail($id);
        $role->delete();
        return back()->with('success','El registro se ha eliminado con éxito.');
    }

    public function indexRoleDeleted(){
        $role =Role::onlyTrashed()->get();
        //dd($users);

        return view('publico.roles.rolesDeleted')
            ->with('roles', $role);
    }

    public function restoreRoleDeleted($id){
        $role_deleted=Role::where('id',$id);
        $role_deleted->restore();
        Flash::success('Rol restaurado exitosamente.');

        return redirect(route('roleDelete.index'));
    }
}
