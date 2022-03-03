<?php
include("config.php");
?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>图书管理系统主页面</title>
   <style>
      body,td,th {font-family: 微软雅黑;font-size: 9px;color: #222;}
      body {background-color: #FFFFFF;line-height:20px;}
      a:link {color: #222;text-decoration: none;}
      a:visited {text-decoration: none;color: #222;}
      a:hover {text-decoration: underline;color: #FF0000;}
      a:active {text-decoration: none;color: #999999;}
   </style>
</head>
<body>
<?php include("head.php");?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td height="22">
    <?php
    //判断是否登录
    if ($_SESSION['id']==""){
      echo "<script language=javascript>alert('您还没有登陆');window.location='landing.php'</script>";
      exit();
    }

     $pagesize=5;  //每页显示5条数据
     if(!urldecode(@$_GET['proid'])){
     //urldecode()函数将 URL 编码后字符串还原成未编码的样子。编码使用 %## 的格式
      $sql="select * from lend where user_id='".@$_SESSION['id']."' order by id desc";  //倒序排列
     }else{
      $sql="select * from lend where user_id='".@$_SESSION['id']."' and type='".urldecode($_GET['proid'])."'";
     //将查询出来的书目类别中文字转换为编码形式
     }
     $rs=mysqli_query($link,$sql);
     $recordcount=mysqli_num_rows($rs);  //输出查询的总数
     //mysql_num_rows() 返回结果集中行的数目。此命令仅对 SELECT 语句有效。
     $pagecount=($recordcount-1)/$pagesize+1;  //计算总页数
     $pagecount=(int)$pagecount;
     $pageno=empty($_GET["pageno"])?'':$_GET["pageno"];  //当前页

     if($pageno=="")  //当前页为空时显示第一页
     {
      $pageno=1;
     }
     if($pageno<1)   //当前页小于第一页时显示第一页
     {
      $pageno=1;
     }
     if($pageno>$pagecount)  //当前页数大于总页数时显示总页数
     {
      $pageno=$pagecount;
     }
     $startno=($pageno-1)*$pagesize;  //每页从第几条数据开始显示

     if(!urldecode(@$_GET["proid"])){
       $sql="select * from lend where user_id='".@$_SESSION['id']."' order by id desc limit $startno,$pagesize";
     }else{
       $sql="select * from lend where user_id='".@$_SESSION['id']."' and type='".urldecode($_GET['proid'])."' order by id desc limit $startno,$pagesize";
     }
     $rs=mysqli_query($link,$sql);
     ?>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
       <td width="1%" height="30" align="center" bgcolor="#FFFFFF" class="line2">书目ID</td>
       <td width="8%" align="center" bgcolor="#FFFFFF" class="line2">书名</td>
       <td width="8%" align="center" bgcolor="#FFFFFF" class="line2">借阅时刻</td>
       <td width="8%" align="center" bgcolor="#FFFFFF" class="line2">最迟归还时间</td>
       <td width="2%" align="center" bgcolor="#FFFFFF" class="line2">违约金额</td>
       <td width="8%" align="center" bgcolor="#FFFFFF" class="line2">操作</td>
      </tr>
      <form action="batchreturn.php" method="post">
          <?php
            if(!empty($rs)){
                while($rows=mysqli_fetch_array($rs))
              {
            ?>
            <tr>
            <td height="30" align="center" bgcolor="#FFFFFF"><input id="choose_id[]" name="choose_id[]" type="checkbox" value =<?php echo $rows["book_id"];?>><?php echo $rows["book_id"];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $rows["book_title"];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $rows["lend_time"];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $rows["maintain"];?></td>
            <td align="center" bgcolor="#FFFFFF"><?php echo $rows["fine"];?></td>
            <td align="center" bgcolor="#FFFFFF" class="line2">
            <?php
            $rs2=mysqli_query($link,"select * from lend where book_id='".$rows['book_id']."' 
            and user_id='".@$_SESSION['id']."'");
            $rows2=mysqli_fetch_assoc($rs2);
            if($rows2['book_id']){
              echo "<font color='red'>您已借阅</font>  
              <a href=returnbook1.php?book_id=".$rows['book_id'].">我要还书</a>&nbsp<a href=renew.php?book_id=".$rows['book_id']."><font color='blue'>续借</font></a>"; 
              }
            ?> </td>
            </tr>
            <?php
              }
            }
            ?>
          </table>
        <div align="right">
        <input type="submit" value="批量还书" />
        </div>
      </form> 
     <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td height="35" align="center" bgcolor="#FFFFFF">
          <?php
if($pageno==1)
{
   ?>
   首页 | 上一页 |
   <?php if($pageno+1<= $pagecount) { ?>
   <a href="myborrow.php?proid=<?php echo empty($_GET['proid']) ? '' : urlencode($_GET['proid']); ?>&pageno=<?php echo $pageno + 1 ?>">下一页</a> |
   <a href="myborrow.php?proid=<?php echo empty($_GET['proid']) ? '' : urlencode($_GET['proid']); ?>&pageno=<?php echo $pagecount ?>">末页</a>
   <?php
     }
}
else if($pageno==$pagecount)
{
   ?>
   <a href="myborrow.php?proid=<?php echo urlencode($_GET['proid']);?>&pageno=1">首页</a> |
   <a href="myborrow.php?proid=<?php echo urlencode($_GET['proid']);?>&pageno=<?php echo $pageno-1?>">上一页</a> | 下一页 | 末页
   <?php
}
else
{
   ?>
   <a href="myborrow.php?proid=<?php echo urlencode($_GET['proid']);?>&pageno=1">首页</a> |
   <a href="myborrow.php?proid=<?php echo urlencode($_GET['proid']);?>&pageno=<?php echo $pageno-1?>">上一页</a> |
   <a href="myborrow.php?proid=<?php echo urlencode($_GET["proid"]);?>&pageno=<?php echo $pageno+1?>" class="forumRowHighlight">下一页</a> |
   <a href="?pageno=<?php echo $pagecount?>">末页</a>
   <?php
}
?>
 页次：<?php echo $pageno ?>/<?php echo $pagecount ?>页 共有<?php echo $recordcount?>条信息</td>
      </tr>
     </table></td></tr>
</table>

</body>
</html>