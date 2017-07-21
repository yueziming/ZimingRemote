<?php

    namespace App\Exceptions;

    use Exception;
    use Illuminate\Auth\AuthenticationException;
    use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use Symfony\Component\HttpKernel\Exception\HttpException;

    class Handler extends ExceptionHandler
    {
        /**
         * A list of the exception types that should not be reported.
         *
         * @var array
         */
        protected $dontReport = [
            \Illuminate\Auth\AuthenticationException::class,
            \Illuminate\Auth\Access\AuthorizationException::class,
            \Symfony\Component\HttpKernel\Exception\HttpException::class,
            \Illuminate\Database\Eloquent\ModelNotFoundException::class,
            \Illuminate\Session\TokenMismatchException::class,
            \Illuminate\Validation\ValidationException::class,
        ];

        /**
         * Report or log an exception.
         * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
         *
         * @param  \Exception $exception
         *
         * @return void
         */
        public function report(Exception $exception)
        {
            parent::report($exception);
        }

        /**
         * Render an exception into an HTTP response.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Exception               $exception
         *
         * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
         */
        public function render($request, Exception $exception)
        {
            if(!config('app.debug')){
                $error_code = $exception->getStatusCode();
                if(view()->exists('error.'.$error_code)){
                    $error_message = $exception->getMessage();

                    return response()->view("error.$error_code", [
                        'code'        => $error_code,
                        'message'     => $error_message,
                        'wait_second' => env('APP_ERROR_SECOND', 3),
                        'return_page' => $_SERVER['REDIRECT_URL']
                    ], $error_code);
                }
            }

            return parent::render($request, $exception);
        }

        /**
         * Convert an authentication exception into an unauthenticated response.
         *
         * @param  \Illuminate\Http\Request                 $request
         * @param  \Illuminate\Auth\AuthenticationException $exception
         *
         * @return \Illuminate\Http\Response
         */
        protected function unauthenticated($request, AuthenticationException $exception)
        {
            if($request->expectsJson()){
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            return redirect()->guest(route('login'));
        }
    }
