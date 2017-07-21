<?php

namespace App\Model\HealthOne;


use App\Standard\System\BasicDictionaryStandard;

class AcquisitionApproach extends HealthOne implements BasicDictionaryStandard
{
    // 咨询途径
    protected $table = 'BHO1';

    protected $primaryKey = 'BHO01';

    protected $fillable = [
        'BHO01', // [int 0] 主键
        'BHO02', // [varchar 20] 名称
        'ABBRP', // [varchar 10] 拼音
        'ABBRW', // [varchar 10] 五笔
        'ISDEF', // [tinyint 0] 默认
    ];

    //
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
