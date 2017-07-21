<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class ClientLevel extends HealthOne implements BasicDictionaryStandard
{
    // 客户分级 等级
    protected $table = 'ADV1';

    protected $primaryKey = 'ADV01';

    protected $fillable = [
        'ADV01', // [int 2] 编码
        'ADV02', // [varchar 30] 名称
        'ABBRP', // [varchar 10] 拼音
        'ABBRW', // [varchar 10] 五笔
        'ADV05', // [varchar 128] 说明
    ];

    //
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
