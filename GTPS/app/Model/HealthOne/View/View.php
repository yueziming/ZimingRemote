<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-19
     * Time: 14:12
     */

    namespace App\Model\HealthOne\View;

    use App\Model\HealthOne\HealthOne;
    use Prophecy\Exception\Doubler\ClassNotFoundException;

    class View extends HealthOne
    {
        /** 区域 */
        const AREA       = [
            'SZ' => '深圳',
            'GZ' => '广州'
        ];
        const CLASS_LIST = [
            'GZ_Department'   => '\App\Model\HealthOne\View\GuangZhouDepartment',
            'GZ_Employee'     => '\App\Model\HealthOne\View\GuangZhouEmployee',
            'GZ_Organization' => '\App\Model\HealthOne\View\GuangZhouOrganization',
            'GZ_Supplier'     => '\App\Model\HealthOne\View\GuangZhouSupplier',
            'GZ_Materiel'     => '\App\Model\HealthOne\View\GuangZhouMateriel',
            'GZ_Client'       => '\App\Model\HealthOne\View\GuangZhouClient',
        ];

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 实例化对象
         *
         * @param string $alias_class 类别名
         *
         * @return mixed
         */
        public static function make(string $alias_class)
        {
            if(!isset(self::CLASS_LIST[$alias_class])){
                throw new ClassNotFoundException("没有找到{$alias_class}对应的类", $alias_class);
            }
            $full_class_name = self::CLASS_LIST[$alias_class];

            return new $full_class_name();
        }
    }