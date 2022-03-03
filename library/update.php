<?php
include("config.php");
require_once('check.php');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>图书管理系统新书修改</title>
  <link rel="stylesheet" href="css.css" type="text/css">
  <script type="text/javascript">
    function myform_Validator(theForm)
    {

      if (theForm.name.value == "")
      {
        alert("请输入书名。");
        theForm.name.focus();
        return (false);
      }
      if (theForm.price.value == "")
      {
        alert("请输入书名价格。");
        theForm.price.focus();
        return (false);
      }
      if (theForm.type.value == "")
      {
        alert("请输入书名所属类别。");
        theForm.type.focus();
        return (false);
      }
      return (true);
    }

  </script>
</head>
<?php
$sql="select * from books where id='".$_GET['id']."'";
$arr=mysqli_query($link,$sql);
$rows=mysqli_fetch_row($arr);
//mysqli_fetch_row() 函数从结果集中取得一行，并作为枚举数组返回。一条一条获取，输出结果为$rows[0],$rows[1],$rows[2].......
?>
<?php
if(@$_POST['action']=="modify"){
  $imgname = $_FILES['cover']['name'];
  $tmp = $_FILES['cover']['tmp_name'];
  $filepath = 'images/';
  $name = $filepath.$imgname;
  if($name<>'images/'){  
    move_uploaded_file($tmp,$filepath.$imgname);
    $sqlstr = "update books set name = '".$_POST['name']."', author = '".$_POST['author']."', press = '".$_POST['press']."', datepress = '".$_POST['datepress']."', ISBN = '".$_POST['ISBN']."', language = '".$_POST['language']."', pages = '".$_POST['pages']."', price = '".$_POST['price']."', uploadtime = '".$_POST['uptime']."', type = '".$_POST['type']."', cover = '$name', total = '".$_POST['total']."', remain = '".$_POST['total']."' where id='".$_GET['id']."'";
  }
  else{
    $sqlstr = "update books set name = '".$_POST['name']."', author = '".$_POST['author']."', press = '".$_POST['press']."', datepress = '".$_POST['datepress']."', ISBN = '".$_POST['ISBN']."', language = '".$_POST['language']."', pages = '".$_POST['pages']."', price = '".$_POST['price']."', uploadtime = '".$_POST['uptime']."', type = '".$_POST['type']."', total = '".$_POST['total']."', remain = '".$_POST['total']."' where id='".$_GET['id']."'";
  }
  $arry=mysqli_query($link,$sqlstr);
  if ($arry){
    echo "<script> alert('修改成功');location='list.php';</script>";
  }
  else{
    echo "<script>alert('修改失败');history.go(-1);</script>";
  }
}
?>
<body>
<form id="myform" name="myform" method="post" action="" enctype="multipart/form-data" onSubmit="return myform_Validator(this)">
  <table width="100%" height="173" border="0" align="center" cellpadding="2" cellspacing="1" class="table">
    <tr>
      <td colspan="2" align="left" class="bg_tr"> 后台管理 &gt;&gt; 新书修改</td>
    </tr>
    <tr>
      <td width="31%" align="right" class="td_bg">书名：</td>
      <td width="69%" class="td_bg">
        <input name="name" type="text" id="name" value="<?php echo $rows[1] ?>" size="15" maxlength="30" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">作者：</td>
      <td class="td_bg">
        <input name="author" type="text" id="author" value="<?php echo $rows[2] ?>" size="5" maxlength="15" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">出版社：</td>
      <td class="td_bg">
        <input name="press" type="text" id="press" value="<?php echo $rows[3] ?>" size="15" maxlength="30" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">出版日期：</td>
      <td class="td_bg">
        <input name="datepress" type="text" id="datepress" size = "6" maxlength="15" value="<?php echo $rows[4] ?>" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">ISBN：</td>
      <td class="td_bg">
        <input name="ISBN" type="text" id="ISBN" value="<?php echo $rows[5] ?>" size="15" maxlength="30"  />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">语言：</td>
      <td class="td_bg">
        <input name="language" type="text" id="language" value="<?php echo $rows[6] ?>" size="7" maxlength="15"  />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">页数：</td>
      <td class="td_bg">
        <input name="pages" type="text" id="pages" value="<?php echo $rows[7] ?>" size="1" maxlength="5"  />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">价格：</td>
      <td class="td_bg">
        <input name="price" type="text" id="price" value="<?php echo  $rows[8]; ?>" size="5" maxlength="15" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">入库时间：
      </td>
      <td class="td_bg">
        <label>
          <input name="uptime" type="text" id="uptime" value="<?php echo $rows[9] ; ?>" size="17" />
        </label>
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">所属类别：
      </td>
      <td class="td_bg"><label>
          <input name="type" type="text" id="type" value="<?php echo $rows[10]; ?>" size="6" maxlength="19" />
        </label></td>
    </tr>
    <tr>
      <td align="right" class="td_bg">封面：</td>
      <td class="td_bg">
        <input name="cover" type="file" id="cover" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">入库总量：</td>
      <td class="td_bg"><input name="total" type="text" id="total" value="<?php echo  $rows[12]; ?>" size="5" maxlength="15" />
        本</td>
    </tr>
    <tr>
      <td align="right" class="td_bg">
        <input type="hidden" name="action" value="modify">
        <input type="submit" name="button" id="button" value="提交"/></td>
      <td class="td_bg">　　
        <input type="reset" name="button2" id="button2" value="重置"/></td>
    </tr>
  </table>
</form>
</body>
</html>