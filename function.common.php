<?php

/************************************************************
            这是一个公共函数的库文件
            为了方便调等功能都可以在这里添加公共函数
            作用域 ： 全局
    @add By huiwenDuan
    @date 2018/04/08
************************************************************/
/**
 * [getCode description]
 * @param  array $str [description]
 * @return [string]       [description]
 */
function getCode($str = 123456){
    return md5($str);
}

/**
 * [toDate 编程时间]
 * @param  [integer]    $time    [description]
 * @param  [string]     $separator [日期分隔符]
 * @param  [string]     $separator_time [时间分隔符]
 * @param  [string]     $[name] [<description>]
 * @param  [boolean]    $is_need [是否需要时分秒]
 * @return [string]     [description]
 */
function toDate($time , $separator = '-',  $is_need = false, $separator_time = ':'){
    if(intval($time)){
        if($is_need){
            $timeString = date('Y'.$separator.'m'.$separator.'d H'.$separator_time.'i'.$separator_time.'s', $time);
        }else{
            $timeString = date('Y'.$separator.'m'.$separator.'d', $time);
        }
    }else{
        $timeString = '';
    }

    return $timeString;
}

/**
 * [createSnCode 生成订单号]
 * @return [type] [description]
 */
function createSnCode(){
    //第一部分数字
    $strPre = date('YmdHis', time());
    //第二部分是随机数6位
    $strNex = createSixCode();

    return $strPre.$strNex;
}

/**
 * [createSixCode 生成六位随机数 ，前后补0]
 * @return [type] [description]
 */
function createSixCode(){
    // 生成随机六位数，不足六位两边补零
    return str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);
}

/**
 * [get_second 时分秒转成秒]
 * @param  [string] $str [格式例如：01:01:01]
 */
function get_second($str=0){
    if (empty($str)) {
        return $str;
    } else {
        $d      = explode(':', $str);
        $second = $d[0]*3600+$d[1]*60+$d[2];
        return $second;
    }
}

/**
 * [createTicketCode 生成优惠劵编码号]
 * @return [type] [description]
 * eg:M3454321533333333
 */
function createTicketCode($type){
    //生成时间戳加大写字符一位加6位随机码  共17位
    //第一部分数字
    $strPre = date('YmdHis', time());
    //第二部分是随机数6位
    $strNex = createSixCode();
    return $type.$strPre.$strNex;

}

/**
 * deleteFile
 * @param string 带路径  到public 层
 * @return 0 1 [返回是否删除成功]
 */
function deleteFile($filename){
    $linkpath = public_path().$filename;
    if(is_file($linkpath)){
        if(unlink($linkpath)){
            $re_data = 1;
        }else{
            $re_data = 0;
        }
    }else{
        $re_data = 2;
    }

    return $re_data;
}


/**
 * 获取营业等状态
 */
function getsBusStatus(){
    $status = [
        0 => '正常营业',
        1 => '休息中',
        2 => '暂停营业',
        9 => '已删除',
    ];
    return $status;
}


/**
 * 获取现金结算方法
 */
function getsTipsType(){
    $type = [
        0 => '现结',
        1 => '月结',
    ];
    return $type;
}
/**
 * 获取有无笑脸打赏
 */
function getsSmileFlag(){
    $type = [
        0 => '有',
        1 => '无',
    ];
    return $type;
}

/**
 * 获取打赏对象类型
 */
function getTipsTarget(){
    $type = [
        0 => '订单',
        1 => '菜品',
        2 => '环境',
        3 => '服务员',
        4 => '厨师',
        5 => '物流人员',
    ];
    return $type;
}
/**
 * 获取支付方式
 */
function getPayType(){
    $type = [
        0 => '现金',
        1 => '余额',
        2 => '笑脸',
    ];
    return $type;
}
/**
 * 获取打赏状态
 */
