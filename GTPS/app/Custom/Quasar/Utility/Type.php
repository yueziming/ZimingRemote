<?php
    /*
     * 更新日志
     *
     * Version 1.00 2016-04-20 10:55
     * 初始版本
     *
     * Version 1.10 2017-07-01 15:44
     * 更新TypeError异常类
     */

    namespace Quasar\Utility;

    use Exception;
    use Kingdee\TypeConverter;
    use SimpleXMLElement;
    use Throwable;

    /**
     * 封装了复杂数据类型的类型转换方法<br>
     * <br>
     * CreateTime: 2016-04-20 10:55<br>
     * ModifyTime: 2017-07-01 15:44<br>
     *
     * @author  Quasar (lelouchcctony@163.com)
     * @version 1.10
     */
    class Type implements TypeConverter
    {
        /**
         * 将xml对象或xml字符串输出为数组
         *
         * @param array|object $xml    xml字符串或对象或数组
         * @param int          $is_obj 判断是否已经将xml数据转换为对象
         *
         * @return array
         * @throws TypeException
         */
        public static function parseXmlToArray($xml, $is_obj = 0)
        {
            if($is_obj == 0){
                try{
                    $xml = @(new SimpleXMLElement($xml));
                }catch(Exception $error){
                    throw new TypeException('数据类型错误', 1006);
                }
                $xml = json_decode(json_encode($xml));
            }
            $result = [];
            foreach($xml as $key => $val){
                if($key === '@attributes') $result = (array)$val; // 去除属性索引
                else{
                    if((is_object($val) || is_array($val))) $result[$key] = self::parseXmlToArray($val, 1);
                    else $result[$key] = $val;
                }
            }

            return $result;
        }

        /**
         * 将对象转为数组
         *
         * @param object|array $obj 需要转换的对象
         *
         * @return array 转化为数组后的数据
         */
        public static function parseObjectToArray($obj)
        {
            $result = [];
            if(is_array($obj) || is_object($obj)) foreach($obj as $key => $val){
                if(is_object($val) || is_array($val)) $result[$key] = self::parseObjectToArray($val);
                else $result[$key] = $val;
            }

            return $result;
        }
    }

    class TypeException extends Exception
    {
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
    }