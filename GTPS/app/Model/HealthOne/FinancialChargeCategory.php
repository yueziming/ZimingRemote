<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class FinancialChargeCategory extends HealthOne implements BasicDictionaryStandard
{
    // 财务费别 (财务----财务费别)
    protected $table = 'BGF1';

    protected $primaryKey = 'BGF01';

    protected $fillable = [
        'BGF01',    // [varchar 8] 编码
        'BGF02',    // [varchar 64] 名称
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
