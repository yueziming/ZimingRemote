<?php

    namespace App\Providers;

    use App\Model\System\BaseData;
    use Illuminate\Support\ServiceProvider;
    use Quasar\Utility\Tree;

    class CustomServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot()
        {
            //
        }

        /**
         * Register the application services.
         *
         * @return void
         */
        public function register()
        {
            /*
             * 绑定Tree类到服务者容器
             */
            $this->app->bind('Quasar.Tree', function (){
                return new Tree();
            });
            /*
             * 绑定BaseData模型到服务者容器
             */
            $this->app->bind('Quasar.Model.BaseData', function (){
                return new BaseData();
            });
        }
    }
