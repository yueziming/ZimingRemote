<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class IncomeItem extends HealthOne implements BasicDictionaryStandard
{
    // 收入项目 (财务----收入项目)
    protected $table = 'BAX1';

    protected $primaryKey = 'BAX01';

    protected $fillable = [
        'BAX01',    // [int 4] FIRAU
        'BAX02',    // [varchar 10] 编码
        'BAX03',    // [varchar 20] 名称
        'BAX01A',    // [int 4] 上级
        'LVLNR',    // [tinyint 10] 层次,级别
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'BAX08',    // [datetime 10] 创建时间
        'BAX09',    // [datetime 10] 有效时间
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
