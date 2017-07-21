<?php

    namespace App\Model\HealthOne;

    class Department extends HealthOne
    {
        // 科室
        protected $table      = 'BCK1';

        protected $primaryKey = 'bck01';
        /** 自身ID */
        const ID = 'BCK01';
        /** 父级ID */
        const PARENT_ID = 'BCK01A';

        protected $fillable = [
            'BCK01', // [int 0] ID (DEPTU=业务科室,DEPEU=辅助室(如执行科室,执行药房),DEPWU=病区)
            'BCK02', // [varchar 20] 编码
            'BCK03', // [varchar 64] 名称
            'BCK04', // [varchar 128] 英文名称
            'ABBRP', // [varchar 10] 拼音
            'ABBRW', // [varchar 10] 五笔
            'BCK01A', // [int 0] 上级ID
            'LVLNR', // [int 0] 奴属科室ID
            'BCK09', // [varchar 20] 电话
            'BCK10', // [varchar 128] 位置
            'BCK11', // [varchar 2] 业务性质(0=无,1=管理,2=医疗,3=药事)
            'ACA01', // [varchar 8] 诊疗科目编码,参见表TMCPCL ACA1.ACA01
            'BCK13', // [varchar 255] 说明
            'ABY01', // [varchar 2] 洁净等级 参见TMECLV 4个等级 ABY1.ABY01
            'BCK15', // [datetime 0] 创建时间
            'BCK16', // [datetime 0] 撤销时间
            'ADR01', // [int 0] 分支机构ID ADR1.ADR01
            'BCK18', // [tinyint 0] 机构性质 用于药房价格管理(0=零售销售,1=进价销售)
            'BCK19', // [numeric 18,2] 药物配额(%)
            'BLL01', // [int 0] 区域ID BLL1.BLL01
            'ABW01', // [varchar 1] 性别限制 (0=不限制,1=男,2=女) ABW1.ABW01
            'BCK22', // [int 0]
        ];

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 获取 预约科室
         * */
        public function scopeReservationList()
        {
            $field = ['BCK01', 'BCK02', 'BCK03', 'ABBRP', 'ABBRW'];

            return $this->query()->whereExists(function($query){
                $query->select(\DB::raw(1))
                    ->from('BAZ1')
                    ->whereRaw('BAZ1.BCK01 = BCK1.BCK01')
                    ->where('BAU01','01');
            })->select($field)->get()->toArray();
        }
    }
