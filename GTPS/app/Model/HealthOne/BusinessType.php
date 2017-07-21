<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class BusinessType extends HealthOne implements BasicDictionaryStandard
{
    // 业务分类(业务基础资料----服务对象)
    protected $table = 'ACF1';

    protected $primaryKey = 'ACF01';

    protected $fillable = [
        'ACF01',    // [int 4] 编号
        'ACF03',    // [varchar 32] 名称
        'ACF04',    // [tinyint 1] 类型
        'ACF05',    // [varchar 128] 说明
    ];

    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
