<?php

    namespace App\Http\Middleware;

    use App\Model\HealthOne\User;
    use Closure;
    use App\Data\Session;
    use Exception;
    use Illuminate\Database\QueryException;
    use Illuminate\Support\Facades\Route;

    class HealthOneVerify
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         * @param string                    $type
         *
         * @return mixed
         */
        public function handle($request, Closure $next, $type = '')
        {
            $route_name = strtolower(Route::currentRouteName());
            switch($type){
                case 'after_login':
                    $user_id = self::isLogin($request);
                    if($route_name == 'login-page'){
                        if($user_id) return redirect()->route('index-after-login');
                    }
                    else{
                        if(!$user_id) return redirect()->route('login-page');
                    }
                break;
                case 'when_login':
                    $result = self::_xmlMessage($request); //坐标登录验证
                    if($result['status']){
                        try{
                            $userInfo       = User::where('Code', $request->get('username'))->first();
                            $result['data'] = [
                                'id'   => $userInfo->ID,
                                'name' => $userInfo->Name,
                                'code' => $userInfo->Code,
                            ];
                        }catch(Exception $exception){
                            return ['status' => false, 'message' => '用户信息获取失败,请稍后重试'];
                        }
                    }
                    $request->loginVerifyResult = $result;
                break;
                case 'before_login':
                    $user_id = self::isLogin($request);
                    if($route_name != 'login-page'){
                        if(!$user_id) return redirect()->route('login-page');
                    }
                break;
            }

            return $next($request);
        }

        /**
         * 坐标登录验证 XML
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return array
         */
        private static function _xmlMessage($request)
        {
            try{
                $url = env('HEALTHONE_LOGIN_VERIFY_URL', '');
                $url = str_replace('[code]', $request->get('username'), $url);
                $url = str_replace('[pass]', $request->get('password'), $url);
                $xml = get_object_vars(simplexml_load_string(file_get_contents($url)))['@attributes'];
                return $xml['State'] === '0' ? [
                    'status'  => true,
                    'message' => '登录成功'
                ] : [
                    'status'  => false,
                    'message' => $xml['ErrorText']
                ];
            }catch(QueryException $exception){
                return ['status' => false, 'message' => $exception->getMessage()];
            }catch(Exception $exception){
                $message = $exception->getMessage();
                if(stripos($message, 'failed to open stream') !== null) $message = '坐标数据库连接失败';
                return ['status' => false, 'message' => $message];
            }
        }

        /**
         * 判断是否登入
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return bool
         */
        private static function isLogin($request)
        {
            $user_id = $request->session()->get(Session::LOGIN_USER_ID);

            return $user_id ? true : false;
        }
    }