function getTipsStatus(){
    $type = [
        0 => '未转结',
        1 => '已转结',
        2 => '取消',
        9 => '软删除',
    ];
    return $type;
}

/**
 * 获取地域
 */
function getArea($id){
    switch($id){
        case 1:
            $name = '华东';
        break;
        case 2:
            $name = '华东';
        break;
        case 3:
            $name = '华中';
        break;
        case 4:
            $name = '华北';
        break;
        case 5:
            $name = '西南';
        break;
        case 6:
            $name = '东北';
        break;
        case 7:
            $name = '西北';
        break;
        case 8:
            $name = '港澳台';
        break;
        default:
            $name = '同省';
        break;
    }

    return $name;
}

/**
 * [returnData description]
 * @Author   Alpha
 * @DateTime 2019-03-27T16:07:59+0800
 * @return   [type]                   [description]
 */
function returnData($code, $msg = '', $data = [], $count = 0){
    return compact('code','msg','data','count');
}

/**
 * [returnJsonData description]
 * @Author   Alpha
 * @DateTime 2019-06-21T16:28:22+0800
 * @param    [type]                   $code  [description]
 * @param    string                   $msg   [description]
 * @param    array                    $data  [description]
 * @param    integer                  $count [description]
 * @return   [type]                          [description]
 */
function returnJsonData($code, $msg = '', $data = [], $count = 0){
    return json_encode(compact('code','msg','data','count'));
}
/*
 * ajax 正确返回格式
 * @param $data 返回数据
 * @param $msg 提示信息
 * @param $url 路径
 * @param string $status 状态
 * @return string
 */
function ajaxReturn($data='',$msg='',$url='',$status='success'){
    return response()->json(compact('data','msg','url','status'),JSON_UNESCAPED_UNICODE);
}

/**
 * ajax错误返回格式
 * @param $data
 * @param $msg
 * @param $url
 * @return string
 */
function ajaxErrorReturn($data='',$msg='',$url=''){
    return ajaxReturn($data,$msg,$url,'error');
}

/**
 * 对象转数组
 */
function obj2arr($obj){
    return json_decode(json_encode($obj), true);
}
/**
 * [list_to_tree description]
 * @param  [type]  $list  [description]
 * @param  string  $pk    [description]
 * @param  string  $pid   [description]
 * @param  string  $child [description]
 * @param  integer $root  [description]
 * @return [type]         [description]
 */
function list_to_tree($list, $pk='id',$pid = 'pid',$child = 'children',$root=0) {
  // 创建Tree
  $tree = array();
  if(is_array($list)) {
    // 创建基于主键的数组引用
    $refer = array();
    foreach ($list as $key => $data) {
      $refer[$data[$pk]] =& $list[$key];
    }
      foreach ($list as $key => $data) {
      // 判断是否存在parent
      $parentId = $data[$pid];
      if ($root == $parentId) {
        $tree[] =& $list[$key];
      }else{
        if (isset($refer[$parentId])) {
          $parent =& $refer[$parentId];
          $parent[$child][] =& $list[$key];
        }
      }
    }
  }

    return $tree;
}

/**
 * getImgPath 获取图片的完成路径
 * @param int $id 图片id
 * @return string $url
 */
function getImgPath($id){
    $img = DB::table('cy_file')->where('id','=',$id)->first();
    $url = '';
    if($img){
        $url =  is_https().$_SERVER["SERVER_NAME"].$img->path;
    }
    return $url;
}
/**
 * 判断图片是否有绝对地址
 * @param int $id 图片id
 * @return string $url
 */
function absPath($id){
    $img = DB::table('cy_file')->where('id','=',$id)->first()->abs_url;
    return $img;
}

/**
 * [is_https 获取当前协议是否https并返回协议类型]
 * @return string
 */
function is_https() {
    if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return 'https://';
    } elseif ( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
        return 'https://';
    } elseif ( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return 'https://';
    }
    return 'http://';
}
/**
 * curl get 请求指定的url
 * @param string  $url  要请求的url地址
 * @param int $time_out 访问网络超时时间
 * @return bool|mixed
 */
