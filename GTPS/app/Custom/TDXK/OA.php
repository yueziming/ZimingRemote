<?php

    namespace TDXK;

    use App\Standard\Custom\System\UserStandard;
    use Exception;
    use PDO;
    use PDOException;
    use Throwable;

    class OA implements UserStandard
    {
        /** @var array 数据库参数 */
        private $_dbConfig = [
            'type'     => '',
            'address'  => '',
            'port'     => '',
            'database' => '',
            'user'     => '',
            'password' => ''
        ];
        /** @var null|PDO 数据库连接对象 */
        private $_link = null;
        /** @var array 错误栈 */
        private $_errorStack = [];

        /**
         * 创建PDO连接的连接参数
         *
         * @return string
         */
        private function _makeLinkString()
        {
            $type     = $this->_dbConfig['type'];
            $address  = $this->_dbConfig['address'];
            $port     = $this->_dbConfig['port'];
            $database = $this->_dbConfig['database'];

            return "$type:host=$address;port=$port;dbname=$database";
        }

        public function __construct(bool $auto_connect = false, array $option = [])
        {
            if($auto_connect){
                $this->connect($option);
            }
        }

        public function connect(array $option)
        {
            if(is_array($option)){
                $this->_dbConfig = array_merge($this->_dbConfig, $option);
            }
            // 建立mysql连接
            try{
                $this->_link = @new PDO($this->_makeLinkString(), $this->_dbConfig['user'], $this->_dbConfig['password'], [
                    PDO::ATTR_TIMEOUT            => 3,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_CASE               => PDO::CASE_LOWER,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);

                return true;
            }catch(PDOException $pdo_exception){
                $error_message = $pdo_exception->getMessage();
                $error_code    = $pdo_exception->getCode();
                if(!(stripos($error_message, 'could not find driver') === false)){
                    $this->_errorStack[] = [-2, '数据库驱动指定错误'];
                }
                elseif(preg_match("/Host '([0-9.]*)' is not allowed to connect to this MySQL server/", $error_message, $match_result)){
                    $this->_errorStack[] = [$error_code, "当前机($match_result[1])不允许访问OA数据库"];
                }
                else{
                    switch($error_code){
                        case 1049:
                            $this->_errorStack[] = [$error_code, '找不到指定的数据库'];
                        break;
                        case 1045:
                            $this->_errorStack[] = [$error_code, '数据库用户/密码错误'];
                        break;
                        case 2002:
                            $this->_errorStack[] = [$error_code, '数据库地址/端口错误'];
                        break;
                        case 1130:
                            $this->_errorStack[] = [$error_code, $error_message];
                        break;
                    }
                }

                return false;
            }
        }

        /**
         * 构析函数<br>
         * 并断开数据库连接
         */
        public function __destruct()
        {
            $this->_link = null;
        }

        /**
         * 获取错误
         *
         * @param bool $get_new      是否只获取最后一个错误信息
         * @param bool $just_message 只获取错误提示（$get_new为true时才生效）
         *
         * @return array
         */
        public function getError($get_new = false, $just_message = true)
        {
            if(count($this->_errorStack) === 0) return [];
            else return $get_new ? ($just_message ? @$this->_errorStack[count($this->_errorStack)-1][1] : @$this->_errorStack[count($this->_errorStack)-1]) : $this->_errorStack;
        }

        public function getUserList()
        {
            if(!$this->_link){
                $recent_error = $this->getError(true, false);
                throw new OAException($this->getError($recent_error[0], $recent_error[1]));
            }
            $fetch_statement = $this->_link->query("
SELECT
    uid id,
    user_id,
    user_name `name`,
    user_name_index `name_pinyin`,
    byname code,
    password,
    user_priv_name `position`,
    department.dept_id,
    department.dept_name,
    case sex when 0 then '男' when 1 then '女' else '未知' end gender,
    birthday,
    mobil_no mobile,
    email,
    oicq_no qq,
    my_status signature ,
    photo avater
FROM user
LEFT JOIN department ON user.DEPT_ID = department.DEPT_ID
WHERE not_login = 0
");
            $result          = $fetch_statement->fetchAll();

            return $result;
        }

        public function getDeptList()
        {
            function makeTree($data, $top_id = 0)
            {
                $result = [];
                foreach($data as $key => $val){
                    if($val['parent_id'] == $top_id){
                        unset($data[$key]);
                        $val['sub_dept'] = makeTree($data, $val['id']);
                        $result[]        = $val;
                    }
                }

                return $result;
            }

            if(!$this->_link){
                $recent_error = $this->getError(true, false);
                throw new OAException($this->getError($recent_error[0], $recent_error[1]));
            }
            $fetch_statement = $this->_link->query("
SELECT
    dept_id id,
    dept_parent parent_id,
    dept_name name,
    manager,
    assistant_id assistant,
    leader1,
    leader2,
    weixin_dept_id,
    dept_func description
FROM department
");
            $result          = $fetch_statement->fetchAll();
            $result          = makeTree($result, 0);

            return $result;
        }

        public function loginVerify(string $user_name, string $password)
        {
            if(!$this->_link){
                $recent_error = $this->getError(true, false);
                throw new OAException($this->getError($recent_error[0], $recent_error[1]));
            }
            try{
                $fetch_statement = $this->_link->prepare("
SELECT
    uid id,
    user_id,
    user_name `name`,
    user_name_index `name_pinyin`,
    byname code,
    password,
    user_priv_name `position`,
    department.dept_id,
    department.dept_name,
    case sex when 0 then '男' when 1 then '女' else '未知' end gender,
    birthday,
    mobil_no mobile,
    email,
    oicq_no qq,
    my_status signature ,
    photo avater
FROM user
LEFT JOIN department ON user.DEPT_ID = department.DEPT_ID
WHERE not_login = 0 and byname = ?");
                $fetch_statement->bindValue(1, $user_name);
                if(!$fetch_statement->execute()){
                    $this->_errorStack[] = [$fetch_statement->errorCode(), $fetch_statement->errorInfo()];

                    return ['status' => false, 'message' => $this->getError(true)];
                }
                $current_user = $fetch_statement->fetch();
                if(!$current_user){
                    $this->_errorStack[] = [-444, '账号/工号不存在'];

                    return ['status' => false, 'message' => $this->getError(true)];
                }
            }catch(Exception $exception){
                $this->_errorStack[] = [$exception->getCode(), $exception->getMessage()];

                return ['status' => false, 'message' => $this->getError(true)];
            }
            if(!preg_match('/\$1\$\S+\$/', $current_user['password'], $preg_result)){
                $this->_errorStack[] = [-445, '密码数据异常'];

                return ['status' => false, 'message' => $this->getError(true)];
            }
            $crypt_prefix   = $preg_result['0'];
            $crypt_password = crypt($password, $crypt_prefix);
            $result         = hash_equals($current_user['password'], $crypt_password);
            if($result) return ['status' => true, 'message' => '验证成功', 'data' => $current_user];
            else{
                $this->_errorStack[] = [-446, '密码错误'];

                return ['status' => false, 'message' => '密码错误'];
            }
        }
    }

    class OAException extends Exception
    {
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
    }