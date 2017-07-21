<?php

namespace App\Model\HealthOne;

use App\Standard\System\BasicDictionaryStandard;

class Supplier extends HealthOne implements BasicDictionaryStandard
{
    // 供应商
    protected $table = 'BBH1';

    protected $primaryKey = 'BBH01';

    protected $fillable = [
        'BBH01A',   // [int 4] 上级ID
        'BBH03',    // [varchar 10] 供应商编码
        'BBH04',    // [varchar 64] 供应商名称
        'ABBRP',    // [varchar 20] 中文拼音缩写
        'ABBRW',    // [varchar 20] 中文五笔缩写
        'LVLNR',    // [smallint 2] 层次,级别
        'BBH08',    // [varchar 20] 许可证号,Hygienic Permit Number
        'BBH09',    // [datetime] 许可证有效期,Permit valid data
        'BBH10',    // [varchar 20] 营业执照,business license number
        'BBH11',    // [datetime] 营业执照有效期,License valid data
        'BBH12',    // [varchar 20] 税务等级证号,Tax Registration No
        'BBH13',    // [varchar 64] 地址
        'BBH14',    // [varchar 20] 电话
        'BBH15',    // [varchar 20] 传真
        'BBO02',    // [varchar 32] 开户银行 关联BBO1.BBO02
        'BBH17',    // [varchar 20] 银行账号
        'BBH18',    // [varchar 20] 联系人,contact person name
        'BBH19',    // [varchar 20] 联系人固话,contact person telephone number
        'BBH20',    // [varchar 16] 联系人移动电话,contact person mobile phone number
        'BBH21',    // [int 4] 信用期 period of validity
        'BBH22',    // [numeric 18,2] 信用额度 credit amount
        'BBH23',    // [varchar 8] 类型 vendor type 用二进制表示关联(00111),顺序(药品,卫材,设备,物资,器械,其他等)
        'BBH24',    // [varchar 20] 销售委托人
        'BBH25',    // [datetime] 销售委托日期
        'BBH26',    // [varchar 20] 质量认证号
        'BBH27',    // [datetime] 质量认证日期
        'BBH28',    // [varchar 20] 药监局备案号
        'BBH29',    // [datetime] 药监局备案日期
        'BBH30',    // [varchar 16] 授权证号
        'BBH31',    // [datetime] 授权有效日期
        'BBH32',    // [datetime] 创建日期
        'BBH33',    // [datetime] 有效日期
    ];

    /**
     * 获取供应商列表
     * */
    public function getList()
    {
        return $this->get()->toArray();
    }
}
