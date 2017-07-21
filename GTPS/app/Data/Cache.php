<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-13
     * Time: 17:41
     */

    namespace App\Data;

    use Closure;
    use Predis\Connection\ConnectionException;

    class Cache
    {
        /** 没有保存的判定值 */
        const NOT_SET_VALUE = null;
        /** 无限期存储时间 */
        const INFINITE_TIME = 0;

        /**
         * 将数据保存到缓存
         *
         * @param string    $key         键
         * @param mixed     $val         值
         * @param float|int $expire_time 过期时间。单位：分钟
         */
        public static function set($key, $val, $expire_time = 5)
        {
            try{
                if($expire_time === self::INFINITE_TIME) \Illuminate\Support\Facades\Cache::forever($key, $val);
                else \Illuminate\Support\Facades\Cache::put($key, $val, $expire_time);
            }catch(ConnectionException $connection_exception){
            }
        }

        /**
         * 从缓存获取数据
         *
         * @param string $key 键
         *
         * @return mixed
         */
        public static function get($key)
        {
            try{
                return \Illuminate\Support\Facades\Cache::get($key);
            }catch(ConnectionException $connection_exception){
                return self::NOT_SET_VALUE;
            }
        }

        /**
         * 清除缓存中所有数据
         *
         * @return bool
         */
        public static function clean()
        {
            try{
                return \Illuminate\Support\Facades\Cache::flush();
            }catch(ConnectionException $connection_exception){
                return false;
            }
        }

        /**
         * 从缓存删除数据
         *
         * @param string $key 键
         *
         * @return null
         */
        public static function del($key)
        {
            try{
                return \Illuminate\Support\Facades\Cache::forget($key);
            }catch(ConnectionException $connection_exception){
                return self::NOT_SET_VALUE;
            }
        }

        /**
         * 试图从缓存获取数据，若缓存不存在该数据则从闭包中获取
         *
         * @param string  $key    键
         * @param Closure $fetch  其他获取数据的方式
         * @param bool    $update 是否更新到缓存
         *
         * @return mixed
         */
        public static function pick(string $key, Closure $fetch, bool $update = true)
        {
            if(($result = self::get($key)) === self::NOT_SET_VALUE){
                $result = $fetch();
                if($update) self::set($key, $result);
            }

            return $result;
        }
    }