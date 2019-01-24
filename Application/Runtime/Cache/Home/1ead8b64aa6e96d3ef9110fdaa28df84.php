<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-bg">
<head>
    <title>CTBAdmin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="/Public/jquery/jquery.min.js"></script>
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/main.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body class="admin_bg">
<div class="container" style="width: 100%;">
    <div class="row">
        <div class="col-xs-12" style="padding-top:80px;height: 180px;color: aliceblue;font-size: 30px;text-align: center;">
            CTB-Admin登陆系统
        </div>
    </div>
    <form action="<?php echo U('index');?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div style="height: 330px;width: 350px; background-color: aliceblue; margin: 0 auto;opacity: 0.8;border-radius:5px;box-shadow: 5px 5px 0px #888888;">
            <div class="row" style="text-align: center;font-size: 18px;padding-top: 30px;padding-bottom: 30px;"><b>用户信息</b></div>
            <div class="row">
                <input type="text" name="username" style="width: 280px;height: 40px;margin-left: 50px;padding-left: 10px;background-color:#ffffff;border-radius:4px;" placeholder="输入用户名">
            </div>
            <div style="height: 10px;"></div>
            <div class="row">
                <input type="password" name="pwd" style="width: 280px;height: 40px;margin-left:50px;padding-left: 10px;border-radius:4px;" placeholder="输入密码">
            </div>
            <div class="row" style="text-align: right;padding-right: 62px;padding-top: 15px;font-size: 14px;">
                <span style="text-decoration:underline; color: #8c8c8c;">忘记密码</span>
            </div>
            <div class="row" style="padding-left:55px;">
                <table style="border: 0;">
                    <tr style="height: 20px;">
                        <td><input type="checkbox" name="checkbox" id="checkbox" ></td>
                        <td style="padding-top: 5px;font-size: 12px;">记住密码</td>
                        <td style="width: 20px;"></td>
                        <td><input type="radio" name="systemset" id="checkbox12" value="system"></td>
                        <td style="padding-top: 5px;font-size: 12px;">系统设置</td>
                        <td style="width: 20px;"></td>
                        <td><input type="radio" name="systemset" checked="checked"  id="checkbox23" value="test"></td>
                        <td style="padding-top: 5px;font-size: 12px;">习题处理</td>
                    </tr>
                </table>
            </div>
            <div class="row" style="padding-left: 40%;">
                <input class="admin_login" style="border:0;" type="submit" value="登录">
            </div>
        </div>
    </div>
    </form>
    <div class="row" style="color: aliceblue;padding-top:30px;padding-bottom: 20px;text-align: center">
        <span>还没有账号！</span><a>注册</a>
    </div>
</div>
</body>
</html>