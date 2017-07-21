<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-6-29
     * Time: 9:22
     */

    namespace Kingdee
    {

        use ErrorException;
        use Exception;
        use Quasar\Utility\Type;
        use SoapClient;
        use SoapFault;

        /** 默认主机地址 */
        define('DEFAULT_HOST', 'localhost');
        /** 默认协议 */
        define('DEFAULT_PROTOCOL', 'http');

        class K3Api extends K3Exception
        {
            private $_config = [
                'host'            => DEFAULT_HOST,
                'protocol'        => DEFAULT_PROTOCOL,
                'authorityCode'   => '',
                'encryptPassword' => ''
            ];
            /** @var TokenHandler|null */
            private $_tokenHandler = null;
            /** @var Sender|null */
            private $_sender = null;
            /** 成功返回码 */
            const ERROR_STATUS_CODE = '200';
            /** 加密方式 */
            const ENCRYPT_METHOD = 'des-ecb';

            /**
             * K3Api constructor.
             *
             * @param string $host             主机地址（若有端口需写明端口号）
             * @param string $authority_code   授权码
             * @param Sender $sender
             * @param string $protocol         协议
             * @param string $encrypt_password API数据加密的密码
             */
            public function __construct(string $host, string $authority_code, Sender $sender, string $protocol = DEFAULT_PROTOCOL, string $encrypt_password = '')
            {
                $this->_config['host']            = $host;
                $this->_config['protocol']        = $protocol;
                $this->_config['authority_code']  = $authority_code;
                $this->_config['encryptPassword'] = $encrypt_password;
                $this->_sender                    = $sender;
                $this->_tokenHandler              = new TokenHandler($sender, [
                    'host'            => $host,
                    'protocol'        => $protocol,
                    'authorityCode'   => $authority_code,
                    'encryptPassword' => $encrypt_password
                ]);
            }

            /**
             * 解密数据
             *
             * @param string $data 密文
             *
             * @return string
             */
            private function _decryptData($data)
            {
                $response        = openssl_decrypt($data, self::ENCRYPT_METHOD, $this->_config['encryptPassword']);
                $response_object = json_decode($response);

                return $response_object;
            }

            /**
             * 构建接口地址
             *
             * @param string $uri   接口URI地址
             * @param string $token 接口调用凭证
             *
             * @return string
             */
            private function _makeApiUrl($uri, $token)
            {
                $protocol = $this->_config['protocol'];
                $host     = $this->_config['host'];
                $api_url  = "$protocol://$host/$uri?token=$token";

                return $api_url;
            }

            /**
             * 分析从接口返回的原生数据
             *
             * @param string $raw_response 原生返回值
             *
             * @return array
             */
            private function _analysisResponse(string $raw_response)
            {
                $response = json_decode($raw_response);
                $result   = [
                    'message'     => $response->Message,
                    'code'        => $response->StatusCode,
                    'rawResponse' => $raw_response
                ];
                if(isset($response->Data)){
                    if(is_string($response->Data)){
                        $result['data'] = $this->_decryptData($response->Data);
                    }
                    else{
                        $result['data'] = $response->Data;
                    }
                }
                if((string)($response->StatusCode) === self::ERROR_STATUS_CODE) $result['status'] = true;
                else $response['status'] = false;

                return $result;
            }

            public function getDepartmentTemplate()
            {
                $token    = $this->_tokenHandler->get();
                $api_url  = $this->_makeApiUrl('K3API/Department/GetTemplate', $token);
                $response = $this->_sender->get($api_url);
                $result   = $this->_analysisResponse($response);
                dump($result);
                exit;
            }

            /**
             * 获取部门列表
             *
             * @return array
             */
            public function getDepartmentList()
            {
                $token    = $this->_tokenHandler->get();
                $api_url  = $this->_makeApiUrl('K3API/Department/GetList', $token);
                $response = $this->_sender->get($api_url);
                $result   = $this->_analysisResponse($response);
                if($result['status']) return $result['data']->Data;

                return [];
            }

            public function getClientList()
            {
                $token    = $this->_tokenHandler->get();
                $api_url  = $this->_makeApiUrl('K3API/Customer/GetList', $token);
                $response = $this->_sender->get($api_url);
                $result   = $this->_analysisResponse($response);
                dump($result);
                exit;
            }

            public function getSupplierList()
            {
                $token    = $this->_tokenHandler->get();
                $api_url  = $this->_makeApiUrl('K3API/Supplier/GetList', $token);
                $response = $this->_sender->get($api_url);
                $result   = $this->_analysisResponse($response);
                dump($result);
                exit;
            }

            public function getUserList()
            {
                $token    = $this->_tokenHandler->get();
                $api_url  = $this->_makeApiUrl('K3API/Employee/GetList', $token);
                $response = $this->_sender->get($api_url);
                $result   = $this->_analysisResponse($response);
                dump($result);
                exit;
            }

            public function getSaleDeliveryList()
            {
                $token    = $this->_tokenHandler->get();
                $api_url  = $this->_makeApiUrl('K3API/Sales_Delivery/GetList', $token);
                $response = $this->_sender->post($api_url, [
                    'data' => json_encode([
                        "Top"        => "100",
                        "PageSize"   => "10",
                        "PageIndex"  => "1",
                        "Filter"     => "[FBillNo] like '%0%'",
                        "OrderBy"    => "[FBillNo] asc",
                        "SelectPage" => "2",
                    ])
                ]);
                print_r($response);
                exit;
                $result = $this->_analysisResponse($response);
                dump($result);
                exit;
            }
        }

        class TokenHandler
        {
            private $_data   = [
                // 缓存文件的过期时间 （单位：秒）
                'expiredTime' => null,
                // 缓存文件的内容
                'data'        => null,
                // 缓存文件路径
                'file'        => null
            ];
            private $_config = [
                // 若token获取被加密需要该密码进行解密
                'encryptPassword' => '',
                // 接口地址
                'apiUrl'          => '[PROTOCOL]://[DOMAIN_PORT]/K3API/Token/Create/?authorityCode=[AUTHORITY_CODE]&language=CHS',
                // 授权码
                'authorityCode'   => '',
                // 主机地址
                'host'            => DEFAULT_HOST,
                // 协议
                'protocol'        => DEFAULT_PROTOCOL,
                // 文件名前缀
                'filePrefix'      => 'token_',
                // 缓存后缀
                'fileSuffix'      => '.json',
                // 文件夹
                'cacheFolder'     => '.Kingdee-Cache/'
            ];
            /** 缓存文件有效时间 */
            const EXPIRED_TIME = 3500;
            /** 缓存文件模板 */
            const CACHE_FILE_TEMPLATE = [
                'expiredTime' => 0,
                'data'        => ''
            ];
            /** 加密方式 */
            const ENCRYPT_METHOD = 'des-ecb';
            /** @var null|Sender */
            private $_sender = null;

            /**
             * TokenHandler constructor.
             * #$option参数为关联数组，索引参数如下。
             * * **host => string** [必须]主机地址或域名（若存在端口号则需要包含端口），例：192.168.127.99:76
             * * **authorityCode => string** [必须]授权码
             * * cacheFolder => string 本地缓存文件目录
             *
             * @param Sender $sender
             * @param array  $option
             */
            public function __construct(Sender $sender, array $option = [])
            {
                $initConfig = function ($option){
                    if($option['cacheFolder'] != null) $this->_config['cacheFolder'] = $option['cacheFolder'];
                    $this->_config['host']            = $option['host'];
                    $this->_config['authorityCode']   = $option['authorityCode'];
                    $this->_config['apiUrl']          = str_replace('[PROTOCOL]', $option['protocol'], $this->_config['apiUrl']);
                    $this->_config['apiUrl']          = str_replace('[DOMAIN_PORT]', $option['host'], $this->_config['apiUrl']);
                    $this->_config['apiUrl']          = str_replace('[AUTHORITY_CODE]', $option['authorityCode'], $this->_config['apiUrl']);
                    $this->_config['encryptPassword'] = $option['encryptPassword'];
                };
                $initData   = function () use ($sender){
                    $this->_data['file'] = $this->_config['cacheFolder'].$this->_config['filePrefix'].substr($this->_config['authorityCode'], 2, 8).$this->_config['fileSuffix'];
                    $this->_sender       = $sender;
                    $this->_getFile();
                };
                $default    = [
                    'cacheFolder'   => null,
                    'host'          => DEFAULT_HOST,
                    'protocol'      => DEFAULT_PROTOCOL,
                    'authorityCode' => 'AUTHORITY_CODE'
                ];
                $option     = array_merge($default, $option);
                $initConfig($option);
                $initData();
            }

            /**
             * 获取凭证
             *
             * @param bool $new  是否从接口获取新的凭证
             * @param bool $save 是否自动缓存到本地
             *
             * @return string
             */
            public function get(bool $new = false, bool $save = true)
            {
                if(!$new && $this->_data['data'] && ($this->_data['expiredTime']>time())) return $this->_data['data'];
                else return $this->getToken($save);
            }

            /**
             * 从缓存文件获取数据
             */
            private function _getFile()
            {
                try{
                    $content = file_get_contents($this->_data['file']);
                    if($content){
                        $content_object             = json_decode($content);
                        $this->_data['expiredTime'] = $content_object->expiredTime;
                        $this->_data['data']        = $content_object->data;
                    }
                }catch(ErrorException $exception){
                    $this->_data['expiredTime'] = 0;
                    $this->_data['data']        = '';
                }
            }

            /**
             * 从接口获取Token凭证
             *
             * @param bool $save 是否自动保存到缓存
             *
             * @return string
             */
            protected function getToken(bool $save)
            {
                $response        = $this->_sender->get($this->_config['apiUrl']);
                $response_object = json_decode($response);
                if(is_string($response_object->Data)){
                    $response_2        = openssl_decrypt($response_object->Data, self::ENCRYPT_METHOD, $this->_config['encryptPassword']);
                    $response_2_object = json_decode($response_2);
                    $token             = $response_2_object->Token;
                }
                else{
                    $token = $response_object->Data->Token;
                }
                try{
                    if($response_object->StatusCode == 200){
                        $this->_data['data']        = $token;
                        $this->_data['expiredTime'] = time()+self::EXPIRED_TIME;
                        if($save) $this->save();

                        return $token;
                    }
                    else return '';
                }catch(Exception $exception){
                    return '';
                }
            }

            /**
             * 缓存到本地
             *
             * @return int
             */
            public function save()
            {
                $content                = self::CACHE_FILE_TEMPLATE;
                $content['expiredTime'] = $this->_data['expiredTime'];
                $content['data']        = $this->_data['data'];
                try{
                    mkdir(dirname($this->_data['file']), false);
                }catch(Exception $error){
                }
                try{
                    $file = fopen($this->_data['file'], 'w');
                    fwrite($file, json_encode($content));
                    fclose($file);
                }catch(Exception $error){
                    return 0;
                }

                return 1;
            }
        }

        interface Sender
        {
            /**
             * @param string $url    请求地址
             * @param array  $option 额外参数
             *
             * @return string
             */
            public function get(string $url, array $option = []);

            /**
             * @param string $url    请求地址
             * @param array  $option 额外参数
             *
             * @return string
             */
            public function post(string $url, array $option = []);
        }

        interface TypeConverter
        {
            /**
             * 将对象转为数组
             *
             * @param object|array $object 需要转换的对象
             *
             * @return array 转化为数组后的数据
             */
            public static function parseObjectToArray($object);
        }

        class K3WebServiceApi extends K3Exception
        {
            /** @var string 用户 */
            private $_user = '';
            /** @var string 密码 */
            private $_password = '';
            /** @var string 账套 */
            private $_account = '';
            /** @var array 配置 */
            private $_config = [
                'protocol' => DEFAULT_PROTOCOL, // 协议
                'host'     => DEFAULT_HOST // 主机地址
            ];
            /** @var null|TypeConverter */
            private $_typeObject = null;

            /**
             * K3WebServiceApi constructor.
             * # $option参数键值说明如下。
             * * user => [string] 用户名
             * * password => [string] 密码
             * * account => [string] 账套
             * * host => [string] 主机地址（若包含端口号则需要端口号）
             * * protocol => [string] 协议
             *
             * @param TypeConverter $type_object
             * @param array         $option
             */
            public function __construct(TypeConverter $type_object, $option = [])
            {
                $this->_typeObject = $type_object;
                $this->setConfig($option);
            }

            /**
             * 设定接口配置
             * # $option参数键值说明如下。
             * * user => [string] 用户名
             * * password => [string] 密码
             * * account => [string] 账套
             * * host => [string] 主机地址（若包含端口号则需要端口号）
             * * protocol => [string] 协议
             *
             * @param $config
             */
            public function setConfig($config)
            {
                if(isset($config['user']) && is_string($config['user'])) $this->_user = $config['user'];
                if(isset($config['password']) && is_string($config['password'])) $this->_password = $config['password'];
                if(isset($config['account']) && is_string($config['account'])) $this->_account = $config['account'];
                if(isset($config['host']) && is_string($config['host'])) $this->_config['host'] = $config['host'];
                if(isset($config['protocol']) && is_string($config['protocol'])) $this->_config['protocol'] = $config['protocol'];
            }

            /**
             * @return array
             */
            public function getConfig()
            {
                return [
                    'user'     => $this->_user,
                    'password' => $this->_password,
                    'account'  => $this->_account,
                    'host'     => $this->_config['host'],
                    'protocol' => $this->_config['protocol']
                ];
            }

            /**
             * 构建接口地址
             *
             * @param string $uri 接口URI地址
             *
             * @return string
             */
            private function _makeApiUrl($uri)
            {
                $protocol = $this->_config['protocol'];
                $host     = $this->_config['host'];
                $api_url  = "$protocol://$host/$uri";

                return $api_url;
            }

            /**
             * 获取账套列表
             *
             * @return array
             */
            public function getAccountList()
            {
                // 获取接口地址
                $api_url = $this->_makeApiUrl('KDWEBSERVICE/Public.asmx?wsdl');
                // 开始获取数据
                try{
                    $soap_object = new SoapClient($api_url);
                    $list        = $soap_object->__call('AisQuery', []);
                    $list        = $this->_typeObject::parseObjectToArray($list);
                    if(isset($list['AisQueryResult']['AisInfo'])){
                        $list = $list['AisQueryResult']['AisInfo'];
                    }
                    else $list = [];
                }catch(SoapFault $soap_fault){
                    $this->setError($soap_fault->getMessage(), $soap_fault->getCode());
                    $list = [];
                }catch(Exception $exception){
                    $this->setError($exception->getMessage(), $exception->getCode());
                    $list = [];
                }

                return $list;
            }

            /**
             * 获取账套类型
             *
             * @param null|int    $account_id 账号ID
             * @param null|string $user       用户名
             * @param null|string $password   密码
             *
             * @return string
             */
            public function getAccountType($account_id = null, $user = null, $password = null)
            {
                // 构建参数
                (function () use (&$account_id, &$user, &$password){
                    if($account_id === null) $account_id = $this->_user;
                    else $this->_account = $account_id;
                    if($user === null) $user = $this->_user;
                    else $this->_user = $user;
                    if($password === null) $password = $this->_password;
                    else $this->_password = $password;
                })();
                // 获取接口地址
                $api_url = $this->_makeApiUrl('KDWEBSERVICE/Public.asmx?wsdl');
                // 开始获取数据
                try{
                    $soap_object = new SoapClient($api_url);
                    $list        = $soap_object->__soapCall('GetAisType', [
                        'in' => [
                            'iAisID'      => $account_id,
                            'strUser'     => $user,
                            'strPassword' => $password,
                        ]
                    ]);
                    $list        = $this->_typeObject::parseObjectToArray($list);
                }catch(SoapFault $soap_fault){
                    $this->setError($soap_fault->getMessage(), $soap_fault->getCode());
                    $list = [];
                }catch(Exception $exception){
                    $this->setError($exception->getMessage(), $exception->getCode());
                    $list = [];
                }

                return $list;
            }

            /**
             * 获取币种
             *
             * @param int         $page_count 每页显示的数目
             * @param string      $sql_filter 标准的Sql条件查询语句
             * @param null|int    $account_id 账号ID
             * @param null|string $user       用户名
             * @param null|string $password   密码             *
             *
             * @return array
             */
            public function getCurrency($page_count = 20, $sql_filter = '', $account_id = null, $user = null, $password = null)
            {
                // 构建参数
                (function () use (&$account_id, &$user, &$password){
                    if($account_id === null) $account_id = $this->_user;
                    else $this->_account = $account_id;
                    if($user === null) $user = $this->_user;
                    else $this->_user = $user;
                    if($password === null) $password = $this->_password;
                    else $this->_password = $password;
                })();
                // 获取接口地址
                $api_url = $this->_makeApiUrl('KDWEBSERVICE/Currency.asmx?wsdl');
                // 开始获取数据
                try{
                    $soap_object = new SoapClient($api_url);
                    $list        = $soap_object->__call('Query', [
                        'in' => [
                            'iAisID'      => $account_id,
                            'strUser'     => $user,
                            'strPassword' => $password,
                            'iPerCount'   => $page_count,
                            'strFilter'   => $sql_filter
                        ]
                    ]);
                    $list        = $this->_typeObject::parseObjectToArray($list);
                }catch(SoapFault $soap_fault){
                    $this->setError($soap_fault->getMessage(), $soap_fault->getCode());
                    $list = [];
                }catch(Exception $exception){
                    $this->setError($exception->getMessage(), $exception->getCode());
                    $list = [];
                }

                return $list;
            }

            /**
             * 获取供应商
             *
             * @param int         $page_count 每页显示的数目
             * @param string      $sql_filter 标准的Sql条件查询语句
             * @param null|int    $account_id 账号ID
             * @param null|string $user       用户名
             * @param null|string $password   密码             *
             *
             * @return array
             */
            public function getSupplier($page_count = 20, $sql_filter = '', $account_id = null, $user = null, $password = null)
            {
                // 构建参数
                (function () use (&$account_id, &$user, &$password){
                    if($account_id === null) $account_id = $this->_user;
                    else $this->_account = $account_id;
                    if($user === null) $user = $this->_user;
                    else $this->_user = $user;
                    if($password === null) $password = $this->_password;
                    else $this->_password = $password;
                })();
                // 获取接口地址
                $api_url = $this->_makeApiUrl('KDWEBSERVICE/Supplier.asmx?wsdl');
                // 开始获取数据
                try{
                    $soap_object = new SoapClient($api_url);
                    $list        = $soap_object->__call('Query', [
                        'in' => [
                            'iAisID'      => $account_id,
                            'strUser'     => $user,
                            'strPassword' => $password,
                            'iPerCount'   => $page_count,
                            'strFilter'   => $sql_filter
                        ]
                    ]);
                    $list        = $this->_typeObject::parseObjectToArray($list);
                }catch(SoapFault $soap_fault){
                    $this->setError($soap_fault->getMessage(), $soap_fault->getCode());
                    $list = [];
                }catch(Exception $exception){
                    $this->setError($exception->getMessage(), $exception->getCode());
                    $list = [];
                }

                return $list;
            }
        }

        class K3Exception extends Exception
        {
            private $_errorTrace = [];

            /**
             * 设定错误
             *
             * @param string     $message 错误信息
             * @param int|string $code    错误码
             */
            public function setError($message, $code)
            {
                $this->_errorTrace[] = ['code' => $code, 'message' => $message];
            }

            /**
             * 获取错误
             *
             * @param bool $new 是否获取最新的错误信息
             *
             * @return array
             */
            public function getError($new = true)
            {
                if($new) return end($this->_errorTrace);
                else return $this->_errorTrace;
            }
        }
    }