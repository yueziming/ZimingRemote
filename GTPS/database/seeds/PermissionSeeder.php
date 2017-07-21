<?php
    use Illuminate\Database\Seeder;

    class PermissionSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $data = [
                [
                    'code'      => 'USER',
                    'name'      => '用户管理',
                    'parent_id' => 0,
                    'creatime'  => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'      => 'ROLE',
                    'name'      => '角色管理',
                    'parent_id' => 0,
                    'creatime'  => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'      => 'USER-VIEW',
                    'name'      => '查看',
                    'parent_id' => 1,
                    'creatime'  => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'      => 'USER-GRANT',
                    'name'      => '授权',
                    'parent_id' => 1,
                    'creatime'  => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'      => 'ROLE-VIEW',
                    'name'      => '查看',
                    'parent_id' => 2,
                    'creatime'  => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'      => 'ROLE-GRANT',
                    'name'      => '授权',
                    'parent_id' => 2,
                    'creatime'  => \App\Data\Time::getCurrentTime()
                ],
            ];
            $getPinyin = function() use(&$data){
                foreach($data as &$val) $val['name_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['name'], true, '');
            };
            $getPinyin();
            \App\Model\System\Permission::insert($data);
        }
    }
