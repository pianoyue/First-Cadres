<?php


namespace App\Http\Controllers\Cadre;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\StoreCadre;
use App\Models\Cadre;
use Illuminate\Http\Request;



class IndexController extends Controller
{
    /**
     * 显示干部信息视图页面
     **/
    public function showInfo()
    {
        return view('cadre.info');
    }

    /**
     * 显示修改干部信息视图页面
     **/
    public function showEditInfo()
    {
        return view('cadre.editInfo');
    }

    /**
     * 显示评论视图页面
     **/
    public function showComment()
    {
        $comment=Comment::paginate(15);
        return View('cadre.myComment',[
            'comments' =>$comment,
            'pagination' => $comment->links('pagination.default')
        ]);
    }


    /**
     * 编辑干部信息页面
     **/

    public function editInfo(Request $request)           //编辑信息
    {
        $request = $request->all();
        $cadre=Cadre::find($request['id']);

        $string = $request['Region'];
        $array=explode('/',$string);    //将传过来的区域以'/'进行分割



        $birthday=$request['birth'];                     //自动计算年龄
        $date=date("Y-m-d");                      //取当前时间
        list($y,$m,$d)=explode("-",$birthday);  // 按“-”分割生日的日期
        list($xy,$xm,$xd)=explode("-", $date);  // 按“-”分割当前的日期

         $age=$xy-$y;  //当前年份减去客人出生年份
         if($xm>$m || $xm==$m&&$xd>$d) //判断月份和日期，如果当前日期大于客人出生       日期，年龄加一
         {
             $age=$age+1;
         }

        $cadre->cadre_trueName=$request['cadre_trueName'];
        $cadre->cadre_gender=$request['cadre_gender'];
        $cadre->political_status=$request['political_status'];
        $cadre->cadreRegion_c=$array[0];
        $cadre->cadreRegion_t=$array[1];
        $cadre->cadreRegion_v=$array[2];
        $cadre->startTime=$request['startTime'];
        $cadre->endTime=$request['endTime'];
        $cadre->cadre_phone=$request['cadre_phone'];
        $cadre->birth=$request['birth'];
        $cadre->age=$age;
        $cadre->education=$request['education'];
        $cadre->company=$request['company'];
        $cadre->job=$request['job'];
        $cadre->address=$request['address'];
        $cadre->identity=$request['identity'];
        $cadre->secretary=$request['secretary'];
        $cadre->origin=$request['origin'];

        $cadre->save();

        return redirect('/cadre/info');
    }


}







