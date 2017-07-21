<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class Profession extends HealthOne implements BasicDictionaryStandard
{
    // 从业状况 职业
    protected $table = 'ACM1';

    protected $primaryKey = 'ACM01';

    protected $fillable = [
        'ACM01', // [varchar 2] 编码
        'ACM02', // [varchar 20] 名称
        'ACM03', // [varchar 64] 说明
        'ISDEF', // [tinyint 0] 默认
        'ABBRP', // [varchar 10] 拼音
        'ABBRW', // [varchar 10] 五笔
    ];

    //
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
