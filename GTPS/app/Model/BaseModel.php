<?php

    namespace App\Model;

    use Illuminate\Database\Eloquent\Model;

    /**
     * @property \Carbon\Carbon $created_at
     * @property int            $id
     * @property \Carbon\Carbon $updated_at
     */
    class BaseModel extends Model
    {
        /** 通用记录状态 */
        const STATUS = [
            self::STATUS_DISABLED => '禁用',
            self::STATUS_ENABLED  => '可用',
            self::STATUS_DELETED  => '删除'
        ];
        /** 记录已禁用 */
        const STATUS_DISABLED = 0;
        /** 记录可用 */
        const STATUS_ENABLED = 1;
        /** 记录已删除 */
        const STATUS_DELETED = 2;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 返回结果数据
         *
         * @param bool   $status  结果状态
         * @param string $message 提示信息
         * @param array  $option  额外信息
         *
         * @return array
         */
        protected static function returnResult(bool $status, string $message, array $option = [])
        {
            if(isset($option['status'])) unset($option['status']);
            if(isset($option['message'])) unset($option['message']);

            return array_merge(['status' => $status, 'message' => $message], $option);
        }

        /**
         * 分析并获取错误信息
         *
         * @param string $message 错误信息
         *
         * @return string
         */
        public static function analysisErrorMessage(string $message)
        {
            if(preg_match('/Column not found: 1054 Unknown column \'(\S+)\'/', $message, $match) === 1) return "找不到【$match[1]】字段";
            else return $message;
        }
    }
