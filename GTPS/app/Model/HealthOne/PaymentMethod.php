<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class PaymentMethod extends HealthOne implements BasicDictionaryStandard
{
    // 付款方式 (财务----付款方式)
    protected $table = 'ABJ1';

    protected $primaryKey = 'ABJ01';

    protected $fillable = [
        'ABJ01',    // [varchar 2] 编码
        'ABJ02',    // [varchar 20] 名称
        'ISDEF',    // [tinyint 1] 默认
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
