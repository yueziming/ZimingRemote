<?php

namespace App\Custom\HealthOne;

/**
 * ##基础字典 对象池
 *
 * 公共字典
 * * Sex 性别
 * * Area 行政区域(地区)
 * * AgeUnit 年龄单位
 * * AgeGroup 年龄段
 * * CountriesRegions 国家和地区
 * * Nation 民族
 *
 * 业务基础资料
 * * BusinessType 业务类型(服务对象)
 * * CommonUnits 常用单位
 * * ConsultingApproach 咨询途径
 * * AcquisitionApproach 了解途径(病人媒介)
 * * RegistrationPeriod 挂号有效期限(挂号有效期限)
 * * EquipmentMaintenanceType 设备保养类型
 * * ClientLevel 客户分级(等级)
 * * PatientType  病人类型
 *
 * 财务
 * * ReimbursementCategory 偿付类别
 * * ReceiptChargeCategory 收据费别
 * * PaymentMethod 付款方式
 * * ChargeItemType 收费项目类型
 * * ChargeItemClassification 收费项目分类
 * * NatureOfChargeItem 收费项目性质
 * * OtherChargeCategory 其他费别
 * * DiscountChargeCategory 折扣费别
 * * IncomeItem 收入项目
 * * FinancialChargeCategory 财务费别
 * * ServiceChargeCategory 业务费别
 *
 * 其他
 * * HospitalTreatment 入院待遇
 * * AnesthesiaMode 麻醉方式
 * * DrugDosageType 药品剂型
 *
 * 电子病例
 * * CompanyPolicy 公司政策(公司政策维护)
 *
 * 行政日常费用
 * * 暂时不用
 *
 * 特训营返金券
 * * 暂时不用
 */
class BasicDictionary
{
    private $instances = [];

