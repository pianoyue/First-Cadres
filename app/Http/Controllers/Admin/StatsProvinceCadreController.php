<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCadre;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class StatsProvinceCadreController extends BaseController
{
    public function index()                              //省直驻村干部统计表
    {

        $cadre = Cadre::where('origin', '=',1)->where('startTime','!=',null)->paginate(15);



        return View('admin.statistics.stats_provincecadre', [
            'cadres' => $cadre,
            'pagination' => $cadre->links('pagination.default')]);
    }

    public function search(Request $request){        //根据姓名搜索省直驻村干部

        $request = $request->all();
        $cadre = Cadre::where('origin', '=',1)->where('startTime','!=',null)->where('cadre_trueName','=',$request['search_name'])->paginate(15);


        return View('admin.statistics.stats_provincecadre', [
            'cadres' => $cadre,
            'pagination' => $cadre->links('pagination.default')]);
    }

}







