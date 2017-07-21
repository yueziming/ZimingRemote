<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class ConsultingApproach extends HealthOne implements BasicDictionaryStandard
{
    // 咨询途径(业务基础资料----咨询途径)
    protected $table = 'BHO1';

    protected $primaryKey = 'BHO01';

    protected $fillable = [
        'BHO01',    // [int 1] 主键
        'BHO02',    // [varchar 20] 名称
        'ABBRP',    // [varchar 10] 拼音码
        'ABBRW',    // [varchar 10] 五笔码
        'ISDEF',    // [tinyint 0] 默认值
    ];

    //
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
