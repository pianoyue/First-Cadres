<?php
/**
 * Created by PhpStorm.
 * User: zzwu
 * Date: 18-1-2
 * Time: 下午4:05
 */


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'permission']);
    }
}