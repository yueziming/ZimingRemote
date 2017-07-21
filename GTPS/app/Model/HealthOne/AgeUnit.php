<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class AgeUnit extends HealthOne implements BasicDictionaryStandard
{
    // 年龄单位(公共字典----年龄单位)
    protected $table = 'AAU1';

    protected $primaryKey = 'AAU01';

    protected $fillable = [
        'AAU01',    // [varchar 1] 序号 值域:Y,M,D,H,N,W(不用)
        'AAU02',    // [varchar 10] 名称 值域:岁,月,天,小时,分,周
        'ROWNR',    // [tinyint 1] 次序 优先级
        'ISDEF',    // [tinyint 1] 默认 默认值
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
