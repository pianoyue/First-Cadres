<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cadre extends Authenticatable
{
    use SoftDeletes;

//    protected $table= 'cadres';
//    protected $primaryKey= 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //允许批量赋值的字段
    protected $fillable = [
        'cadre_name','cadre_trueName','password', 'cadre_phone', 'cadre_gender', 'cadreRegion_c',
        'cadreRegion_t','cadreRegion_v','startTime','endTime','political_status','status',
        'birth','age','education','company','job','address','identity','secretary','origin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 自定义用Passport授权登录：用户名+密码
     * @param $username
     * @return mixed
     */
//    public function findForPassport($username)
//    {
//        return self::where('user_name', $username) // 用户名验证
//        ->orWhere('user_phone', $username) // 手机验证
//        ->first();
//    }
}
