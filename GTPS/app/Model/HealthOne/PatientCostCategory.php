<?php

namespace App\Model\HealthOne;


class PatientCostCategory extends HealthOne
{
    // 病人费别
    protected $table = 'ABC1';

    protected $primaryKey = 'ABC01';

    protected $fillable = [
        'ABC01', // [varchar 4] 编码 DTYPC
        'ABC02', // [varchar 20] 名称 DTYPN
        'ABBRP', // [varchar 10] 拼音
        'ABBRW', // [varchar 10] 五笔
        'ABC05', // [tinyint 0] 科室限定
        'ABC06', // [tinyint 0] 性质,属性,1=唯一性,2=多重性
        'ABC07', // [tinyint 0] 仅限初诊
        'ISDEF', // [tinyint 0] 默认
        'ACF01', // [int 0] 医疗业务.ID ACF1.ACF01
        'ROWNR', // [int 0] 次序
        'ABC11', // [varchar 128] 说明
        'ABC12', // [datetime 0] 开始日期
        'ABC13', // [datetime 0] 结束日期
        'ABC14', // [tinyint 0] 特性（0=零价，1=成本价）
    ];
}
