<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class HospitalTreatment extends HealthOne implements BasicDictionaryStandard
{
    // 入院待遇 (其他----入院待遇)
    protected $table = 'ABZ1';

    protected $primaryKey = 'ABZ01';

    protected $fillable = [
        'ABZ01',    // [varchar 8] 编码
        'ABZ02',    // [varchar 10] 名称
        'ISDEF',    // [tinyint 1] 默认
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
