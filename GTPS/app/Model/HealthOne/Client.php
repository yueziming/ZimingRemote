<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-13
     * Time: 11:02
     */

    namespace App\Model\HealthOne;

    use App\Standard\Model\JoinTableStandard;

    class Client extends HealthOne
    {
        protected $table      = 'SCA1';
        public    $timestamps = false;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        public function getList(JoinTableStandard $organization_model)
        {
            $organization_table = $organization_model->getTable();
            $client_table       = $this->getTable();
            $result             = $this::setTable("$client_table as c")->join("$organization_table as o", "o.SCA01", '=', "c.SCA01B")->where('c.sca37', '=', 1)->get([
                'c.SCA01',
                'c.SCA05',
                'o.SCA01 as SCA01O',
                'o.SCA06 as SCA06O',
                'c.SCA06',
                'c.SCA07',
                'c.ABW01',
                'c.SCA11',
                'c.SCA12',
                'c.SCA15',
                'c.SCA16',
                'c.SCA17',
                'c.ACC02',
                'c.SCA19',
                'c.SCA20',
                'c.ABQ02',
                'c.SCA22',
                'c.AAT02',
                'c.SCA24',
                'c.SCA25',
                'c.SCA26',
                'c.SCA27',
                'c.SCA28',
                'c.SCA29',
                'c.SCA30',
                'c.SCA31',
                'c.SCA32',
                'c.SCA33',
                'c.BDP02',
                'c.SCA04',
                'c.ABBRP',
                'c.ABBRW'
            ])->toArray();

            return $result;
        }
    }