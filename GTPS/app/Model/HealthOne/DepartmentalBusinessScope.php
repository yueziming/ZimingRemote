<?php

namespace App\Model\HealthOne;


class DepartmentalBusinessScope extends HealthOne
{
    // 部门业务范围
    protected $table = 'BAZ1';

    protected $primaryKey = 'BAZ01';

    protected $fillable = [
        'BAZ01', // [int 0] ID
        'BCK01', // [int 0] 部门ID (DEPTU=业务科室,DEPEU=辅助室(如执行科室,执行药房),DEPWU=病区) BCK1.BCK01
        'BAU01', // [varchar 4] 部门业务类别ID BAU1.BAU01
        'ACF01', // [int 0] 业务类别ID 业务分类,服务对象(0=无,1=门急诊,2=住院,3综合) ACF1.ACF01
    ];
}
