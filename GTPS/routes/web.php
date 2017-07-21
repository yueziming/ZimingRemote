<?php
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */
    Route::get('/', 'Controller@index')->name('homepage');
    Route::get('/test', 'Workstation\TestController@index');
    /* 登入页 */
    Route::get('/login', 'Workstation\UserController@login')->middleware('healthOneVerify.login:after_login')->name('login-page');
    Route::post('/login', 'Workstation\UserController@login')->middleware('healthOneVerify.login:when_login');
    /* 注销页 */
    Route::delete('/logout', 'Workstation\UserController@logout')->middleware('healthOneVerify.login:before_login');
    /* 获取登入用户的状态和信息 */
    Route::get('/get-login-user', 'Workstation\UserController@getLoginUser');
    /* PC端后台路由组 */
    Route::group(['prefix' => 'workstation', 'middleware' => ['healthOneVerify.login:before_login']], function (){
        Route::group(['prefix' => 'member'], function (){
            /* 会员管理页 */
            Route::get('manage', 'Workstation\MemberController@manage');
            /* 发卡管理页 */
            Route::get('manage-card', 'Workstation\CardController@manage');
        });
        Route::group(['prefix' => 'socket'], function (){
            /* 将用户和Socket标识进行绑定 */
            Route::post('bind', 'Workstation\SocketController@bind');
        });
        Route::group(['prefix' => 'client'], function (){
            /* 客户管理页 */
            Route::get('manage', 'Workstation\ClientController@manage');
            /* 客户详情页  */
            Route::get('detail/{client_id}', 'Workstation\ClientController@detail')->where('user_id', '[0-9]+');
            /* 获取客户列表 */
            Route::get('get-list', 'Workstation\ClientController@getList');
            /* 获取客户表字段列表 */
            Route::get('get-field-list', 'Workstation\FieldController@getClientList');
            /* 创建客户数据 */
            Route::post('save', 'Workstation\ClientController@save');
        });
        Route::group(['prefix' => 'user'], function (){
            /* 用户管理页 */
            Route::get('manage', 'Workstation\UserController@manage');
            /* 获取部门列表的响应 */
            Route::get('get-tree', 'Workstation\UserController@getTreeList');
            /* 获取选择用户的角色列表 */
            Route::get('get-role-by-user/{user_id}', 'Workstation\RoleController@getListByUser')->where('user_id', '[0-9]+');
            /* 获取选择角色的权限列表 */
            Route::get('get-permission/{user_id}', 'Workstation\UserController@getPermission')->where('user_id', '[0-9]+');
            /* 获取选择用户的所有权限列表 */
            Route::get('get-all-permission/{user_id}', 'Workstation\UserController@getAllPermission')->where('user_id', '[0-9]+');
            /* 用户独立授权 */
            Route::post('grant/{user_id}', 'Workstation\UserController@grant')->where('user_id', '[0-9]+');
            /* 取消用户独立授权 */
            Route::patch('revoke/{user_id}', 'Workstation\UserController@revoke')->where('user_id', '[0-9]+');
        });
        Route::group(['prefix' => 'message'], function (){
            /* 消息管理页 */
            Route::get('manage', 'Workstation\MessageController@manage');
        });
        Route::group(['prefix' => 'role'], function (){
            /* 角色管理页 */
            Route::get('manage', 'Workstation\RoleController@manage');
            /* 获取角色列表的响应 */
            Route::get('get-list', 'Workstation\RoleController@getList');
            /* 获取选择角色的用户列表 */
            Route::get('get-user-by-role/{role_id}', 'Workstation\UserController@getListByRole')->where('user_id', '[0-9]+');
            /* 获取选择角色的权限列表 */
            Route::get('get-permission/{role_id}', 'Workstation\RoleController@getPermission')->where('user_id', '[0-9]+');
            /* 角色授权 */
            Route::post('grant/{role_id}', 'Workstation\RoleController@grant')->where('user_id', '[0-9]+');
            /* 取消角色授权 */
            Route::patch('revoke/{role_id}', 'Workstation\RoleController@revoke')->where('user_id', '[0-9]+');
        });
        /* 登入后主页 */
        Route::get('index', 'Workstation\Workstation@index')->name('index-after-login');
        Route::group(['prefix' => 'k3'], function (){
            /* 获取区域列表 */
            Route::get('get-area', function (){
                return \App\Model\HealthOne\View\View::AREA;
            });
            /* 客户同步页 */
            Route::get('client', 'Workstation\K3\ClientController@sync');
            /* 获取客户输入数据 */
            Route::get('client/get-input-list', 'Workstation\K3\ClientController@getInputList');
            /* 部门同步页 */
            Route::get('department', 'Workstation\K3\DepartmentController@sync');
            /* 获取部门输入数据 */
            Route::get('department/get-input-list/{area}', 'Workstation\K3\DepartmentController@getInputList')->where('area', '[A-Za-z]+');
            /* 员工同步页 */
            Route::get('employee', 'Workstation\K3\EmployeeController@sync');
            /* 获取员工输入数据 */
            Route::get('employee/get-input-list', 'Workstation\K3\EmployeeController@getInputList');
            /* 供应商同步页 */
            Route::get('supplier', 'Workstation\K3\SupplierController@sync');
            /* 获取供应商输入数据 */
            Route::get('supplier/get-input-list', 'Workstation\K3\SupplierController@getInputList');
            /* 物料同步页 */
            Route::get('materiel', 'Workstation\K3\MaterielController@sync');
            /* 获取物料输入数据 */
            Route::get('materiel/get-input-list', 'Workstation\K3\MaterielController@getInputList');
            /* 会所同步页 */
            Route::get('organization', 'Workstation\K3\MaterielController@sync');
            /* 获取会所输入数据 */
            Route::get('organization/get-input-list', 'Workstation\K3\OrganizationController@getInputList');
        });
    });
    Route::get('/k3', function (){
        $k3 = new \Kingdee\K3Api(env('KINGDEE_HOST'), env('KINGDEE_AUTHORITY'), new \Quasar\Utility\Curl(), 'http', env('KINGDEE_ENCRYPT_PASSWORD'));
        $k3->getSaleDeliveryList();
    });
    Route::get('/redis', function (){
        \App\Data\Cache::clean();
    });
    Route::get('/asd', function (){
        $r = \App\Data\Cache::get('Login.User.List');
        dump($r);
    });