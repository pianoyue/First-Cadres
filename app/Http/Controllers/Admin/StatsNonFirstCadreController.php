<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCadre;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class StatsNonFirstCadreController extends BaseController
{
    public function index()                              //驻村(不含第一书记)名册
    {
        $result=array();

        //总人数
        $result[0]=Cadre::where( 'secretary',0)->count();
        //男
        $result[1]=Cadre::where( 'secretary',0)->where('cadre_gender',0)->count();
        //女
        $result[2]=Cadre::where( 'secretary',0)->where('cadre_gender',1)->count();
        //党员
        $result[3]=Cadre::where( 'secretary',0)->where('political_status',0)->count();
        //中直
        $result[4]=Cadre::where( 'secretary',0)->where('origin',0)->count();
        //省直
        $result[5]=Cadre::where( 'secretary',0)->where('origin',1)->count();
        //市直
        $result[6]=Cadre::where( 'secretary',0)->where('origin',2)->count();
        //县直
        $result[7]=Cadre::where( 'secretary',0)->where('origin',3)->count();
        //厅级
        $result[8]=Cadre::where( 'secretary',0)->where('job', 0)->count();
        //处级
        $result[9]=Cadre::where(function ($query) {
                            $query->where('secretary', 0)->where('job', 1);
                        })->orWhere(function ($query){
                            $query->where('secretary',0)->where('job', 2);
                        })->count();
        //科级
        $result[10]=Cadre::where( 'secretary',0)->where('job', 3)->count();
        //一般干部
        $result[11]=Cadre::where( 'secretary',0)->where('job', 4)->count();
        //博士
        $result[12]=Cadre::where( 'secretary',0)->where('education', 0)->count();
        //硕士
        $result[13]=Cadre::where( 'secretary',0)->where('education', 1)->count();
        //本科
        $result[14]=Cadre::where( 'secretary',0)->where('education', 2)->count();
        //中专
        $result[15]=Cadre::where( 'secretary',0)->where('education', 3)->count();
        //中专及以下
        $result[16]=Cadre::where( 'secretary',0)->where('education', 4)->count();
        //<35
        $result[17]=Cadre::where( 'secretary',0)->where('age','<',35)->count();
        //35-45
        $result[18]=Cadre::where( 'secretary',0)->where('age','>',35)->where('age','<',45)->count();
        //45-60
        $result[19]=Cadre::where( 'secretary',0)->where('age','>',45)->where('age','<',60)->count();

        return View('admin.statistics.stats_nonfirstcadre', [
            'result' => $result]);
    }

}


