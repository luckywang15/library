<?php
require_once("config.php"); //引入数据库文件
?>
<?php
if(@$_POST["Submit"])
{
   $username=$_POST["username"];
   $pwd=$_POST["pwd"];
   $code=$_POST["code"];
   if($code<>$_SESSION["auth"])
   {
      echo "<script language=javascript>alert('验证码不正确！');window.location='login.php'</script>";
      ?>
      <?php
      die();
   }
   $sql = "SELECT * FROM admin where username='$username' and password='$pwd'";//判断用户名和密码的正确性
   $sql1 = "SELECT id FROM admin where username='$username' and password='$pwd'";//取到ID，用来权限分配
   $rs=mysqli_query($link,$sql);
   $rs1=mysqli_query($link,$sql1);
   $id = mysqli_fetch_array($rs1);
   if(mysqli_num_rows($rs)==1)
   {
      $_SESSION["pwd"]=$_POST["pwd"];
      $_SESSION["admin"]=session_id();
      if($id[0] == 1)
      {
         echo "<script language=javascript>alert('登陆成功！');window.location='admin_index.php'</script>";
      }
      if($id[0] == 2)
      {
         echo "<script language=javascript>alert('登陆成功！');window.location='readeradmin.php'</script>";
      }
      elseif($id[0] == 3)
      {
         echo "<script language=javascript>alert('登陆成功！');window.location='booksadmin.php'</script>";
      }
      elseif($id[0] == 4)
      {
         echo "<script language=javascript>alert('登陆成功！');window.location='lendadmin.php'</script>";
      }
      else
      echo "die!";
   }
   else
   {
      echo "<script language=javascript>alert('用户名或密码错误！');window.location='login.php'</script>";
      ?>
      <?php
      die();
   }
}
?>
<?php
if(@$_GET['tj'] == 'out'){
   session_destroy();
   echo "<script language=javascript>alert('退出成功！');window.location='login.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>图书后台管理系统登陆功能</title>
   <!-- 引入CSS样式 -->
   <!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->
   <style>
 body {
	margin:0;
	padding:0;
	overflow:hidden;
	background:url(3.gif) repeat-x #152753;
	font-size: 12px;
	color: #adc9d9;
 }
		
 #center {
	height:84px;
	text-align:center;
 }
		
 * IE7 HACK*/
 *+html #center_left {
	margin-left:206px !important;
 }
 /* END HACK*/
 #center_middle {
	float:left;
	background:url(4.gif) no-repeat;
	height:84px;
	width:162px;
 }
 #center_middle_right {
	float:left;
	background:url(5.gif) no-repeat;
	height:84px;
	width:26px;
 }
 #center_submit {
	float:left;
	background:url(6.gif) no-repeat;
	height:84px;
	width:67px;
 }
 #center_right {
	float:left;
	background:url(7.gif) no-repeat;
	height:84px;
	width:211px;
 }
		
 INPUT {
	width:100px;
	height:17px;
	background-color:#87adbf;
	border:solid 1px #153966;
	font-size:12px;
	color:#283439;
 }
 .chknumber_input {
	width:40px;
 }
 .user {
	margin: 6px auto;
 }
 /* IE7 HACK*/
 *+html .user {
	margin: 4px auto;
 }
 /* END HACK*/
 .chknumber {
	margin-bottom:3px;
	text-align:left;
	padding-left:3px
 }
 .button {
	margin: 15px auto;
 }
 .submit{
	background-image:url(8.gif); width:57px; height:20px;
 }
 .reset{
	background-image:url(9.gif); width:57px; height:20px;
 }
 IMG {
	border:none;
	cursor:pointer;
 }
 FORM {
	margin:0;
	padding:0
 }
</style> 
</head>
<body>
<div id="top"> </div>
<form id="frm" name="frm" method="post" action="" onSubmit="return check()">
   <div id="center">
      <div id="center_left"></div>
      <div id="center_middle">
         <div class="user">
            <label>用户名：
               <input type="text" name="username" id="username" />
            </label>
         </div>
         <div class="user">
            <label>密　码：
               <input type="password" name="pwd" id="pwd" />
            </label>
         </div>
         <div class="chknumber">
            <label>验证码：
               <input name="code" type="text" id="code" maxlength="4" class="chknumber_input" />
            </label>
            <img src="verify.php" style="vertical-align:middle" />
         </div>
      </div>
      <div id="center_middle_right"></div>
      <div id="center_submit">
         <div class="button"> <input type="submit" name="Submit" class="submit" value=" ">
         </div>
         <div class="button"><input type="reset" name="Submit" class="reset" value=""> </div>
      </div>
      <div id="center_middle_right"></div>
   </div>
</form>
<div id="footer"></div>
</body>
</html>