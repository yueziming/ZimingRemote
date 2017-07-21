<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class ReimbursementCategory extends HealthOne implements BasicDictionaryStandard
{
    // 偿付类别 (财务----偿付类别)
    protected $table = 'AAS1';

    protected $primaryKey = 'AAS01';

    protected $fillable = [
        'AAS01',    // [varchar 4] 编码
        'AAS02',    // [varchar 32] 名称
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'AAS05',    // [int 4] 类型
        'ISDEF',    // [tinyint 1] 默认
        'AAS07',    // [int 0] 显示颜色
    ];

    /**
     * 获取列表
     * */
    public function getList()
    {
        return $this->query()->get()->toArray();
    }
}
