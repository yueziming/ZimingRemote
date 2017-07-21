<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class DrugDosageType extends HealthOne implements BasicDictionaryStandard
{
    // 药品剂型 (其他----药品剂型)
    protected $table = 'BAP1';

    protected $primaryKey = 'BAP01';

    protected $fillable = [
        'BAP01',    // [varchar 4] 编码
        'BAP02',    // [varchar 20] 名称
        'BAP03',    // [varchar 1] 类型 (0=口服 1针剂 9其他)
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'ROWNR',    // [int 4] 说明
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
