<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-8
     * Time: 14:56
     */

    namespace App\Http\Controllers\Workstation;

    use App\Business\SocketBusiness;
    use Illuminate\Http\Request;

    class SocketController extends Workstation
    {
        private $_selfBusiness  = null;
        private $_httpRequest = null;

        public function __construct(Request $request)
        {
            parent::__construct();
            $this->_selfBusiness  = new SocketBusiness();
            $this->_httpRequest = $request;
        }

        /**
         * 将用户和Socket标识进行绑定
         * @SWG\Post(
         *   path="/workstation/socket/bind",
         *   tags={"表单提交"},
         *   summary="绑定用户和Socket标识",
         *   description="将登入用户和Socket连接的客户端标识进行绑定",
         *   @SWG\Parameter(
         *     name="socket_id",
         *     in="formData",
         *     description="Socket客户端ID",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="user_id",
         *     in="formData",
         *     description="用户ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回{status:bool, message:string}格式数据",
         *   )
         * )
         *
         * @return array
         */
        public function bind()
        {
            $socket_id = $this->_httpRequest->get('socketID', '');
            $user_id   = $this->_httpRequest->get('userID', '');
            $result    = $this->_selfBusiness->bind($socket_id, $user_id);

            return $result;
        }
    }