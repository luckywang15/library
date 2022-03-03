<?php
include("config.php");
require_once('check.php');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>借书证信息修改</title>
  <link rel="stylesheet" href="css.css" type="text/css">
  <script type="text/javascript">
    function myform_Validator(theForm)
    {

      if (theForm.name.value == "")
      {
        alert("请输入姓名。");
        theForm.name.focus();
        return (false);
      }sex
      if (theForm.sex.value == "")
      {
        alert("请输入性别。");
        theForm.sex.focus();
        return (false);
      }
      if (theForm.tel.value == "")
      {
        alert("请输入联系电话。");
        theForm.tel.focus();
        return (false);
      }
      return (true);
      if (theForm.address.value == "")
      {
        alert("请输入联系地址。");
        theForm.address.focus();
        return (false);
      }
      return (true);
    }

  </script>
</head>
<?php
$sql="select * from user where id='".$_GET['id']."'";
$arr=mysqli_query($link,$sql);
$rows=mysqli_fetch_row($arr);
//mysqli_fetch_row() 函数从结果集中取得一行，并作为枚举数组返回。一条一条获取，输出结果为$rows[0],$rows[1],$rows[2].......
?>
<?php
if(@$_POST['action']=="modify"){
  $imgname = $_FILES['photo']['name'];
  $tmp = $_FILES['photo']['tmp_name'];
  $filepath = 'userimages/';
  $pname = $filepath.$imgname;
  if($pname<>'userimages/'){
    move_uploaded_file($tmp,"../lendbook/userimages/".$imgname);
    function salt(){
      $intermediateSalt = md5(uniqid(rand(), true));
      $salt = substr($intermediateSalt, 0, 6);
      return hash("sha256", @$_POST['password'] . $salt);
   }
   $options = [

      'salt' => salt()
     
     ];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    $sqlstr = "update user set name = '".$_POST['name']."', sex = '".$_POST['sex']."', password = '".$password."', email = '".$_POST['email']."', photo = '$pname', tel = '".$_POST['tel']."', address = '".$_POST['address']."', usertype = '".$_POST['seltype']."' where id='".$_GET['id']."'";
  }
  else{
  function salt(){
      $intermediateSalt = md5(uniqid(rand(), true));
      $salt = substr($intermediateSalt, 0, 6);
      return hash("sha256", @$_POST['password'] . $salt);
   }
   $options = [

      'salt' => salt()
     
     ];
   $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    $sqlstr = "update user set name = '".$_POST['name']."', sex = '".$_POST['sex']."', password = '".$password."', email = '".$_POST['email']."', tel = '".$_POST['tel']."', address = '".$_POST['address']."', usertype = '".$_POST['seltype']."' where id='".$_GET['id']."'";
  }
  $arry=mysqli_query($link,$sqlstr);
  if ($arry){
    echo "<script> alert('修改成功');location='reader.php';</script>";
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
      <td colspan="2" align="left" class="bg_tr"> 后台管理 &gt;&gt; 借书证信息修改</td>
    </tr>
    <tr>
      <td width="31%" align="right" class="td_bg">姓名：</td>
      <td width="69%" class="td_bg">
        <input name="name" type="text" id="name" value="<?php echo $rows[1] ?>" size="15" maxlength="30" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">性别：</td>
      <td class="td_bg">
        <input name="sex" type="text" id="sex" value="<?php echo $rows[2] ?>" size="5" maxlength="15" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">密码：</td>
      <td class="td_bg">
        <input name="password" type="text" id="password" value="<?php echo $rows[3] ?>" size="15" maxlength="30" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">邮箱：</td>
      <td class="td_bg">
        <input name="email" type="text" id="email" size = "6" maxlength="15" value="<?php echo $rows[4] ?>" />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">照片：</td>
      <td class="td_bg">
        <input name="photo" type="file" id="photo"/>
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">电话：</td>
      <td class="td_bg">
        <input name="tel" type="text" id="tel" value="<?php echo $rows[6] ?>" size="7" maxlength="15"  />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">地址：</td>
      <td class="td_bg">
        <input name="address" type="text" id="address" value="<?php echo $rows[7] ?>" size="5" maxlength="10"  />
      </td>
    </tr>
    <tr>
      <td align="right" class="td_bg">读者类别状态：</td>
      <td class="td_bg">
      <select name="seltype" id="seltype">
          <option value="0">本科生</option>
          <option value="1">硕士生</option>
          <option value="2">博士生</option> 
          <option value="3">教师</option>  
          <option value="4">注销</option>
          <option value="5">挂失</option>                         
      </select>
      </td>
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