<?php

namespace App\Http\Controllers\Publico;

use App\Http\Requests\Publico\CreateMenu_rolRequest;
use App\Http\Requests\Publico\UpdateMenu_rolRequest;
use App\Repositories\Publico\Menu_rolRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;
use App\Models\Publico\Menu;
use App\Models\Publico\Menu_rol;

class Menu_rolController extends AppBaseController
{
    /** @var  Menu_rolRepository */
    private $menuRolRepository;
    private $titulo="Menús";
    public function __construct(Menu_rolRepository $menuRolRepo)
    {
        $this->menuRolRepository = $menuRolRepo;
    }

    /**
     * Display a listing of the Menu_rol.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        

        $menuRols = DB::table('menus_roles')
            ->select('menus_roles.*','menus.name as name_menu', 'roles.name as name_role')
            ->Join('menus', 'menus.id', '=', 'menus_roles.menu_id')
            ->Join('roles', 'roles.id', '=', 'menus_roles.role_id')
            ->orderBy('name_menu','ASC')
            ->get();
        
        $count=Menu::select(DB::raw('count(menus.name) as rowspan'), 'menus.name')
        ->Join('menus_roles', 'menus.id', '=', 'menus_roles.menu_id')
        ->groupBy('menus.name')
        ->orderBy('name','ASC')
        ->get();

        $datos=[];
        foreach ($count as $value) {
            $datos[$value->name]=$value->rowspan;
        }

        return view('publico.menus.tableroles')
        ->with('menuRols', $menuRols)
        ->with('rowspan', $datos)
        ->with('count', $count)->with('titulo', $this->titulo);

    }

    /**
     * Show the form for creating a new Menu_rol.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created Menu_rol in storage.
     *
     * @param CreateMenu_rolRequest $request
     *
     * @return Response
     */
    public function store(CreateMenu_rolRequest $request)
    {

    }

    /**
     * Display the specified Menu_rol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified Menu_rol.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified Menu_rol in storage.
     *
     * @param int $id
     * @param UpdateMenu_rolRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMenu_rolRequest $request)
    {

    }

    /**
     * Remove the specified Menu_rol from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {

    }
}
