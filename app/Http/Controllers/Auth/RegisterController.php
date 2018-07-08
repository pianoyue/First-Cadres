<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers,ThrottlesLogins;   //使用该类作为认证类

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';   //注册成功重定向链接

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); //中间件保护
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)   //这里自带了一个验证逻辑，request的验证有2种方法，一种是写request文件，一种就是用validator
    {
        return Validator::make($data, [
            'user_name' => 'required|string|max:255|unique:users',
            'true_name' => ['required','string','max:5','regex:/^[\x{4e00}-\x{9fa5}]+$/u'],
            'user_phone' => 'required|string|max:11|min:11|unique:users',
            'password' => ['required','string','min:6','confirmed','regex:/[0-9]+[a-zA-Z]+[0-9a-zA-Z]*|[a-zA-Z]+[0-9]+[0-9a-zA-Z]*/'],
            'password_confirmation' => 'required|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)  //这个就是create，在函数体里面就是用了model的create方法，直接在数据库生成数据
    {

        $string = $data['Region'];
        $array=explode('/',$string);    //将传过来的区域以'/'进行分割

        return User::create([
            'user_name' => $data['user_name'],
            'true_name' => $data['true_name'],
            'user_phone' => $data['user_phone'],
            'password' => bcrypt($data['password']),
            'user_gender' =>$data['user_gender'],
            'region_c' => $array[0],
            'region_t' => $array[1],
            'region_v' => $array[2],

        ]);
    }

}
