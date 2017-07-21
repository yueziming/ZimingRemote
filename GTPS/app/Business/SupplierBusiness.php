<?php

namespace App\Business;

use Quasar\Utility\Tree;
use App\Model\HealthOne\Supplier;

class SupplierBusiness
{
    private $supplier = null;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * 获取供应商树列表
     * */
    public function page()
    {
        $supplierList = $this->supplier->getList();

        // todo 根据条件去获取列表[关键词,排序,条目]

        return $supplierList;
    }

    /**
     * 获取供应商树形结构
     * */
    public function getSupplierTree()
    {
        $supplierList = $this->supplier->getList();

        $tree = new Tree($supplierList,['parentIndex' => 'BBH01A','selfIndex' => 'BBH01']);

        return $tree->parseTree();
    }


}