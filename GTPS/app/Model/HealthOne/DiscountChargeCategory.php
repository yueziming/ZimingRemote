<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class DiscountChargeCategory extends HealthOne implements BasicDictionaryStandard
{
    // 折扣费别 (财务----折扣费别)
    protected $table = 'BCH1';

    protected $primaryKey = 'BCH01';

    protected $fillable = [
        'BCH01',    // [varchar 4] 编码
        'BCH02',    // [varchar 20] 名称
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