function curl_get($url, $time_out=60) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_TIMEOUT, $time_out);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        return false;
    }
    curl_close($ch);
    return $result;
}

/**
 * curl post 请求指定的url
 * @param string $url 要请求的url地址
 * @param array $data 要请求的参数
 * @param int $time_out 访问网络超时时间
 * @return bool|mixed
 */
function curl_post($url, $data, $time_out=60){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_TIMEOUT,$time_out);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        return false;
    }
    curl_close($ch);
    return $result;
}


function get_tree($data,$pid=0,$le=0,$field='name'){
    //创建一个静态数组保存数据
    static $array = array();
    if($le==0){
        $array = array();
    }
    //循环出所有的有关数据保存进数组
    foreach ($data as $v){
        $v['style'] = '';
        $v['show']  = 1;
        //当第一循环是pid==0 因为上面已经设置pid==0
        if($v['parent'] == $pid){
            //这里是为了区分级别
            $v['le'] = $le;
            if($v['parent'] > 0){
                $v['_name'] = str_repeat('&nbsp;', 4*$le).'┣'.$v[$field];
                $v['style'] = "margin-left: 33px;";
            }else{
                $v['_name'] = $v[$field];
            }
            if($v['status'] == 0){
                $v['end'] = false;
            }else{
                $v['end'] = true;
            }
            //将有关数据保存如数据
            $array[] = $v;
            //为了将有关数据保存数据，这里使用递归
            get_tree($data,$v['id'],$le+1,$field);
        }
    }
    //将最后的内容输出返回

    return $array;
}

/**
 * [disbale_tree description]
 * @Author   Alpha
 * @DateTime 2019-04-17T16:42:08+0800
 * @return   [type]                   [description]
 */
function disbale_tree($data){
    $ids = array_unique(array_column($data, 'parent'));
    foreach($data as &$v){
        if(!in_array($v['id'], $ids)){
            //不在这里所以就要屏蔽
            $v['end'] = true;
        }else{
            $v['end'] = false;
        }
    }
    return $data;
}

/**
 * [disbale_tree_new 屏蔽已经禁用信息]
 * @Author   Alpha
 * @DateTime 2019-04-17T16:42:08+0800
 * @return   [type]                   [description]
 */
function disbale_tree_new($data){
    $ids = array_unique(array_column($data, 'parent'));
    foreach($data as &$v){
        if(in_array($v['id'], $ids)){
            //不在这里所以就要屏蔽
            $v['end'] = true;
        }else{
            if($v['status'] <> 0){
                $v['end'] = true;
            }else{
                $v['end'] = false;
            }
        }
    }
    return $data;
}

/**
 * [disable_me_low 禁用自己以及下边]
 * @Author   Alpha
 * @DateTime 2019-04-23T11:08:30+0800
 * @return   [type]                   [description]
 */
function disable_me_low($data, $disable_ids = []){
    if($disable_ids){
        foreach($data as &$v){
            if(in_array($v['id'], $disable_ids)){
                $v['end'] = true;
            }
        }
    }
    return $data;
}

/**
 * [getAllChild 获取所有子级]
 * @Author   Alpha
 * @DateTime 2019-04-23T11:25:02+0800
 * @param    [type]                   $actionModel [description]
 * @param    integer                  $id          [description]
 * @param    integer                  $le          [description]
 * @param    array                    $where       [description]
 * @return   [type]                                [description]
 */

