<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class TravelExpenses extends HealthOne implements BasicDictionaryStandard
{
    // 差旅费用 (行政日常费用----差旅费用登记表)
    protected $table = 'HR_CLF1';

    protected $primaryKey = 'CLF01';

    protected $fillable = [
        'CLF01',    // [int 4] ID
        'CLF02',    // [varchar 40] 管理部门
        'CLF03',    // [varchar 64] 报销部门
        'CLF05',    // [numeric 18,2] 报销费用
        'CLF06',    // [numeric 18,2] 其他费用
        'CLF07',    // [numeric 18,2] 不知道干嘛用的
        'CLF08',    // [varchar 18,2] 不知道干嘛用的
        'CLF13',    // [varchar 25] 备注
        'CLF15',    // [datetime] 报销日期
        'CLF16',    // [datetime] 创建时间
        'CLF17',    // [datetime] 有效日期
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
