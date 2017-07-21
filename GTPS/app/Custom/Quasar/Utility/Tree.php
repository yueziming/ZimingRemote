<?php
    /*
     * 更新日志
     *
     * Version 1.00 2016-05-02 10:17
     * 初始版本
     *
     * Version 1.30 2016-05-03 19:20
     * 1、新增获取子节点的方法
     * 2、新增转换树数组为数组列表的方法
     * 3、解决部分bug
     *
     * Version 2.00 2017-06-20 10:25
     * 重构类方法
     *
     * Version 2.10 2017-06-20 15:11
     * 添加获取父节点以及获取同级节点的方法
     *
     * Version 2.11 2017-07-01 15:32
     * 1、修改参数键值
     * 2、更新注释说明
     */

    namespace Quasar\Utility;

    use ErrorException;

    /**
     * 树数组<br>
     * <br>
     * CreateTime: 2017-05-02 10:17<br>
     * ModifyTime: 2017-07-01 15:32<br>
     *
     * @author  Quasar (lelouchcctony@163.com)
     * @version 2.11
     */
    class Tree
    {
        /* 控制参数 */
        /** @var int 根节点的值 */
        private $_root = 0;
        /** @var string 父节点的数据索引 */
        private $_parentIndex = 'parent_id';
        /** @var string 自身节点的数据索引 */
        private $_selfIndex = 'id';
        /** @var string 每个节点的子节点树的索引 */
        private $_listIndex = '_list';
        /** @var string 节点层级 */
        private $_levelIndex = '_level';
        /* 对象 */
        /** @var array 数据对象 */
        private $_data = [];
        /** @var null|int 数据对象类型 */
        private $_dataType = null;
        /** 树类型 */
        const TYPE_TREE = 1;
        /** 列表类型 */
        const TYPE_LIST = 0;

        /**
         * 构造函数
         * #$option参数键说明。
         * * root => int 根节点的值，默认值0
         * * parentIndex => string 父节点的数据索引，默认值'parent_id'
         * * selfIndex => string 自身节点的数据索引，默认值'id'
         * * listIndex => string 每个节点的子节点树的索引，默认值'_list'
         * * levelIndex => string 节点层级，默认值'_level'
         *
         * @param array $data   处理数据
         * @param array $option 配置参数
         */
        public function __construct($data = [], $option = [])
        {
            $this->setConfig($option);
            $this->setData($data);
        }

        /**
         * 是否含有子节点
         *
         * @param array $node 节点
         *
         * @return bool
         */
        public function hasChildNode($node)
        {
            return (isset($node[$this->_listIndex]) && is_array($node[$this->_listIndex]) && count($node[$this->_listIndex])>0) ? true : false;
        }

        /**
         * 设定配置
         * #$option参数键说明。
         * * root => int 根节点的值，默认值0
         * * parentIndex => string 父节点的数据索引，默认值'parent_id'
         * * selfIndex => string 自身节点的数据索引，默认值'id'
         * * listIndex => string 每个节点的子节点树的索引，默认值'_list'
         * * levelIndex => string 节点层级，默认值'_level'
         *
         * @param array $option 配置参数
         */
        public function setConfig($option = [])
        {
            if(isset($option['root'])) $this->_root = $option['root'];
            if(isset($option['parentIndex'])) $this->_parentIndex = $option['parentIndex'];
            if(isset($option['selfIndex'])) $this->_selfIndex = $option['selfIndex'];
            if(isset($option['listIndex'])) $this->_listIndex = $option['listIndex'];
            if(isset($option['levelIndex'])) $this->_levelIndex = $option['levelIndex'];
        }

        /**
         * 获取配置
         *
         * @return array
         */
        public function getConfig()
        {
            return [
                'root'        => $this->_root,
                'parentIndex' => $this->_parentIndex,
                'selfIndex'   => $this->_selfIndex,
                'listIndex'   => $this->_listIndex,
                'level'       => $this->_levelIndex,
                'dataType'    => $this->_dataType
            ];
        }

        /**
         * 设定数据
         *
         * @param array $data 数据
         *
         * @throws ErrorException()
         */
        public function setData($data)
        {
            if(!is_array($data)) throw new ErrorException('数据类型必须为数组', 1230);
            if(!count($data)<=0){
                $check = function ($data) use (&$check){
                    foreach($data as $item){
                        if(!isset($item[$this->_selfIndex])) throw new ErrorException('数据项缺少ID值', 1232);
                        if(!isset($item[$this->_parentIndex])) throw new ErrorException('数据项缺少父级ID值', 1233);
                        if($this->hasChildNode($item)) $check($item[$this->_listIndex]);
                    }
                };
                $check($data);
            }
            $this->_data = $data;
            $this->checkType();
        }

        /**
         * 获取数据
         *
         * @return array
         */
        public function getData()
        {
            return $this->_data;
        }

        /**
         * 检测当前数据是列表还是树
         *
         * @return int 0: 列表 1: 树
         */
        public function checkType()
        {
            $handler = function ($data) use (&$handler){
                foreach($data as $item){
                    if($this->hasChildNode($item)) return self::TYPE_TREE;
                }

                return self::TYPE_LIST;
            };

            return $this->_dataType = $handler($this->_data);
        }

        /**
         * 生成树
         * #$option参数键说明。
         * * root => int 根节点的值，默认值0
         * * parentIndex => string 父节点的数据索引，默认值'parent_id'
         * * selfIndex => string 自身节点的数据索引，默认值'id'
         * * listIndex => string 每个节点的子节点树的索引，默认值'_list'
         * * levelIndex => string 节点层级，默认值'_level'
         *
         * @param array $option 配置
         *
         * @return array
         */
        public function parseTree($option = [])
        {
            $this->setConfig($option);
            $handler         = function ($list, $root_val, $level = 1) use (&$handler){
                $result = [];
                foreach($list as $key => $val){
                    if($val[$this->_parentIndex] == $root_val){
                        unset($list[$key]);
                        $val[$this->_listIndex]  = $handler($list, $val[$this->_selfIndex], $level+1);
                        $val[$this->_levelIndex] = $level;
                        $result[]                = $val;
                    }
                }

                return $result;
            };
            $result          = $handler($this->_data, $this->_root);
            $this->_dataType = self::TYPE_TREE;
            $this->_data     = $result;

            return $result;
        }

        /**
         * 将树数组转化为列表
         * #$option参数键说明。
         * * root => int 根节点的值，默认值0
         * * parentIndex => string 父节点的数据索引，默认值'parent_id'
         * * selfIndex => string 自身节点的数据索引，默认值'id'
         * * listIndex => string 每个节点的子节点树的索引，默认值'_list'
         * * levelIndex => string 节点层级，默认值'_level'
         *
         * @param array $option 配置
         *
         * @return array
         */
        public function parseList($option = [])
        {
            $this->setConfig($option);
            $handler         = function ($data, $result) use (&$handler){
                foreach($data as $node){
                    if($this->hasChildNode($node)) $result = $handler($node[$this->_listIndex], $result);
                    unset($node[$this->_listIndex]);
                    $result[] = $node;
                }

                return $result;
            };
            $result          = $handler($this->_data, []);
            $this->_dataType = self::TYPE_LIST;
            $this->_data     = $result;

            return $result;
        }

        /**
         * 获取指定节点的子节点树
         *
         * @param int $id 节点ID
         *
         * @return array
         */
        public function getChildTree($id)
        {
            $handler = function ($tree, $result) use ($id, &$handler){
                if($id == $this->_root) return $tree;
                foreach($tree as $node){
                    if($this->hasChildNode($node)){
                        if($node[$this->_selfIndex] == $id) return $node[$this->_listIndex];
                        else $result = $handler($node[$this->_listIndex], $result);
                    }
                }

                return $result;
            };

            return $handler($this->_data, []);
        }

        /**
         * 获取指定节点的子节点列表
         *
         * @param int $id 节点ID
         *
         * @return array
         */
        public function getChildList($id)
        {
            $handler = function ($tree, $result, $found = false) use ($id, &$handler){
                foreach($tree as $node){
                    if(($node[$this->_selfIndex] == $id) || $this->_root == $id || $found) $found = true;
                    if($this->hasChildNode($node)) $result = $handler($node[$this->_listIndex], $result, $found);
                    if($found){
                        unset($node[$this->_listIndex]);
                        unset($node[$this->_levelIndex]);
                        $result[] = $node;
                    }
                }

                return $result;
            };

            return $handler($this->_data, []);
        }

        /**
         * 获取指定节点的同级树
         *
         * @param int $id 节点ID
         *
         * @return array
         */
        public function getSiblingTree($id)
        {
            $handler = function ($tree) use ($id, &$handler){
                $node           = $result = [];
                $need_parent_id = null;
                foreach($tree as $node){
                    if($node[$this->_selfIndex] == $id){
                        $need_parent_id = $node[$this->_parentIndex];
                    }
                    else $result[] = $node;
                    if($this->hasChildNode($node)){
                        $r = $handler($node[$this->_listIndex]);
                        if($r) return $r;
                    }
                }

                return $need_parent_id == $node[$this->_parentIndex] ? $result : [];
            };

            return $handler($this->_data);
        }

        /**
         * 获取指定节点父级节点
         *
         * @param int $id 节点ID
         *
         * @return array
         */
        public function getParentTree($id)
        {
            $handler = function ($tree, $result) use ($id, &$handler){
                foreach($tree as $node){
                    if($node[$this->_selfIndex] == $id) return ['found' => true, 'data' => $result];
                    if($this->hasChildNode($node)){
                        $current = $node;
                        unset($current[$this->_listIndex]);
                        $result[] = $current;
                        $r        = $handler($node[$this->_listIndex], $result);
                        if($r['found']) return $r;
                        else array_pop($result);
                    }
                }

                return ['found' => false, 'data' => $result];
            };
            $result  = [];
            $result  = $handler($this->_data, $result);

            return $result['data'];
        }
    }

