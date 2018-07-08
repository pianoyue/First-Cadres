<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Excel;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::paginate(15);
        return View('admin.user.user_index', [
            'users' => $users,
            'pagination' => $users->links('pagination.default')]);
    }

    public function store(StoreUser $request)
    {
        $request = $request->all();

        $string = $request['Region'];
        $array=explode('/',$string);    //将传过来的区域以'/'进行分割


        try{
            $user = $this->create($request,$array);
            return $user ? redirect('/user') :$user ;
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
    private function create(array $data,array $array)
    {

        return User::create([
            'user_name' => $data['user_name'],
            'true_name' => $data['true_name'],
            'user_phone' => $data['user_phone'],
            'user_gender' => $data['user_gender'],
            'region_c' => $array[0],
            'region_v' => $array[1],
            'region_t' => $array[2],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function delete(Request $request)         //删除用户
    {
        $request = $request->all();
        $user = User::destroy($request['id']);
        return $user;
    }

    public function edit(Request $request)           //编辑用户
    {
        $request = $request->all();

        $string = $request['Region'];
        $array=explode('/',$string);    //将传过来的区域以'/'进行分割

        $user=User::find($request['id']);
        $user->user_name=$request['user_name'];
        $user->true_name=$request['true_name'];
        $user->user_gender=$request['user_gender'];
        $user->region_c=$array[0];
        $user->region_t=$array[1];
        $user->region_v=$array[2];
        $user->user_phone=$request['user_phone'];
        $user->save();

        return redirect('/user');

    }

    public function search(Request $request){      //搜索功能
        $request = $request->all();

        $users = User::where('true_name', $request['search_text'])->orwhere('region_c',$request['search_text'])->paginate(15);

        return View('admin.user.user_search', [
            'users' => $users,
            'pagination' => $users->links('pagination.default')]);
    }

    public function export(){               //导出总的用户到excel

        $export[] = array('用户名','真实姓名','所属市','所属县、区','所属乡、镇');
        foreach (User::all() as $key => $value) {
            $export[] = array(
                '用户名' => $value['user_name'],
                '真实姓名' => $value['true_name'],
                '所属市' => $value['region_c'],
                '所属县、区' => $value['region_t'],
                '所属乡、镇' => $value['region_v'],
            );
        }

        Excel::create('管理员用户表',function ($excel) use ($export){
            $excel->sheet('text', function ($sheet) use ($export){
                $sheet->rows($export);
            });
        })->export('xls');
    }
}







