<?php
    /*
     * 更新日志
     *
     * Version 1.00 2016-05-03 14:35
     * 初始版本
     *
     * Version 1.10 2017-02-21 17:38
     * 更新汉字转拼音的方法
     *
     * Version 1.20 2017-02-27 11:36
     * 更新crypt加密以及验证的方法
     *
     * Version 1.25 2017-06-19 15:07
     * 将StringPlus中汉子表独立为单独文件进行加载
     *
     * Version 1.50 2017-07-11 17:22
     * 1、方法静态化
     * 2、优化获取随机字符串的方法
     * 3、更新注释
     * 4、删除字符串过滤方法
     */

    namespace Quasar\Utility;

    use Exception;

    header('Content-type:text/html;charset=utf-8');

    /**
     * 封装了字符串的一些操作集合<br>
     * <br>
     * CreateTime: 2016-05-03 14:35<br>
     * ModifyTime: 2017-07-11 17:22<br>
     *
     * @author  Quasar (lelouchcctony@163.com)
     * @version 1.50
     */
    class StringPlus
    {
        /** 加密模式 */
        const CRYPT_MODE = [
            'des'      => 1,
            'desPlus'  => 2,
            'md5'      => 3,
            'blowfish' => 4,
            'sha256'   => 5,
            'sha512'   => 6
        ];

        /**
         * hash算法
         *
         * @param string $message 进行hash计算的内容
         * @param string $method  hash算法
         *
         * @return string
         * @throws Exception
         */
        public static function hash($message, $method)
        {
            if(in_array($method, hash_algos())) return hash($method, $message);
            else throw new Exception("不支持 $method 的hash函数");
        }

        /**
         * 使用crypt加密信息
         * #加密模式可指定以下值
         * * 1：des
         * * 2：des+
         * * 3：md5
         * * 4：blowfish
         * * 5：sha256
         * * 6：sha512
         * #盐值参数需要满足以下要求
         * * 若选定**blowfish**、**sha256**和**sha512**加密模式，盐值参数类型为**array(int, int|string)**，第一数组元素为循环次数，第二个数组元素为具体的盐值
         * * 若选定**des**、**des+**和**md5**加密模式，盐值参数类型为**string**且满足对应加密模式需要格式
         * * 若盐值指定false，则该方法会自动生成盐值
         *
         * @param string             $message 明文信息
         * @param string|array|false $salt    盐值
         * @param int|mixed          $mode    加密模式
         *
         * @return string
         * @throws Exception
         */
        public static function crypt($message, $salt, $mode = self::CRYPT_MODE['md5'])
        {
            switch($mode){
                case self::CRYPT_MODE['des']:
                    if(CRYPT_STD_DES == 1){
                        if($salt === false) $salt = self::makeRandomString(2);
                        elseif(!preg_match('~[/.0-9A-Za-z]{2,}~', $salt)) throw new Exception('盐值必须满足[/.0-9A-Za-z]{2,}的正则规则', 400001);
                        $result = crypt($message, $salt);

                        return $result;
                    }
                    else throw new Exception('系统不支持DES加密', 400011);
                break;
                case self::CRYPT_MODE['desPlus']:
                    if(CRYPT_EXT_DES == 1){
                        if($salt === false) $salt = self::makeRandomString(8);
                        elseif(!preg_match('~[/.0-9A-Za-z]{8,}~', $salt)) throw new Exception('盐值必须满足[/.0-9A-Za-z]{8,}的正则规则', 400002);
                        $result = crypt($message, "_$salt");

                        return $result;
                    }
                    else throw new Exception('系统不支持扩展的DES加密', 400012);
                break;
                case self::CRYPT_MODE['md5']:
                    if(CRYPT_MD5 == 1){
                        if($salt === false) $salt = self::makeRandomString(8);
                        $result = crypt($message, "$1$$salt$");

                        return $result;
                    }
                    else throw new Exception('系统不支持MD5加密', 400013);
                break;
                case self::CRYPT_MODE['blowfish']:
                    $makeLoopCount = function () use (&$makeLoopCount){
                        $result = rand(0, 1);
                        if($result === 0) $result .= rand(4, 9);
                        else $result .= rand(0, 9);
                        if((int)$result>12) return $makeLoopCount();

                        return $result;
                    };
                    if(CRYPT_BLOWFISH == 1){
                        if($salt === false) $salt = [$makeLoopCount(), self::makeRandomString(20)];
                        else{
                            if(!preg_match('/(0[4-9])/', $salt[0]) && !((int)$salt[0]<=31 && (int)$salt[0]>=4)) throw new Exception('循环次数必须满足[04-31]的规则', 400003);
                            if(!(preg_match('~[./0-9A-Za-z]{20,}~', $salt[1]) && strlen($salt[1]) == 20)) throw new Exception('盐值必须满足[./0-9A-Za-z]{20}的正则规则', 400004);
                        }
                        $result = crypt($message, "$2y$$salt[0]$$salt[1]$");

                        return $result;
                    }
                    else throw new Exception('系统不支持BLOWFISH加密', 400014);
                break;
                case self::CRYPT_MODE['sha256']:
                    if(CRYPT_SHA256 == 1){
                        if($salt === false) $salt = [rand(1000, 1000000), self::makeRandomString(16)];
                        elseif($salt[0]<1000 && $salt[0]>999999999) throw new Exception('循环次数必须满足[1000-999999999]的规则', 400005);
                        $result = crypt($message, "$5$".'rounds='."$salt[0]$$salt[1]$");

                        return $result;
                    }
                    else throw new Exception('系统不支持SHA256加密', 400015);
                break;
                case self::CRYPT_MODE['sha512']:
                    if(CRYPT_SHA512 == 1){
                        if($salt === false) $salt = [rand(1000, 1000000), self::makeRandomString(16)];
                        elseif($salt[0]<1000 && $salt[0]>999999999) throw new Exception('循环次数必须满足[1000-999999999]的规则', 400005);
                        $result = crypt($message, "$6$".'rounds='."$salt[0]$$salt[1]$");

                        return $result;
                    }
                    else throw new Exception('系统不支持SHA512加密', 400016);
                break;
                default:
                    return null;
                break;
            }
        }

        /**
         * 验证crypt加密密文和明文是否匹配
         *
         * @param string $message     明文信息
         * @param string $cipher_text 密文
         *
         * @return bool
         * @throws Exception
         */
        public static function verifyCrypt($message, $cipher_text)
        {
            if(preg_match('/\$1\$([^$]{0,8})\$/', $cipher_text, $opt)) $mode = self::CRYPT_MODE['md5'];
            elseif(preg_match('~\$2y\$(0[4-9]|[10-31])\$([./0-9A-Za-z]{20,})\$~', $cipher_text, $opt)) $mode = self::CRYPT_MODE['blowfish'];
            elseif(preg_match('~\$5\$rounds=([0-9]{4,9})\$([\S]{0,16})\$~', $cipher_text, $opt)) $mode = self::CRYPT_MODE['sha256'];
            elseif(preg_match('~\$6\$rounds=([0-9]{4,9})\$([\S]{0,16})\$~', $cipher_text, $opt)) $mode = self::CRYPT_MODE['sha512'];
            elseif(preg_match('~_[/.0-9A-Za-z]{8}[\S]+~', $cipher_text, $opt)) $mode = self::CRYPT_MODE['desPlus'];
            elseif(preg_match('~[/.0-9A-Za-z]{2,}[\S]+~', $cipher_text, $opt)) $mode = self::CRYPT_MODE['des'];
            else $mode = null;
            switch($mode){
                case self::CRYPT_MODE['des']:
                    $salt    = substr($cipher_text, 0, 2);
                    $tmp_pwd = crypt($message, $salt);

                    return hash_equals($tmp_pwd, $cipher_text);
                break;
                case self::CRYPT_MODE['desPlus']:
                    $salt    = substr($cipher_text, 0, 9);
                    $tmp_pwd = crypt($message, $salt);

                    return hash_equals($tmp_pwd, $cipher_text);
                break;
                case self::CRYPT_MODE['md5']:
                case self::CRYPT_MODE['blowfish']:
                case self::CRYPT_MODE['sha256']:
                case self::CRYPT_MODE['sha512']:
                    $tmp_pwd = crypt($message, $opt[0]);

                    return hash_equals($tmp_pwd, $cipher_text);
                break;
                default:
                    return false;
                break;
            }
        }

        /**
         * @功能: 最全的PHP汉字转拼音函数 （共25961字，包括 20902基本字 + 5059生僻字）
         * @版本: 1.0.0
         * @作者: wuzhaohuan <kongphp@gmail.com> <blog.520.at>
         * @时间: 2013-10-08
         *
         * @param string $word      需要转换的汉字
         * @param bool   $is_first  是否只输出拼音首字母
         * @param string $delimiter 输出的分隔符
         *
         * @return string
         */
        public static function getPinyin($word, $is_first = false, $delimiter = ' ')
        {
            $word   = trim($word);
            $length = strlen($word);
            if($length<3) return $word;
            if(!isset($pinyin_str)){
                $directory  = file_get_contents(dirname(__FILE__).'/StringPlus_ChineseWord.data');
                $arr_1      = explode('|', $directory);
                $pinyin_str = [];
                foreach($arr_1 as $val){
                    $arr_2                 = explode(':', $val);
                    $pinyin_str[$arr_2[0]] = $arr_2[1];
                }
            }
            $result = '';
            for($i = 0; $i<$length; $i++){
                $code = ord($word[$i]);
                if($code<0x80){
                    if(($code>=48 && $code<=57) || ($code>=97 && $code<=122)) $result .= $word[$i]; // 0-9 a-z
                    elseif($code>=65 && $code<=90) $result .= strtolower($word[$i]); // A-Z
                    else $result .= $word[$i];
                }
                else{
                    $index = $word[$i].$word[++$i].$word[++$i];
                    if(isset($pinyin_str[$index])) $result .= ($is_first ? $pinyin_str[$index][0] : $pinyin_str[$index]).$delimiter;
                    else $result .= '';
                }
            }

            return trim($result, $delimiter);
        }

        /**
         * 根据数字生成大写汉字金额
         *
         * @param string|double $number
         *
         * @return string
         */
        public static function parseNumberToUpperWord($number)
        {
            function _handler($list, $unit)
            {
                $unit_count = count($unit);
                $result     = [];
                foreach(array_reverse($list) as $val){
                    $result_count = count($result);
                    if($val != "0" || !($result_count%4)) $is_number = ($val == '0' ? '' : $val).($unit[($result_count-1)%$unit_count]);
                    else $is_number = is_numeric($result[0][0]) ? $val : '';
                    array_unshift($result, $is_number);
                }

                return $result;
            }

            $upper_word = ["零", "壹", "贰", "叁", "肆", "伍", "陆", "柒", "捌", "玖"];
            $upper_unit = ["圆", "角", "分"];
            $upper_bit  = ["拾", "佰", "仟", "万", "拾", "佰", "仟", "亿"];
            list($integer, $decimal) = explode(".", $number, 2);
            $decimal = array_filter([$decimal[1], $decimal[0]]);
            $temp    = array_merge($decimal, [implode("", _handler(str_split($integer), $upper_bit)), ""]);
            $temp    = implode("", array_reverse(_handler($temp, $upper_unit)));

            return str_replace(array_keys($upper_word), $upper_word, $temp);
        }

        /**
         * 生成GUID字符串
         *
         * @param string $namespace 干扰字符
         * @param bool   $brace     是否输出花括号
         *
         * @return string
         */
        public static function makeGuid($namespace = '', $brace = true)
        {
            $guid = '';
            $uid  = uniqid("", true);
            $data = $namespace;
            $data .= $_SERVER['REQUEST_TIME'];
            $data .= $_SERVER['HTTP_USER_AGENT'];
            $data .= $_SERVER['LOCAL_ADDR'];
            $data .= $_SERVER['LOCAL_PORT'];
            $data .= $_SERVER['REMOTE_ADDR'];
            $data .= $_SERVER['REMOTE_PORT'];
            $hash = strtoupper(hash('ripemd128', $uid.$guid.md5($data)));
            $guid = substr($hash, 0, 8).'-'.substr($hash, 8, 4).'-'.substr($hash, 12, 4).'-'.substr($hash, 16, 4).'-'.substr($hash, 20, 12);
            if($brace == true) $guid = '{'.$guid.'}';

            return $guid;
        }

        /**
         * 创建随机字符串
         * #字符串字符集合参数可由以下值组合而成（例：W+、NC、NW-）
         * * N：数字
         * * C：特殊字符
         * * W：大小写字母
         * * W+：大写字母
         * * W-：小写字母
         *
         * @param int    $length 随机字符串长度
         * @param string $type   字符串字符集合
         *
         * @return string
         */
        public static function makeRandomString($length = 6, $type = 'NW')
        {
            $chars   = [
                'abcdefghijklmnopqrstuvwxyz',
                'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                '0123456789',
                '~!@#$%^&()[]{}_+=-;.,'
            ];
            $charset = "";
            if(strpos($type, 'N') !== false) $charset .= $chars[2];
            if(strpos($type, 'C') !== false) $charset .= $chars[3];
            if(strpos($type, 'W+') !== false && strpos($type, 'W-') !== false) $charset .= "$chars[0]$chars[1]";
            else{
                if(strpos($type, 'W+') !== false) $charset .= $chars[1];
                if(strpos($type, 'W-') !== false) $charset .= $chars[0];
            }
            if($charset === '') $charset .= "$chars[0]$chars[1]";
            $result = '';
            for($i = 0; $i<$length; $i++){
                // 这里提供两种字符获取方式
                // 第一种是使用substr 截取$chars中的任意一位字符；
                // 第二种是取字符数组$chars 的任意元素
                // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
                $result .= $charset[mt_rand(0, strlen($charset)-1)];
            }

            return $result;
        }

        /**
         * 获取当前url地址
         *
         * @return string
         */
        public static function getCurrentUrl()
        {
            return "$_SERVER[REQUEST_SCHEME]://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }
    }
