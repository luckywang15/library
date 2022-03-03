<?php
include("config.php");
require_once('check.php');
?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>图书统计</title>
   <link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="table">
   <tr>
      <td height="27" colspan="2" align="left" bgcolor="#FFFFFF" class="bg_tr"> 后台管理 &gt;&gt; 图书统计</td>
   </tr>
   <tr>
      <td align="center" bgcolor="#FFFFFF" height="27">图书类别</td>
      <td align="center" bgcolor="#FFFFFF">库内图书</td>
   </tr>
   <?php
   $sql="select type, count(*) from books group by type";
   $val=mysqli_query($link,$sql);
   while($arr=mysqli_fetch_row($val)){
      echo "<tr height='30'>";
      echo "<td align='center' bgcolor='#FFFFFF'>".$arr[0]."</td>";
      echo "<td align='center' bgcolor='#FFFFFF'>本类目共有：".$arr[1]." 种</td>";
      echo "</tr>";
   }
   ?>
</table>
</body>
</html>