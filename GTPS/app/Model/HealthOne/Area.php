<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class Area extends HealthOne implements BasicDictionaryStandard
{
    // 行政区划 地区
    protected $table = 'ABU1';

    protected $primaryKey = 'ABU01';

    protected $fillable = [
        'ABU01',    // [varchar 6] 编码
        'ABU02',    // [varchar 64] 名称
        'ABU03',    // [varchar 64] 英文名称
        'ABBRP',    // [varchar 10] 拼音
        'ABBRW',    // [varchar 10] 五笔
        'ABU01A',    // [varchar 6] 上级编码
        'LVLNR',    // [int 4] 层次
        'ENABL',    // [tinyint 1] 有效标志
        'ABU09',    // [varchar 128] 说明
        'ABU10',    // [varchar 255] 备注
        'ISDEF',    // [tinyint 1] 默认
    ];

    /**
     * 获取列表
     *
     * 坐标系统特别处理
     * */
    public function getList()
    {
//        return $this->query()->get()->toArray();

        return $this->query()->ClientRegisterArea()->get()->toArray();
    }

    /*
     * 客服登记 --- 地区
     * */
    public function scopeClientRegisterArea($query)
    {
        $field = [
            'ABU1.ABU01',
            'ABU1.ABU02',
            'a.ABU02 As Area',
            \DB::raw('CASE WHEN ISNULL(b.ABU02,\'\') = \'\' THEN a.ABU02 ELSE b.ABU02 END  AS province'),
            'ABU1.ABU03',
            'ABU1.ABBRP',
            'ABU1.ABBRW',
            'ABU1.ABU01A',
            'ABU1.LVLNR',
            'ABU1.ENABL',
            'ABU1.ABU09',
            'ABU1.ABU10',
            'ABU1.ISDEF',
        ];

        return $query->select($field)
            ->leftjoin('ABU1 As a', 'ABU1.ABU01A', '=', 'a.ABU01')
            ->leftjoin('ABU1 As b', 'ABU1.ABU01A', '=', 'b.ABU01')
            ->where([['ABU1.LVLNR', '>=', 1], ['ABU1.Enabl', '=', 1]]);
    }

}
