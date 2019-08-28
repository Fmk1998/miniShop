<?php
/**
 * Created by PhpStorm.
 * User: lizer
 * Date: 2019/2/27
 * Time: 19:04
 */
session_start();
unset($_SESSION['userid']);
session_destroy();
header('Location:index.php')
?>