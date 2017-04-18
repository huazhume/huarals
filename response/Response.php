<?php

/**
 * Created by PhpStorm.
 * User: huaral
 * Date: 2017/2/18
 * Time: 12:58
 */

/*
 * 数据请求
 * eg 用法
    echo Response::responseDao(200,"成功",$arr,'json');
 */
class Response
{
    /*
     **json xml 综合数据输出
     *
     * @param integer $msg_code 状态码
     * @param string $msg_error 状态信息
     * @param array $msg_data 数据
     * @param array $type 数据类型(xml/json)
     * return jsonString
     */
    public static function responseDao($msg_code,$msg_error,$msg_data,$type="JSON"){
        if(!is_numeric($msg_code)){
            return;
        }

        $result = array(
            'msg_code'=>$msg_code,
            'msg_error'=>$msg_error,
            'msg_data'=>$msg_data
        );

        if(!strcasecmp("JSON",$type)){
            return self::json($result);
        }elseif (!strcasecmp("XML",$type)){
            return self::xml($result);
        }
        return "";
    }
    /*
     **json
     *
     * @param integer $msg_code 状态码
     * @param string $msg_error 状态信息
     * @param array $msg_data 数据
     * return jsonString
     */
    public static function json($result){
        return json_encode($result);
    }
    /*
    **xml
    *
    * @param integer $msg_code 状态码
    * @param string $msg_error 状态信息
    * @param array $msg_data 数据
    * return xmlString
    */
    public static function xml($result){
        $xml = "<?xml version = '1.0' encoding = 'UTF-8'?>\n";
        $xml.="<root>\n";
        $xml.=self::xmlToEncoding($result);
        $xml.="</root>\n";
        return $xml;
    }
    public static function xmlToEncoding($result){
        $xml = $attr = "";
        foreach ($result as $key=>$value){
            if(is_numeric($key)){
                $attr = " id='{$key}'";
                $key = "item";
            }
            $xml.="<{$key}{$attr}>";
            $xml.= is_array($value)?self::xmlToEncoding($value):$value;
            $xml.="</{$key}>\n";
        }
        return $xml;
    }
}
