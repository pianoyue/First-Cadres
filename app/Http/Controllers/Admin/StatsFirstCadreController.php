<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCadre;
use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Excel;

class StatsFirstCadreController extends BaseController
{
//    public static $import=Array(Array());

    public function index()                              //第一书记统计表
    {

        return View('admin.statistics.stats_index');
    }

    public function search(Request $request){

        //定义地区的二维数组
        $address = Array(
            Array('南宁市','柳州市','桂林市','梧州市','北海市','防城港市','钦州市','贵港市','玉林市','百色市','贺州市','河池市','来宾市','崇左市'),
            Array('兴宁区', '青秀区', '江南区', '西乡塘区', '良庆区', '邕宁区', '武鸣区', '隆安县', '马山县', '上林县', '宾阳县', '横县'),
            Array('城中区', '鱼峰区', '柳南区', '柳北区', '柳江县', '柳城县', '鹿寨县', '融安县', '融水苗族自治县', '三江侗族自治县'),
            Array('秀峰区', '叠彩区', '象山区', '七星区', '雁山区', '临桂区', '阳朔县', '灵川县', '全州县', '兴安县', '永福县', '灌阳县', '龙胜各族自治县', '资源县', '平乐县', '荔浦县', '恭城瑶族自治县'),
            Array('万秀区', '长洲区', '龙圩区', '苍梧县', '藤县', '蒙山县', '岑溪市'),
            Array('海城区', '银海区', '铁山港区', '合浦县'),
            Array('港口区', '防城区', '上思县', '东兴市'),
            Array('钦南区', '钦北区', '灵山县', '浦北县'),
            Array('港北区', '港南区', '覃塘区', '平南县', '桂平市'),
            Array('玉州区', '福绵区', '容县', '陆川县', '博白县', '兴业县', '北流市'),
            Array('右江区', '田阳县', '田东县', '平果县', '德保县', '靖西县', '那坡县', '凌云县', '乐业县', '田林县', '西林县', '隆林各族自治县'),
            Array('八步区', '昭平县', '钟山县', '富川瑶族自治县'),
            Array('金城江区', '南丹县', '天峨县', '凤山县', '东兰县', '罗城仫佬族自治县', '环江毛南族自治县', '巴马瑶族自治县', '都安瑶族自治县', '大化瑶族自治县', '宜州市'),
            Array('兴宾区', '忻城县', '象州县', '武宣县', '金秀瑶族自治县', '合山市'),
            Array('江州区', '扶绥县', '宁明县', '龙州县', '大新县', '天等县', '凭祥市')
        );
        $request = $request->all();

        if($request['search']==0){        //广西
            $array=$address[0];
        }
        else if($request['search']==1){   //南宁
            $array=$address[1];
        }
        else if($request['search']==2){
            $array=$address[2];
        }
        else if($request['search']==3){
            $array=$address[3];
        }
        else if($request['search']==4){
            $array=$address[4];
        }
        else if($request['search']==5){
            $array=$address[5];
        }
        else if($request['search']==6){
            $array=$address[6];
        }
        else if($request['search']==7){
            $array=$address[7];
        }
        else if($request['search']==8){
            $array=$address[8];
        }
        else if($request['search']==9){
            $array=$address[9];
        }
        else if($request['search']==10){
            $array=$address[10];
        }
        else if($request['search']==11){
            $array=$address[11];
        }else if($request['search']==12){
            $array=$address[12];
        }else if($request['search']==13){
            $array=$address[13];
        }else {
            $array = $address[14];
        }

        $result= Array();
        for($i=0;$i<count($array,0);$i++){
            $result[$i][0]=$array[$i];
        }

        if($request['search']==0){
            for($i=0;$i<count($result,0);$i++){
                $result[$i][1]=$this->search_number($result[$i][0],0);
                $result[$i][2]=$this->search_number($result[$i][0],1);
                $result[$i][3]=$this->search_number($result[$i][0],2);
                $result[$i][4]=$this->search_number($result[$i][0],3);
                $result[$i][5]=$this->search_number($result[$i][0],4);
                $result[$i][6]=$this->search_number($result[$i][0],5);
                $result[$i][7]=$this->search_number($result[$i][0],6);
                $result[$i][8]=$this->search_number($result[$i][0],7);
                $result[$i][9]=$this->search_number($result[$i][0],8);
                $result[$i][10]=$this->search_number($result[$i][0],9);
                $result[$i][11]=$this->search_number($result[$i][0],10);
                $result[$i][12]=$this->search_number($result[$i][0],11);
                $result[$i][13]=$this->search_number($result[$i][0],12);
            }
        }else{
            for($i=0;$i<count($result,0);$i++){
                $result[$i][1]=$this->search_number2($result[$i][0],0);
                $result[$i][2]=$this->search_number2($result[$i][0],1);
                $result[$i][3]=$this->search_number2($result[$i][0],2);
                $result[$i][4]=$this->search_number2($result[$i][0],3);
                $result[$i][5]=$this->search_number2($result[$i][0],4);
                $result[$i][6]=$this->search_number2($result[$i][0],5);
                $result[$i][7]=$this->search_number2($result[$i][0],6);
                $result[$i][8]=$this->search_number2($result[$i][0],7);
                $result[$i][9]=$this->search_number2($result[$i][0],8);
                $result[$i][10]=$this->search_number2($result[$i][0],9);
                $result[$i][11]=$this->search_number2($result[$i][0],10);
                $result[$i][12]=$this->search_number2($result[$i][0],11);
                $result[$i][13]=$this->search_number2($result[$i][0],12);
            }

        }

//        for($i=0;$i<count($result,0);$i++)
//            for($j=0;$j<13;$j++)
//                self::$import[$i][$j]=$result[$i][$j];
//        echo(self::$import[0][0]);



        return View('admin.statistics.stats_firstcadre', ['result' => $result]);
    }



