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
    <link rel="stylesheet" href="css/add.css">
</head>
<body>

    <?php require("menu.php") ?>
    <h3>发布商品信息</h3>
        <div id="left">
            <form action="houtai/action.php?action=add" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <th class="info"></th>
            <th class="input"></th>
        </tr>
        <tr>
            <td class="info">名称</td>
            <td class="input"><input type="text" name="name" ></td>
        </tr>
        <tr>
            <td class="info">类型</td>
            <td class="input">
                <select name="type">
                <?php
                    require("houtai/dbconfig.php");
                    foreach ($typelist as $k=>$v)
                    {
                        echo "<option value='$k'>$v</option>";
                    }
                ?>
                </select>

            </td>
        </tr>
        <tr>
            <td class="info">单价</td>
            <td class="input"><input type="text" name="price"></td>
        </tr>
        <tr>
            <td class="info">库存</td>
            <td class="input"><input type="text" name="total"></td>
        </tr>
        <tr>
            <td class="info">图片</td>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000000"/>
            <td class="input"><input type="file" name="pic"/></td>
        </tr>
        <tr>
            <td valign="top" class="info">描述</td>
            <td class="input"><textarea rows="5" cols="20" name="note"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td class="input">
                <input type="submit" value="添加" id="submit">

            <input type="reset" value="重置" id="reset"></td>
        </tr>

    </table></div>
    </form>
<!--右侧-->
    <div id="right">
        <h5>推荐商品</h5>
        <table id="right">
            <tr id="top">
                <th>商品名称</th>
                <th>单价</th>
                <th>剩余数量</th>
                <th>描述</th>
            </tr>
            <?php
//            if(empty($_SESSION['shoplist']))
//            {
//                echo "<tr id='cart'><td colspan='4'>什么都没有哦</td></tr>    ";
//            }
            //

            $link=mysql_connect(host,user,pass);
            mysql_select_db(dbname,$link);
            $ji=mysql_query('select * from goods order by RAND() limit 3',$link);
            while($row=mysql_fetch_assoc($ji))
            {
                echo "  <tr id='cart'><td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['total']}</td>
                        <td>{$row['note']}</td></tr>
                     ";
            }

            ?>

        </table>
    </div>
</body>
</html>
<?php }?>