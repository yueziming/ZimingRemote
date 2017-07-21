<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class InstitutionalMobileExpenses extends HealthOne implements BasicDictionaryStandard
{
    // 机构电话费用登记表 (行政日常费用----机构电话费用登记表)
    protected $table = 'HR_TEL1';

    protected $primaryKey = 'TEL01';

    protected $fillable = [
        'TEL01',    // [int 4] ID
        'TEL02',    // [varchar 20] 电话
        'TEL03',    // [varchar 64] 使用部门
        'TEL05',    // [numeric 18,2] 套餐费用
        'TEL06',    // [numeric 18,2] 月基础费
        'TEL07',    // [numeric 18,2] 本地话费
        'TEL08',    // [numeric 18,2] 预付金支付
        'TEL13',    // [varchar 255] 备注
        'tel15',    // [datetime] 缴费日期
        'tel16',    // [datetime] 有效日期
    ];


    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
