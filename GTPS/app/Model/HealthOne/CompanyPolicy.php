<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class CompanyPolicy extends HealthOne implements BasicDictionaryStandard
{
    // 公司政策维护 (电子病例----公司政策)
    protected $table = 'RZC1';

    protected $primaryKey = 'RZC01';

    protected $fillable = [
        'RZC01',    // [varchar 10] 编码
        'RZC02',    // [int 4] ID
        'RZC03',    // [varchar 800] 名称
        'RZC04',    // [varchar 8] 是否有效
        'RZC05',    // [datetime] 启用日期
        'RZC06',    // [datetime] 截止日期
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'RZC07',    // [varchar 1000] 描述
        'RZC08',    // [int 4] 优惠金额
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
