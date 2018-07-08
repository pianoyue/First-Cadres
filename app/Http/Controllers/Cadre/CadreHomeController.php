<?php
/**
 * Created by PhpStorm.
 * User: yanyue
 * Date: 2018/4/6
 * Time: 16:14
 */
namespace App\Http\Controllers\Cadre;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CadreHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cadre.index');
    }
}