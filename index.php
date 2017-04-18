<?php
/**
 * Created by PhpStorm.
 * User: huaral
 * Date: 2017/2/18l
 * Time: 12:27
 */
//test

// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:get');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

require_once './response/Response.php';
require_once './files/common/RequestCodeEnum.php';
require_once './files/sqlDao/DBDao.php';

//$page = isset($_GET['page'])?$_GET['page']:1;
//$pagesize = isset($_GET['pagesize'])?$_GET['pagesize']:1;

//if(!is_numeric($page)||!is_numeric($pagesize)){
//
//    return Response::responseDao(RequestCodeEnum::Requset_PARAMERROR,RequestCodeEnum::RequestMessage(RequestCodeEnum::Requset_PARAMERROR),array());
//}
//
//

//echo 'hello world1!';
$db = new DBDao("testTable",array());
echo Response::responseDao(RequestCodeEnum::Request_SUCCESS,RequestCodeEnum::RequestMessage(RequestCodeEnum::Request_SUCCESS),$db->getResults());





