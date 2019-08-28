<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (!isset($_SESSION['userid'])||$_SESSION['userid']==null)
echo "<script>alert('请先登录！');window.location.href='index.php';</script>";
else
{
$userid=$_SESSION['userid'];

?>
<!doctype html>
<html >
<head>
    <meta charset="UTF-8">
    <title>商品信息管理</title>
<!--    <script>-->
<!--        function tanchuang(){-->
<!--            alert("添加成功！");-->
<!--        }-->
<!--    </script>-->
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/index.css">

</head>
<body>
<?php
    require("menu.php");
    require("houtai/create.php");

?>
<h3>浏览商品信息</h3>

    <!--<th>商品编号</th>
    <th>商品名称</th>
    <th>商品图片</th>
    <th>单价</th>
    <th>库存</th>
    <th>添加时间</th>
    <th>操作</th>-->
<div id="left">
    <?php
    date_default_timezone_set('Asia/Shanghai');
        require("houtai/dbconfig.php");
        $link=mysql_connect(host,user,pass);
        mysql_select_db(dbname,$link);
        $res=mysql_query("select * from goods",$link);
        if(mysql_num_rows($res)==0)
        {
            echo "<p >什么都没有哦，快去发布商品吧</p>";
        }else
        while($row=mysql_fetch_assoc($res))
        {
            echo"
            
            <div id='center'>
            <!--<td>{$row['id']}</td>-->
            <h2 id='name'>{$row["name"]}</h2>
            <div id='img'><img src='./uploads/_{$row['pic']}'/></div>
            <div class='one'> <total>库存：{$row['total']}</total><br>
           <time>发布时间：".date("Y-m-d H:i:s",$row['addtime'])."</time><br>
           <div id='note'>
           描述：<br>{$row['note']}
</div>
         <h4>{$row['price']}元</h4><br></div><br>
           
       
            <a href='edit.php?id={$row['id']}'id='update'>修改</a>
            <a href='houtai/action.php?action=del&id={$row['id']}&picname={$row['pic']}' id='del'>删除</a>
            <a href='houtai/addcart.php?id={$row['id']}' id='buy'>加入购物车</a></div>
            
            
            ";
        }

    ?>

</div>
<div id="right">
    <h5>我的购物车</h5>
    <table id="right">
        <tr id="top">
            <th>商品名称</th>
            <th>单价</th>
            <th>数量</th>
            <th>小计</th>
        </tr>
    <?php
    $sum0=0;
    mysql_select_db(dbname,$link);
    $res=mysql_query("select * from userscart where userid='{$userid}'");
//    if($row=mysql_fetch_assoc($res))
//    {
//        echo "<tr id='cart'><td colspan='4'>什么都没有哦</td></tr>    ";
//    }
//else
    while($row=mysql_fetch_assoc($res))
    {
        $id=$row['id'];

        mysql_select_db(dbname,$link);
        $result=mysql_query("select * from goods where id='{$id}'",$link);
        $shop=mysql_fetch_assoc($result);
        $sum = $shop['price'] * $row['num'];
        echo "<tr id='cart'>
              <td>{$shop['name']}</td>
              <td>{$shop['price']}</td>
              <td>{$row['num']}</td>
              <td>{$sum}</td>
              </tr>
             ";
        $sum0 += $sum;
    }

    ?>
    <tr id="bottom">
        <th id="sum">总计</th>
        <th colspan="3" id="pricetotal"><?php echo $sum0; ?>元</th>
    </tr>
    </table>
</div>

</body>
<?php }?>