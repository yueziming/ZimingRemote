<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-18
     * Time: 10:03
     */

    namespace App\Model\System;

    use Illuminate\Database\QueryException;

    class BaseData extends System
    {
        protected $table = 'base_data';
        /** 是默认值 */
        const DEFAULT_TRUE = 1;
        /** 不是是默认值 */
        const DEFAULT_FALSE = 0;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        public function getList(string $index)
        {
            try{
                $result = $this->newQuery()->where('index', '=', $index)->get([
                    'id',
                    'index',
                    'value_pinyin',
                    'value',
                    'default'
                ])->toArray();
            }catch(QueryException $query_exception){
                $result = [];
            }

            return $result;
        }
    }