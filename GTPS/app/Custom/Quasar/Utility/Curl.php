<?php
    /*
     * 更新日志
     *
     * Version 1.00 2016-04-20 10:52
     * 初始版本
     *
     * Version 1.01 2017-02-24 17:45
     * 更新注释返回值类型
     */

    namespace Quasar\Utility;

    /**
     * Curl请求
     * *附录1：<br>
     * 请求函数配置数组支持如下<br>
     * key: data       val: mixed          post数据<br>
     * key: return     val: boolean        是否返回数据<br>
     * key: getHeader  val: boolean        是否返回header<br>
     * key: getBody    val: boolean        是否返回响应体<br>
     * key: userAgent  val: string|null    设定userAgent<br>
     * key: setHeader  val: string|string  设定header<br>
     * key: keyPath    val: string|null    SSL加密的密钥路径<br>
     * key: pemPath    val: string|null    SSL加密的证书路径<br>
     * key: verify     val: boolean        是否开启服务器验证<br>
     * key: async      val: boolean        是否为异步请求<br>
     * key: debug      val: boolean        是否报告遇到的每一个错误<br>
     * <br>
     * CreateTime: 2016-04-20 10:52<br>
     * ModifyTime: 2017-02-24 17:45<br>
     *
     * @author  Quasar (lelouchcctony@163.com)
     * @version 1.01
     */
    class Curl implements \Kingdee\Sender
    {
        /**
         * post请求
         *
         * @param string $url    请求地址
         * @param array  $option 配置数组 键值参考附录1
         *
         * @return string
         */
        public function post(string $url, array $option = [])
        {
            $default = [
                'data'      => null,
                'return'    => true,
                'getHeader' => false,
                'getBody'   => true,
                'userAgent' => null,
                'setHeader' => null,
                'keyPath'   => null,
                'pemPath'   => null,
                'verify'    => false,
                'async'     => false,
                'debug'     => false,
            ];
            $opt     = array_merge($default, $option);
            $curl    = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            if($opt['data'] != null){
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $opt['data']);
            }
            if($opt['return']) curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            if($opt['getHeader']) curl_setopt($curl, CURLOPT_HEADER, true);
            if(!$opt['getBody']) curl_setopt($curl, CURLOPT_NOBODY, true);
            if($opt['userAgent']) curl_setopt($curl, CURLOPT_USERAGENT, $opt['userAgent']);
            if($opt['setHeader']) curl_setopt($curl, CURLOPT_HTTPHEADER, $opt['setHeader']);
            if($opt['keyPath'] != null && $opt['pemPath'] != null){
                curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');
                curl_setopt($curl, CURLOPT_SSLCERT, $opt['pemPath']);
                curl_setopt($curl, CURLOPT_SSLKEYTYPE, 'PEM');
                curl_setopt($curl, CURLOPT_SSLKEY, $opt['keyPath']);
            }
            if($opt['verify']){
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
            }
            else{
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            if($opt['async']) curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            if($opt['debug']) curl_setopt($curl, CURLOPT_VERBOSE, 1);
            $result = curl_exec($curl);
            if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200' && $opt['return'] && $opt['getHeader'] && $opt['getBody']){
                $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
                $header      = substr($result, 0, $header_size);
                $body        = substr($result, $header_size);
                $result      = [
                    'header' => $header,
                    'body'   => $body
                ];
            }
            if(!$result) $result = curl_error($curl);
            curl_close($curl);

            return $result;
        }

        /**
         * get请求
         *
         * @param string $url    请求地址
         * @param array  $option 配置数组 键值参考附录1
         *
         * @return string
         */
        public function get(string $url, array $option = [])
        {
            $default = [
                'data'      => null,
                'return'    => true,
                'getHeader' => false,
                'getBody'   => true,
                'userAgent' => null,
                'setHeader' => null,
                'useSSL'    => false,
                'keyPath'   => null,
                'pemPath'   => null,
                'verify'    => false,
                'async'     => false,
                'debug'     => false,
            ];
            $opt     = array_merge($default, $option);
            $curl    = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            if($opt['return']) curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            if($opt['getHeader']) curl_setopt($curl, CURLOPT_HEADER, true);
            if(!$opt['getBody']) curl_setopt($curl, CURLOPT_NOBODY, true);
            if($opt['userAgent']) curl_setopt($curl, CURLOPT_USERAGENT, $opt['userAgent']);
            if($opt['setHeader']) curl_setopt($curl, CURLOPT_HTTPHEADER, $opt['setHeader']);
            if($opt['keyPath'] != null && $opt['pemPath'] != null){
                curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');
                curl_setopt($curl, CURLOPT_SSLCERT, $opt['pemPath']);
                curl_setopt($curl, CURLOPT_SSLKEYTYPE, 'PEM');
                curl_setopt($curl, CURLOPT_SSLKEY, $opt['keyPath']);
            }
            if($opt['verify']){
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
            }
            else{
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            if($opt['async']) curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            if($opt['debug']) curl_setopt($curl, CURLOPT_VERBOSE, 1);
            $result = curl_exec($curl);
            if(curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200' && $opt['return'] && $opt['getHeader'] && $opt['getBody']){
                $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
                $header      = substr($result, 0, $header_size);
                $body        = substr($result, $header_size);
                $result      = [
                    'header' => $header,
                    'body'   => $body
                ];
            }
            if(!$result) $result = curl_error($curl);
            curl_close($curl);

            return $result;
        }
    }