<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class RegistrationPeriod extends HealthOne implements BasicDictionaryStandard
{
    // 挂号有效期限(业务基础资料----挂号有效期限)
    protected $table = 'BLJ1';

    protected $primaryKey = 'BLJ01';

    protected $fillable = [
        'BLJ01',    // [uniqueidentifier 43] ID
        'BCK01',    // [int 4] 科室ID
        'BDP02',    // [varchar 50] 病人类型
        'BLJ04',    // [int 4] 有效天数
        'ROWNR',    // [int 4] 优先级
    ];

    //
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
