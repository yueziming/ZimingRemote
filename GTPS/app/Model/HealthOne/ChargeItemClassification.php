<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class ChargeItemClassification extends HealthOne implements BasicDictionaryStandard
{
    // 收费项目分类 (财务----收费项目分类)
    protected $table = 'BCA1';

    protected $primaryKey = 'BCA01';

    protected $fillable = [
        'BCA01',    // [int 4] ID
        'BCA02',    // [varchar 20] 编码
        'BCA03',    // [varchar 64] 名称
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'BCA01A',    // [int 4] 上级
        'LVLNR',    // [smallint 2] 层次
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
