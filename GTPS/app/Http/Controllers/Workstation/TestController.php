<?php

namespace App\Http\Controllers\Workstation;

use App\Business\BaseDictionaryBusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 开发测试用的控制器
 * */
class TestController extends Controller
{

    public function __construct()
    {
    }

    /**
     * 供应商视图
     * */
    public function index(Request $request)
    {
//        $this->service->index();
        $this->getHeathOneModelDetail();
    }

    /**
     * HeathOne Model 文件名称和对应的表
     * */
    public function getHeathOneModelDetail()
    {
        $data = [
            //-- A
            'AAW1' => 'AgeGroup -- 年龄段(公共字典----年龄段)',
            'AAU1' => 'AgeUnit -- 年龄单位(公共字典----年龄单位)',
            'AAS1' => 'ReimbursementCategory -- 偿付类别 (财务----偿付类别)',
            'ABC1' => 'PatientCostCategory -- 病人费别',
            'ABF1' => 'ReceiptChargeCategory -- 收据费别 (财务----收据费别)',
            'ABJ1' => 'PaymentMethod -- 付款方式 (财务----付款方式)',
            'ABU1' => 'Area -- 行政区划 地区 (公共字典----行政区划 地区)',
            'ABW1' => 'Sex -- 性别表(公共字典----性别表)',
            'ABZ1' => 'HospitalTreatment -- 入院待遇 (其他----入院待遇)',
            'ACF1' => 'BusinessType -- 业务分类(业务基础资料----服务对象)',
            'ACI1' => 'AnesthesiaMode -- 麻醉类型 (其他----麻醉方式)',
            'ADV1' => 'ClientLevel -- 客户分级(等级)',
            'ACC1' => 'CountriesRegions -- 国家和地区',
            'ABQ1' => 'Nation -- 民族',
            'ACM1' => 'Profession -- 从业状况(职业)',

            //-- B
            'BAP1' => 'DrugDosageType -- 药品剂型 (其他----药品剂型)',
            'BAX1' => 'IncomeItem -- 收入项目 (财务----收入项目)',
            'BAZ1' => 'DepartmentalBusinessScope -- 部门业务范围',
            'BBH1' => 'Supplier -- 供应商',
            'BCA1' => 'ChargeItemClassification -- 收费项目分类 (财务----收费项目分类)',
            'BCF1' => 'NatureOfChargeItem -- 收费项目性质 (财务----收费项目性质)',
            'BCG1' => 'FinanceOtherChargeCategory -- 其他费别 (财务----其他费别)',
            'BCH1' => 'DiscountChargeCategory -- 折扣费别 (财务----折扣费别)',
            'BCK1' => 'Department -- 科室',
            'BDG1' => 'CommonUnits -- 常用单位(业务基础资料----常用单位)',
            'BDN1' => 'ChargeItemType -- 收费项目类型 (财务----收费项目类型)',
            'BDP1' => 'PatientType -- 病人类型',
            'BHO1' => 'AcquisitionApproach -- 咨询途径',
            'BGF1' => 'FinancialChargeCategory -- 财务费别 (财务----财务费别)',
            'BHH1' => 'ServiceChargeCategory -- 业务费别 (财务----业务费别)',
            'BKH1' => 'EquipmentMaintenanceType -- 设备保养类型(业务基础资料----设备保养类型)',
            'BLJ1' => 'RegistrationPeriod -- 挂号有效期限(业务基础资料----挂号有效期限)',
            'BDX1' => 'UnderstandingWay -- 了解途径(业务基础资料----病人媒介)',

            //-- E
            'BCE1' => 'Employee -- 员工表 人员表',

            //-- H
            'HR_CLF1' => 'TravelExpenses -- 差旅费用 (行政日常费用----差旅费用登记表)',
            'HR_CYF1' => 'CateringReceptionExpenses -- 涉及非公司人员的费用 (行政日常费用----外联费用登记表)',
            'HR_FSD1' => 'HotelResidenceExpenses -- 租房涉及到的相关费用 (行政日常费用----房屋租赁费用登记表)',
            'HR_HC1' => 'OfficeSuppliesExpenses -- 办公耗材费用 (行政日常费用----办公耗材费用登记表)',
            'HR_WL1' => 'OutreachExpenses -- 涉及非公司人员的费用 (行政日常费用----外联费用登记表)',
            'HR_TEL1' => 'InstitutionalMobileExpenses -- 机构电话费用登记表 (行政日常费用----机构电话费用登记表)',
            'HR_JTF1' => 'TrafficExpenses -- 外出涉及的交通费 (行政日常费用----交通费用登记表)',
            'HR_JD1' => 'HotelResidenceExpenses -- 酒店住宿费用 (行政日常费用----酒店住宿费用登记表)',

            //-- P

            //-- R
            'RZC1' => 'CompanyPolicy -- 公司政策维护 (电子病例----公司政策)',

            //-- S
            'SCA1' => 'GuestFile -- 客人档案',
            'SYS_Users' => 'User -- 用户信息表',
            'SYS_UserRoles' => 'UserRole -- 角色用户关系',
            'SYS_Roles' => 'Role -- 角色',
        ];
        dd($data);
    }

}
