<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCadre;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;


class CadreController extends BaseController
{
    public function index()
    {
        $cadre = Cadre::paginate(15);
        return View('admin.cadre.cadre_index', [
            'cadres' => $cadre,
            'pagination' => $cadre->links('pagination.default')]);
    }

    public function store(Request $request)           //添加管理员
    {
        $request = $request->all();
        $string = $request['Region'];
        $array=explode('/',$string);    //将传过来的区域以'/'进行分割


        $birthday=$request['birth'];                     //自动计算年龄
        $date=date("Y-m-d");                      //取当前时间
        list($y,$m,$d)=explode("-",$birthday);  // 按“-”分割生日的日期
        list($xy,$xm,$xd)=explode("-", $date);  // 按“-”分割当前的日期

        $age=$xy-$y;  //当前年份减去客人出生年份
        if($xm>$m || $xm==$m&&$xd>$d) //判断月份和日期，如果当前日期大于客人出生日期，年龄加一
        {
            $age=$age+1;
        }

        try{
            $cadre = $this->create($request,$array,$age);
            return $cadre ? redirect('/cadre') :$cadre ;
        }catch (QueryException $exception) {
            abort(403, '包含重名标签名'.$exception);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    private function create(array $data,array $array,$age)
    {

        return Cadre::create([
            'cadre_name' => $data['cadre_phone'],
            'cadre_trueName' => $data['cadre_trueName'],
            'cadre_phone' => $data['cadre_phone'],
            'cadre_gender' => $data['cadre_gender'],
            'political_status' =>$data['political_status'],
            'cadreRegion_c' =>$array[0],
            'cadreRegion_v' =>$array[1],
            'cadreRegion_t' =>$array[2],
            'startTime' =>$data['startTime'],
            'endTime' =>$data['endTime'],
            'password' => bcrypt($data['cadre_phone']),
            'birth' =>$data['birth'],
            'age'=>$age,
            'education'=>$data['education'],
            'company'=>$data['company'],
            'job'=>$data['job'],
            'address'=>$data['address'],
            'identity'=>$data['identity'],
            'secretary'=>$data['secretary'],
            'origin' =>$data['origin']
        ]);
    }

    public function delete(Request $request)         //删除
    {
        $request = $request->all();
        $cadre = Cadre::destroy($request['id']);
        return $cadre;
    }

    public function edit(Request $request)           //编辑信息
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

        return redirect('/cadre');

    }

    public function editStatus(Request $request)           //编辑审核状态
    {
        $request = $request->all();
        $cadre=Cadre::find($request['id']);

            $cadre->status=$request['status'];
            $cadre->save();

            return $cadre;
    }

    public function search(Request $request){      //搜索功能
        $request = $request->all();

        if($request['search_name']==null) {
            if ($request['search_region_c'] == null) {
                if ($request['search_status'] == null) {
                    $cadre = Cadre::paginate(15);
                } else
                    $cadre = Cadre::where('status', $request['search_status'])->paginate(15);
            }
            else if($request['search_status']==null){
                $cadre = Cadre::where('cadreRegion_c', $request['search_region_c'])->paginate(15);
            }
            else
                $cadre = Cadre::where([ 'cadreRegion_c'=>$request['search_region_c'] , 'status'=>$request['search_status']])->paginate(15);
        }
        else if($request['search_region_c']==null){
            if($request['search_status']==null){
                $cadre = Cadre::where('cadre_trueName', $request['search_name'])->paginate(15);
            }else
                $cadre = Cadre::where([ 'cadre_trueName'=>$request['search_name'] , 'status'=>$request['search_status']])->paginate(15);
        }
        else {
            if (($request['search_status'] == null)) {
                $cadre = Cadre::where(['cadre_trueName' => $request['search_name'], 'cadreRegion_c' => $request['search_region_c']])->paginate(15);
            }
            else{
                $cadre = Cadre::where(['cadre_trueName'=>$request['search_name'],'cadreRegion_c'=>$request['search_region_c'],
                    'status'=>$request['search_status']])->paginate(15);
            }
        }

        return View('admin.cadre.cadre_search', [
            'cadres' => $cadre,
            'pagination' => $cadre->links('pagination.default')]);
    }
}







