<?php
include("config.php");
require_once('check.php');
$sql = "DELETE FROM books where id='".$_GET['id']."'";
$arry=mysqli_query($link,$sql);
if($arry){
  echo "<script> alert('删除成功');location='list.php';</script>";
}
else
  echo "删除失败";
?>