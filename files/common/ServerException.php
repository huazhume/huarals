<?php

/**
 * Created by PhpStorm.
 * User: huaral
 * Date: 2017/2/20
 * Time: 09:57
 */


/*
 *  自定义异常处理
 *  用法
 *  try {
        $o = new TestException(TestException::THROW_CUSTOM);
    } catch (MyException $e) {      // 捕获异常
        echo "Caught my exception\n", $e;
        $e->customFunction();
    }
 */
class ServerException
{
    public $var;
    const THROW_NONE = 0;
    const THROW_CUSTOM = 1;
    const THROW_DEFAULT = 2;

    function __construct($avalue = self::THROW_NONE) {
        switch($avalue) {
            case self::THROW_CUSTOM:
                throw new CustomException('invalid parameter', 5);
                break;
            case self::THROW_DEFAULT:
                throw new CustomException('isnt allowed as a parameter', 6);
                break;
            default:
                $this->var = $avalue;
                break;
        }
    }
}

class CustomException extends Exception
{
    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
    }
    public function __toString() {
        return __CLASS__.':['.$this->code.']:'.$this->message.'\n';
    }
    public function customFunction() {
        echo 'CustomServerException';
    }
}