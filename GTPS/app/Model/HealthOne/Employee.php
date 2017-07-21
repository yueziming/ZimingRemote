<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-3
     * Time: 16:45
     */

    namespace App\Model\HealthOne;

    use App\Standard\Model\JoinTableStandard;
    use Illuminate\Database\QueryException;
    use Mockery\Exception;

    class Employee extends HealthOne
    {
        // 员工表 人员表
        protected $table      = 'BCE1';
        public    $timestamps = false;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 获取所有（在职的）用户列表
         *
         * @param JoinTableStandard   $user_model
         * @param string $keyword 搜索关键字
         *
         * @return array
         */
        public function getList(JoinTableStandard $user_model, $keyword = '')
        {
            $employee_table_name = $this->getTable();
            $user_table_name     = $user_model->getTable();
            try{
                $keyword = "%$keyword%";
                $result  = $this->newQuery()->join($user_table_name, "$employee_table_name.BCE01", '=', "$user_table_name.EmployeeID")->orWhere("$employee_table_name.BCE02", 'like', $keyword)->orWhere("$employee_table_name.BCE03", 'like', $keyword)->orWhere("$employee_table_name.ABBRP", 'like', $keyword)->orWhere("$employee_table_name.ABBRW", 'like', $keyword)->select([
                    "$user_table_name.ID",
                    "$employee_table_name.*"
                ])->get()->toArray();
            }catch(Exception $exception){
                $result = [];
            }catch(QueryException $exception){
                $result = [];
            }

            return $result;
        }
    }