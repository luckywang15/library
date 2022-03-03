<?php
include("config.php");
require_once('check.php');
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>借阅查询</title>
   <link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="1" class="table">
   <tr>
      <td width="90%" height="27" valign="top" bgcolor="#FFFFFF" class="bg_tr"> 后台管理 &gt;&gt; 借阅查询</td>
   <tr>
      <td height="27" valign="top" bgcolor="#FFFFFF" class="bg_tr">
         <form id="form1" name="form1" method="post" action="" style="margin:0px; padding:0px;">
            <table width="35%" height="42" border="0" align="center" cellpadding="0" cellspacing="0" class="bk">
               <tr>
                  <td width="36%" align="center">
                     <select name="seltype" id="seltype">
                        <option value="book_id">书本ID</option>
                        <option value="book_title">图书名称</option>
                        <option value="user_id">读者ID</option>                     
                     </select>
                  </td>
                  <td width="31%" align="center">
                     <input type="text" name="coun" id="coun" />
                  </td>
                  <td width="33%" align="center">
                     <input type="submit" name="button" id="button" value="查询" />
                  </td>
               </tr>
            </table>
          </form>
      </td>
   </tr>
</table>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="table" >
   <tr>
      <td width="3%" height="35" align="center" bgcolor="#FFFFFF">书本ID</td>
      <td width="10%" align="center" bgcolor="#FFFFFF">书名</td>
      <td width="3%" align="center" bgcolor="#FFFFFF">借阅时刻</td>
      <td width="3%" align="center" bgcolor="#FFFFFF">最迟还书日期</td>
      <td width="3%" align="center" bgcolor="#FFFFFF">超时罚款</td>
      <td width="10%" align="center" bgcolor="#FFFFFF">借阅用户&ID</td>
   </tr>
   <?php
   $pagesize = 8;  //每页显示数
   $sql = "select * from lend where ".@$_POST['seltype']." like ('%".@$_POST['coun']."%')";
   $rs=mysqli_query($link,$sql) or die("&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp请输入查询条件");
   $recordcount=mysqli_num_rows($rs);
   //mysql_num_rows() 返回结果集中行的数目。此命令仅对 SELECT 语句有效。
   $pagecount=($recordcount-1)/$pagesize+1;  //计算总页数
   $pagecount=(int)$pagecount;
   @$pageno = $_GET["pageno"];  //获取当前页
   if($pageno=="")
   {
      $pageno=1;   //当前页为空时显示第一页
   }
   if($pageno<1)
   {
      $pageno=1;  //当前页小于第一页时显示第一页
   }
   if($pageno>$pagecount)
   {
      $pageno=$pagecount;  //当前页数大于总页数时显示总页数
   }
   $startno=($pageno-1)*$pagesize;  //每页从第几条数据开始显示
   $sql="select * from lend where ".$_POST['seltype']." like ('%".$_POST['coun']."%') order by id desc limit $startno,$pagesize";
   $rs=mysqli_query($link,$sql);
   ?>
   <?php
   while(@$rows=mysqli_fetch_assoc($rs))
   {
      ?>
      <tr align="center">
      <td class="td_bg" width="3%"><?php echo $rows["book_id"]?></td>
         <td class="td_bg" width="10%" height="26"><?php echo $rows["book_title"]?></td>
         <td class="td_bg" width="3%" height="26"><?php echo $rows["lend_time"]?></td>
         <td class="td_bg" width="3%" height="26"><?php echo $rows["maintain"]?></td>
         <td class="td_bg" width="3%" height="26"><?php echo $rows["fine"]?></td>
         <td class="td_bg" width="10%" height="26">
         <?php 
         $sql1 = "SELECT name FROM user where id=$rows[user_id]";
         $rs1 = mysqli_query($link,$sql1);
         $name = mysqli_fetch_array($rs1);
         ?>
         <?php echo $name[0]."&".$rows["user_id"]?>
         
         </td>
      </tr>
      <?php
   }
   ?>
</table>
   <div width = "100%" align = "center">
      <th height="25" colspan="6" align="center" class="bg_tr">
         <?php
         if($pageno==1)
         {
            ?>
            首页 | 上一页 | <a href="?pageno=<?php echo $pageno+1?>">下一页</a> |
            <a href="?pageno=<?php echo $_POST['seltype']?>">末页</a>
            <?php
         }
         else if($pageno==$pagecount)
         {
            ?>
            <a href="?pageno=1">首页</a> | <a href="?pageno=<?php echo $pageno-1?>">上一页</a> | 下一页 | 末页
            <?php
         }
         else
         {
            ?>
            <a href="?pageno=1">首页</a> | <a href="?pageno=<?php echo $pageno-1?>">上一页</a> |
            <a href="?pageno=<?php echo $pageno+1?>" class="forumRowHighlight">下一页</a> |
            <a href="?pageno=<?php echo $pagecount?>">末页</a>
            <?php
         }
         ?>
          页次：<?php echo $pageno ?>/<?php echo $pagecount ?>页 共有<?php echo $recordcount?>条信息 </th>
   </div>

</body>
</html>