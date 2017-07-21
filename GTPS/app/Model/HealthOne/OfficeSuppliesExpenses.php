<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class OfficeSuppliesExpenses extends HealthOne implements BasicDictionaryStandard
{
    // 办公耗材费用 (行政日常费用----办公耗材费用登记表)
    protected $table = 'HR_HC1';

    protected $primaryKey = 'HC01';

    protected $fillable = [
        'HC01',    // [int 4] ID
        'HC02',    // [varchar 40] 项目
        'HC03',    // [varchar 64] 不知道什么玩意
        'HC04',    // [numeric 18,2] 数量
        'HC05',    // [numeric 18,2] 单价
        'HC06',    // [numeric 18,2] 合计
        'HC07',    // [numeric 18,2] 不知道什么价格
        'HC14',    // [varchar 255] 备注
        'HC15',    // [datetime] 使用日期
        'HC16',    // [datetime] 登记日期
        'HC17',    // [datetime] 不知道什么日期
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
