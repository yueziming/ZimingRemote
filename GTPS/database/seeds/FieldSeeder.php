<?php
    use Illuminate\Database\Seeder;

    class FieldSeeder extends Seeder
    {
        private function _getClientFieldData()
        {
            $client_table_data = [
                [
                    'code'           => 'client.name',
                    'table'          => 'client',
                    'field'          => 'name',
                    'name'           => '名称',
                    'searchable'     => \App\Model\System\Field::ENABLED,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::ENABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.name_pinyin',
                    'table'          => 'client',
                    'field'          => 'name_pinyin',
                    'name'           => '名称拼音码',
                    'searchable'     => \App\Model\System\Field::ENABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::DISABLED,
                    'read_viewable'  => \App\Model\System\Field::DISABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.organization_id',
                    'table'          => 'client',
                    'field'          => 'organization_id',
                    'name'           => '会所',
                    'searchable'     => \App\Model\System\Field::FORBIDDEN,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::ENABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.birthday',
                    'table'          => 'client',
                    'field'          => 'birthday',
                    'name'           => '生日',
                    'searchable'     => \App\Model\System\Field::FORBIDDEN,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::DISABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.mobile',
                    'table'          => 'client',
                    'field'          => 'mobile',
                    'name'           => '手机号',
                    'searchable'     => \App\Model\System\Field::ENABLED,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::ENABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.email',
                    'table'          => 'client',
                    'field'          => 'email',
                    'name'           => '邮箱',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.qq',
                    'table'          => 'client',
                    'field'          => 'qq',
                    'name'           => 'QQ号',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.constellation',
                    'table'          => 'client',
                    'field'          => 'constellation',
                    'name'           => '星座',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.blood_group',
                    'table'          => 'client',
                    'field'          => 'blood_group',
                    'name'           => '血型',
                    'searchable'     => \App\Model\System\Field::FORBIDDEN,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.gender',
                    'table'          => 'client',
                    'field'          => 'gender',
                    'name'           => '性别',
                    'searchable'     => \App\Model\System\Field::FORBIDDEN,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::ENABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.level',
                    'table'          => 'client',
                    'field'          => 'level',
                    'name'           => '等级',
                    'searchable'     => \App\Model\System\Field::FORBIDDEN,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.nationality',
                    'table'          => 'client',
                    'field'          => 'nationality',
                    'name'           => '国籍',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.religion',
                    'table'          => 'client',
                    'field'          => 'religion',
                    'name'           => '宗教',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.race',
                    'table'          => 'client',
                    'field'          => 'race',
                    'name'           => '民族',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.identity_card',
                    'table'          => 'client',
                    'field'          => 'identity_card',
                    'name'           => '身份证',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.profession',
                    'table'          => 'client',
                    'field'          => 'profession',
                    'name'           => '职业',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.unit',
                    'table'          => 'client',
                    'field'          => 'unit',
                    'name'           => '工作单位',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.province',
                    'table'          => 'client',
                    'field'          => 'province',
                    'name'           => '省',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.city',
                    'table'          => 'client',
                    'field'          => 'city',
                    'name'           => '市',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.county',
                    'table'          => 'client',
                    'field'          => 'county',
                    'name'           => '县/区',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.address',
                    'table'          => 'client',
                    'field'          => 'address',
                    'name'           => '地址',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.agent',
                    'table'          => 'client',
                    'field'          => 'agent',
                    'name'           => '媒介',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.type',
                    'table'          => 'client',
                    'field'          => 'type',
                    'name'           => '类型',
                    'searchable'     => \App\Model\System\Field::ENABLED,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::ENABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'client.comment',
                    'table'          => 'client',
                    'field'          => 'comment',
                    'name'           => '备注',
                    'searchable'     => \App\Model\System\Field::FORBIDDEN,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ]
            ];
            $getPinyin         = function () use (&$client_table_data){
                foreach($client_table_data as &$val) $val['name_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['name'], true, '');
            };
            $getPinyin();

            return $client_table_data;
        }

        private function _getOrganizationFieldData()
        {
            $organization_table_data = [
                [
                    'code'           => 'organization.name',
                    'table'          => 'organization',
                    'field'          => 'name',
                    'name'           => '名称',
                    'searchable'     => \App\Model\System\Field::ENABLED,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::ENABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.name_pinyin',
                    'table'          => 'organization',
                    'field'          => 'name_pinyin',
                    'name'           => '名称拼音码',
                    'searchable'     => \App\Model\System\Field::ENABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::DISABLED,
                    'read_viewable'  => \App\Model\System\Field::DISABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.telephone',
                    'table'          => 'organization',
                    'field'          => 'telephone',
                    'name'           => '联系电话',
                    'searchable'     => \App\Model\System\Field::ENABLED,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.email',
                    'table'          => 'organization',
                    'field'          => 'email',
                    'name'           => '邮箱',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.province',
                    'table'          => 'organization',
                    'field'          => 'province',
                    'name'           => '省',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.city',
                    'table'          => 'organization',
                    'field'          => 'city',
                    'name'           => '市',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.county',
                    'table'          => 'organization',
                    'field'          => 'county',
                    'name'           => '县/区',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.address',
                    'table'          => 'organization',
                    'field'          => 'address',
                    'name'           => '地址',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.is_new',
                    'table'          => 'organization',
                    'field'          => 'is_new',
                    'name'           => '是否新店',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::ENABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.agent',
                    'table'          => 'organization',
                    'field'          => 'agent',
                    'name'           => '媒介',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.level',
                    'table'          => 'organization',
                    'field'          => 'level',
                    'name'           => '等级',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::ENABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::ENABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.parent_id',
                    'table'          => 'organization',
                    'field'          => 'parent_id',
                    'name'           => '上级会所',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
                [
                    'code'           => 'organization.comment',
                    'table'          => 'organization',
                    'field'          => 'comment',
                    'name'           => '备注',
                    'searchable'     => \App\Model\System\Field::DISABLED,
                    'list_viewable'  => \App\Model\System\Field::DISABLED,
                    'write_viewable' => \App\Model\System\Field::ENABLED,
                    'read_viewable'  => \App\Model\System\Field::ENABLED,
                    'necessary'      => \App\Model\System\Field::DISABLED,
                    'creatime'       => \App\Data\Time::getCurrentTime()
                ],
            ];
            $getPinyin               = function () use (&$organization_table_data){
                foreach($organization_table_data as &$val) $val['name_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['name'], true, '');
            };
            $getPinyin();

            return $organization_table_data;
        }

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $client_table_data       = $this->_getClientFieldData();
            $organization_table_data = $this->_getOrganizationFieldData();
            \App\Model\System\Field::insert($client_table_data);
            \App\Model\System\Field::insert($organization_table_data);
        }
    }
