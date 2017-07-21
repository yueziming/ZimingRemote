<?php
	/**
	 * Created by PhpStorm.
	 * User: 0967
	 * Date: 2017-3-30
	 * Time: 14:38
	 */
	namespace General\Logic;

	use Quasar\Utility\Type;
	use SoapClient;

	class SMSMobset{
		/** 发送状态 */
		const STATUS = [
			0  => '提交成功',
			1  => '审核中',
			2  => '提交失败',
			3  => '提交失败',
			4  => '提交失败',
			5  => '提交失败',
			6  => '号码不支持',
			7  => '审核失败',
			10 => '发送成功',
			11 => '发送失败',
			12 => '接收成功',
			13 => '接收失败',
			15 => '未知状态'
		];

		public function __construct($url = '', $corp_id = '', $user = '', $password = ''){
			$this->setConfig($url, $corp_id, $user, $password);
		}

		/**
		 * 获取接口配置信息
		 *
		 * @return array
		 */
		public function getConfig(){
			return $this->_config;
		}

		/**
		 * 设定接口配置信息
		 *
		 * @param string     $url      WebService接口地址
		 * @param int|string $corp_id  企业ID
		 * @param string     $user     登入用户
		 * @param string     $password 登入密码
		 */
		public function setConfig($url, $corp_id, $user, $password){
			$this->_config = [
				'corpID'  => $corp_id,
				'user'    => $user,
				'pass'    => $password,
				'soapUrl' => $url
			];
		}

		/** @var array 接口配置 */
		private $_config = [
			'corpID'  => 0, // 企业ID
			'user'    => '', // 登入用户
			'pass'    => '', // 登入密码
			'soapUrl' => '' // WebService接口地址
		];

		/**
		 * 获取短信剩余条数
		 *
		 * @return number
		 */
		public function getBalance(){
			$time            = $this->_getTimestamp();
			$password        = $this->_getPassword($time);
			$soap_client_obj = new SoapClient($this->_config['soapUrl']);
			/** @noinspection PhpUndefinedMethodInspection */
			$result = $soap_client_obj->Sms_GetBalance([
				'CorpID'    => $this->_config['corpID'],
				'LoginName' => $this->_config['user'],
				'Password'  => $password,
				'TimeStamp' => $time,
			]);

			return $result->Balance;
		}

		/**
		 * 获取短信抬头签名
		 *
		 * @return null|string
		 */
		public function getSign(){
			$time            = $this->_getTimestamp();
			$password        = $this->_getPassword($time);
			$soap_client_obj = new SoapClient($this->_config['soapUrl']);
			/** @noinspection PhpUndefinedMethodInspection */
			$result = $soap_client_obj->Sms_GetSign([
				'CorpID'    => $this->_config['corpID'],
				'LoginName' => $this->_config['user'],
				'Password'  => $password,
				'TimeStamp' => $time,
			]);
			if($result->ErrCode == 0) return $result->Sign;
			else return null;
		}

		/**
		 * 获取短信发送报告
		 *
		 * @return array
		 */
		public function getStatus(){
			$time            = $this->_getTimestamp();
			$password        = $this->_getPassword($time);
			$soap_client_obj = new SoapClient($this->_config['soapUrl']);
			/** @noinspection PhpUndefinedMethodInspection */
			$result   = $soap_client_obj->Sms_GetReport([
				'CorpID'    => $this->_config['corpID'],
				'LoginName' => $this->_config['user'],
				'Password'  => $password,
				'TimeStamp' => $time,
			]);
			$type_obj = new Type();
			$result   = $type_obj->parseObjectToArray($result);
			if($result['Count']>0){
				if($result['Count'] == 1){
					return [
						'status'  => true,
						'message' => '获取短信发送报告成功',
						'data'    => [
							[
								'time'    => $result['SmsReportList']['SmsReportGroup']['ReportTime'],
								'smsID'   => $result['SmsReportList']['SmsReportGroup']['SmsID'],
								'code'    => $result['SmsReportList']['SmsReportGroup']['Status'],
								'message' => self::STATUS[$result['SmsReportList']['SmsReportGroup']['Status']]
							]
						]
					];
				}
				else{
					$report = [
						'status'  => true,
						'message' => '获取短信发送报告成功',
						'data'    => []
					];
					foreach($result['SmsReportList']['SmsReportGroup'] as $record){
						$report['data'][] = [
							'time'    => $record['ReportTime'],
							'smsID'   => $record['SmsID'],
							'code'    => $record['Status'],
							'message' => self::STATUS[$record['Status']]
						];
					}

					return $report;
				}
			}
			else return ['status' => false, 'message' => '暂无最新的短信发送报告'];
		}

		/**
		 * 发送短信
		 *
		 * @param string $message  发送的短信信息
		 * @param array  $receiver 接收者的手机号（数量不能超过50条）
		 * @param bool   $long     是否为长短信
		 *
		 * @return array data索引的数据为Sms_ID数组
		 */
		public function send($message, $receiver = [], $long = false){
			/**
			 * 用于生成MobileListGroup对象的闭包函数
			 *
			 * @param array      $list        接收短信的电话号码的数组
			 * @param SoapClient $soap_client Soap对象
			 *
			 * @return array 封装的MobileListGroup数组
			 */
			$makeMobileListGroup = function ($list, $soap_client){
				/** @noinspection PhpUndefinedFieldInspection */
				$mobile_list = $soap_client->ArrayOfMobileList[1];
				foreach($list as $key => $val){
					/** @noinspection PhpUndefinedFieldInspection */
					$mobile_list[$key]         = $soap_client->MobileListGroup;
					$mobile_list[$key]->Mobile = $val;
				}

				return $mobile_list;
			};
			$time                = $this->_getTimestamp();
			$password            = $this->_getPassword($time);
			$soap_client_obj     = new SoapClient($this->_config['soapUrl']);
			/** @noinspection PhpUndefinedMethodInspection */
			$result   = $soap_client_obj->Sms_Send([
				'Content'    => $message,
				'CorpID'     => $this->_config['corpID'],
				'LongSms'    => $long ? 1 : 0,
				'LoginName'  => $this->_config['user'],
				'Password'   => $password,
				'TimeStamp'  => $time,
				'MobileList' => $makeMobileListGroup($receiver, $soap_client_obj)
			]);
			$type_obj = new Type();
			$result   = $type_obj->parseObjectToArray($result);

			return [
				'status'  => $result['Count']>0 ? true : false,
				'message' => $result['ErrMsg'],
				'data'    => $result['Count']>1 ? $result['SmsIDList']['SmsIDGroup'] : ($result['Count'] == 1 ? [$result['SmsIDList']['SmsIDGroup']] : [])
			];
		}

		/**
		 * 生成密码
		 *
		 * @param string $time 时间戳
		 *
		 * @return string
		 */
		private function _getPassword($time){
			return md5($this->_config['corpID'].$this->_config['pass'].$time);
		}

		/**
		 * 生成时间戳
		 *
		 * @return string
		 */
		private function _getTimestamp(){
			return date('mdHid');
		}
	}