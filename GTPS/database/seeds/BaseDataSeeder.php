<?php
    use Illuminate\Database\Seeder;

    class BaseDataSeeder extends Seeder
    {
        /**
         * 客户
         *
         * @return array
         */
        private function _getConstellation()
        {
            $data      = [
                [
                    'index'    => 'constellation',
                    'value'    => '水瓶座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '双鱼座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '白羊座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '金牛座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '双子座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '巨蟹座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '狮子座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '处女座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '天枰座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '天蝎座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '射手座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'constellation',
                    'value'    => '摩羯座',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ]
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getBloodGroup()
        {
            $data      = [
                [
                    'index'    => 'blood_group',
                    'value'    => 'A',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'blood_group',
                    'value'    => 'B',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'blood_group',
                    'value'    => 'AB',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'blood_group',
                    'value'    => 'O',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'blood_group',
                    'value'    => 'Rh阴性型',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'blood_group',
                    'value'    => 'Rh阳性型',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'blood_group',
                    'value'    => '其他',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ]
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getGender()
        {
            $data      = [
                [
                    'index'    => 'gender',
                    'value'    => '男',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'gender',
                    'value'    => '女',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'gender',
                    'value'    => '雌雄同体',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'gender',
                    'value'    => '未知',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ],
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getAgent()
        {
            $data      = [
                [
                    'index'    => 'agent',
                    'value'    => '朋友介绍',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'agent',
                    'value'    => '户外宣传媒体',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'agent',
                    'value'    => '网络资讯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'agent',
                    'value'    => '公司活动',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'agent',
                    'value'    => '社交群',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'agent',
                    'value'    => '社交媒体',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'agent',
                    'value'    => '销售开拓',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'agent',
                    'value'    => '其他',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ],
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getNationality()
        {
            $data      = [
                [
                    'index'    => 'nationality',
                    'value'    => '阿布哈兹',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿富汗',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿尔巴尼亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿尔及利亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '安道尔',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '安哥拉',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '安提瓜和巴布达',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿根廷',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '亚美尼亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '澳大利亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '奥地利',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿塞拜疆',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴哈马',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴林',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '孟加拉国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴巴多斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '白俄罗斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '比利时',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '伯利兹',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '贝宁',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '不丹',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '玻利维亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '波黑',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '博茨瓦纳',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴西',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '文莱',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '保加利亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '布基纳法索',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '布隆迪',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '柬埔寨',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '喀麦隆',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '加拿大',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '佛得角',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '中非共和国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '乍得',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '智利',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '中国（中华人民共和国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '哥伦比亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '科摩罗',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '刚果共和国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '刚果民主共和国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '库克群岛（新西兰）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '哥斯达黎加',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '科特迪瓦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '克罗地亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '古巴',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '塞浦路斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '捷克',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '丹麦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '吉布提',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '顿涅茨克',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '多米尼克',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '多米尼加',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '厄瓜多尔',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '埃及',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '萨尔瓦多',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '赤道几内亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '厄立特里亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '爱沙尼亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '埃塞俄比亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '斐济',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '芬兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '法国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '加蓬',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '冈比亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '格鲁吉亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '德国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '加纳',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '希腊',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '格林纳达',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '危地马拉',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '几内亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '几内亚比绍',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圭亚那',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '海地',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '洪都拉斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '匈牙利',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '冰岛',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '印度',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '印度尼西亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '伊朗',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '伊拉克',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '爱尔兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '以色列',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '意大利',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '牙买加',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '日本',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '约旦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '哈萨克斯坦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '肯尼亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '基里巴斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '韩国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '科索沃',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '科威特',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '吉尔吉斯斯坦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '老挝',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '拉脱维亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '黎巴嫩',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '莱索托',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '利比里亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '利比亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '列支敦士登',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '立陶宛',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '卢森堡',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马其顿',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马达加斯加',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马拉维',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马来西亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马尔代夫',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马耳他骑士团',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马里',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马耳他',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马绍尔群岛',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '毛里塔尼亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '毛里求斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '墨西哥',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '密克罗尼西亚联邦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '摩尔多瓦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '摩纳哥',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '蒙古国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '黑山',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '摩洛哥',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '莫桑比克',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '缅甸',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '纳戈尔诺-卡拉巴赫',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '纳米比亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '瑙鲁',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '尼泊尔',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '荷兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '新西兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '尼加拉瓜',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '尼日尔',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '尼日利亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '纽埃（新西兰）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '北塞浦路斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '挪威',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿曼',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴基斯坦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '帕劳',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴勒斯坦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴拿马',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴布亚新几内亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '巴拉圭',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '朝鲜',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '秘鲁',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '菲律宾',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '波兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '葡萄牙',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '德涅斯特河沿岸',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '邦特兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '卡塔尔',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '罗马尼亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '俄罗斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '卢旺达',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圣基茨和尼维斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圣卢西亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圣文森特和格林纳丁斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '萨摩亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圣马力诺',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圣多美和普林西比',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '沙特阿拉伯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '塞内加尔',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '塞尔维亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '塞舌尔',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '塞拉利昂',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '新加坡',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '斯洛伐克',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '斯洛文尼亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '所罗门群岛',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '索马里',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '索马里兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '南非',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '南奥塞梯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '南苏丹',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '西班牙',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '斯里兰卡',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '苏丹',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '苏里南',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '斯威士兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '瑞典',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '瑞士',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '叙利亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '塔吉克斯坦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '坦桑尼亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '泰国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '东帝汶',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '多哥',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '汤加',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '特立尼达和多巴哥',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '突尼斯',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '土耳其',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '土库曼斯坦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '图瓦卢',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '乌干达',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '乌克兰',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿联酋',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '英国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '美国',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '乌拉圭',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '乌兹别克斯坦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '瓦努阿图',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '梵蒂冈',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '委内瑞拉',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '越南',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '西撒哈拉',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '也门',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '赞比亚',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '津巴布韦',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '南极',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '比尔泰维勒',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '休达（西班牙、摩洛哥争议）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '哈拉伊卜三角区（埃及、苏丹争议）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '克什米尔（印度、巴基斯坦争议）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '梅利利亚（西班牙、摩洛哥争议）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '索科特拉岛（也门、索马里争议）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '法属圭亚那（法国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '留尼旺（法国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '美属萨摩亚（美国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '安圭拉（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿鲁巴（荷兰）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '亚速尔群岛（葡萄牙）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '百慕大（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '英属印度洋领地（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '加那利群岛（西班牙）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '开曼群岛（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圣诞岛（澳大利亚）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '科科斯群岛（澳大利亚）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '库拉索（荷兰）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '福克兰群岛（英国、阿根廷争议）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '法罗群岛（丹麦）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '法属波利尼西亚（法国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '直布罗陀（英国、西班牙争议）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '格陵兰（丹麦）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '关岛（美国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '根西岛（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '泽西岛（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马恩岛（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马约特（法国、科摩罗争议）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '马德拉群岛（葡萄牙）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '蒙特塞拉特岛（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '新喀里多尼亚（法国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '诺福克岛（澳大利亚）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '北马里亚纳群岛（美国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '皮特凯恩群岛（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '波多黎各（美国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圣赫勒拿（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '法属圣马丁',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '圣皮埃尔和密克隆群岛（法国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '荷属圣马丁（荷兰）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '南乔治亚岛和南桑威奇群岛(英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '斯瓦尔巴特群岛（挪威）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '托克劳（新西兰）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '特克斯与凯科斯群岛（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '英属维尔京群岛（英国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '美属维尔京群岛（美国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '瓦利斯和富图纳（法国）',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getRace()
        {
            $data      = [
                [
                    'index'    => 'nationality',
                    'value'    => '汉族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '蒙古族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '回族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '藏族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '维吾尔族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '苗族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '彝族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '壮族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '布依族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '朝鲜族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '满族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '侗族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '瑶族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '白族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '土家族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '哈尼族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '哈萨克族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '傣族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '黎族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '僳僳族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '佤族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '畲族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '高山族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '拉祜族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '水族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '东乡族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '纳西族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '景颇族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '柯尔克孜族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '土族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '达斡尔族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '仫佬族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '羌族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '布朗族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '撒拉族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '毛南族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '仡佬族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '锡伯族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '阿昌族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '普米族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '塔吉克族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '怒族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '乌孜别克族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '俄罗斯族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '鄂温克族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '德昂族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '保安族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '裕固族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '京族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '塔塔尔族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '独龙族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '鄂伦春族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '赫哲族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '门巴族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '珞巴族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'nationality',
                    'value'    => '基诺族',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ]
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getClientType()
        {
            $data      = [
                [
                    'index'    => 'client.type',
                    'value'    => '终端新客',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.type',
                    'value'    => '终端老客',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.type',
                    'value'    => '陪同',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.type',
                    'value'    => '老板娘',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.type',
                    'value'    => '员工',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.type',
                    'value'    => '嘉宾',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.type',
                    'value'    => '观摩',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.type',
                    'value'    => '专家',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.type',
                    'value'    => '其他',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ],
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getClientLevel()
        {
            $data      = [
                [
                    'index'    => 'client.level',
                    'value'    => '1星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ],
                [
                    'index'    => 'client.level',
                    'value'    => '2星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.level',
                    'value'    => '3星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.level',
                    'value'    => '4星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'client.level',
                    'value'    => '5星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getOrganizationIsNew()
        {
            $data      = [
                [
                    'index'    => 'organization.is_new',
                    'value'    => '新店',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ],
                [
                    'index'    => 'organization.is_new',
                    'value'    => '老店',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        private function _getOrganizationLevel()
        {
            $data      = [
                [
                    'index'    => 'organization.level',
                    'value'    => '1星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_TRUE
                ],
                [
                    'index'    => 'organization.level',
                    'value'    => '2星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'organization.level',
                    'value'    => '3星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'organization.level',
                    'value'    => '4星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
                [
                    'index'    => 'organization.level',
                    'value'    => '5星',
                    'creatime' => \App\Data\Time::getCurrentTime(),
                    'default'  => \App\Model\System\BaseData::DEFAULT_FALSE
                ],
            ];
            $getPinyin = function () use (&$data){
                foreach($data as &$val) $val['value_pinyin'] = \Quasar\Utility\StringPlus::getPinyin($val['value'], true, '');
            };
            $getPinyin();

            return $data;
        }

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $constellation_data       = $this->_getConstellation();
            $agent_data               = $this->_getAgent();
            $blood_group_data         = $this->_getBloodGroup();
            $gender_data              = $this->_getGender();
            $nationality_data         = $this->_getNationality();
            $race_data                = $this->_getRace();
            $client_level_data        = $this->_getClientLevel();
            $client_type_data         = $this->_getClientType();
            $organization_is_new_data = $this->_getOrganizationIsNew();
            $organization_level_data  = $this->_getOrganizationLevel();
            \App\Model\System\BaseData::insert($constellation_data);
            \App\Model\System\BaseData::insert($agent_data);
            \App\Model\System\BaseData::insert($blood_group_data);
            \App\Model\System\BaseData::insert($gender_data);
            \App\Model\System\BaseData::insert($nationality_data);
            \App\Model\System\BaseData::insert($race_data);
            \App\Model\System\BaseData::insert($client_level_data);
            \App\Model\System\BaseData::insert($client_type_data);
            \App\Model\System\BaseData::insert($organization_is_new_data);
            \App\Model\System\BaseData::insert($organization_level_data);
        }
    }

