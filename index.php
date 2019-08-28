<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/login.css">
    <title>登录</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: lizer
 * Date: 2019/2/26
 * Time: 18:37
 */
require('menu.php');
setcookie('username', '');
setcookie('password','');
 ?>
<h3 align="center">登录/注册</h3>
<form action="houtai/register2.php?action=login" method="post">
    <table id="center">
    <tr>
        <td class="info">账号</td> <td><input type="text" name="username"  value="<?php echo @$_COOKIE['username'] ?>"></td>
    </tr>
    <tr>
        <td class="info">密码</td> <td><input type="password" name="password" value="<?php echo @$_COOKIE['password'] ?>"></td>
    </tr>
    <tr>
        <td class="info">密码</td> <td><input type="password" name="password" value="<?php echo @$_COOKIE['password'] ?>"></td>
    </tr>
    <tr>
        <td id="cheeee"><input  id="checkbox" type="checkbox" name="rem" value="1">记住密码</td></tr>
    <tr>
        <td></td>
        <td><input type="submit" value="登录" id="submit"><a href="register.php" id="register">注册</a></td>
    </tr></table>
</form>
</body>
</html>
