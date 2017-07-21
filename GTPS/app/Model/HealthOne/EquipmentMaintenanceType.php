<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class EquipmentMaintenanceType extends HealthOne implements BasicDictionaryStandard
{
    // 设备保养类型(业务基础资料----设备保养类型)
    protected $table = 'BKH1';

    protected $primaryKey = 'BKH01';

    protected $fillable = [
        'BKH01',    // [varchar 1] 编码
        'BKH02',    // [varchar 30] 名称
    ];

    //
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
