<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCadre;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class AreaController extends BaseController
{
    public function index()                    //界面显示
    {

        $area=Area::paginate(15);

        return View('admin.area.area_index',[
            'areas' => $area,
            'pagination' => $area->links('pagination.default')]);
    }

    public function store(Request $request)     //增加
    {
        $request = $request->all();

        try{
            $area = $this->create($request);
            return $area ? redirect('/area') :$area ;
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
    private function create(array $data)
    {

        return Area::create([
            'area_name' => $data['area_name'],
            'area_manage' => $data['area_manage'],
            'area_type' => $data['area_type'],
            'area_number' => $data['area_number'],
        ]);
    }

    public function delete(Request $request)         //删除
    {
        $request = $request->all();
        $area = Area::destroy($request['id']);
        return $area;
    }

    public function edit(Request $request)           //编辑
    {
        $request = $request->all();
        $area=Area::find($request['id']);
        $area->area_name=$request['area_name'];
        $area->area_manage=$request['area_manage'];
        $area->area_type=$request['area_type'];
        $area->area_number=$request['area_number'];

        $area->save();

        return redirect('/area');

    }

}







