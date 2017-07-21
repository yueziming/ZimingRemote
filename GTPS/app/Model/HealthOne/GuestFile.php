<?php

namespace App\Model\HealthOne;

class GuestFile extends HealthOne
{
    // 客人档案
    protected $table = 'SCA1';

    protected $primaryKey = 'SCA01';

    protected $fillable = [
        'SCA01', // [int 0] ID
        'SCA02', // [uniqueidentifier 33] UID
        'VAA01', // [int 0] VAA1.VAA01
        'SCA04', // [int 0] 客户分级(与ADV1基础表做对应)
        'SCA05', // [varchar 20] 编号
        'SCA06', // [varchar 64] 名称
        'SCA07', // [varchar 20] 头街
        'ABBRP', // [varchar 30] 拼音
        'ABBRW', // [varchar 30] 五笔
        'ABW01', // [varchar 1] 性别 ABW1.ABW01
        'SCA11', // [datetime 0] 出生日期
        'SCA12', // [int 0] 年龄
        'AAU01', // [varchar 1] 年龄单位 AAU1.AAU01
        'SCA14', // [varchar 20] 年龄描述
        'SCA15', // [varchar 64] 省/市
        'SCA16', // [varchar 64] 县/区
        'SCA17', // [varchar 64] 地址
        'ACC02', // [varchar 32] 国籍 ACC1.ACC02
        'SCA19', // [varchar 20] 宗教
        'SCA20', // [varchar 20] 种族
        'ABQ02', // [varchar 32] 名族 ABQ1.ABQ02
        'SCA22', // [varchar 20] 身份证
        'AAT02', // [varchar 64] 职业 AAT1.AAT02
        'SCA24', // [varchar 64] 工作单位
        'SCA25', // [varchar 20] 联系电话
        'SCA26', // [varchar 20] 移动电话
        'SCA27', // [varchar 64] 电子邮箱
        'SCA28', // [varchar 30] QQ
        'SCA29', // [varchar 128] 其他
        'SCA30', // [varchar 20] 客人媒介方式
        'SCA31', // [varchar 20] 建档途径(1=现场,2=电话,3=网络,4=短信)
        'SCA32', // [varchar 255] 客人要求
        'SCA33', // [varchar 255] 备注
        'BCE01', // [int 0] 登记人ID BCE1.BCE01
        'BCE03', // [varchar 20] 制单人 BCE1.BCE03
        'SCA36', // [datetime 0] 制单时间
        'SCA37', // [tinyint 0] 档案状态(0=正常,1=黑单,3=被合并)
        'SCA38', // [tinyint 0] 进度(0=建档,1=公共,2=独占,3=签约)
        'SCA39', // [varchar 20] 等级医院
        'SCA01A', // [int 0] 相关ID
        'SCA41', // [varchar 50] 地/市/州
        'SCA42', // [varchar 50] 乡/镇/街道
        'SCA43', // [varchar 50] 村/街/小区
        'SCA44', // [varchar 30] 门牌号
        'SCA45', // [varchar 20] 档案号
        'SCA46', // [varchar 20] 健康档案号
        'SCA47', // [varchar 20] 社保保障号
        'SCA48', // [varchar 20] 会员号
        'SCA49', // [varchar 20] 门诊号
        'SCA50', // [varchar 20] 住院号
        'SCA51', // [varchar 20] 体检号
        'AAY02', // [varchar 32] 学历 AAY1.AAY02
        'SCA53', // [tinyint 0] 类型(0=个人,1=团体)
        'SCA54', // [int 0] 资料来源,4体检
        'VBU01', // [int 0] 会员ID VBU1.VBU01
        'SCA01B', // [int 0] 上级ID,个人/渠道关系 SCA2.SCA01
        'SCA58', // [varchar 30] 手机号码归属地
        'SCA56', // [tinyint 0] 客户类型 (0=个人,1=渠道)
        'BDP02', // [varchar 100] 病人类别
    ];
}
