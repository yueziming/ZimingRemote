<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class CateringReceptionExpenses extends HealthOne implements BasicDictionaryStandard
{
    // 涉及非公司人员的费用 (行政日常费用----外联费用登记表)
    protected $table = 'HR_CYF1';

    protected $primaryKey = 'CYF01';

    protected $fillable = [
        'CYF01',    // [int 4] ID
        'CYF02',    // [varchar 40] 项目
        'CYF03',    // [varchar 64] 不知道什么鬼
        'CYF05',    // [numeric 18,2] 单价
        'CYF06',    // [numeric 18,2] 数量
        'CYF07',    // [numeric 18,2] 数量
        'CYF08',    // [numeric 18,2] 数量
        'CYF09',    // [numeric 18,2] 数量
        'CYF10',    // [numeric 18,2] 数量
        'CYF11',    // [numeric 18,2] 数量
        'CYF12',    // [numeric 18,2] 数量
        'CYF13',    // [numeric 18,2] 数量
        'CYF14',    // [numeric 18,2] 数量
        'CYF15',    // [numeric 18,2] 数量
        'CYF16',    // [numeric 18,2] 数量
        'CYF17',    // [varchar 255] 备注
        'CYF18',    // [datetime] 使用日期
        'CYF19',    // [datetime] 不知道什么鬼
        'CYF20',    // [datetime] 不知道什么鬼
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
