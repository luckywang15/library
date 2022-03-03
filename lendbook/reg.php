<?php
include("config.php");
?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>图书管理系统注册页面</title>
   <style>
      body,td,th {font-family: 微软雅黑;font-size: 9px;color: #222;}
      body {background-color: #FFFFFF;line-height:20px;}
      a:link {color: #222;text-decoration: none;}
      a:visited {text-decoration: none;color: #222;}
      a:hover {text-decoration: underline;color: #FF0000;}
      a:active {text-decoration: none;color: #999999;}
   </style>
</head>
<script type="text/javascript">
   function checkreg()
   {
      if (form1.name.value=="")
      {
         // 如果真实姓名为空，则显示警告信息
         alert("真实姓名不能为空！");
         form1.name.focus();
         return false;
      }
      if (form1.password.value=="" )
      {
         // 如果密码为空，则显示警告信息
         alert("密码不能为空！");
         form1.password.focus();
         return false;
      }
      if (form1.pwd.value=="" )
      {
         // 如果确认密码为空，则显示警告信息
         alert("确认密码不能为空！");
         form1.pwd.focus();
         return false;
      }
      // 两次密码应一样
      if (form1.password.value!=form1.pwd.value && form1.password.value!="")
      {
         alert("两次密码不一样，请确认！");
         form1.password.focus();
         return false;
      }
      if (form1.email.value=="")
      {
         // 如果Email为空，则显示警告信息
         alert("Email不能为空！");
         form1.email.focus();
         return false;
      }
      // 检查email格式是否正确
      else if (form1.email.value.charAt(0)=="." ||
            form1.email.value.charAt(0)=="@"||
            form1.email.value.indexOf('@', 0) == -1 ||
            form1.email.value.indexOf('.', 0) == -1 ||
            form1.email.value.lastIndexOf("@")==form1.email.value.length-1 ||
            form1.email.value.lastIndexOf(".")==form1.email.value.length-1)
      {
         alert("Email的格式不正确！");
         form1.email.select();
         return false;
      }
      return true;

   }
</script>
<?php
if(@$_POST['submit']){
// 取得网页的参数
   $name=$_POST['name'];
   $sex=$_POST['sex'];
   $password=$_POST['password'];
   $email=$_POST['email'];
   $tel=$_POST['tel'];
   $address=$_POST['address'];

   $imgname = $_FILES['photo']['name'];
   $tmp = $_FILES['photo']['tmp_name'];
   $filepath = 'userimages/';
   $pname = $filepath.$imgname;
   move_uploaded_file($tmp,$filepath.$imgname);

// 加密密码
   // $password=md5($password);
   function salt(){
      $intermediateSalt = md5(uniqid(rand(), true));
      $salt = substr($intermediateSalt, 0, 6);
      return hash("sha256", @$password . $salt);
   }
   $options = [

      'salt' => salt()
     
     ];
   $password = password_hash($password, PASSWORD_DEFAULT, $options);
// 连接数据库，注册用户
   $sql="insert into user(name, sex, password, email, photo, tel, address) values('$name','$sex','$password','$email', '$pname','$tel','$address')";
   mysqli_query($link,$sql);

// 获得注册用户的自动id，以后使用此id才可登录
   $result=mysqli_query($link,"select last_insert_id()");
   $re_arr=mysqli_fetch_array($result);
   $id=$re_arr[0];

//注册成功，自动登录，注册session变量
   $_SESSION['user'] = null;
   $user=$id;
   echo "<script language=javascript>alert('注册成功,进入首页!');window.location='index.php'</script>";
}
?>
<body>
<?php include("head.php");?>
<form name="form1" method="post" action="" enctype="multipart/form-data" onSubmit="return checkreg()" >
   <table width=80% border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
         <th colspan="2" bgcolor="#FFFFFF"><font size="5">用 户 注 册 界 面</font></th>
      </tr>
      <tr>
         <td width="364" align="right" bgcolor="#FFFFFF">姓   名：</td>
         <td width="403" bgcolor="#FFFFFF">
            <input type="text" name="name">
      </tr>
      <tr>
         <td align="right" bgcolor="#FFFFFF">性   别:</td>
         <td bgcolor="#FFFFFF">
            <input type="text" name="sex">
      </tr>
      <tr>
         <td align="right" bgcolor="#FFFFFF">密   码:</td>
         <td bgcolor="#FFFFFF">
            <input type="password" name="password">
      </tr>
      <tr>
         <td align="right" bgcolor="#FFFFFF">确认密码：</td>
         <td bgcolor="#FFFFFF">
            <input type="password" name="pwd">
      </tr>
      <tr>
         <td align="right" bgcolor="#FFFFFF">Email：</td>
         <td bgcolor="#FFFFFF">
            <input type="text" name="email">
      </tr>
      <tr>
         <td align="right" bgcolor="#FFFFFF">照   片:</td>
         <td bgcolor="#FFFFFF">
            <input type="file" name="photo">
      </tr>
      <tr>
         <td align="right" bgcolor="#FFFFFF">电   话:</td>
         <td bgcolor="#FFFFFF">
            <input type="text" name="tel">
      </tr>
      <tr>
         <td align="right" bgcolor="#FFFFFF">地   址:</td>
         <td bgcolor="#FFFFFF">
            <input type="text" name="address">
      </tr>
      <tr>
         <td  align=right bgcolor="#FFFFFF" >
            <input type="submit" name="submit" value="注 册">
         </td>
         <td align=left bgcolor="#FFFFFF">
            <input type="reset" name="submit" value="重 写">
         </td>
      </tr>
   </table>
</form>
</body>
</html>