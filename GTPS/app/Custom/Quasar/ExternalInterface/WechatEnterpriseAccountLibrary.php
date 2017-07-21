<?php
	/*
	 * 更新日志
	 *
	 * Version 1.00 2016-03-30 10:52
	 * 初始版本
	 *
	 * Version 1.01 2017-02-13 14:36
	 * 更新注释
	 */

	namespace Quasar\ExternalInterface\Wechat;

	use Exception;
	use Quasar\Utility\Curl;
	use Quasar\Utility\Type;
	use stdClass;

	header("Content-type:text/html; charset=utf-8");

	interface EnterpriseAccountNativeAPI{
		/** 接口状态索引值 */
		const STATUS_INDEX = 'errcode';
		/** 接口调用成果结果值 */
		const STATUS_SUCCESS = 0;
		/** 消息发送的状态 */
		const SEND_STATUS = [
			0 => '发送失败',
			1 => '发送成功',
			2 => '未知状态'
		];
		/** 消息类型 */
		const MESSAGE_TYPE = [
			'news'         => 'news', // (临时)图文
			'mpNews'       => 'mpnews', // 存储在微信后台的图文信息
			'mpNewsManual' => 'mpnewsmanual', // 手动编写的图文信息
			'text'         => 'text', // 文本
			'voice'        => 'voice', // 语音
			'music'        => 'music', // 音乐
			'image'        => 'image', // 图片
			'video'        => 'video', // 视频
			'file'         => 'file', // 文件
		];
		/** 用户类型为成员 */
		const ID_TYPE_USER_ID = 1;
		/** 用户类型为非成员 */
		const ID_TYPE_OPEN_ID = 2;
		/** 用户授权模式 */
		const USER_VERIFY_SCOPE = [
			'base' => 'snsapi_base',
			'full' => 'snsapi_userinfo',
			'priv' => 'snsapi_privateinfo'
		];

		/**
		 * 获取access_token
		 *
		 * @param null|string $cache_path 凭据缓存路径
		 *
		 * @return array|string 成功则返回access_token，否则返回错误信息
		 */
		public function getAccessToken($cache_path = null);

		/**
		 * 获取jsapi_ticket
		 *
		 * @param null|string $cache_path   凭据缓存路径
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array|string 成功则返回jsapi_ticket，否则返回错误信息
		 */
		public function getJSAPITicket($cache_path = null, $access_token = null);

		/**
		 * 获取code
		 * *这里做了页面的定向跳转，且需要被调用的页面在微信中打开！
		 * *回调地址中将会携带code参数
		 *
		 * @param string       $url      回调地址
		 * @param string       $data     附带数据
		 * @param mixed|string $scope    应用授权作用域<br>参考本类常量USER_VERIFY_SCOPE
		 * @param int|string   $agent_id 应用ID
		 * @param string       $corp_id  企业号的corpid
		 *
		 * @return
		 */
		public function getCode($url, $data = '', $scope = self::USER_VERIFY_SCOPE['base'], $agent_id = 0, $corp_id = null);

		/**
		 * 获取成员id<br>
		 * *有是否为企业成员的区别
		 *
		 * @param string      $code         换取用户信息的code
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 若成功则返回以type索引的类型值【1表示企业成员，0表示非企业成员】，以id索引的成员id值
		 *               否则返回错误信息
		 */
		public function getUserID($code, $access_token = null);

		/**
		 * 通过UserTicket获得
		 *
		 * @param string      $user_ticket  成员票据
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array
		 */
		public function getUserDetail($user_ticket, $access_token = null);

		/**
		 * 获取成员信息<br>
		 * 通过UserID获得
		 *
		 * @param int         $user_id      企业成员id
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回成员信息和接口调用结果
		 */
		public function getUserInformation($user_id, $access_token = null);

		/**
		 * 进行二次验证
		 *
		 * @param int         $user_id      企业成员id
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回接口调用结果
		 */
		public function checkUser($user_id, $access_token = null);

		/**
		 * 更新成员信息
		 *
		 * @param int         $user_id      企业成员id
		 * @param array       $data         需要保存到用户信息的数据<br>
		 *                                  可指定的键值如下：<br>
		 *                                  [<br>
		 *                                  "name": "李四", //成员名称。长度为0~64个字节<br>
		 *                                  "department"=>[1,2,3], //成员所属部门id列表，不超过20个<br>
		 *                                  "position"=> "后台工程师", //职位信息。长度为0~64个字节<br>
		 *                                  "mobile"=> "15913215421", //手机号码。企业内必须唯一，mobile/weixinid/email三者不能同时为空<br>
		 *                                  "gender"=> "1", //性别。1表示男性，2表示女性<br>
		 *                                  "email"=> "zhangsan@gzdev.com", //邮箱。长度为0~64个字节。企业内必须唯一<br>
		 *                                  "weixinid"=> "lisifordev", //微信号。企业内必须唯一。（注意：是微信号，不是微信的名字）<br>
		 *                                  "enable": 1, //启用/禁用成员。1表示启用成员，0表示禁用成员<br>
		 *                                  "avatar_mediaid": "2-G6nrLmr5EC3MNb_-zL1dDdzkd0p7cNliYu9V5w7o8K0",<br>
		 *                                  //成员头像的mediaid，通过多媒体接口上传图片获得的mediaid<br>
		 *                                  "extattr":<br>
		 *                                  {"attrs":[{"name":"爱好","value":"旅游"},{"name":"卡号","value":"1234567234"}]}<br>
		 *                                  //扩展属性。扩展属性需要在WEB管理端创建后才生效，否则忽略未知属性的赋值<br>
		 *                                  ]
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function saveUser($user_id, $data, $access_token = null);

		/**
		 * 企业号成员id和微信openid的相互转换
		 * *若不是企业成员，使用openid获取userid会提示openid非法
		 *
		 * @param int|string  $id           userid或openid
		 * @param int         $type         转换类型【1表示通过userid获取openid，0表示通过openid获取userid】
		 * @param null|int    $agent_id     需要发送红包的应用id，若只是使用微信支付和企业转账，则无需该参数
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return bool|string|int|array 若成功则返回相应的id值，否则返回错误信息或者$type参数赋值不正确直接返回false
		 */
		public function parseID($id, $type, $agent_id = null, $access_token = null);

		/**
		 * 获取部门列表
		 *
		 * @param int         $id           部门id号（根部门为1）
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回部门列表数据和接口调用结果
		 */
		public function getDepartmentList($id = 1, $access_token = null);

		/**
		 * 获取部门下的用户列表
		 *
		 * @param int         $id           部门id号（根部门为1）
		 * @param int         $fetch_child  是否递归获取子部门下面的成员。枚举为[0,1]
		 * @param int         $status       0获取全部成员
		 *                                  1获取已关注成员列表
		 *                                  2获取禁用成员列表
		 *                                  4获取未关注成员列表
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和员工列表
		 */
		public function getUserList($id, $fetch_child = 1, $status = 0, $access_token = null);

		/**
		 * 获取标签列表
		 *
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getTagList($access_token = null);

		/**
		 * 根据标签获取用户信息
		 *
		 * @param int         $tag_id       标签id
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getUserByTag($tag_id, $access_token = null);

		/**
		 * 发送消息
		 *
		 * @param string       $type         消息类型，详见本类MESSAGE_TYPE常量
		 * @param array|string $data         传递的数据，具体参照对应的消息类型所需的数据
		 * @param int          $agent_id     应用ID
		 * @param array        $receiver     接收者信息
		 *                                   枚举为[
		 *                                   'user'=>[string, string, string, ...],
		 *                                   'dept'=>[string, string, string, ...],
		 *                                   'tag'=>[string, string, string, ...]
		 *                                   ]
		 * @param int          $safe         是否保密消息，枚举为0|1
		 * @param null|string  $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function sendMessage($type, $data, $agent_id, $receiver, $safe = 0, $access_token = null);

		/**
		 * 获取临时媒体文件
		 *
		 * @param string      $media_id     媒体文件ID
		 * @param bool        $download     是否下载文件
		 * @param string|null $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getMediaTemporary($media_id, $download = false, $access_token = null);

		/**
		 * 获取媒体文件总数
		 *
		 * @param string|null $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getMediaCount($access_token = null);

		/**
		 * 获取永久素材列表
		 *
		 * @param string      $type         素材类型 可为mpnews（图文）、image（图片）、voice（音频）、video（视频）、file（文件）
		 * @param int         $offset       偏移量
		 * @param int         $count        返回数量
		 * @param string|null $access_token 接口调用凭证
		 *
		 * @return mixed
		 */
		public function getMediaList($type, $offset = 0, $count = 50, $access_token = null);

		/**
		 * 获取永久媒体文件
		 *
		 * @param string      $media_id     媒体文件ID
		 * @param bool        $download     是否下载文件
		 * @param string|null $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getMedia($media_id, $download = false, $access_token = null);

		/**
		 * 获取自定义菜单
		 *
		 * @param int         $agent_id     应用ID
		 * @param string|null $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getMenu($agent_id, $access_token = null);

		/**
		 * 获取应用列表
		 *
		 * @param string|null $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getAppList($access_token = null);

		/**
		 * 获取应用详情
		 *
		 * @param int         $agent_id     应用ID
		 * @param string|null $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getApp($agent_id, $access_token = null);
	}

	/**
	 * 封装了微信企业号接口的方法集合<br>
	 * <br>
	 * CreateTime: 2016-03-30 10:52<br>
	 * ModifyTime: 2017-02-13 14:36<br>
	 *
	 * @author  Quasar (lelouchcctony@163.com)
	 * @see     Curl
	 * @see     Type
	 * @version 1.01
	 */
	class EnterpriseAccountLibrary implements EnterpriseAccountNativeAPI{
		private $_config = [
			'corpID'     => null, // 企业号corpid
			'corpSecret' => null // 企业号corpsecret
		];

		/**
		 * EnterpriseAccountLibrary constructor.
		 * 用于初始化公众号的基本配置信息
		 *
		 * @param null|string $corp_id     企业号的corpid
		 * @param null|string $corp_secret 企业号的corpsecret
		 */
		public function __construct($corp_id = null, $corp_secret = null){
			if($corp_id != null) $this->_config['corpID'] = $corp_id;
			if($corp_secret != null) $this->_config['corpSecret'] = $corp_secret;
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			通用
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		/**
		 * 返回企业号的基本参数配置
		 *
		 * @return array 格式为['corpID'=>string, 'corpSecret'=>string]
		 */
		public function getConfigs(){
			return $this->_config;
		}

		/**
		 * 手动设置corpid
		 *
		 * @param string $corp_id 企业号的corpid
		 */
		public function setCorpID($corp_id){
			$this->_config['corpID'] = $corp_id;
		}

		/**
		 * 手动设置corpsecret
		 *
		 * @param string $corp_secret 企业号的corpsercet
		 */
		public function setCorpSecret($corp_secret){
			$this->_config['corpSecret'] = $corp_secret;
		}

		/**
		 * 发送post请求
		 *
		 * @param string $api_url   接口地址
		 * @param array  $post_data 传递数据
		 * @param array  $config    Curl配置
		 *
		 * @return array
		 */
		private function _postRequest($api_url, $post_data, $config = []){
			$isJSONString = function ($str){
				return !is_null(json_decode($str));
			};
			$curl_obj     = new Curl();
			$native_str   = $curl_obj->post($api_url, array_merge(['data' => $post_data], $config));

			return $isJSONString($native_str) ? $this->_makeResult($native_str) : ['data' => $native_str];
		}

		/**
		 * 发送get请求
		 *
		 * @param string $api_url 接口地址
		 * @param array  $config  Curl配置
		 *
		 * @return array 请求结果
		 */
		private function _getRequest($api_url, $config = []){
			$isJSONString = function ($str){
				return !is_null(json_decode($str));
			};
			$curl_obj     = new Curl();
			$native_str   = $curl_obj->get($api_url, $config);

			return $isJSONString($native_str) ? $this->_makeResult($native_str) : ['data' => $native_str];
		}

		/**
		 * 统一输出原生接口返回数据
		 *
		 * @param string $native_result 原生接口返回字符串
		 *
		 * @return array status索引的接口调用状态<br>
		 *                data索引的接口数据<br>
		 *                nativeStr索引的接口原生字符串
		 */
		private function _makeResult($native_result){
			if(is_string($native_result)){
				// 若传入数据为原生字符串
				try{
					$result = json_decode($native_result);
				}catch(Exception $error){
					$result = new stdClass();
				}
			}
			else $result = $native_result;
			/**
			 * 获取调用状态
			 *
			 * @param string|object $data 接口返回数据
			 *
			 * @return bool
			 */
			$getStatus   = function ($data){
				if(gettype($data) == 'string') $data = json_decode($data);
				$var_obj  = new Type();
				$data_arr = $var_obj->parseObjectToArray($data);
				if(isset($data_arr[self::STATUS_INDEX])){
					if($data_arr[self::STATUS_INDEX] == self::STATUS_SUCCESS) return true;
					else return false;
				}
				else{
					return true;
				}
			};
			$type_object = new Type();

			return [
				'status'    => $getStatus($result),
				'data'      => $type_object->parseObjectToArray($result),
				'nativeStr' => $native_result
			];
		}

		public function getAccessToken($cache_path = null){
			$cache_obj = new EnterpriseAccountCache($this->_config['corpID'], EnterpriseAccountCache::TYPE_ACCESS_TOKEN, $cache_path);
			if($cache_obj->isExpired()){
				$response = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=".$this->_config['corpID']."&corpsecret=".$this->_config['corpSecret']);
				if($response['status']){
					$cache_obj->saveCacheData(json_encode([
						'accessToken' => $response['data']['access_token'],
						'expiredTime' => time()+$cache_obj::CONFIG_EXPIRED_TIME
					]));

					return $response['data']['access_token'];
				}
				else{
					if($cache_obj->isLimited($response['data'])) return $response['data']['errmsg'];
					else return $response['data'];
				}
			}
			else{
				return $cache_obj->readCacheData();
			}
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			网页
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getCode($url, $data = '', $scope = self::USER_VERIFY_SCOPE['base'], $agent_id = 0, $corp_id = null){
			if($corp_id === null) $corp_id = $this->_config['corpID'];
			$url  = urlencode($url);
			$data = urlencode((string)$data);
			header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=$corp_id&redirect_uri=$url&response_type=code&scope=$scope&agentid=$agent_id&state=$data#wechat_redirect");
		}

		public function getUserID($code, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=$access_token&code=$code");
			if($response['status']){
				if(isset($response['data']['UserId'])){
					$result = [
						'userID'     => $response['data']['UserId'],
						'deviceID'   => $response['data']['DeviceId'],
						'userTicket' => $response['data']['user_ticket'],
						'type'       => self::ID_TYPE_USER_ID,
					];

					return $result;
				}
				if(isset($response['data']['OpenId'])){
					$result = [
						'openID'     => $response['data']['OpenId'],
						'deviceID'   => $response['data']['DeviceId'],
						'userTicket' => $response['data']['user_ticket'],
						'type'       => self::ID_TYPE_OPEN_ID,
					];

					return $result;
				}
			}
			else{
				return $response['data'];
			}

			return $response['data'];
		}

		/**
		 * 获取当前微信账号的信息
		 *
		 * @param string $opt_str                 额外参数
		 * @param string $scope                   应用授权作用域<br>参考本类常量USER_VERIFY_SCOPE
		 * @param int    $agent_id                应用ID
		 * @param bool   $is_get_full_information 是否获取详情信息
		 * @param string $corp_id                 企业号的corpid
		 *
		 * @return array|mixed 若成功对应数据，否则返回null
		 */
		public function getUserFullSet($opt_str = '', $scope = self::USER_VERIFY_SCOPE['base'], $agent_id = 0, $is_get_full_information = false, $corp_id = null){
			if(isset($_GET['code'])){
				$code     = $_GET['code'];
				$response = $this->getUserID($code);
				if($is_get_full_information){
					if(in_array($scope, [self::USER_VERIFY_SCOPE['priv'], self::USER_VERIFY_SCOPE['full']])){
						$result              = $this->getUserDetail($response['userTicket']);
						$result['type']      = $response['type'];
						$result['device_id'] = $response['deviceID'];
						$response            = $result;
					}
					elseif(isset($response['userID'])){
						$result              = $this->getUserInformation($response['userID']);
						$result['type']      = $response['type'];
						$result['device_id'] = $response['deviceID'];
						$response            = $result;
					}
				}

				return $response;
			}
			else{
				if($corp_id === null) $corp_id = $this->_config['corpID'];
				$redirect_url = ("$_SERVER[REDIRECT_URL]");
				$this->getCode($redirect_url, $opt_str, $scope, $agent_id, $corp_id);
				exit;
			}
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			自定义菜单
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getMenu($agent_id, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/menu/get?access_token=$access_token&agentid=$agent_id");

			return $response['data'];
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			企业应用
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getApp($agent_id, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/agent/get?access_token=$access_token&agentid=$agent_id");

			return $response['data'];
		}

		public function getAppList($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/agent/list?access_token=$access_token");

			return $response['data'];
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			消息
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function sendMessage($type, $data, $agent_id, $receiver, $safe = 0, $access_token = null){
			error_reporting(E_ALL|E_STRICT);
			ini_set('display_errors', false);
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$post_data    = [
				'agentid' => $agent_id
			];
			if(isset($receiver['user'])){
				if(is_array($receiver['user'])) $post_data = array_merge($post_data, ['touser' => implode('|', $receiver['user'])]);
				if(is_string($receiver['user'])) $post_data = array_merge($post_data, ['touser' => $receiver['user']]);
			}
			if(isset($receiver['dept'])){
				if(is_array($receiver['dept'])) $post_data = array_merge($post_data, ['toparty' => implode('|', $receiver['dept'])]);
				if(is_string($receiver['dept'])) $post_data = array_merge($post_data, ['toparty' => $receiver['dept']]);
			}
			if(isset($receiver['tag'])){
				if(is_array($receiver['tag'])) $post_data = array_merge($post_data, ['totag' => implode('|', $receiver['tag'])]);
				if(is_string($receiver['tag'])) $post_data = array_merge($post_data, ['totag' => $receiver['tag']]);
			}
			switch(strtolower($type)){
				case self::MESSAGE_TYPE['text']:
					$post_data = array_merge($post_data, [
						'msgtype' => 'text',
						'text'    => ['content' => $data],
						'safe'    => $safe
					]);
				break;
				case self::MESSAGE_TYPE['image']:
				case self::MESSAGE_TYPE['voice']:
				case self::MESSAGE_TYPE['file']:
				case self::MESSAGE_TYPE['mpNews']:
					$post_data = array_merge($post_data, [
						'msgtype' => $type,
						$type     => ['media_id' => $data['media_id']],
						'safe'    => $safe
					]);
				break;
				case self::MESSAGE_TYPE['video']:
					$post_data = array_merge($post_data, [
						'msgtype' => 'video',
						'voice'   => [
							'media_id'    => $data['media_id'],
							'title'       => $data['title'],
							'description' => $data['description']
						],
						'safe'    => $safe
					]);
				break;
				case self::MESSAGE_TYPE['news']:
					$article_list = [];
					for($i = 0; $i<count($data); $i++){
						array_push($article_list, [
							'title'       => $data[$i]['title'],
							'description' => $data[$i]['description'],
							'url'         => $data[$i]['url'],
							'picurl'      => $data[$i]['picurl']
						]);
					}
					$post_data = array_merge($post_data, [
						'msgtype' => 'news',
						'news'    => ['articles' => $article_list]
					]);
				break;
				case self::MESSAGE_TYPE['mpNewsManual']:
					$article_list = [];
					for($i = 0; $i<count($data); $i++){
						array_push($article_list, [
							'title'              => $data[$i]['title'],
							'thumb_media_id'     => $data[$i]['thumb_media_id'],
							'author'             => $data[$i]['author'],
							'content_source_url' => $data[$i]['content_source_url'],
							'content'            => $data[$i]['content'],
							'digest'             => $data[$i]['digest'],
							'show_cover_pic'     => $data[$i]['show_cover_pic']
						]);
					}
					$post_data = array_merge($post_data, [
						'msgtype' => 'mpnews',
						'mpnews'  => ['articles' => $article_list],
						'safe'    => $safe
					]);
				break;
				default:
					return null;
				break;
			}
			$response = $this->_postRequest("https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=$access_token", json_encode($post_data, JSON_UNESCAPED_UNICODE));

			return $response;
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			部门&成员
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getDepartmentList($id = 1, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token=$access_token&id=$id");

			return $response['data'];
		}

		public function saveUser($user_id, $data, $access_token = null){
			$access_token   = $access_token == null ? $this->getAccessToken() : $access_token;
			$data['userid'] = $user_id;
			$response       = $this->_postRequest("https://qyapi.weixin.qq.com/cgi-bin/user/update?access_token=$access_token", json_encode($data));

			return $response['data'];
		}

		public function getUserList($id, $fetch_child = 1, $status = 0, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token=$access_token&department_id=$id&fetch_child=$fetch_child&status=$status");

			return $response['data'];
		}

		public function getUserInformation($user_id, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token=$access_token&userid=$user_id");

			return $response['data'];
		}

		public function getUserDetail($user_ticket, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://qyapi.weixin.qq.com/cgi-bin/user/getuserdetail?access_token=$access_token", json_encode([
				'user_ticket' => $user_ticket
			]));

			return $response['data'];
		}

		public function parseID($id, $type, $agent_id = null, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			switch($type){
				case 0:
					$response = $this->_postRequest("https://qyapi.weixin.qq.com/cgi-bin/user/convert_to_userid?access_token=$access_token", json_encode(['openid' => $id]));
					if($response['status']) return $response['data']['userid'];
					else return $response['data'];
				break;
				case 1:
					$response = $this->_postRequest("https://qyapi.weixin.qq.com/cgi-bin/user/convert_to_openid?access_token=$access_token", json_encode([
						'userid'  => $id,
						'agentid' => $agent_id
					]));
					if($response['status']) return $response['data']['openid'];
					else return $response['data'];
				break;
				default:
					return false;
			}
		}

		public function checkUser($user_id, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/user/authsucc?access_token=$access_token&userid=$user_id");

			return $response['data'];
		}

		public function getTagList($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/tag/list?access_token=$access_token");

			return $response['data'];
		}

		public function getUserByTag($tag_id, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/tag/get?access_token=$access_token&tagid=$tag_id");

			return $response['data'];
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			JSApi
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		/**
		 * 获取签名字符串
		 *
		 * @param string      $random_str 随机字符串
		 * @param int         $cur_time   当前时间戳
		 * @param null|string $url        当前网页的URL
		 *
		 * @return string
		 */
		public function getSignature($random_str, $cur_time, $url = null){
			$url          = $url == null ? "$_SERVER[REQUEST_SCHEME]://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" : $url;
			$jsapi_ticket = $this->getJSAPITicket();
			$config       = [
				'noncestr'     => $random_str,
				'jsapi_ticket' => $jsapi_ticket,
				'timestamp'    => $cur_time,
				'url'          => $url
			];
			ksort($config);
			$str = '';
			foreach($config as $key => $val) $str .= $key.'='.$val.'&';

			return sha1(trim($str, "&"));
		}

		public function getJSAPITicket($cache_path = null, $access_token = null){
			$cache_obj    = new EnterpriseAccountCache($this->_config['corpID'], EnterpriseAccountCache::TYPE_JSAPI_TICKET, $cache_path);
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			if($cache_obj->isExpired()){
				$response = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$access_token");
				if($response['status']){
					$cache_obj->saveCacheData(json_encode([
						'jsApiTicket' => $response['data']['ticket'],
						'expiredTime' => time()+$cache_obj::CONFIG_EXPIRED_TIME
					]));

					return $response['data']['ticket'];
				}
				else{
					if($cache_obj->isLimited($response['data'])) return $response['data']['errmsg'];
					else return $response['data'];
				}
			}
			else{
				return $cache_obj->readCacheData();
			}
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			素材
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getMediaTemporary($media_id, $download = false, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$media_id", [
				'getHeader' => true
			]);
			if($download){
				preg_match('/filename=\"(\S+)\"/', $response['data']['header'], $match_arr);
				header("Content-Disposition: attachment; filename=\"$match_arr[1]\"");
				echo $response['data']['body'];

				return $response['data']['body'];
			}
			else return $response['data'];
		}

		public function getMediaCount($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/material/get_count?access_token=$access_token");

			return $response['data'];
		}

		public function getMediaList($type, $offset = 0, $count = 50, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://qyapi.weixin.qq.com/cgi-bin/material/batchget?access_token=$access_token", json_encode([
				'type'   => $type,
				'offset' => $offset,
				'count'  => $count
			]));

			return $response['data'];
		}

		public function getMedia($media_id, $download = false, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			if($download){
				$response = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/material/get?access_token=$access_token&media_id=$media_id", ['getHeader' => true]);
				preg_match('/filename=\"(\S+)\"/', $response['data']['header'], $match_arr);
				header("Content-Disposition: attachment; filename=\"$match_arr[1]\"");
				echo $response['data']['body'];

				return $response['data']['body'];
			}
			else{
				$response = $this->_getRequest("https://qyapi.weixin.qq.com/cgi-bin/material/get?access_token=$access_token&media_id=$media_id");

				return $response['data'];
			}
		}
	}

	/**
	 * Class EnterpriseAccountCache
	 * 用于提供检测和维护本地jsapi_ticket、access_token凭据的处理类
	 */
	class EnterpriseAccountCache{
		private $_data = [
			'expiredTime' => null, // 缓存文件的过期时间 （单位：秒）
			'data'        => null, // 缓存文件的内容
			'filePath'    => null, // 缓存文件路径
			'fileName'    => null // 缓存文件名
		];
		/** 缓存文件有效时间 */
		const CONFIG_EXPIRED_TIME = 7000;
		/** 缓存类型 access_token */
		const TYPE_ACCESS_TOKEN = 'access_token';
		/** 缓存类型 jsapi_ticket */
		const TYPE_JSAPI_TICKET = 'jsapi_ticket';
		private $_config = [
			'filePrefixOfAccessToken' => 'access_token_', // AccessToken前缀
			'filePrefixOfJSAPITicket' => 'jsapi_ticket_', // JSAPITicket前缀
			'fileSuffix'              => '.json', // 缓存后缀
			//			'cacheFolder'             => './.Wechat-Enterprise-Account-Cache', // 文件夹
			'cacheFolder'             => './Project/Runtime/Wechat-Enterprise-Cache', // 文件夹
			'type'                    => ''
		];

		/**
		 * 类构造函数，需要提供企业号的corpid作为参数传入
		 *
		 * @param string      $corp_id    企业号的corpid
		 * @param string      $type       凭据类型
		 * @param string|null $cache_path 缓存文件夹的路径
		 * @param string      $ext        文件名扩展串
		 */
		public function __construct($corp_id, $type, $cache_path = null, $ext = ''){
			if($cache_path != null) $this->_config['cacheFolder'] = $cache_path;
			switch($type){
				case self::TYPE_ACCESS_TOKEN:
				default:
					$this->_data['fileName'] = $this->_config['filePrefixOfAccessToken'];
					$this->_config['type']   = self::TYPE_ACCESS_TOKEN;
				break;
				case self::TYPE_JSAPI_TICKET:
					$this->_data['fileName'] = $this->_config['filePrefixOfJSAPITicket'];
					$this->_config['type']   = self::TYPE_JSAPI_TICKET;
				break;
			}
			$this->_data['fileName'] .= $corp_id.$ext.$this->_config['fileSuffix'];
			$this->_data['filePath'] = $this->_config['cacheFolder'].'/'.$this->_data['fileName'];
			$content                 = $this->_readFile();
			if($content){
				$content = json_decode($content);
				if($this->_config['type'] == self::TYPE_ACCESS_TOKEN){
					$this->_data['data']        = $content->accessToken;
					$this->_data['expiredTime'] = $content->expiredTime;
				}
				elseif($this->_config['type'] == self::TYPE_JSAPI_TICKET){
					$this->_data['data']        = $content->jsApiTicket;
					$this->_data['expiredTime'] = $content->expiredTime;
				}
			}
			else $this->_createNewFile();
		}

		/**
		 * 创建凭据所需的缓存文件夹和文件
		 *
		 * @return int 创建结果状态值[0,1,2]，分别表示未创建、只创建了文件、同时创建了文件夹和文件
		 */
		private function _createNewFile(){
			if(is_dir($this->_config['cacheFolder'])){
				if(is_file($this->_data['filePath'])) return 0;
				else{
					try{
						$file = fopen($this->_data['filePath'], 'w');
						fclose($file);

						return 1;
					}catch(Exception $Error){
						print_r($Error);

						return 1;
					}
				}
			}
			else{
				$r = mkdir($this->_config['cacheFolder']);
				if($r){
					try{
						$file = fopen($this->_data['filePath'], 'w');
						fclose($file);

						return 2;
					}catch(Exception $Error){
						print_r($Error);

						return 1;
					}
				}
				else return 0;
			}
		}

		/**
		 * 读取存储文件
		 *
		 * @return string 返回文件内容
		 */
		private function _readFile(){
			return @file_get_contents($this->_data['filePath']);
		}

		/**
		 * 获取凭据
		 *
		 * @return string 返回存储文件中的凭据
		 */
		public function readCacheData(){
			return $this->_data['data'];
		}

		/**
		 * 存储凭据至本地文件
		 *
		 * @param string $content 写入存储文件的内容
		 *
		 * @return int 存储成功返回1，否则返回0
		 */
		public function saveCacheData($content){
			try{
				$file = fopen($this->_data['filePath'], 'w');
				fwrite($file, $content);
				fclose($file);
			}catch(Exception $error){
				return 0;
			}

			return 1;
		}

		/**
		 * 清除本地的凭据缓存
		 *
		 * @return bool
		 */
		public function cleanCacheData(){
			return unlink($this->_data['filePath']);
		}

		/**
		 * 检测凭据是否过期（7200秒/个）
		 *
		 * @return bool 过期则返回true，不过期则返回false
		 */
		public function isExpired(){
			if($this->_data['expiredTime'] == null) return true;
			else{
				if($this->_data['expiredTime']<=time()) return true;
				else return false;
			}
		}

		/**
		 * 检测凭据是否超过每日限制（2000次/天）
		 *
		 * @param string $content 获取凭据接口的返回数据
		 *
		 * @return bool 超过则返回true，不超过则返回false
		 */
		public function isLimited($content){
			if($content['errcode'] == '45009') return true;
			else return false;
		}
	}