    function search_number($region,$type ){
        if($type==0){             //统计总数
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1])->count();
        }
        else if($type==1){        //统计男
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'cadre_gender' =>0])->count();
        }
        else if($type==2)         //统计女
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'cadre_gender' =>1])->count();
        else if($type==3)         //来源中直
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'origin' =>0])->count();
        else if($type==4)         //来源省直
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'origin' =>1])->count();
        else if($type==5)         //市直
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'origin' =>2])->count();
        else if($type==6)         //县直
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'origin' =>3])->count();

        else if($type==7)        //处级
            $number=Cadre::where(function ($query) use ($region) {
                            $query->where('cadreRegion_c',"$region")->where('secretary', 1)->where('job', 1);
                                    })->orWhere(function ($query) use ($region){
                                        $query->where('cadreRegion_c',"$region")->where('secretary',1)->where('job', 2);
                                    })->count();

        else if($type==8)        //科级
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'job' =>3])->count();
        else if($type==9)        //一般干部
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'job' =>4])->count();
        else if($type==10)       //<35
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1])->where('age','<',35)->count();
        else if($type==11)        //35-45
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1])->where('age','>',35)->where('age','<',45)->count();
        else                      //45-60
            $number=Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1])->where('age','>',45)->where('age','<',60)->count();

        return $number;
    }


    function search_number2($region,$type ){
        if($type==0){             //统计总数
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1])->count();
        }
        else if($type==1){        //统计男
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1,'cadre_gender' =>0])->count();
        }
        else if($type==2)         //统计女
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1,'cadre_gender' =>1])->count();
        else if($type==3)         //来源中直
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1,'origin' =>0])->count();
        else if($type==4)         //来源省直
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1,'origin' =>1])->count();
        else if($type==5)         //市直
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1,'origin' =>2])->count();
        else if($type==6)         //县直
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1,'origin' =>3])->count();

        else if($type==7)        //处级
            $number=Cadre::where(function ($query) use ($region) {
                            $query->where('cadreRegion_t',"$region")->where('secretary', 1)->where('job', 1);
                                })->orWhere(function ($query) use ($region){
                                    $query->where('cadreRegion_t',"$region")->where('secretary',1)->where('job', 2);
                                })->count();

        else if($type==8)        //科级
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1,'job' =>3])->count();
        else if($type==9)        //一般干部
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1,'job' =>4])->count();
        else if($type==10)       //<35
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1])->where('age','<',35)->count();
        else if($type==11)        //35-45
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1])->where('age','>',35)->where('age','<',45)->count();
        else                      //45-60
            $number=Cadre::where(['cadreRegion_t'=>$region , 'secretary'=>1])->where('age','>',45)->where('age','<',60)->count();


        return $number;
    }



    function export(){                  //导出

//        $array=$this->import;
//
//        echo(self::$import[0][0]);

//        $export[] = array('地区','总人数','性别(男)','性别(女)','来源(中直)','来源(省直)','来源(市直)','来源(县直)','级别(处级)','级别(科级)','级别(一般干部)','年龄(<35)','年龄(35-45)','年龄(45-60)');
//        foreach ($array as $key => $value) {
//            $export[] = array(
//                $value[0],
//                $value[1],
//                $value[2],
//                $value[3],
//                $value[4],
//                $value[5],
//                $value[6],
//                $value[7],
//                $value[8],
//                $value[9],
//                $value[10],
//                $value[11],
//                $value[12],
//                $value[13]
//            );
//        }
//
//        Excel::create('第一书记统计表',function ($excel) use ($export){
//            $excel->sheet('text', function ($sheet) use ($export){
//                $sheet->rows($export);
//            });
//        })->export('xls');
    }


    function GetChartData(){
        $my_data = array(
            array(1,2),
            array(1,2,3,4),
            array(1,1,1,4),
            array(1,2,3,4,5),
            array(1,1,1),
        );
//        array_push($today_data, Cadre::where(['cadreRegion_c'=>$region , 'secretary'=>1,'cadre_gender' =>0])->count());
//        array_push(1);
//        array_push(2);
//        array_push(3);

        Log::info(json_encode($my_data));
        return $my_data;
    }

    function GetChartData_index(){      //显示饼图

        return View('admin.statistics.chart_firstcadre');
    }


}







