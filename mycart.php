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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品信息管理</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/mycart.css">
</head>
<body>
<?php
require("menu.php");
?>
<h3>浏览我的购物车</h3>

              <?php
              $sum0=0;

              require ("houtai/dbconfig.php");
              $link=mysql_connect(host,user,pass);

              mysql_select_db(dbname,$link);
              $res=mysql_query("select * from userscart where userid='{$userid}'");
              
              echo " <form method='post' action='houtai/buy.php'>";
              if(mysql_num_rows($res)>0) {
                  while ($row=mysql_fetch_assoc($res))
                  {
                      $id=$row['id'];

                      mysql_select_db(dbname,$link);
                      $result=mysql_query("select * from goods where id='{$id}'");
                    $shop=mysql_fetch_assoc($result);

//                  foreach ($shop  as $shop)

                      $sum = $shop['price'] * $row['num'];
                      echo "<div class='center'>
                                <div class='img'><img src='./uploads/_{$shop['pic']}'/></div>
                                <h4>{$shop['name']}</h4><br>
                                <price><em>单价：</em>{$shop['price']}</price><br><br>
                                <num>数量:<button type='button' onclick='window.location.href=\"houtai/updatecart.php?id={$shop['id']}&num=-1\"'>-</button>   
                                 {$row['num']}
                                <button type='button'  onclick='window.location.href=\"houtai/updatecart.php?id={$shop['id']}&num=1\"'>+</button></num>
                                <br><br>
                                <input type='checkbox' name='id[]' value={$shop['id']}>
                                <sum>合计:{$sum}元</sum>
                               <delete><a href='houtai/clearcart.php?id={$shop['id']}'>删除</a></delete>
                                <buy><a href='houtai/buy.php?id={$shop['id']}'>购买</a></buy>
                              </div>
                              
                             ";
                      $sum0 += $sum;
                         }
                  }
              ?>
<br>
<div id="total">
    <h5>总计金额
        <?php echo $sum0 ?>
        <input type="submit" value="结算">
    </h5>
</div>
</form>





</body>
<?php }?>