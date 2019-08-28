<div id="head">
<h2 >商品信息管理</h2>
<a href="liulan.php" id="one">浏览商品</a>
<a href="add.php">添加商品</a>
<a href="mycart.php">我的购物车(<?php
//    if(empty($_SESSION[$userid]['totalnum']))
//    {
//        $_SESSION[$userid]['totalnum']=0;
//    }
//
//    echo $_SESSION[$userid]['totalnum'];
//    !--)</a>-->$
    if(empty($_SESSION['userid'])) {

        echo"0";
    }else {
        $userid=$_SESSION['userid'];
        $totalnum=0;
        $link = mysql_connect('localhost', 'root', 'root');
        $sel = mysql_select_db('shopdb');
        $res=mysql_query("select * from userscart where userid='{$userid}'");
        if(mysql_num_rows($res)>0)
        {
            while ($row=mysql_fetch_assoc($res)){
            $totalnum+=$row['num'];

            };
        }
        echo $totalnum;

    }
?>)
<a href="houtai/clearcart.php">清空购物车</a>
    <?php
    if(empty($_SESSION['userid'])) {

     echo "   <a href = 'index.php'> 登录</a >";
    }else
    {
        echo "<a href='out.php'>注销</a>";
    }
?>
</div>