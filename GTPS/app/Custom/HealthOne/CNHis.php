<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-6-30
     * Time: 9:10
     */

    namespace HealthOne;

    class CNHis
    {
        public function __construct()
        {
        }

//        public function connect(array $option)
//        {
//            if(is_array($option)){
//                $this->_dbConfig = array_merge($this->_dbConfig, $option);
//            }
//            // 建立mysql连接
//            try{
//                $this->_link = @new PDO($this->_makeLinkString(), $this->_dbConfig['user'], $this->_dbConfig['password'], [
//                    PDO::ATTR_TIMEOUT            => 3,
//                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
//                    PDO::ATTR_CASE               => PDO::CASE_LOWER,
//                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//                ]);
//
//                return true;
//            }catch(PDOException $pdo_exception){
//                $error_message = $pdo_exception->getMessage();
//                $error_code    = $pdo_exception->getCode();
//                if(!(stripos($error_message, 'could not find driver') === false)){
//                    $this->_errorStack[] = [-2, '数据库驱动指定错误'];
//                }
//                elseif(preg_match("/Host '([0-9.]*)' is not allowed to connect to this MySQL server/", $error_message, $match_result)){
//                    $this->_errorStack[] = [$error_code, "当前机($match_result[1])不允许访问OA数据库"];
//                }
//                else{
//                    switch($error_code){
//                        case 1049:
//                            $this->_errorStack[] = [$error_code, '找不到指定的数据库'];
//                        break;
//                        case 1045:
//                            $this->_errorStack[] = [$error_code, '数据库用户/密码错误'];
//                        break;
//                        case 2002:
//                            $this->_errorStack[] = [$error_code, '数据库地址/端口错误'];
//                        break;
//                        case 1130:
//                            $this->_errorStack[] = [$error_code, $error_message];
//                        break;
//                    }
//                }
//
//                return false;
//            }
//        }
    }