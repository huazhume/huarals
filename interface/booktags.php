<?php
/**
 * Created by PhpStorm.
 * User: huaral
 * Date: 2017/2/24
 * Time: 17:07
 */
// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:get');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

require_once '../response/Response.php';
require_once '../files/common/RequestCodeEnum.php';
require_once '../files/sqlDao/DBDao.php';

if(isset($_GET["bookname"])){
    $bookname = $_GET["bookname"];
    $db = new DBDao();
    $db->selectTable('bookshelf');
    $db->setSqlParams(array("bookname"=>$bookname));
    $result = $db->getResults();
    $result[0]["booktags"]= json_decode( $result[0]["booktags"]);
    echo Response::responseDao(RequestCodeEnum::Request_SUCCESS,RequestCodeEnum::RequestMessage(RequestCodeEnum::Request_SUCCESS),$result);

}else{
    //api参数错误
    echo Response::responseDao(RequestCodeEnum::Requset_PARAMERROR,RequestCodeEnum::RequestMessage(RequestCodeEnum::Requset_PARAMERROR),array());
}
