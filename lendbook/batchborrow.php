<?php include("config.php");?>
<html>
<head>
  <meta charset="UTF-8">
  <title>借书功能页</title>
</head>
<body>
<?php

$id_arr = array();
$id_arr = $_POST['choose_id'];
foreach ($id_arr as $k=>$v)
    {
        // 如果图书编号没填写，提示用户
        $book_id = $v;
        if ($book_id==""){
        echo "<script language=javascript>alert('编号不正确');window.location='index.php'</script>";
        exit();
        }
        else {
        ?>
        <?php
        // 借书
        
        $sql1="select * from lend where user_id=".$_SESSION['id']."";
        $rs1=mysqli_query($link,$sql1);
        $count=mysqli_num_rows($rs1)+1;
        $sql2="select canlendsum from usertype where type=(select usertype from user where id=".$_SESSION['id'].")";
        $rs2=mysqli_query($link,$sql2);
        $canlendsum=mysqli_fetch_array($rs2);
        // 查看用户ID是否已填
        if ($_SESSION['id']==""){
            echo "<script language=javascript>alert('您还没有登陆');window.location='landing.php'</script>";
            exit();
        }
        //判断是否超出该借阅角色最大借阅数目
        elseif($count>$canlendsum[0]){
            echo "<script language=javascript>alert('超出最大借阅数目！');window.location='index.php'</script>";
        }else{
            // 可以正常借书，记录之
            // 获得当前日期
            $now = date("Y-m-d,H-i-m");
            $nextmonth = date("Y-m-d",strtotime("+1 month"));
            $sql = "SELECT name from books where id=$book_id";
            $rs = mysqli_query($link,$sql);
            $title = mysqli_fetch_array($rs);
            $lendsql="INSERT INTO lend(book_id, book_title, lend_time, maintain, user_id) values('$book_id','$title[0]','$now', '$nextmonth','".$_SESSION['id']."')";
            mysqli_query($link,$lendsql);

            // 借出后需要在该书记录中库存剩余数减一
            mysqli_query($link,"update books set remain=remain-1 where id='$book_id'");
            echo "<script language=javascript>alert('借阅成功！请在规定日期内归还或提前续借哦~ps:超出借阅数目的书目借不到哦');window.location='index.php'</script>";
            ?>
            <?php
        }
        }
    }
?>
</body>
</html>