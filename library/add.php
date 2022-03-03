<?php
include("config.php");
require_once('check.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>新书入库</title>
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

if(@$_POST['action']=="insert"){

  $imgname = $_FILES['cover']['name'];
  $tmp = $_FILES['cover']['tmp_name'];
  $filepath = 'images/';
  $name = $filepath.$imgname;
  move_uploaded_file($tmp,$filepath.$imgname);
  $sql = "INSERT INTO books (name,author,press,datepress,ISBN,language,pages,price,uploadtime,type,cover,total,remain)
          values('".$_POST['name']."','".$_POST['author']."','".$_POST['sele']."','".$_POST['datepress']."','".$_POST['ISBN']."','".$_POST['language']."','".$_POST['pages']."','".$_POST['price']."','".$_POST['uptime']."','".$_POST['type']."','$name','".$_POST['total']."','".$_POST['total']."')";
  $arr=mysqli_query($link,$sql);
  if ($arr){
    echo "<script language=javascript>alert('添加成功！');window.location='add.php'</script>";
  }
  else{
    echo "<script>alert('添加失败');history.go(-1);</script>";
  }
}
?>
<body>
<form id="myform" name="myform" method="post" action="" enctype="multipart/form-data" onsubmit="return myform_Validator(this)">
  <table width="100%" height="173" border="0" align="center" cellpadding="2" cellspacing="1" class="table">
    <tr>
      <td colspan="2" align="left" class="bg_tr"> 后台管理 &gt;&gt; 新书入库</td>
    </tr>
    <tr>
      <td width="31%" align="right" class="td_bg">书名：</td>
      <td width="69%" class="td_bg">
        <input name="name" type="text" id="name" size="15" maxlength="30" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">作者：</td>
      <td class="td_bg">
        <input name="author" type="text" id="author" size="5" maxlength="15" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">出版社：</td>
      <td class="td_bg">
       <select name="sele" id="sele">
            <option value="科学出版社">科学出版社</option>
            <option value="清华大学出版社">清华大学出版社</option>
            <option value="机械工业出版社">机械工业出版社</option>
            <option value="电子工业出版社">电子工业出版社</option>
            <option value="化学工业出版社">化学工业出版社</option>
            <option value="建筑工业出版社">建筑工业出版社</option>
            <option value="人民邮电出版社">人民邮电出版社</option>
            <option value="人民出版社">人民出版社</option>
        </select>
        <!-- <input name="press" type="text" id="press" size="15" maxlength="30" /> -->
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">出版日期：</td>
      <td class="td_bg">
        <input name="datepress" type="text" id="datepress" size = "6" maxlength="15"value="<?php echo @date("Y-m-d"); ?>" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">ISBN：</td>
      <td class="td_bg">
        <input name="ISBN" type="text" id="ISBN" size="15" maxlength="30"  />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">语言：</td>
      <td class="td_bg">
        <input name="language" type="text" id="language" size="7" maxlength="15"  />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">页数：</td>
      <td class="td_bg">
        <input name="pages" type="text" id="pages" size="1" maxlength="5"  />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">价格：</td>
      <td class="td_bg">
        <input name="price" type="text" id="price" size="5" maxlength="15" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">入库时间：</td>
      <td class="td_bg">
        <input name="uptime" type="text" id="uptime" size = "15" maxlength="30" value="<?php echo @date("Y-m-d H:i:s"); ?>" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">所属类别：</td>
      <td class="td_bg">
        <input name="type" type="text" id="type" size="6" maxlength="19" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">封面：</td>
      <td class="td_bg">
        <input name="cover" type="file" id="cover" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">入库总量：</td>
      <td class="td_bg"><input name="total" type="text" id="total" size="5" maxlength="15" />
        本</td>
    </tr>
    <tr>
      <td align="right" class="td_bg">
        <input type="hidden" name="action" value="insert">
        <input type="submit" name="button" id="button" value="提交" />
      </td>
      <td class="td_bg">　　
        <input type="reset" name="button2" id="button2" value="重置" />
      </td>
    </tr>
  </table>
</form>

</body>
</html>