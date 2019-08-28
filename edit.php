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
    <title>商品信息管理</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
        <?php
            require("houtai/menu.php");
            date_default_timezone_set('Asia/Shanghai');
            require ("houtai/dbconfig.php");
            $link=mysql_connect(host,user,pass);
            mysql_select_db(dbname,$link);
            $res=mysql_query("select * from goods where id={$_GET['id']}",$link);
            if($res && mysql_num_rows($res)>0)
            {
                $shop=mysql_fetch_assoc($res);
            }else
            {
                die("没有找到要修改的商品信息");
            }
        ?>
<h3>修改商品信息</h3>
<!--        左侧-->
        <div id="left">
<form action="houtai/action.php?action=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $shop['id'] ?>">
    <input type="hidden" name="oldpic" value="<?php echo $shop['pic'] ?>">
    <table>
        <tr>
            <th class="info"></th>
            <th class="input"></th>
        </tr>
        <tr>
            <td valign="top" class="info">原始图片</td>
            <td style="text-align: left"><img src="./uploads/_<?php echo $shop['pic'] ?>"  style="margin-left: 40px"></td>
        </tr>
        <tr>
            <td class="info">名称</td>
            <td class="input"><input type="text" name="name" value="<?php echo $shop['name']?>"></td>
        </tr>
        <tr>
            <td class="info">类型</td>
            <td class="input">
                <select name="type">
                    <?php
                    require ("houtai/dbconfig.php");
                    foreach ($typelist as $k=>$v)
                    {
                        $key=($shop['type']==$k)?"selected":"";
                        echo "<option value='$k'{$key}>$v</option>";
                    }
                    ?>
                </select>

            </td>
        </tr>
        <tr>
            <td class="info">单价</td>
            <td class="input"><input type="text" name="price" value="<?php echo $shop['price']?>"></td>
        </tr>
        <tr>
            <td class="info">库存</td>
            <td class="input"><input type="text" name="total" value="<?php echo $shop['total']?>"></td>
        </tr>
        <tr>
            <td class="info">图片</td>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000000"/>
            <td class="input"><input type="file" name="pic"/></td>

        </tr>
        <tr>
            <td valign="top" class="info">描述</td>
            <td class="input"><textarea rows="5" cols="20" name="note"><?php echo $shop['note']?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td class="input">
                <input type="submit" value="修改" id="submit">

            <input type="reset" value="重置" id="reset"></td>
        </tr>

    </table>

</form>
        </div>

<!--        右侧-->
        <div id="right">
            <h5>推荐商品</h5>
            <table id="right">
                <tr id="top">
                    <th>商品名称</th>
                    <th>单价</th>
                    <th>剩余数量</th>
                    <th i>描述</th>
                </tr>
                <?php
//                if(empty($_SESSION['shoplist']))
//                {
//                    echo "<tr id='cart'><td colspan='4'>什么都没有哦</td></tr>    ";
//                }

                $link=mysql_connect(host,user,pass);
                mysql_select_db(dbname,$link);
                $ji=mysql_query('select * from goods order by RAND() limit 3',$link);
                while($row=mysql_fetch_assoc($ji))
                {
                    echo "  <tr id='cart'><td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['total']}</td>
                        <td id='note'>{$row['note']}</td></tr>
                     ";
                }

//                $sum0=0;
//                if(isset($_SESSION['shoplist']))
//                    foreach ($_SESSION['shoplist'] as $v)
//                    {
//                        $sum=$v['price']*$v['num'];
//                        echo "<tr id='cart'>
//              <td>{$v['name']}</td>
//              <td>{$v['price']}</td>
//              <td>{$v['num']}</td>
//              <td>{$sum}</td>
//              </tr>
//             ";
//                        $sum0+=$sum;
//                    }

                ?>
<!--                <tr id="bottom">-->
<!--                    <th id="sum">总计</th>-->
<!--                    <th colspan="3" id="pricetotal">--><?php //echo $sum0; ?><!--元</th>-->
<!--                </tr>-->
            </table>
        </div>
</body>
</html>