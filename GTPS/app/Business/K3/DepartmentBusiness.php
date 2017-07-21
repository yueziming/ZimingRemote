<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-19
     * Time: 14:36
     */

    namespace App\Business\K3;

    use App\Model\HealthOne\View\View;
    use Kingdee\K3Api;
    use Quasar\Utility\Curl;
    use Quasar\Utility\Type;

    class DepartmentBusiness extends K3Business
    {
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * 获取待同步的数据列表
         *
         * @param string      $area       区域
         * @param string|null $start_time 开始时间
         * @param string|null $end_time   结束时间
         *
         * @return array
         */
        public function getInputList(string $area, string $start_time = null, string $end_time = null)
        {
            // 获取坐标视图数据
            $healthone_data = (function () use ($area){
                /** @var View $department_view */
                $department_view = View::make("{$area}_Department");
                $healthone_data  = $department_view->newQuery()->get()->toArray();

                return $healthone_data;
            })();
            // 获取金蝶数据
            $kingdee_data = (function (){
                $kingdee_object = new K3Api(env('KINGDEE_HOST'), env('KINGDEE_AUTHORITY'), new Curl(), 'http', env('KINGDEE_ENCRYPT_PASSWORD'));
                $kingdee_data   = $kingdee_object->getDepartmentList();
                $kingdee_data   = Type::parseObjectToArray($kingdee_data);

                return $kingdee_data;
            })();
            // 对比坐标和金蝶的数据
            $result = (function ($kingdee_data, $healthone_data){
                $kingdee_reflect = [
                    'name' => [],
                    'code' => []
                ];
                foreach($kingdee_data as $value){
                    $kingdee_reflect['code'][] = $value['FNumber'];
                    $kingdee_reflect['name'][] = $value['FName'];
                }
                $result = [];
                foreach($healthone_data as $value){
                    $code_index = array_search($value['BCK02'], $kingdee_reflect['code']);
                    $name_index = array_search($value['BCK03'], $kingdee_reflect['name']);
                    if($code_index === $name_index && $code_index !== false){
                        continue;
                    }
                    $result[] = $value;
                }

                return $result;
            })($kingdee_data, $healthone_data);

            return $result;
        }
    }