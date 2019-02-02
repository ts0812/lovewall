<?php
/**
 * Created by PhpStorm.
 * User: https://pingxonline.com/
 * Date: 2018-11-02
 * Time: 10:17
 *
 * 配置文件
 *
 */

class config
{
    // 数据库链接配置
    public static $config = [
        // 数据库地址
        "host" => '127.0.0.1',
        // 数据库用户名
        "user" => 'root',
        // 数据库密码
        "pass" => 'root',
        // 对应的数据库名字
        "db_name" => 'lovewall'
    ];
    // 邮件发送配置
    public static $email_config = [
        // 邮件的主题名字
        "SMTP_NAME" => "小世界表白墙",
        // SMTP 用户名，如果是QQ邮箱申请的则填写QQ邮箱
        "SMTP_USERNAME" => "1352645017@qq.com",
        // SMTP 邮箱地址，如果是QQ邮箱申请的则填写QQ邮箱
        "SMTP_ADRESS" => "1352645017@qq.com",
        // SMTP 密码，如果是QQ邮箱申请的则填写开通SMTP服务后生成的密码
        "SMTP_PASSWORD" => "dltsscmokkuyjafb",
        // 分享地址，填写到能够访问该表白墙 share.php 文件的地址
        "SHARE_LINK" => "http://love.mybdxc.cn/app/saylove/share.php",
        // 邮件标题
        "EMAIL_TITLE" => "你被表白啦！来自小世界表白墙",
        // 邮件内容，{{link}} 为表白链接的占位符，可随意更改位置，系统自动替换为表白链接。
        "EMAIL_BODY" => "你被表白啦！点击这里查看表白：{{link}}。<br>此封邮件来自小世界表白墙应用<br>官网地址：http://love.mybdxc.cn/app/saylove",
        // 邮件发送成功返回
        "EMAIL_SUCCESS" => "邮件发送成功",
        // 邮件发送失败返回
        "EMAIL_FAILED" => "邮件发送失败！因为当前人数太多，邮件发送频率高被限制，不过系统会在稍后自动重新发送邮件，请放心，联系站长QQ：1352645017<br>",
        // 失败的时候是否返回错误的详细信息，英文的信息，带错误码，用于程序调试，不显示就改为false
        "EMAIL_DEBUG" => true
    ];

    // 基本配置
    public static $base_config = [
        // 每页显示多少条表白数
      "max_item" => 18,
        // 限制在session有效期内的表白提交次数，防御脚本攻击
      "max_submit_post" => 3
    ];

    // 后台登录账号密码
    public static $admin_config = [
        "admin_username" => "admin",
        "admin_password" => "123456"
    ];
}
