<?php

/**
 * 数据库连接类
 *
 * BY https://pingxonline.com/
 *
 */

include_once 'config.php';

class connectDataBase
{
    public $link = "";
    function __construct()
    {
        // 配置数据库链接参数：地址、用户名、密码、数据库名,
		// 请修改config.php文件
        $host = config::$config['host'];
        $user = config::$config['user'];
        $pass = config::$config['pass'];
        $db_name = config::$config['db_name'];
        $timezone="Asia/Shanghai"; // 时区

        if ($link = mysqli_connect($host,$user,$pass)) {
            mysqli_select_db($link,$db_name);
            mysqli_query($link,"set names 'UTF8'");
            // $ip = getIP();
            $this->link = $link;
            // echo "数据库连接成功".$this->link."\n";
        } else {
            echo "数据库连接失败！";
            exit;
        }
    }
    /**
     * 检测当前IP是否在黑名单内
     * @method checkBlackList
     * @param  string         $ip [传入的IP地址]
     * @return [int]           -1  [IP地址不存在]
     *                         0   [IP地址不在黑名单内]
     *                         1   [IP地址存在黑名单内]
     */
    public function checkBlackList($ip)
    {
        # 检测黑名单
        if ($ip == '') {
            return -1;
        } else {
            $sql = mysqli_query($this->link, "SELECT `ip` FROM `saylove_2017_blacklist` WHERE ip='$ip'");
            $count = mysqli_num_rows($sql);
            if($count==0){
                return 0;
            }else {
                return 1;
            }
        }
    }

    /**
     * 获取真实IP地址
     * @method getIP
     * @return string 返回真实IP地址
     */
    public function getIP()
    {
        $unknown = 'unknown';$ip='';
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        /**
         * 处理多层代理的情况
         * 或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;
         */
        if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip));
        return $ip;
    }


    /**
     * 检测与过滤服务器接收到的数据
     * @method test_input
     * @param  string     $data 传入需要检测的数据
     * @return string           返回过滤过的数据
     */
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>
