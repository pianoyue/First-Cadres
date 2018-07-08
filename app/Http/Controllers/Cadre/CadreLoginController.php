<?php
/**
 * Created by PhpStorm.
 * User: yanyue
 * Date: 2018/4/6
 * Time: 16:05
 */
namespace App\Http\Controllers\Cadre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesCadres;
use Illuminate\Foundation\Auth\ThrottlesLogins;


class CadreLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesCadres,ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/cadre/index';
    protected $username;

    /**
     * Create a new controller instance.
     **/
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
//        $this->username = config('admin.global.username');
    }
    /**
     * 重写登录视图页面
     **/
    public function showLoginForm()
    {
        return view('cadre.login');
    }

}