function getAllChilds($actionModel, $id = 0,$arr_ids=[]){
    $model = $actionModel;
    $list = DB::table($model)->where('parent', '=', $id)->where('status','<>',9)->get();
    foreach($list as $val){
        if($val->parent==0) continue;
        $arr_ids[] = $val->id;
        getAllChilds($model,$val->id,$arr_ids);
    }
    return $arr_ids;
}
function getAllChild($actionModel, $id = 0, $le = 1,$where = []){
    $model = $actionModel;
    static $arr_ids = array();
    $list = DB::table($model)->where('parent', '=', $id)->where('status','<>',9)->get();
    foreach($list as $val){
        $arr_ids[] = $val->id;
        getAllChild($model,$val->id,$le+1);
    }

    return $arr_ids;
}

function getChild($actionModel, $id = 0,$ids=[], $le = 1){
    $model = $actionModel;
    $arr_ids = array();
    $list = DB::table($model)->whereIn('id',$ids)->where('parent',$id)->where('status','<>',9)->get();
    foreach($list as $key=>$val){
        $arr_ids[] = $val->id;
        getChild($model,$val->id,$ids,$le+1);
    }
    return $arr_ids;
}
function get_cards($mid){
    $c = DB::table('vip_cards')->whereRaw('status=0 and mer_id='.$mid)->select('id','name')->get();
    $c = obj2arr($c);
    $d = [];
    foreach ($c as $key => $value) {
        $d[$value['id']] = $value;
        $d[$value['id']]['vip_currenc'] = obj2arr(DB::table('vip_currenc')->whereRaw('status=0 and vip_id='.$value['id'])->select('id','name')->get());
        $d[$value['id']]['vip_level']   = obj2arr(DB::table('vip_level')->whereRaw('status=0 and vip_id='.$value['id'])->select('id','name')->get());
    }
    return $d;
}

function get_cards_for_select($mid){
    $c = DB::table('vip_cards')->whereRaw('status=0 and mer_id='.$mid)->select('id as value','name as label')->get();
    $c = obj2arr($c);
    $d = [];
    foreach ($c as $key => $value) {
        $d[$value['value']] = $value;
        $d[$value['value']]['vip_currenc'] = obj2arr(DB::table('vip_currenc')->whereRaw('status=0 and vip_id='.$value['value'])->select('id as value','name as label')->get());
        $d[$value['value']]['vip_level']   = obj2arr(DB::table('vip_level')->whereRaw('status=0 and vip_id='.$value['value'])->select('id as value','name as label')->get());
    }
    return $d;
}
/**
 * [remake_string description]
 * @Author   Alpha
 * @DateTime 2019-04-22T14:48:27+0800
 * @param    array                    $arr    [description]
 * @param    string                   $string [description]
 * @return   [type]                           [description]
 */
function remake_string($arr = [], $string = '', $break = ','){
    $re_data = [];
    if($arr && $string){
        $arr_string = explode($break, $string);
        foreach($arr_string as $v){
            $re_data[] = $arr[$v]?:'';
        }
        return implode($break, $re_data);
    }
    return '';
}

/**
 * 逆编码获取经纬度
 * $address,$city=''
 */
function getLA($address){
    /*百度经纬度*/
    //$ak = C('BD_AK');
    //$url = "http://api.map.baidu.com/geocoder/v2/?address=$address&output=json&ak={$ak}";
    //$res = file_get_contents($url);
    //$data = json_decode($res,true);
    //if($data['status'] == 0){
    //    return $data['result']['location'];
    //}else{
    //    return array('lat'=>'0','lng'=>'0');
    //}
    /*高德经纬度*/
    $address = str_replace(" ","",$address);
    $url = "http://restapi.amap.com/v3/geocode/geo?address=$address&output=json&key=7adec2f6bb05da72030ec2e38d98d858";
    $res = file_get_contents($url);
    $data = json_decode($res,true);
    if($data['status'] == 1){
        $location = explode(",",$data['geocodes'][0]['location']);
        $lng = $location[0];
        $lat = $location[1];
        return array("lat"=>$lat,"lng"=>$lng);
    }else{
        return array('lat'=>'0','lng'=>'0');
    }
}

