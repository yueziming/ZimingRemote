<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-4
     * Time: 16:05
     */

    namespace App\Http\Controllers;

    use Symfony\Component\HttpFoundation\Request;

    /**
     * @SWG\Swagger(
     *   schemes={"http"},
     *   produces={"application/json", "text/html"},
     *   @SWG\Info(
     *     version="1.1",
     *     title="医美系统路由接口",
     *     description="定义所有路由uri对应的RESTFul请求"
     *   ),
     *   @SWG\Tag(
     *     name="视图请求",
     *     description="获取页面视图请求",
     *   ),
     *   @SWG\Tag(
     *     name="创建数据请求",
     *     description="该请求用于对数据资源进行创建操作。默认的所有提交使用POST方式",
     *   ),
     *   @SWG\Tag(
     *     name="删除数据请求",
     *     description="该请求用于对数据资源进行删除操作。默认的所有提交使用DELETE方式",
     *   ),
     *   @SWG\Tag(
     *     name="局部修改数据请求",
     *     description="该请求用于对数据资源进行局部修改操作。默认的所有提交使用PATCH方式",
     *   ),
     *   @SWG\Tag(
     *     name="修改数据请求",
     *     description="该请求用于对数据资源进行修改操作。默认的所有提交使用PUT方式",
     *   ),
     *   @SWG\Tag(
     *     name="获取数据请求",
     *     description="该请求用于对数据资源进行获取操作。默认的所有提交使用GET方式",
     *   ),
     *   @SWG\Tag(
     *     name="获取数据的请求类型",
     *     description="该请求用于获取数据资源所有请求类型。默认的所有提交使用OPTIONS方式",
     *   ),
     *   @SWG\Tag(
     *     name="表单提交",
     *     description="描述了所有表单或异步提交。所有提交都需要在参数中携带表单令牌（键为_token），或在header中携带表单令牌（名称为X-CSRF-TOKEN）"
     *   )
     * )
     */
    class SwaggerController extends Controller
    {
        public function start(Request $request, $module = '')
        {
            switch(strtolower($module)){
                case 'user':
                    $path = 'Http/Controllers/Workstation/UserController.php';
                break;
                default:
                    $path = 'Http/Controllers/';
                break;
            }
            $swagger = \Swagger\scan(app_path($path));

            return response()->json($swagger, 200);
        }
    }