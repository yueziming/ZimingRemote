<?php

    namespace App\Http\Controllers\Workstation;

    use App\Business\DepartmentBusiness;

    class DepartmentController extends Workstation
    {
        private $_selfBusiness = null;

        public function __construct()
        {
            parent::__construct();
            $this->_selfBusiness = new DepartmentBusiness();
        }

        public function manage()
        {
            return view('Workstation.Department.manage');
        }
    }
