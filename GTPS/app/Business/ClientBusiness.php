<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-13
     * Time: 10:58
     */

    namespace App\Business;

    use App\Custom\HealthOne\BasicDictionary;
    use App\Data\Cache;
    use App\Data\Session;
    use App\Data\Time;
    use App\Model\System\Client;
    use App\Model\System\Field;
    use App\Model\System\Organization;
    use App\Standard\Model\JoinTableStandard;
    use Exception;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\Request;
    use Quasar\Utility\StringPlus;

    class ClientBusiness extends Business
    {
        /** @var JoinTableStandard|\App\Model\System\Organization */
        private $_organizationModel     = null;
        private $_clientModel           = null;
        private $_basicDictionaryObject = null;
        private $_httpRequest           = null;

        public function __construct(Request $request_object)
        {
            parent::__construct();
            $this->_organizationModel     = new Organization();
            $this->_clientModel           = new Client();
            $this->_basicDictionaryObject = new BasicDictionary();
            $this->_httpRequest           = $request_object;
        }

        public function getFieldList(Field $field_model)
        {
            $result = Cache::pick('Client.Field.List', function () use ($field_model){
                try{
                    return $field_model->getList($this->_clientModel->getTable());
                }catch(QueryException $query_exception){
                    return [];
                }
            });
            /** @var \App\Model\System\BaseData $base_data_model */
            $base_data_model = app('Quasar.Model.BaseData');
            foreach($result as &$field){
                switch(strtolower($field['field'])){
                    case 'constellation':
                        $field['type'] = 'select';
                        $field['data'] = Cache::pick('Client.Field.List.Constellation', function () use ($base_data_model){
                            try{
                                return $base_data_model->getList('constellation');
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'blood_group':
                        $field['type'] = 'select';
                        $field['data'] = Cache::pick('Client.Field.List.BloodGroup', function () use ($base_data_model){
                            try{
                                return $base_data_model->getList('blood_group');
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'gender':
                        $field['type'] = 'select';
                        $field['data'] = Cache::pick('Client.Field.List.Gender', function () use ($base_data_model){
                            try{
                                return $base_data_model->getList('gender');
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'level':
                        $field['type'] = 'select';
                        $field['data'] = Cache::pick('Client.Field.List.Level', function () use ($base_data_model){
                            try{
                                return $base_data_model->getList('client.level');
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'nationality':
                        $field['type'] = 'select';
                        $field['data'] = Cache::pick('Client.Field.List.Nationality', function () use ($base_data_model){
                            try{
                                return $base_data_model->getList('nationality');
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'race':
                        $field['type'] = 'select';
                        $field['data'] = Cache::pick('Client.Field.List.Race', function () use ($base_data_model){
                            try{
                                return $base_data_model->getList('race');
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'province':
                    case 'city':
                    case 'county':
                        $field['type'] = 'select&chain';
                        $field['data'] = '';
                    break;
                    case 'agent':
                        $field['type'] = 'select';
                        $field['data'] = Cache::pick('Client.Field.List.Agent', function () use ($base_data_model){
                            try{
                                return $base_data_model->getList('agent');
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'type':
                        $field['type'] = 'select';
                        $field['data'] = Cache::pick('Client.Field.List.Type', function () use ($base_data_model){
                            try{
                                return $base_data_model->getList('client.type');
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'comment':
                        $field['type'] = 'textarea';
                        $field['data'] = '';
                    break;
                    case 'organization_id':
                        $field['type'] = 'select&search';
                        $field['data'] = Cache::pick('Organization.Data.List', function (){
                            try{
                                return $this->_organizationModel->getList(true);
                            }catch(QueryException $query_exception){
                                return [];
                            }
                        });
                    break;
                    case 'name':
                    case 'mobile':
                    case 'email':
                    case 'qq':
                    case 'religion':
                    case 'identity_card':
                    case 'unit':
                    case 'address':
                    case 'profession':
                    default:
                        $field['type'] = 'input';
                        $field['data'] = '';
                    break;
                }
            }

            return $result;
        }

        public function getList()
        {
            $result = Cache::pick('Client.Data.List', function (){
                try{
                    return $this->_clientModel->getList($this->_organizationModel, false);
                }catch(QueryException $query_exception){
                    return [];
                }
            });

            return $result;
        }

        public function save(array $post_data)
        {
            //Ps: 已在Controller层验证完毕 无需在逻辑层继续验证
//            //检测POST数据正确性
//            $checkout_result = (function (&$post){
//                if(!isset($post['name'])) return self::returnResult(false, '缺少客户姓名');
//                if(isset($post['birthday'])){
//                    $post['birthday'] = Time::filterDateFormat($post['birthday']);
//                }
//
//                return ['status' => true, 'message' => '检测无误'];
//            })($post_data);
//            if(!$checkout_result['status']) return $checkout_result;

            // 构造额外存储数据
            $post_data['name_pinyin'] = StringPlus::getPinyin($post_data['name'], true, '');
            $post_data['creatime']    = Time::getCurrentTime();
            $post_data['creator']     = $this->_httpRequest->session()->get(Session::LOGIN_USER_NAME);
            $post_data['creator_id']  = $this->_httpRequest->session()->get(Session::LOGIN_USER_ID);
            // 保存
            try{
                $result = $this->_clientModel->newQuery()->insertGetId($post_data);

                return self::returnResult(true, '创建成功', ['data' => $result]);
            }catch(Exception $exception){
                $message = $this->_clientModel::analysisErrorMessage($exception->getMessage());

                return self::returnResult(false, $message);
            }
        }
    }