<?php
include("config.php");
require_once('check.php');
?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>借书证管理</title>
   <link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>
<?php
$pagesize = 8; //每页显示数
$sql = "select * from user";
$rs = mysqli_query($link,$sql);
$recordcount = mysqli_num_rows($rs);
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
$sql="select * from user order by id desc limit $startno,$pagesize";
$rs=mysqli_query($link,$sql);
?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="table" >
   <tr>
      <td height="27" colspan="10" align="left" bgcolor="#FFFFFF" class="bg_tr"> 后台管理 &gt;&gt; 借书证管理</td>
   </tr>
   <tr>
      <td width="3%" height="35" align="center" bgcolor="#FFFFFF">ID</td>
      <td width="10%" align="center" bgcolor="#FFFFFF">姓名</td>
      <td width="3%" align="center" bgcolor="#FFFFFF">性别</td>
      <td width="16%" align="center" bgcolor="#FFFFFF">密码</td>
      <td width="11%" align="center" bgcolor="#FFFFFF">邮箱</td>
      <td width="5%" align="center" bgcolor="#FFFFFF">照片</td>
      <td width="11%" align="center" bgcolor="#FFFFFF">电话</td>
      <td width="11%" align="center" bgcolor="#FFFFFF">地址</td>
      <td width="8%" align="center" bgcolor="#FFFFFF">读者类别状态</td>
      <td width="12%" align="center" bgcolor="#FFFFFF">操作</td>
   </tr>
   <?php
   while($rows=mysqli_fetch_assoc($rs))
   {
   ?>
      <tr align="center">
         <td class="td_bg" width="3%"><?php echo $rows["id"]?></td>
         <td class="td_bg" width="10%" height="26"><?php echo $rows["name"]?></td>
         <td class="td_bg" width="3%" height="26"><?php echo $rows["sex"]?></td>
         <td class="td_bg" width="16%" height="26"><?php echo $rows["password"]?></td>
         <td width="11%" height="26" class="td_bg"><?php echo $rows["email"]?></td>
         <td width="5%" height="26" class="td_bg">
         <?php $a = "../lendbook/".$rows["photo"];
         echo "<img width=50px height=70px src=$a>";?>
         </td>
         <td width="11%" height="26" class="td_bg"><?php echo $rows["tel"]?></td>
         <td width="11%" height="26" class="td_bg"><?php echo $rows["address"]?></td>
         <td width="8%" height="26" class="td_bg"><?php 
         if($rows["usertype"]==0){
            echo "本科生";
         }elseif($rows["usertype"]==1){
            echo "硕士生";
         }elseif($rows["usertype"]==2){
            echo "博士生";
         }elseif($rows["usertype"]==3){
            echo "教师";
         }elseif($rows["usertype"]==4){
            echo "注销";
         }elseif($rows["usertype"]==5){
            echo "挂失";
         }else{
            echo "error!";
         }
         
         ?>
         </td>
         <td class="td_bg" width="12%">
            <a href="updateuser.php?id=<?php echo $rows['id'] ?>" class="trlink">修改</a>  
         </td>
      </tr>
   <?php
   }
   ?>
   <tr>
      <th height="25" colspan="10" align="center" class="bg_tr">
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