/**
 * [getTopAndAllChild description]
 * @Author   Alpha
 * @DateTime 2019-05-05T10:02:23+0800
 * @param    [type]                   $actionModel [数据库模型]
 * @param    integer                  $id          [当前数据id]
 * @param    boolean                  $is_data     [是否需要数据，暂时没有开发]
 * @return   [type]                                [description]
 */
function getTopAndAllChild($actionModel, $id = 0, $is_data = false){
    $model = $actionModel;
    //获取最上级以及下边的无限级
    static $arr_ids = array();

    $row    = DB::table($model)->where('id', '=', $id)->first();
    $rowp   = DB::table($model)->where('id', '=', $row->parent)->first();
    if($row->parent && $rowp){
        getTopAndAllChild($model, $row->parent);
    }else{
        //赋值最上级
        $le = 0;
        //找到了这就是最顶级项
        $arr_ids = getAllChild($model,$row->id, $le+1);
        array_unshift($arr_ids, $row->id);
    }

    return $arr_ids;
}

/**
 * [getTopAndAllChild description]
 * @Author   Alpha
 * @DateTime 2019-05-05T10:02:23+0800
 * @param    [type]                   $actionModel [数据库模型]
 * @param    integer                  $id          [当前数据id]
 * @param    boolean                  $is_data     [是否需要数据，暂时没有开发]
 * @return   [type]                                [description]
 */
function getPicture($pid){
    $picture = [];
    $ps = explode(',',$pid);
    foreach($ps as $k=>$v){
        $picture[$k]['id']         = $v;
        $picture[$k]['url']        = getImgPath($v);
        $picture[$k]['old_name'] = DB::table('cy_file')->where('id','=',$v)->value('describe');
        $picture[$k]['status']     = 'finished';
    }
//     $picture = json_encode($picture);
    return $picture;
}

/**
 * [getAllTop description]
 * @DateTime 2019-05-13T10:02:23+0800
 * @param    [type]                   $actionModel [数据库模型]
 * @param    integer                  $id          [当前数据id]
 * @param    boolean                  $is_data     [是否需要数据，暂时没有开发]
 * @return   [type]                                [description]
 */
function getAllTop($actionModel, $id = 0, $is_data = false){
    $model = $actionModel;
    //获取最上级以及下边的无限级
    static $arr_ids = array();
    $row   = DB::table($model)->where('id', '=', $id)->first();
    if($row && $row->parent != 0){
        $ids = $row->parent;
        $arr_ids[] = $ids;
        getAllTop($model, $ids);
    }

    return $arr_ids;
}

/**
 *  API返回信息格式函数 ；失败：code=-1登录失效，code=0失败 code=1成功
 * @param string $code
 * @param string $message
 * @param array $data
 */
function apiResponse($code = '0', $message = '',$data = array(),$nums =0){
    header('Access-Control-Allow-Origin: *');
    header('Content-Type:application/json; charset=utf-8');
    $result = array(
        'code'=>$code,
        'message'=>$message,
        'data'=>$data,
        'nums'=>empty($nums)?count($data):$nums,
    );
    die(json_encode($result,JSON_UNESCAPED_UNICODE));
}
/**
 * [getPictureAbs 接口获取图片绝对地址]
 * @Author  LBH
 * @DateTime 2019-05-05T10:02:23+0800
 * @param    [type]                   $actionModel [数据库模型]
 * @param    integer                  $id          [当前数据id]
 * @param    boolean                  $is_data     [是否需要数据，暂时没有开发]
 * @return   [type]                                [description]
 */
function getPictureAds($pid){
    $picture = [];
    $ps = explode(',',$pid);
    foreach($ps as $k=>$v){
        $picture[$k]       = getImgPath($v);
    }
    return $picture;
}

function toString($v){
    return (string)$v;
}


/**
 * 获取最新的排号编号
 */
