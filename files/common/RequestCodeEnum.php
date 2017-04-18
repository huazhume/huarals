<?php

/**
 * Created by PhpStorm.
 * User: huaral
 * Date: 2017/2/19
 * Time: 21:29
 *
 */
/*
 * 自定义请求枚举类
 * 用法：
 * $re = RequestCodeEnum::RequestMessage(RequestCodeEnum::Request_SUCCESS);
    echo "内容是:".$re;
 */
class RequestCodeEnum
{
    public static $son;

    const __default = 0;//未知
    const Request_SUCCESS = 200;
    const Request_ERRORREQUEST = 400;//请求错误
    const Request_UNAUTHORIZED = 401;//未授权
    const Request_REFUSE = 403;//服务器拒绝访问
    const Request_NORESOURCES = 404;
    const Request_NOSUPPORTMEDIA = 415;
    const Request_INTERNALERROR = 500;//内部错误
    const Request_NOAVAILABLE = 503;//服务不可用
    const Request_OVERTIME = 504;//请求超时
    const Request_NOSUPPORT = 505;//不支持请求协议
    const Requset_PARAMERROR = 1000;//api参数错误

    private function __construct()
    {

    }
    /**
     * 设置message值
     * @param $codeType 请求返回码
     * @return string 状态信息
     */
    private function setCodeMessage($codeType)
    {
        $message = "";
        switch ($codeType){
            case self::Request_SUCCESS:
                $message = "成功";
                break;
            case self::Request_ERRORREQUEST:
                $message = "请求错误";
                break;
            case self::Request_UNAUTHORIZED:
                $message = "请求未授权";
                break;
            case self::Request_REFUSE:
                $message = "服务器拒绝访问";
                break;
            case self::Request_NORESOURCES:
                $message = "未知资源";
                break;
            case self::Request_NOSUPPORTMEDIA:
                $message = "不支持的媒体类型";
                break;
            case self::Request_INTERNALERROR:
                $message = "内部错误";
                break;
            case self::Request_NOAVAILABLE:
                $message = "服务不可用";
                break;
            case self::Request_OVERTIME:
                $message = "请求超时";
                break;
            case self::Request_NOSUPPORT:
                $message = "不支持请求协议";
                break;
            case self::Requset_PARAMERROR:
                $message = "API参数错误";
                break;
            default:
                $message = "未知错误";
                break;
        }
        return $message;
    }

    /**单例
     * @param $codeType 请求码
     * @return string 状态信息
     */
    public static function RequestMessage($codeType){
        if(!self::$son){
            self::$son = new RequestCodeEnum();
        }
        return self::$son->setCodeMessage($codeType);
    }
}


