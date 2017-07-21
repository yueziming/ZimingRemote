<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class AnesthesiaMode extends HealthOne implements BasicDictionaryStandard
{
    // 麻醉类型 (其他----麻醉方式)
    protected $table = 'ACI1';

    protected $primaryKey = 'ACI01';

    protected $fillable = [
        'ACI01',    // [varchar 4] 编码
        'ACI02',    // [varchar 30] 名称
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'ACI05',    // [varchar 64] 说明
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
