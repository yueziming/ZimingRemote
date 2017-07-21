<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class FinanceOtherChargeCategory extends HealthOne implements BasicDictionaryStandard
{
    // 其他费别 (财务----其他费别)
    protected $table = 'BCG1';

    protected $primaryKey = 'BCG01';

    protected $fillable = [
        'BCG01',    // [varchar 4] OEXNC
        'BCG02',    // [varchar 20] 编码
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
