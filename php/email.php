<?php
/**
 * SMTP 邮件发送服务
 *
 * 可以不用QQ邮箱，只要是SMTP服务的邮箱都可以
 *
 * BY https://pingxonline.com/
 */

include_once 'config.php';

class sendEmail
{
    function __construct()
    {

    }

    /**
     * @param $linkDatabaese
     * @param $uid
     * @param $email
     * @throws phpmailerException
     */
    public function sendOut($linkDatabaese, $uid, $email)
    {
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.qq.com;';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;
        $mail->CharSet = "utf-8";                               // Enable SMTP authentication
        $mail->Username = config::$email_config['SMTP_USERNAME'];                 // SMTP username
        $mail->Password = config::$email_config['SMTP_PASSWORD'];                           // SMTP password 这里需要QQ邮箱开启独立密码并填写到这里
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, tls `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $link = config::$email_config['SHARE_LINK']."?id={$uid}";

        $mail->setFrom(config::$email_config['SMTP_ADRESS'], config::$email_config['SMTP_NAME']);// 填写发送人的邮箱，和主题标题
        $mail->addAddress("{$email}");               // Name is optional 对方的邮件地址
        $mail->addReplyTo(config::$email_config['SMTP_ADRESS'], config::$email_config['SMTP_NAME']); // 填写回复的邮箱，和主题标题

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        // 组装a标签链接
        $a_tag = "<a href='{$link}'>{$link}</a>";
        // 替换占位符
        $body = str_replace("{{link}}", $a_tag, config::$email_config['EMAIL_BODY']);

        $mail->Subject = config::$email_config['EMAIL_TITLE'];// 邮件的标题
        $mail->Body    = $body;
        $mail->AltBody = '';

        if(!$mail->send()) {
            echo config::$email_config['EMAIL_FAILED'];
            if (config::$email_config['EMAIL_DEBUG']){
                // 输出DEBUG信息，调试邮件发送功能
                echo 'Mailer Error: ' . $mail->ErrorInfo . '<br>';
            }
            // 发送失败，标记isSended为2，0为未发送，1为发送成功，2为失败
            $sql = "UPDATE `saylove_2017_posts` set isSended = '2' where id='$uid'";
            mysqli_query($linkDatabaese, $sql);
        } else {
            echo config::$email_config['EMAIL_SUCCESS'];
            $sql = "UPDATE `saylove_2017_posts` set isSended = '1' where id='$uid'";
            mysqli_query($linkDatabaese, $sql);
        }
    }
}

?>
