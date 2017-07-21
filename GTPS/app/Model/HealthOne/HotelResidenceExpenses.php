<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class HotelResidenceExpenses extends HealthOne implements BasicDictionaryStandard
{
    // 酒店住宿费用 (行政日常费用----酒店住宿费用登记表)
    protected $table = 'HR_JD1';

    protected $primaryKey = 'HC01';

    protected $fillable = [
        'JD01',    // [int 4] ID
        'JD02',    // [varchar 40] 角色
        'JD03',    // [varchar 64] 姓名
        'JD04',    // [varchar 64] 酒店
        'JD05',    // [numeric 18,2] 天数
        'JD06',    // [numeric 18,2] 金额
        'JD07',    // [numeric 18,2] 合计
        'JD14',    // [varchar 255] 备注
        'JD15',    // [datetime] 入住日期
        'JD16',    // [datetime] 退房日期
        'JD17',    // [datetime] 登记日期
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
