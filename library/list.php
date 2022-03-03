<?php
include("config.php");
require_once('check.php');
?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>新书管理功能页</title>
   <link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>
<?php
$pagesize = 8; //每页显示数
$sql = "select * from books";
$rs = mysqli_query($link,$sql);
$recordcount = mysqli_num_rows($rs);
//mysql_num_rows() 返回结果集中行的数目。此命令仅对 SELECT 语句有效。
$pagecount = ($recordcount-1)/$pagesize+1;  //计算总页数
$pagecount = (int)$pagecount;
@$pageno = $_GET["pageno"];   //获取当前页
if($pageno == "")
{
   $pageno=1;   //当前页为空时显示第一页
}
if($pageno<1)
{
   $pageno=1;    //当前页小于第一页时显示第一页
}
if($pageno>$pagecount)  //当前页数大于总页数时显示总页数
{
   $pageno=$pagecount;
}
$startno=($pageno-1)*$pagesize;  //每页从第几条数据开始显示
$sql="select * from books order by id desc limit $startno,$pagesize";
$rs=mysqli_query($link,$sql);
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="table" >
   <tr>
      <td height="27" colspan="7" align="left" bgcolor="#FFFFFF" class="bg_tr"> 后台管理 &gt;&gt; 新书管理</td>
   </tr>
   <tr>
      <td width="6%" height="35" align="center" bgcolor="#FFFFFF">ID</td>
      <td width="25%" align="center" bgcolor="#FFFFFF">书名</td>
      <td width="11%" align="center" bgcolor="#FFFFFF">价格</td>
      <td width="16%" align="center" bgcolor="#FFFFFF">入库时间</td>
      <td width="11%" align="center" bgcolor="#FFFFFF">类别</td>
      <td width="11%" align="center" bgcolor="#FFFFFF">入库总量</td>
      <td width="20%" align="center" bgcolor="#FFFFFF">操作</td>
   </tr>
   <?php
   while($rows=mysqli_fetch_assoc($rs))
   {
   ?>
      <tr align="center">
         <td class="td_bg" width="6%"><?php echo $rows["id"]?></td>
         <td class="td_bg" width="25%" height="26"><?php echo $rows["name"]?></td>
         <td class="td_bg" width="11%" height="26"><?php echo $rows["price"]?></td>
         <td class="td_bg" width="16%" height="26"><?php echo $rows["uploadtime"]?></td>
         <td width="11%" height="26" class="td_bg"><?php echo $rows["type"]?></td>
         <td width="11%" height="26" class="td_bg"><?php echo $rows["total"]?></td>
         <td class="td_bg" width="20%">
            <a href="update.php?id=<?php echo $rows['id'] ?>" class="trlink">修改</a>  
            <a href="del.php?id=<?php echo $rows['id'] ?>" class="trlink">删除</a>
         </td>
      </tr>
   <?php
   }
   ?>
   <tr>
      <th height="25" colspan="7" align="center" class="bg_tr">
         <?php
         if($pageno==1)
         {
            ?>
            首页 | 上一页 | <a href="?pageno=<?php echo $pageno+1?>&id=<?php echo @$id?>">下一页</a> |
            <a href="?pageno=<?php echo $pagecount?>&id=<?php echo @$id?>">末页</a>
            <?php
         }
         else if($pageno==$pagecount)
         {
            ?>
            <a href="?pageno=1&id=<?php echo @$id?>">首页</a> |
            <a href="?pageno=<?php echo $pageno-1?>&id=<?php echo @$id?>">上一页</a> | 下一页 | 末页
            <?php
         }
         else
         {
            ?>
            <a href="?pageno=1&id=<?php echo @$id?>">首页</a> |
            <a href="?pageno=<?php echo $pageno-1?>&id=<?php echo @$id?>">上一页</a> |
            <a href="?pageno=<?php echo $pageno+1?>&id=<?php echo @$id?>" class="forumRowHighlight">下一页</a> |
            <a href="?pageno=<?php echo $pagecount?>&id=<?php echo @$id?>">末页</a>
            <?php
         }
         ?>
          页次：<?php echo $pageno ?>/<?php echo $pagecount ?>页 共有<?php echo $recordcount?>条信息
      </th>
   </tr>
</table>
</body>
</html>