<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class AgeGroup extends HealthOne implements BasicDictionaryStandard
{
    // 年龄段(公共字典----年龄段)
    protected $table = 'AAW1';

    protected $primaryKey = 'AAW01';

    protected $fillable = [
        'AAW01',    // [varchar 2] 编码
        'AAW02',    // [varchar 10] 名称
        'AAW03',    // [int 4] 最小年龄
        'AAW04',    // [int 4] 最大年龄
        'AAW05',    // [varchar 1] 年龄单位编码
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
