<?php

    namespace App\Http\Controllers;

    use App\Data\Session;
    use App\Http\Middleware\User\VerifyLogin;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    class Controller extends BaseController
    {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        public function __construct()
        {
        }

        public static function success($uri = null, $message = '', $code = 0)
        {
            if(!$uri) $uri = $_SERVER['REDIRECT_URL'];

            return view('error.success', [
                'code'        => $code,
                'message'     => $message,
                'wait_second' => env('APP_ERROR_SECOND', 3),
                'return_page' => $uri
            ]);
        }

        public static function failure($uri = null, $message = '', $code = 0)
        {
            if(!$uri) $uri = $_SERVER['REDIRECT_URL'];

            return view('error.failure', [
                'code'        => $code,
                'message'     => $message,
                'wait_second' => env('APP_ERROR_SECOND', 3),
                'return_page' => $uri
            ]);
        }

        public function index(Request $request)
        {
            return view('welcome', [
                'user' => [
                    'id' => $request->session()->get(Session::LOGIN_USER_ID),
                    'name' => $request->session()->get(Session::LOGIN_USER_NAME),
                ]
            ]);
        }
    }
