<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class CountriesRegions extends HealthOne implements BasicDictionaryStandard
{
    // 国家和地区
    protected $table = 'ACC1';

    protected $primaryKey = 'ACC01';

    protected $fillable = [
        'ACC01', // [varchar 10] 编码
        'ACC02', // [varchar 32] 名称
        'ACC03', // [varchar 64] 英文名称
        'ACC04', // [varchar 64] 中文全称
        'ACC05', // [varchar 128] 英文全称
        'ACC06', // [varchar 8] 电话区号
        'ACC07', // [numeric 8] 时差
        'ROWNR', // [int 0] 次序
        'ISDEF', // [tinyint 0] 默认值
        'ABBRP', // [varchar 10] 拼音
        'ABBRW', // [varchar 10] 五笔
    ];

    /**
     * 获取 默认的所有国家列表
     * */
    public function getList()
    {
        return $this->query()->ClientRegisterCountriesRegions()->get()->toArray();
    }

    /**
     * 用到的地方 客服登记 预约
     * */
    public function scopeClientRegisterCountriesRegions($query)
    {
        return $query->where(function($where){
            $where->where('ACC01','like','%中国%')
                ->orwhere(\DB::raw('(ACC01 + \'-\' + ACC02)'),'like','%中国%')
                ->orwhere('ACC03','like','%中国%')
                ->orwhere('ACC04','like','%中国%')
                ->orwhere('ACC05','like','%中国%')
                ->orwhere('ACC05','like','%中国%');
        })->OrderBy('ROWNR');
    }
}
