<?php

namespace App\Model\HealthOne;

class PatientType extends HealthOne
{
    // 病人类型
    protected $table = 'BDP1';

    protected $primaryKey = 'BDP01';

    protected $fillable = [
        'BDP01', // [varchar 4] 编码 PATCC
        'BDP02', // [varchar 50] 名称 PATCN
        'ABBRP', // [varchar 10] 拼音
        'ABBRW', // [varchar 10] 五笔
        'BDP05', // [int 0] 颜色
        'ISDEF', // [tinyint 0] 默认
        'BDP07', // [int 0] 是否医保病人(0=否 1=是)
        'BDP08', // [varchar 128] 说明
        'ACF01', // [tinyint 0] 服务对象
        'BBP02', // [varchar 32] 默认支付方式 BBP1.BBP02
        'BDP11', // [varchar 512] 医师站提示信息
        'BDP12', // [int 0] 处方用药天数限制
    ];
}