    private $classAliases = [
        //---- 公共字典
        'Sex' => 'App\Model\HealthOne\Sex', // 性别
        'Area' => 'App\Model\HealthOne\Area', // 行政区域(地区)
        'AgeUnit' => 'App\Model\HealthOne\AgeUnit', // 年龄单位
        'AgeGroup' => 'App\Model\HealthOne\AgeGroup', // 年龄段
        'Nation' => 'App\Model\HealthOne\Nation', // 民族
        'CountriesRegions' => 'App\Model\HealthOne\CountriesRegions', // 国家和地区
        'Profession' => 'App\Model\HealthOne\Profession', // 从业状况(职业)

        //---- 业务基础资料
        'BusinessType' => 'App\Model\HealthOne\BusinessType', // 业务类型(服务对象)
        'ClientLevel' => 'App\Model\HealthOne\ClientLevel', // 客户分级(等级)
        'CommonUnits' => 'App\Model\HealthOne\CommonUnits', // 常用单位
        'ConsultingApproach' => 'App\Model\HealthOne\ConsultingApproach', // 咨询途径
        'AcquisitionApproach' => 'App\Model\HealthOne\AcquisitionApproach', // 了解途径(业务基础资料----病人媒介)
        'UnderstandingWay' => 'App\Model\HealthOne\UnderstandingWay', // 了解途径(客户媒介)
        'RegistrationPeriod' => 'App\Model\HealthOne\RegistrationPeriod', // 挂号有效期限(挂号有效期限)
        'EquipmentMaintenanceType' => 'App\Model\HealthOne\EquipmentMaintenanceType', // 设备保养类型
        'PatientType' => 'App\Model\HealthOne\PatientType', // 病人类型

        //---- 财务
        'ReimbursementCategory' => 'App\Model\HealthOne\ReimbursementCategory', // 偿付类别
        'ReceiptChargeCategory' => 'App\Model\HealthOne\ReceiptChargeCategory', // 收据费别
        'PaymentMethod' => 'App\Model\HealthOne\PaymentMethod', // 付款方式
        'ChargeItemType' => 'App\Model\HealthOne\ChargeItemType', // 收费项目类型
        'ChargeItemClassification' => 'App\Model\HealthOne\ChargeItemClassification', // 收费项目分类
        'NatureOfChargeItem' => 'App\Model\HealthOne\NatureOfChargeItem', // 收费项目性质
        'FinanceOtherChargeCategory' => 'App\Model\HealthOne\FinanceOtherChargeCategory', // 财务其他费别
        'DiscountChargeCategory' => 'App\Model\HealthOne\DiscountChargeCategory', // 折扣费别
        'IncomeItem' => 'App\Model\HealthOne\IncomeItem', // 收入项目
        'FinancialChargeCategory' => 'App\Model\HealthOne\FinancialChargeCategory', // 财务费别
        'ServiceChargeCategory' => 'App\Model\HealthOne\ServiceChargeCategory', // 业务费别

        //---- 其他
        'HospitalTreatment' => 'App\Model\HealthOne\HospitalTreatment', // 入院待遇
        'AnesthesiaMode' => 'App\Model\HealthOne\AnesthesiaMode', // 麻醉方式
        'DrugDosageType' => 'App\Model\HealthOne\DrugDosageType', // 药品剂型

        //---- 电子病例
        'CompanyPolicy' => 'App\Model\HealthOne\CompanyPolicy', // 公司政策(公司政策维护)

        //---- 行政日常费用
//        'InstitutionalMobileExpenses' => 'App\Model\HealthOne\InstitutionalMobileExpenses', // 机构电话费用登记表(机构电话费用)
//        'TravelExpenses' => 'App\Model\HealthOne\TravelExpenses', // 差旅费用登记表(差旅费用)
//        'HouseLeaseExpenses' => 'App\Model\HealthOne\HouseLeaseExpenses', // 房屋租赁费用登记表(租房涉及到的相关费用)
//        'OfficeSuppliesExpenses' => 'App\Model\HealthOne\OfficeSuppliesExpenses', // 办公耗材费用登记表(办公耗材费用)
//        'HotelResidenceExpenses' => 'App\Model\HealthOne\HotelResidenceExpenses', // 酒店住宿费用登记表(酒店住宿费用)
//        'TrafficExpenses' => 'App\Model\HealthOne\TrafficExpenses', // 交通费用登记表(外出涉及的交通费)
//        'OutreachExpenses' => 'App\Model\HealthOne\OutreachExpenses', // 外联费用登记表(涉及非公司人员的费用)
//        'CateringReceptionExpenses' => 'App\Model\HealthOne\CateringReceptionExpenses', // 餐饮和接待费用登记表(涉及餐费,水果等)
//        'PostalTransportExpenses' => 'App\Model\HealthOne\PostalTransportExpenses', // 邮递和运输费用登记表(快递或运输费)
//        'LinenWashing' => 'App\Model\HealthOne\LinenWashing', // 布草洗涤登记表
//        'FlowerReservation' => 'App\Model\HealthOne\FlowerReservation', // 鲜花登记表(登记鲜花预定)
//        'MaintenanceExpenses' => 'App\Model\HealthOne\MaintenanceExpenses', // 日常维修保养费用登记表
//        'EmployeeWelfareExpenses' => 'App\Model\HealthOne\EmployeeWelfareExpenses', // 员工福利费用登记表(员工福利相关)
//        'OtherAdministrativeExpenses' => 'App\Model\HealthOne\OtherAdministrativeExpenses', // 其他费用登记表
//        'InstitutionalConsumables' => 'App\Model\HealthOne\InstitutionalConsumables', // 机构易耗品登记表
//        'ClothingPurchase' => 'App\Model\HealthOne\ClothingPurchase', // 服装购入登记表

        //---- 特训营返金券
//        'CashCouponStorage' => 'App\Model\HealthOne\CashCouponStorage', // 返金券入库
//        'ClubStaffReceiveRegistration' => 'App\Model\HealthOne\ClubStaffReceiveRegistration', // 会所员工领用登记
    ];

    /**
     * 实例化基础类
     *
     * @param string|array $object_name 对象名称
     *
     * @return object
     * @throws
     * */
    public function make($object_name){
        foreach($object_name as $key => $name){
            if(array_key_exists($name, $this->classAliases)){
                $item = new $this->classAliases[$name];
                $this->instances[$name]=$item;
            }else{
                throw new \ErrorException('基础字典中并没有' . $name . '类');
            }
        }
    }

    /**
     * 获取一个基础字典中已经注册的类，找不到则尝试在基础字典的类中注册
     *
     * @param string $object_name  对象名称
     *
     * @return object $item
     * */
    public function get(string $object_name)
    {
        if(isset($this->instances[$object_name])){
            return $this->instances[$object_name];
        }else{
            $this->make([$object_name]);

            return $this->instances[$object_name];
        }
    }

    /**
     * 往基础字典中注册类
     *
     * @param object $object 对象
     * @param string $object_name 对象名称
     * */
    public function add($object,string $object_name)
    {
        $this->instances[$object_name] = $object;
    }

}