function getNumber($merchant_id, $desk_type_id, $use_time)
{
    $where = [
        ['merchant_id' ,'=' ,$merchant_id],
        ['desk_type_id' ,'=' ,$desk_type_id],
        ['num_state','=',1],
        ['status','=',0],
    ];
    if($use_time > 0){
        $use_day = strtotime(date('Y-m-d',$use_time));
        $next_use_day = strtotime(date('Y-m-d',$use_time))+86400;
        $s_where = ['use_time','>=',$use_day];
        $e_where = ['use_time','<=',$next_use_day];
        array_push($where,$s_where,$e_where);
    }
    $row = DB::table('take_number')->where($where)
        ->select('id','create_time','number')
        ->orderBy('id','desc')
        ->first();

    if($row){
        if($use_time > 0){
            $start_num = ++$row->number;
        }else{
            $ztoday = strtotime(date('Y-m-d',strtotime("-1 day"))." 23:59:59");
            $ntoday = strtotime(date('Y-m-d',time())." 23:59:59");
            if($row->create_time > $ztoday && $row->create_time < $ntoday){
                $start_num = ++$row->number;
            }else{
                //表示新的一天从1开始排号
                $start_num = '1';
            }
        }

    }else{
        $start_num = '1';
    }


    $start_num = str_pad($start_num,4,'0',STR_PAD_LEFT);
    return $start_num;

}

/**
 * [getAddress 获取绝对地址]
 * @Author   Alpha
 * @DateTime 2019-05-05T10:02:23+0800
 * @param    [type]                   $actionModel [数据库模型]
 * @param    integer                  $id          [当前数据id]
 * @param    boolean                  $is_data     [是否需要数据，暂时没有开发]
 * @return   [type]                                [description]
 */
function getAddress($data,$province_id,$city_id,$area_id){
    $address = "";
    if(!empty($province_id)){
        foreach($data as $key=>$val)
        {
              if($province_id == $val['value']){
                  $address = $val['label'];
              }
              if(!empty($city_id)){
                    foreach($val['children'] as $k=>$v)
                    {
                        if($city_id == $v['value']){
                            $address .= $v['label'];
                        }
                        if(!empty($area_id)){
                            foreach($v['children'] as $k1=>$v1)
                            {
                                if($area_id == $v1['value']){
                                    $address .= $v1['label'];
                                }
                            }
                        }

                    }
              }
        }
    }

   return $address;
}
/*
 * 秒 转化成  20:50:56
 * */
function Sec2Time($times){
    $result = '00:00:00';
    if ($times>0) {
        $hour = floor($times/3600);
        if(intval($hour) <= 9){
            $hour = '0'.$hour;
        }
        $minute = floor(($times-3600 * $hour)/60);
        if(intval($minute) <= 9){
            $minute = '0'.$minute;
        }
        $second = floor((($times-3600 * $hour) - 60 * $minute) % 60);
        if(intval($second) <= 9){
            $second = '0'.$second;
        }
        $result = $hour.':'.$minute.':'.$second;
    }
    return $result;
}

/**
 * [P 打印函数]
 * @Author   Alpha
 * @DateTime 2019-06-14T15:07:18+0800
 * @param    [type]                   $arr   [description]
 * @param    boolean                  $parse [description]
 */
function P($arr, $parse = true){
    var_dump($arr);
    if($parse){
        die;
    }
}

/**
 * [getJoinMers 根据商户id查找联合运营商集合，包括自己]
 * @Author   Alpha
 * @DateTime 2019-06-19T09:30:17+0800
 * @param    integer                  $mer_id [description]
 * @return   [type]                           [description]
 */
function getJoinMers($mer_id = 1){
    //查找所有联合运营的公司id集合
    $res = DB::table('merchant')->whereRaw('status = 0 and ( (run_type = 2 and  find_in_set('.$mer_id.',run_parent)) or id = '.$mer_id.')')->lists('id');

    if($res){
        $res = $res;
    }else{
        $res = [];
    }

    return $res;
}

