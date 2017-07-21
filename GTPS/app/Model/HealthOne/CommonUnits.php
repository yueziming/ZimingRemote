<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class CommonUnits extends HealthOne implements BasicDictionaryStandard
{
    // 常用单位(业务基础资料----常用单位)
    protected $connection = 'healthOne';

    protected $table = 'BDG1';

    protected $primaryKey = 'BDG01';

    protected $fillable = [
        'BDG01',    // [varchar 20] 编码
        'BDG02',    // [varchar 20] 名称
        'BDG03',    // [int 4] 类型 ( 1 = 诊疗单位 2 = 容量单位)
    ];

    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
