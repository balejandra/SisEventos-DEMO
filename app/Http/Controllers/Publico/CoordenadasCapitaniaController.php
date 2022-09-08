<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publico\CoordenadasCapitania;


class CoordenadasCapitaniaController extends Controller
{

    //ELIMINAR COORDENADAS
    public function destroy($id)
    {
        $coord=CoordenadasCapitania::find($id);
        $coord->delete($id);
        return redirect(route('capitanias.index'))->with('success','Coordenada eliminada con éxito.'); ;

    }

}
