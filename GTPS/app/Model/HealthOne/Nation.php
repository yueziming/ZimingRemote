<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class Nation extends HealthOne implements BasicDictionaryStandard
{
    // 民族
    protected $table = 'ABQ1';

    protected $primaryKey = 'ABQ01';

    protected $fillable = [
        'ABQ01', // [varchar 4]  编码
        'ABQ02', // [varchar 32]  名称
        'ABQ03', // [varchar 64]  英文名称
        'ROWNR', // [smallint 0]  次序
        'ABQ05', // [varchar 128]  说明
        'ISDEF', // [tinyint 0]  默认
        'ABBRP', // [varchar 10]  拼音
        'ABBRW', // [varchar 10]  五笔
    ];

    //
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
