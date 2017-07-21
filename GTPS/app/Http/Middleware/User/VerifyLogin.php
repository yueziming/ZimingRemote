<?php

    namespace App\Http\Middleware\User;

    use App\Data\Session;
    use Closure;
    use Illuminate\Support\Facades\Route;
    use TDXK\OA;

    class VerifyLogin
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         * @param string                    $type 类型
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
                    $oa_object = new OA(true, [
                        'type'     => env('OA_DATABASE_TYPE', 'mysql'),
                        'address'  => env('OA_DATABASE_ADDRESS', ''),
                        'port'     => env('OA_DATABASE_PORT', 3306),
                        'database' => env('OA_DATABASE_NAME', ''),
                        'user'     => env('OA_DATABASE_USER', ''),
                        'password' => env('OA_DATABASE_PASSWORD', '')
                    ]);
                    // 登入验证
                    $result = $oa_object->loginVerify($request->input('username'), $request->input('password'));

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
         * 判断是否登入
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return bool
         */
        public static function isLogin($request)
        {
            $user_id = $request->session()->get(Session::LOGIN_USER_ID);

            return $user_id ? true : false;
        }
    }
