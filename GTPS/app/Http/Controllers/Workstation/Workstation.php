<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-6-22
     * Time: 15:39
     */

    namespace App\Http\Controllers\Workstation;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class Workstation extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * 登入后访问的主页
         * @SWG\Get(
         *   path="/workstation/index",
         *   tags={"视图请求"},
         *   summary="PC后台主页",
         *   description="获取用户管理页面视图",
         *   produces={"text/html"},
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         *
         * @param Request $request
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index(Request $request)
        {
            return view('Workstation.index');
        }
    }