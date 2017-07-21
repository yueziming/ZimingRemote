<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class OutreachExpenses extends HealthOne implements BasicDictionaryStandard
{
    // 涉及非公司人员的费用 (行政日常费用----外联费用登记表)
    protected $table = 'HR_WL1';

    protected $primaryKey = 'WL01';

    protected $fillable = [
        'WL01',    // [int 4] ID
        'WL02',    // [varchar 40] 项目
        'WL03',    // [varchar 64] 不知道什么鬼
        'WL04',    // [numeric 18,2] 单价
        'WL05',    // [numeric 18,2] 数量
        'WL06',    // [numeric 18,2] 不知道什么鬼
        'WL07',    // [numeric 18,2] 不知道什么鬼
        'WL14',    // [varchar 255] 备注
        'WL15',    // [datetime] 使用日期
        'WL16',    // [datetime] 不知道什么鬼
        'WL17',    // [datetime] 不知道什么鬼
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
