<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-11
     * Time: 15:46
     */

    namespace App\Model\System;

    use Exception;
    use Illuminate\Database\QueryException;

    class Field extends System
    {
        protected $table = 'field';
        /** 字段激活状态 */
        const ENABLED = 1;
        /** 字段禁止状态 */
        const DISABLED = 0;
        /** 字段禁止状态 */
        const FORBIDDEN = 9;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 获取某个表的字段信息
         *
         * @param string $table 表名
         *
         * @return array
         */
        public function getList($table)
        {
            try{
                $result = $this->newQuery()->where('table', '=', $table)->get()->toArray();
            }catch(QueryException $query_exception){
                $result = [];
            }catch(Exception $exception){
                $result = [];
            }

            return $result;
        }
    }