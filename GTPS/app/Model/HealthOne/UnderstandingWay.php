<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class UnderstandingWay extends HealthOne implements BasicDictionaryStandard
{
    // 了解途径(业务基础资料----病人媒介)
    protected $table = 'BDX1';

    protected $primaryKey = 'BDX01';

    protected $fillable = [
        'BDX01',    // [varchar 2] 编码
        'BDX01',    // [varchar 64] 名称
        'ABBRP',    // [varchar 10] 拼音码
        'ABBRW',    // [varchar 10] 五笔码
    ];

    //
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
