<?php
require ('config.php');
//如果没有登录，退出
if ($_SESSION['id']==""){
   echo "<script language=javascript>alert('您还没有登陆');window.location='landing.php'</script>";
   exit();
}
$book_id=$_GET["book_id"];
$sql="SELECT * FROM lend where book_id='$book_id' and user_id='".@$_SESSION['id']."'";
$rs=mysqli_query($link,$sql);
$maintain=mysqli_fetch_array($rs);
//通过用户id取得读者类别，最终取到类别表的可借阅规则
$sql2="SELECT * FROM usertype where type=(SELECT usertype FROM user where id='".@$_SESSION['id']."')";
$rs2=mysqli_query($link,$sql2);
$canlend=mysqli_fetch_array($rs2);

$a=strtotime($maintain["maintain"])+24*60*60*$canlend["canlendday"];
$renew=date("Y-m-d", $a);
//续借次数判断
if((strtotime($maintain["maintain"])-strtotime($maintain["lend_time"])-30*24*60*60) < (($canlend["cancontinuetimes"])*$canlend["canlendday"]*24*60*60)){
    $sql1="UPDATE lend SET maintain='$renew' where book_id='$book_id' and user_id='".@$_SESSION['id']."'";
    mysqli_query($link,$sql1) or die ("续借失败：".mysqli_error($link));
}else{
    echo "<script language=javascript>alert('续借失败，超出最大续借次数~');window.location='myborrow.php'</script>";
}
// $sql1="UPDATE lend SET maintain='$renew' where book_id='$book_id' and user_id='".@$_SESSION['id']."'";
// mysqli_query($link,$sql1) or die ("续借失败：".mysqli_error($link));

echo "<script language=javascript>alert('续借成功');window.location='myborrow.php'</script>";
?>