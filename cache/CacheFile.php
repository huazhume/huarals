<?php

/**
 * Created by PhpStorm.
 * User: huaral
 * Date: 2017/2/20
 * Time: 14:23
 */

define("CACHE_FILE_PATH","");

class CacheFile
{
    /**
     * @param $key 文件名
     * @param $value 文件内容
     * @param int $cacheTime  过期时间 0表示永久
     */
    public function cacheData($key, $value, $cacheTime= 0){
        $filePath = dirname(__FILE__).CACHE_FILE_PATH.$key."TXT";
        if($value!==""){
            //write
            $dir = dirname($filePath);
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }
            $cacheTime = sprintf('%11d',$cacheTime);
            if(!is_file($filePath)){
                return flase;
            }
            return file_put_contents($filePath,json_encode($value),true);
        }
    }

    /**
     * @param $key 文件名
     * @return bool|mixed
     * flase : 表示文件不存在或者文件已过期
     * json 返回缓存数据
     */
    public function getCacheData($key){
        $filePath = dirname(__FILE__).CACHE_FILE_PATH.$key."TXT";
        if(is_file($filePath)){
            $datastring = json_decode(file_get_contents($filePath,true));
            $cachetime = (int)substr($datastring,0,11);
            $value = substr($datastring,11);
            if($cachetime!=0&& $cachetime + filemtime($filePath) < time()){
                unlink($filePath);
                return false;
            }
            return json_decode($value,true);
        }else{
            return false;
        }
    }
}