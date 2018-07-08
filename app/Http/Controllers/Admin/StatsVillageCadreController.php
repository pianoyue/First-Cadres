<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCadre;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class StatsVillageCadreController extends BaseController
{
    public function index()                              //驻村名册
    {

        return View('admin.statistics.stats_villagecadre_index');
    }

    public function search(Request $request){

        $request = $request->all();
        if($request['search']==1){
            $region='南宁市';
        }
        else if($request['search']==2){
            $region='柳州市';
        }
        else if($request['search']==3){
            $region='桂林市';
        }
        else if($request['search']==4){
            $region='梧州市';
        }
        else if($request['search']==5){
            $region='北海市';
        }
        else if($request['search']==6){
            $region='防城港市';
        }
        else if($request['search']==7){
            $region='钦州市';
        }
        else if($request['search']==8){
            $region='贵港市';
        }
        else if($request['search']==9){
            $region='玉林市';
        }
        else if($request['search']==10){
            $region='百色市';
        }
        else if($request['search']==11){
            $region='贺州市';
        }
        else if($request['search']==12){
            $region='河池市';
        }
        else if($request['search']==13){
            $region='来宾市';
        }
        else
            $region='崇左市';


        if($request['search_time']!=null){    //驻村时间条件已填写
            if($request['search']==0){        //广西
                $cadre=Cadre::where('startTime','!=',null)->where('startTime','>=',$request['search_time'])->paginate(15);
            }
            else                               //其他市
                $cadre=Cadre::where('startTime','!=',null)->where('cadreRegion_c','=',$region)->where('startTime','>=',$request['search_time'])->paginate(15);
        }
        else{                                  //驻村时间条件未填写
            if($request['search']==0){
                $cadre=Cadre::where('startTime','!=',null)->paginate(15);

            }
            else
                $cadre=Cadre::where('startTime','!=',null)->where('cadreRegion_c','=',$region)->paginate(15);
            }


        return View('admin.statistics.stats_villagecadre', [
            'cadres' => $cadre,
            'pagination' => $cadre->links('pagination.default')]);
    }

}


