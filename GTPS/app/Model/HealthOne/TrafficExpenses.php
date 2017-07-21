<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class TrafficExpenses extends HealthOne implements BasicDictionaryStandard
{
    // 外出涉及的交通费 (行政日常费用----交通费用登记表)
    protected $table = 'HR_JTF1';

    protected $primaryKey = 'JTF1';

    protected $fillable = [
        'JTF01',    // [int 4] ID
        'JTF02',    // [varchar 40] 不知道什么鬼
        'JTF03',    // [varchar 64] 不知道什么鬼
        'JTF05',    // [numeric 18,2] 费用
        'JTF06',    // [numeric 18,2] 不知道什么鬼
        'JTF14',    // [varchar 255] 备注
        'JTF15',    // [datetime] 使用日期
        'JTF16',    // [datetime] 登记日期
        'JTF17',    // [datetime] 不知道什么鬼
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
