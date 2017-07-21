<?php
	/*
	 * 更新日志
	 *
	 * Version 1.00 2016-03-30 10:52
	 * 初始版本
	 *
	 * Version 1.01 2017-02-13 14:36
	 * 发送/获取媒体类型的检测规范
	 */

	namespace Quasar\ExternalInterface\Wechat;

	use Exception;
	use Quasar\Utility\Curl;
	use Quasar\Utility\Type;
	use stdClass;

	header("Content-type:text/html; charset=utf-8");

	interface OfficialAccountNativeAPI{
		/** 接口状态索引值 */
		const STATUS_INDEX = 'errcode';
		/** 接口调用成果结果值 */
		const STATUS_SUCCESS = 0;
		/** 消息类型 */
		const MESSAGE_TYPE = [
			'mpNews'  => 'mpnews', // 图文
			'text'    => 'text', // 文本
			'voice'   => 'voice', // 语音
			'music'   => 'music', // 音乐
			'image'   => 'image', // 图片
			'mpVideo' => 'mpvideo', // 视频
			'wxCard'  => 'wxCard', // 卡券
		];
		/** 素材类型 */
		const MEDIA_TYPE = [
			'image' => 'image', // 图片
			'video' => 'video', // 视频
			'voice' => 'voice', // 语音
			'news'  => 'news' // 图文
		];
		/** 统计关注来源类型 */
		const STATISTICS_TYPE = [
			0  => '其他',
			1  => '公众号搜素',
			17 => '名片分享',
			30 => '扫描二维码',
			43 => '图文页右上角菜单',
			51 => '支付后关注',
			57 => '图文页内公众号名称',
			75 => '公众号文章广告',
			78 => '朋友圈广告',
		];
		/** 消息发送的状态 */
		const SEND_STATUS = [
			0 => '发送失败',
			1 => '发送成功',
			2 => '未知状态'
		];
		/** 用户授权模式 */
		const USER_VERIFY_SCOPE = [
			'base' => 'snsapi_base',
			'full' => 'snsapi_userinfo'
		];

		/**
		 * 获取access_token
		 *
		 * @param null|string $cache_path 凭据缓存路径
		 *
		 * @return string 返回AccessToken
		 */
		public function getAccessToken($cache_path = null);

		/**
		 * 获取粉丝openid列表<br>
		 * *当公众号关注者数量超过10000时，可通过填写next_openid的值，从而多次拉取列表的方式来满足需求。<br>
		 * *具体而言，就是在调用接口时，将上一次调用得到的返回中的next_openid值，作为下一次调用中的next_openid值。
		 *
		 * @param null|string $next_openid  下一批的首个openid
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和openid列表
		 */
		public function getOpenIDList($next_openid = null, $access_token = null);

		/**
		 * 批量获取粉丝用户信息的列表
		 *
		 * @param array       $openid_list  需要获取信息的openid列表
		 * @param string      $lang         地区语言
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和openid对应的用户信息
		 */
		public function getBatchUserList($openid_list, $lang = 'zh-CN', $access_token = null);

		/**
		 * 根据openid获取粉丝信息（UnionID机制）
		 *
		 * @param string      $openid       需要获取信息的openid
		 * @param string      $lang         地区语言
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和openid对应的用户信息
		 */
		public function getUserInformationOfUnionID($openid, $lang = 'zh-CN', $access_token = null);

		/**
		 * 获取标签列表
		 *
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getTagList($access_token = null);

		/**
		 * 根据标签下的粉丝openid列表
		 *
		 * @param int         $tag_id       标签id
		 * @param null|string $next_openid  下一批的首个openid
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getOpenIDByTag($tag_id, $next_openid = null, $access_token = null);

		/**
		 * 根据openid获取粉丝的标签
		 *
		 * @param string      $openid       粉丝的openid
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getTagByOpenID($openid, $access_token = null);

		/**
		 * 获取素材列表
		 *
		 * @param string      $type         素材类型，参照self::MEDIA_TYPE
		 * @param int         $offset       从全部素材的该偏移位置开始返回
		 * @param int         $count        返回数量
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和素材列表信息
		 */
		public function getMediaList($type, $offset = 0, $count = 20, $access_token = null);

		/**
		 * 获取素材
		 *
		 * @param string      $media_id     素材id
		 * @param bool        $download     是否下载文件
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和素材列表信息
		 */
		public function getMedia($media_id, $download = false, $access_token = null);

		/**
		 * 获取素材总数
		 *
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getMediaCount($access_token = null);

		/**
		 * 获取自定义菜单
		 *
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和自定义菜单信息
		 */
		public function getMenu($access_token = null);

		/**
		 * 获取自定义菜单配置
		 *
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和自定义菜单信息
		 */
		public function getCustomMenu($access_token = null);

		/**
		 * 获取code
		 * *这里做了页面的定向跳转，且需要被调用的页面在微信中打开！
		 * *回调地址中将会携带code参数
		 *
		 * @param string       $url    回调地址
		 * @param mixed|string $mode   模式 可用值为本类常量USER_VERIFY_SCOPE<br>
		 *                             USER_VERIFY_SCOPE['base']：不弹出授权页面，直接跳转，只能获取用户openid<br><br>
		 *                             USER_VERIFY_SCOPE['full']：弹出授权页面，可获取用户相信信息，并且即使在未关注的情况下，只要用户授权，也能获取其信息<br>
		 * @param string       $data   附带数据
		 * @param string       $app_id 公众号的appid
		 *
		 * @return
		 */
		public function getCode($url, $mode = self::USER_VERIFY_SCOPE['base'], $data = '', $app_id = null);

		/**
		 * 通过code获取access_token或者openid
		 *
		 * @param string      $code       用户授权code码
		 * @param null|string $app_id     公众号的appid
		 * @param null|string $app_secret 公众号的appsecret
		 *
		 * @return array 返回调用结果
		 */
		public function useCode($code, $app_id = null, $app_secret = null);

		/**
		 * 根据openid获取粉丝信息
		 *
		 * @param string $access_token 接口调用凭证
		 * @param string $openid       需要获取信息的openid
		 * @param string $lang         地区语言
		 *
		 * @return array 返回调用结果和openid对应的用户信息
		 */
		public function getUserInformation($access_token, $openid, $lang = 'zh-CN');

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
		 * 获取行业
		 *
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getIndustry($access_token = null);

		/**
		 * 获取模板列表
		 *
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果和模板列表数据
		 */
		public function getMessageTemplateList($access_token = null);

		/**
		 * 设置行业
		 *
		 * @param int         $industry_1   行业1
		 * @param int         $industry_2   行业2
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function setIndustry($industry_1, $industry_2, $access_token = null);

		/**
		 * 发送模板消息
		 *
		 * @param string      $openid       接收者
		 * @param string      $template_id  模板ID
		 * @param array       $data         发送的数据<br>
		 *                                  格式需满足<br>
		 *                                  [<br>
		 *                                  　'first'=>['value'=>'', 'color'=>''],<br>
		 *                                  　'remark'=>['value'=>'', 'color'=>''],<br>
		 *                                  　'keyword1'=>['value'=>'', 'color'=>''],<br>
		 *                                  　'keyword2'=>['value'=>'', 'color'=>''],<br>
		 *                                  　'keyword3'=>['value'=>'', 'color'=>''].<br>
		 *                                  　'keyword4'=>['value'=>'', 'color'=>'']<br>
		 *                                  ]<br>
		 * @param string      $url          模板跳转链接
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function sendTemplateMessage($openid, $template_id, $data, $url = '', $access_token = null);

		/**
		 * 获取自动回复规则
		 *
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getReplyRule($access_token = null);

		/**
		 * 设定粉丝备注信息
		 *
		 * @param string      $openid       粉丝的openid
		 * @param string      $remark       备注名
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function setUserRemark($openid, $remark, $access_token = null);

		/**
		 * 获取黑名单数据
		 *
		 * @param string      $openid       起始openid
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getUserBlackList($openid = null, $access_token = null);

		/**
		 * 获取粉丝增减数据<br>
		 * *(时间跨度最长7天)
		 *
		 * @param string      $begin_date   开始日期（格式为Y-m-d）
		 * @param string      $end_date     结束日期（格式为Y-m-d）
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getUserSummary($begin_date, $end_date, $access_token = null);

		/**
		 * 获取粉丝累计数据<br>
		 * *(时间跨度最长7天)
		 *
		 * @param string      $begin_date   开始日期（格式为Y-m-d）
		 * @param string      $end_date     结束日期（格式为Y-m-d）
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getUserCumulate($begin_date, $end_date, $access_token = null);

		/**
		 * 获取消息发送状态
		 *
		 * @param string      $msg_id       消息id
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function getMessageSendStatus($msg_id, $access_token = null);

		/**
		 * 预览消息
		 *
		 * @param string      $type         消息类型，参照self::MESSAGE_TYPE
		 * @param mixed       $content      根据以上参数的设定决定该参数的内容<br>
		 *                                  包括media_id值、文本值
		 * @param string      $openid       指定预览消息的粉丝openid
		 * @param string|null $wechat_id    指定预览消息的粉丝微信号（若设定了该参数，将会以此参数发送而忽略上一参数）
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function previewMessage($type, $content, $openid, $wechat_id = null, $access_token = null);

		/**
		 * 通过粉丝openid发送消息
		 *
		 * @param string      $type                消息类型，参照self::MESSAGE_TYPE
		 * @param mixed       $content             根据以上参数的设定决定该参数的内容<br>
		 *                                         包括media_id值、文本值
		 * @param array       $openid_list         指定的接收消息的粉丝openid列表
		 * @param int         $send_ignore_reprint 待群发的文章被判定为转载时 是否继续群发 0：否 1：是
		 * @param null|string $access_token        接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function sendMessageByOpenid($type, $content, $openid_list, $send_ignore_reprint = 0, $access_token = null);

		/**
		 * 通过粉丝标签发送消息
		 *
		 * @param string      $type                参照self::MESSAGE_TYPE
		 * @param mixed       $content             根据以上参数的设定决定该参数的内容<br>
		 *                                         包括media_id值、文本值
		 * @param int         $tag_id              标签id
		 * @param bool        $to_all              是否全部发送
		 * @param int         $send_ignore_reprint 待群发的文章被判定为转载时 是否继续群发 0：否 1：是
		 * @param null|string $access_token        接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function sendMessageByTag($type, $content, $tag_id, $to_all = false, $send_ignore_reprint = 0, $access_token = null);

		/**
		 * 为粉丝打标签
		 *
		 * @param int         $tag_id       标签id
		 * @param array       $openid_list  粉丝openid列表
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function tagUser($tag_id, $openid_list, $access_token = null);

		/**
		 * 为粉丝取消标签
		 *
		 * @param int         $tag_id       标签id
		 * @param array       $openid_list  粉丝openid列表
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function antiTagUser($tag_id, $openid_list, $access_token = null);

		/**
		 * 创建标签
		 *
		 * @param string      $name         名称
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function createTag($name, $access_token = null);

		/**
		 * 删除标签
		 *
		 * @param int         $tag_id       标签id
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function deleteTag($tag_id, $access_token = null);

		/**
		 * 更新标签
		 *
		 * @param int         $tag_id       标签id
		 * @param string      $name         名称
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return array 返回调用结果
		 */
		public function updateTag($tag_id, $name, $access_token = null);

		/**
		 * 获取短链接
		 *
		 * @param string      $url          链接
		 * @param null|string $access_token 接口调用凭证
		 *
		 * @return string
		 */
		public function getShortUrl($url, $access_token = null);
	}

	/**
	 * 封装了微信公众号接口的方法集合<br>
	 * <br>
	 * CreateTime: 2016-03-30 10:52<br>
	 * ModifyTime: 2017-02-13 14:36<br>
	 *
	 * @author  Quasar (lelouchcctony@163.com)
	 * @see     Curl
	 * @see     Type
	 * @version 1.01
	 */
	class OfficialAccountLibrary implements OfficialAccountNativeAPI{
		private $_config = [
			'appID'     => null, // 公众号appid
			'appSecret' => null // 公众号appsecret
		];

		/**
		 * OfficialAccountLibrary constructor.
		 * 用于初始化公众号的基本配置信息
		 *
		 * @param null|string $app_id     公众号的appid
		 * @param null|string $app_secret 公众号的appsecret
		 */
		public function __construct($app_id = null, $app_secret = null){
			if($app_id != null) $this->_config['appID'] = $app_id;
			if($app_secret != null) $this->_config['appSecret'] = $app_secret;
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			通用
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		/**
		 * 返回公众号的基本参数配置
		 *
		 * @return array 格式为['appID'=>string, 'appSecret'=>string]
		 */
		public function getConfigs(){
			return $this->_config;
		}

		/**
		 * 手动设置appid
		 *
		 * @param string $app_id 公众号的appid
		 */
		public function setAppID($app_id){
			$this->_config['appID'] = $app_id;
		}

		/**
		 * 手动设置appsercet
		 *
		 * @param string $app_secret 公众号的appsercet
		 */
		public function setAppSecret($app_secret){
			$this->_config['appSecret'] = $app_secret;
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
			$cache_obj = new OfficialAccountCache($this->_config['appID'], OfficialAccountCache::TYPE_ACCESS_TOKEN, $cache_path);
			if($cache_obj->isExpired()){
				$response = $this->_getRequest('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->_config['appID'].'&secret='.$this->_config['appSecret']);
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
			用户
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getOpenIDList($next_openid = null, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/user/get?access_token=$access_token".($next_openid ? "&next_openid=$next_openid" : ''));

			return $response['status'] ? [
				'list'  => $response['data']['data']['openid'],
				'total' => $response['data']['total'],
				'count' => $response['data']['count'],
				'next'  => $response['data']['next_openid']
			] : $response['data'];
		}

		public function getBatchUserList($openid_list, $lang = 'zh-CN', $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$data         = ['user_list' => []];
			foreach($openid_list as $val) $data['user_list'][] = [
				'openid' => $val,
				'lang'   => $lang
			];
			$response = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=$access_token", json_encode($data));

			return $response['status'] ? $response['data']['user_info_list'] : $response['data'];
		}

		public function getUserInformationOfUnionID($openid, $lang = 'zh-CN', $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=$lang");

			return $response['data'];
		}

		public function getTagList($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$access_token");

			return $response['status'] ? $response['data']['tags'] : [];
		}

		public function getOpenIDByTag($tag_id, $next_openid = null, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=$access_token", json_encode([
				'tagid'       => $tag_id,
				'next_openid' => $next_openid
			]));

			return $response['data'];
		}

		public function getTagByOpenID($openid, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token=$access_token", json_encode([
				'openid' => $openid
			]));

			return $response['status'] ? $response['data']['tagid_list'] : [];
		}

		public function setUserRemark($openid, $remark, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=$access_token", json_encode([
				'openid' => $openid,
				'remark' => $remark
			]));

			return $response['data'];
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			素材
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getMediaList($type, $offset = 0, $count = 20, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			if(!in_array($type, self::MEDIA_TYPE)) return ['errcode' => 40004, "errmsg" => '类型错误'];
			$response = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=$access_token", json_encode([
				'type'   => $type,
				'offset' => $offset,
				'count'  => $count
			]));

			return $response['data'];
		}

		public function getMediaCount($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=$access_token");

			return $response['data'];
		}

		public function getMedia($media_id, $download = false, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			if($download){
				$response = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=$access_token", json_encode(['media_id' => $media_id]), ['getHeader' => true]);
				preg_match('/filename=\"(\S+)\"/', $response['data']['header'], $match_arr);
				header("Content-Disposition: attachment; filename=\"$match_arr[1]\"");
				echo $response['data']['body'];

				return $response['data']['body'];
			}
			else{
				$response = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=$access_token", json_encode(['media_id' => $media_id]));

				return $response['data'];
			}
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			自定义菜单
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getMenu($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/menu/get?access_token=$access_token");

			return $response['data'];
		}

		public function getCustomMenu($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=$access_token");

			return $response['data'];
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			网页授权
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getCode($url, $mode = self::USER_VERIFY_SCOPE['base'], $data = '', $app_id = null){
			if($app_id === null) $app_id = $this->_config['appID'];
			$data  = urlencode((string)$data);
			$url   = urlencode($url);
			$scope = $mode;
			header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=$app_id&redirect_uri=$url&response_type=code&scope=$scope&state=$data#wechat_redirect");
		}

		public function useCode($code, $app_id = null, $app_secret = null){
			if($app_id === null) $app_id = $this->_config['appID'];
			if($app_secret === null) $app_secret = $this->_config['appSecret'];
			$response = $this->_getRequest("https://api.weixin.qq.com/sns/oauth2/access_token?appid=$app_id&secret=$app_secret&code=$code&grant_type=authorization_code");

			return $response['data'];
		}

		public function getUserInformation($access_token, $openid, $lang = 'zh-CN'){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=$lang");

			return $response['data'];
		}

		/**
		 * 直接获取当前微信账号的信息
		 *
		 * @param int         $mode       模式 0：只获取openid 1：获取用户信息
		 * @param string      $opt_str    额外参数
		 * @param null|string $app_id     公众号的appid
		 * @param null|string $app_secret 公众号的appsecret
		 *
		 * @return null|array 若成功则返回相关信息，否则返回null
		 */
		public function getUserFullSet($mode = self::USER_VERIFY_SCOPE['base'], $opt_str = '', $app_id = null, $app_secret = null){
			if(isset($_GET['code'])){
				$code     = $_GET['code'];
				$response = $this->useCode($code, $app_id, $app_secret);
				if(isset($response['openid'])){
					if($mode == self::USER_VERIFY_SCOPE['base']) return ['openid' => $response['openid']];
					elseif($mode == self::USER_VERIFY_SCOPE['full']) return $this->getUserInformation($response['access_token'], $response['openid']);
					else return null;
				}
				else return null;
			}
			else{
				if($app_id === null) $app_id = $this->_config['appID'];
				$redirect_url = "$_SERVER[REQUEST_SCHEME]://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$this->getCode($redirect_url, $mode, $opt_str, $app_id);
				exit;
			}
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			JSAPI
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
		 * @return string 返回签名字符串
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
			$cache_obj    = new OfficialAccountCache($this->_config['appID'], OfficialAccountCache::TYPE_JSAPI_TICKET, $cache_path);
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			if($cache_obj->isExpired()){
				$response = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$access_token&type=jsapi");
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
			消息
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getIndustry($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=$access_token");

			return $response['data'];
		}

		public function getMessageTemplateList($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=$access_token");

			return $response['status'] ? $response['data']['template_list'] : [];
		}

		public function sendTemplateMessage($openid, $template_id, $data, $url = '', $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token", json_encode([
				'touser'      => $openid,
				'template_id' => $template_id,
				'url'         => $url,
				'data'        => $data
			]));

			return $response['data'];
		}

		public function getMessageSendStatus($msg_id, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token=$access_token", json_encode([
				'msg_id' => $msg_id,
			]));

			return $response['data'];
		}

		public function previewMessage($type, $content, $openid, $wechat_id = null, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			if($wechat_id != null) $wechat_id = ['towxname' => $wechat_id];
			else $wechat_id = [];
			if(!in_array($type, self::MESSAGE_TYPE)) return ['errcode' => 40004, 'errmsg' => '类型错误'];
			$data     = array_merge([
				'touser'  => $openid,
				$type     => ['media_id' => $content],
				'text'    => ['content' => $content],
				'msgtype' => $type
			], $wechat_id);
			$response = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=$access_token", json_encode($data));

			return $response['data'];
		}

		public function sendMessageByOpenid($type, $content, $openid_list, $send_ignore_reprint = 0, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			if(!in_array($type, self::MESSAGE_TYPE)) return ['errcode' => 40004, "errmsg" => '类型错误'];
			$data     = [
				'touser'              => $openid_list,
				$type                 => ['media_id' => $content],
				'text'                => ['content' => $content],
				'mpvideo'             => ['media_id' => $content],
				'msgtype'             => $type,
				'send_ignore_reprint' => $send_ignore_reprint
			];
			$response = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$access_token", json_encode($data));

			return $response['data'];
		}

		public function sendMessageByTag($type, $content, $tag_id, $to_all = false, $send_ignore_reprint = 0, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			if(!in_array($type, self::MESSAGE_TYPE)) return ['errcode' => 40004, "errmsg" => '类型错误'];
			$data     = [
				'filter'  => [
					'tag_id'    => $tag_id,
					'is_to_all' => $to_all
				],
				$type     => ['media_id' => $content],
				'text'    => ['content' => $content],
				'mpvideo' => ['media_id' => $content],
				'msgtype' => $type
			];
			$response = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$access_token", json_encode($data));

			return $response['data'];
		}

		public function setIndustry($industry_1, $industry_2, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=$access_token", json_encode([
				'industry_id1' => $industry_1,
				'industry_id2' => $industry_2
			]));

			return $response['data'];
		}

		public function getReplyRule($access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_getRequest("https://api.weixin.qq.com/cgi-bin/get_current_autoreply_info?access_token=$access_token");

			return $response['data'];
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			统计
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getUserSummary($begin_date, $end_date, $access_token = null){
			$replaceSource = function ($list){
				foreach($list['list'] as $key => $val){
					if(in_array($val['user_source'], array_keys(self::STATISTICS_TYPE))){
						$list['list'][$key]['source_name'] = self::STATISTICS_TYPE[$val['user_source']];
					}
				}

				return $list;
			};
			$access_token  = $access_token == null ? $this->getAccessToken() : $access_token;
			$response      = $this->_postRequest("https://api.weixin.qq.com/datacube/getusersummary?access_token=$access_token", json_encode([
				'begin_date' => $begin_date,
				'end_date'   => $end_date,
			]));

			return $replaceSource($response['data']);
		}

		public function getUserCumulate($begin_date, $end_date, $access_token = null){
			$replaceSource = function ($list){
				foreach($list['list'] as $key => $val){
					if(in_array($val['user_source'], array_keys(self::STATISTICS_TYPE))){
						$list['list'][$key]['source_name'] = self::STATISTICS_TYPE[$val['user_source']];
					}
				}

				return $list;
			};
			$access_token  = $access_token == null ? $this->getAccessToken() : $access_token;
			$response      = $this->_postRequest("https://api.weixin.qq.com/datacube/getusercumulate?access_token=$access_token", json_encode([
				'begin_date' => $begin_date,
				'end_date'   => $end_date,
			]));

			return $replaceSource($response['data']);
		}

		/*
		 ************************************************************************************************
		 ************************************************************************************************
			标签分组
		 ************************************************************************************************
		 ************************************************************************************************
		 */
		public function getUserBlackList($openid = null, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/tags/members/getblacklist?access_token=$access_token", json_encode([
				'begin_openid' => $openid,
			]));

			return $response['data'];
		}

		public function tagUser($tag_id, $openid_list, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$access_token", json_encode([
				'openid_list' => $openid_list,
				'tagid'       => $tag_id
			]));

			return $response['data'];
		}

		public function antiTagUser($tag_id, $openid_list, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=$access_token", json_encode([
				'openid_list' => $openid_list,
				'tagid'       => $tag_id
			]));

			return $response['data'];
		}

		public function createTag($name, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/tags/create?access_token=$access_token", json_encode([
				'tag' => [
					'name' => $name
				]
			]));

			return $response['data'];
		}

		public function deleteTag($tag_id, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=$access_token", json_encode([
				'tag' => [
					'id' => $tag_id
				]
			]));

			return $response['data'];
		}

		public function updateTag($tag_id, $name, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/tags/update?access_token=$access_token", json_encode([
				'tag' => [
					'id'   => $tag_id,
					'name' => $name
				]
			]));

			return $response['data'];
		}

		public function getShortUrl($url, $access_token = null){
			$access_token = $access_token == null ? $this->getAccessToken() : $access_token;
			$response     = $this->_postRequest("https://api.weixin.qq.com/cgi-bin/shorturl?access_token=$access_token", json_encode([
				'action'   => 'long2short',
				'long_url' => $url
			]));
			if($response['status']) return $response['data']['short_url'];
			else return $url;
		}
	}

	/**
	 * Class OfficialAccountCache
	 * 用于提供检测和维护本地jsapi_ticket、access_token凭据的处理类
	 */
	class OfficialAccountCache{
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
			'cacheFolder'             => './Project/Runtime/Wechat-Official-Cache', // 文件夹
			'type'                    => ''
		];

		/**
		 * 类构造函数，需要提供公众号的appid作为参数传入
		 *
		 * @param string      $app_id     公众号的appid
		 * @param string      $type       凭据类型[ac,jt]
		 * @param string|null $cache_path 缓存文件夹的路径
		 * @param string      $ext        文件名扩展串
		 */
		public function __construct($app_id, $type, $cache_path = null, $ext = ''){
			if($cache_path != null) $this->_config['cacheFolder'] = $cache_path;
			switch(strtolower($type)){
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
			$this->_data['fileName'] .= $app_id.$ext.$this->_config['fileSuffix'];
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