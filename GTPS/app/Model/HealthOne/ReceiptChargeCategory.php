<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class ReceiptChargeCategory extends HealthOne implements BasicDictionaryStandard
{
    // 收据费别 (财务----收据费别)
    protected $table = 'ABF1';

    protected $primaryKey = 'ABF01';

    protected $fillable = [
        'ABF01',    // [varchar 8] 编码
        'ABF02',    // [varchar 20] 名称
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'ROWNR',    // [int 0] 次序
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
