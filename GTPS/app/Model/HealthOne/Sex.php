<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class Sex extends HealthOne implements BasicDictionaryStandard
{
    // 性别表(公共字典----性别表)
    protected $table = 'ABW1';

    protected $primaryKey = 'ABW01';

    // 0 = 未知 1 = 男 2 = 女 9 = 未说明
    protected $fillable = [
        'ABU01',    // [varchar 1] 编码
        'ABU02',    // [varchar 10] 名称
        'ABU02',    // [tinyint 1] 默认
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
