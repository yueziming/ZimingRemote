<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class ChargeItemType extends HealthOne implements BasicDictionaryStandard
{
    // 收费项目类型 (财务----收费项目类型)
    protected $table = 'BDN1';

    protected $primaryKey = 'BDN01';

    protected $fillable = [
        'BDN01',    // [varchar 2] 主键
        'BDN01',    // [varchar 20] 名称
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'BDN05',    // [varchar 128] 说明
        'RONLY',    // [tinyint 1] 是否只读
        'ROWNR',    // [int 4] 优先级
        'BEI01',    // [varchar 2] 根码 [Index => 收费项目根类(BEI1) DEI01]
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