/**
 * [getPurchaseMers 集中采购]
 * @Author   Alpha
 * @DateTime 2019-06-20T15:38:30+0800
 * @param    integer                  $mer_id [description]
 * @return   [type]                           [description]
 */
function getPurchaseMers($mer_id = 1){
    //查找所有联合运营的公司id集合
    $res = DB::table('merchant')
                ->leftJoin('basicinfo', 'merchant.id', '=', 'basicinfo.mer_id')
                ->whereRaw('merchant.status = 0 and ( (basicinfo.yuancailiao_caigou = 2 and  find_in_set('.$mer_id.', basicinfo.up_merchant)) or merchant.id = '.$mer_id.')')->lists('merchant.id');
    if($res){
        $res = $res;
    }else{
        $res = [];
    }

    return $res;
}

/**
 * [getManagerMers description]
 * @Author   Alpha
 * @DateTime 2019-06-28T10:31:06+0800
 * @param    integer                  $mer_id [description]
 * @return   [type]                           [description]
 */
function getManagerMers($mer_id = 1){
     //查找所有商品管理选择的所属餐厅
    $res = DB::table('merchant')
                ->leftJoin('basicinfo', 'merchant.id', '=', 'basicinfo.mer_id')
                ->whereRaw('merchant.status = 0 and ( (basicinfo.goods_manager = 2 and  find_in_set('.$mer_id.', basicinfo.up_basic)) or merchant.id = '.$mer_id.')')->lists('merchant.id');
    if($res){
        $res = $res;
    }else{
        $res = [];
    }

    return $res;
}
/**
 * [pp 断点]
 * @param  [type] $arr [description]
 * @return [type]      [description]
 * @author [herry] <[<email address>]>
 */
function pp($arr){
    print_r($arr);exit;
}

/**
 * [getCurrentGuard 获取当前guard]
 * @Author   Alpha
 * @DateTime 2019-06-25T14:35:27+0800
 * @return   [type]                   [description]
 */
function getCurrentGuard(){
    $guards = array_keys(config('auth.guards'));
    foreach ($guards as $guard) {
        if ($user = auth($guard)->user()) {
            $currentGuard = $guard;
            break;
        }
    }

    return $currentGuard;
}

/**
 * [clearTakeNum description]
 * @Author   Alpha
 * @DateTime 2019-07-01T11:41:30+0800
 * @return   [type]                   [description]
 */
function clearTakeNum(){
    DB::table('take_number')->where('status',0)->update(['status' => 9]);
}

/**
 * [upload_pic description]
 * @Author   Alpha
 * @DateTime 2019-07-01T17:53:22+0800
 * @return   [type]                   [description]
 */
function get_content($url){
    $file_dir   = Config::get('filesystems.disks.public.root');
    // $file_path  = $file_dir.'/'.$filename;

    $aext   = explode('.', $url);
    $ext    = end($aext);

    $name   = $file_dir.'/'. time().time() . '.' . $ext;

    $source =   file_get_contents($url);
    file_put_contents($name, $source);
    return $name;
}

/**
 * [get_content description]
 * @Author   Alpha
 * @DateTime 2019-07-01T17:53:47+0800
 * @param    [type]                   $url [description]
 * @return   [type]                        [description]
 */
function upload_pic($url, $source){
    $name =  get_content($source);
    // 将文件内容base64编码当作post请求的一个参数
    // $obj = new CurlFile(realpath($name));
    $data = array('name' => 'Foo', 'file' => new \CURLFile(realpath($name)));
    // $obj->setMimeType("multipart/form-data");//必须指定文件类型，否则会默认为application/octet-stream，二进制流文件</span>
    // $post['file'] =  $obj;
    // $re = curl_post($url, $data, 3);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_TIMEOUT,3);
    $result = curl_exec($ch);
    unlink($name);
    if (curl_errno($ch)) {
        return false;
    }
    curl_close($ch);
    return $result;
}
