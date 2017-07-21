<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class HouseLeaseExpenses extends HealthOne implements BasicDictionaryStandard
{
    // 租房涉及到的相关费用 (行政日常费用----房屋租赁费用登记表)
    protected $table = 'HR_FSD1';

    protected $primaryKey = 'FSD1';

    protected $fillable = [
        'FSD01',    // [int 4] ID
        'FSD02',    // [varchar 40] 宿舍名称
        'FSD03',    // [varchar 64] 报销部门
        'FSD05',    // [numeric 18,2] 房租
        'FSD06',    // [numeric 18,2] 水费
        'FSD07',    // [numeric 18,2] 电费
        'FSD08',    // [varchar 18,2] 垃圾排污费
        'FSD09',    // [varchar 18,2] 维修基金
        'FSD10',    // [varchar 18,2] 物业管理费
        'FSD11',    // [varchar 18,2] 其他费用
        'FSD12',    // [varchar 18,2] 电视费
        'FSD13',    // [varchar 255] 备注
        'FSD15',    // [datetime] 登记日期
        'FSD16',    // [datetime] 续费日期
        'FSD17',    // [datetime] 不知道什么日期
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
