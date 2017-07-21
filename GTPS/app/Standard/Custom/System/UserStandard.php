<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-6-28
     * Time: 14:12
     */

    namespace App\Standard\Custom\System;

    use App\Standard\Standard;

    interface UserStandard extends Standard
    {
        /**
         * UserStandard constructor.
         *
         * @param bool  $auto_connect 是否自动连接
         * @param array $option       连接配置
         */
        public function __construct(bool $auto_connect = false, array $option = []);

        /**
         * 连接到OA数据库
         *
         * @param array $option 连接配置
         *
         * @return bool
         */
        public function connect(array $option);

        /**
         * 获取用户列表
         *
         * @return array
         */
        public function getUserList();

        /**
         * 获取部门列表
         *
         * @return array
         */
        public function getDeptList();

        /**
         * 登入验证
         *
         * @param string $user_name 用户名
         * @param string $password  密码
         *
         * @return array
         */
        public function loginVerify(string $user_name, string $password);
    }