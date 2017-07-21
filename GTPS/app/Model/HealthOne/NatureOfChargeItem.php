<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class NatureOfChargeItem extends HealthOne implements BasicDictionaryStandard
{
    // 收费项目性质 (财务----收费项目性质)
    protected $table = 'BCF1';

    protected $primaryKey = 'BCF01';

    protected $fillable = [
        'BCF01',    // [int 4] FCASU
        'BCF02',    // [varchar 2] 编码
        'BCF03',    // [varchar 20] 名称
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
