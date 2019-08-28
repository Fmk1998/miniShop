<?php
session_start();
if (isset($_SESSION['userid']))
    $userid=$_SESSION['userid'];
else
    $userid=null;

?>
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

<h3>登录/注册</h3>
<form action="houtai/register2.php?action=register" method="post">
    <table id="center">
    <tr><td class="info">账号</td> <td><input type="text" name="username"></td></tr>
    <tr><td class="info">密码</td> <td><input type="password" name="password" ></td></tr>
       <tr><td class="info">确认密码</td> <td><input type="password" name="repassword"></td></tr>
    <tr><td></td><td><input type="submit" value="注册" id="submit">
    <input type="reset" value="重置"id="reset"></td></tr>
    </table>
</form>
</body>
</html>