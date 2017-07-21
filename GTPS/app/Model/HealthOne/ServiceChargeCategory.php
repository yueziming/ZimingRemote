<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class ServiceChargeCategory extends HealthOne implements BasicDictionaryStandard
{
    // 业务费别 (财务----业务费别)
    protected $table = 'BHH1';

    protected $primaryKey = 'BHH01';

    protected $fillable = [
        'BHH01',    // [varchar 8] 编码
        'BHH02',    // [varchar 64] 名称
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
