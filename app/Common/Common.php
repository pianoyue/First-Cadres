<?php

namespace App\Common;

class Common{
    /**
     * 格式化成功返回值
     * @param $content array | string | object 返回值数据
     * @param $massage string 返回值信息
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sprintSuccessResult($content, $massage = '获取成功'){
        $data = [
            'content' => $content,
            'massage' => $massage,
            'status' => true,
            'code'    => 200
        ];
        return response()->json($data);
    }

    /**
     * 格式化错误返回值
     * @param $massage string 返回值信息
     * @return \Illuminate\Http\JsonResponse
     */
//    public static function sprintErrorResult($massage){
//        $data = [
//            'content' => '',
//            'massage' => $massage,
//            'status' => false,
//            'code'    => 403
//        ];
//        return response()->json($data);
//    }


    /**
     * 格式化错误返回值
     * @param $massage string 返回值信息
     * @param $code int HTTP状态码
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sprintErrorResult( $code = 401 ,  $massage = ''){
        return abort($code, $massage);
    }
}