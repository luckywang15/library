<?php
include("config.php");
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>简单图书借阅系统登录</title>
  <style>
    body,td,th {font-family: 微软雅黑;font-size: 9px;color: #222;}
    body {background-color: #FFFFFF;line-height:20px;}
    a:link {color: #222;text-decoration: none;}
    a:visited {text-decoration: none;color: #222;}
    a:hover {text-decoration: underline;color: #FF0000;}
    a:active {text-decoration: none;color: #999999;}
  </style>
</head>
<?php
//初始化session
if(isset($_GET['tj']) == 'out'){
  session_destroy();
  echo "<script language=javascript>alert('退出成功！');window.location='landing.php'</script>";
}

if(isset($_POST['submit'])){
// 如果已经登录过，直接退出
  if(isset($_SESSION['id'])) {
    //重定向到管理留言
    echo "<script language=javascript>alert('您已登陆');window.location='index.php'</script>";
    // 登录过的话，立即结束
    exit;
  }
// 获得参数
  $nickname=$_POST['username'];
  $password=$_POST['password'];
  //$password=md5($password);

// 检查帐号和密码是否正确,
  $sql="select * from user where name='$nickname'";
  $re = mysqli_query($link,$sql);
  $result=mysqli_fetch_array($re);
  $hash = $result['password'];

// 如果用户登录正确
  if(password_verify($password, $hash)) {
    //注册session变量，保存当前会话用户的昵称
    $_SESSION['id']=$result['id'];
    // 登录成功重定向到管理页面
    echo "<script language=javascript>alert('登陆成功');window.location='index.php'</script>";
  }
  else {
    // 管理员登录失败
    echo "<script language=javascript>alert('密码不正确');window.location='landing.php'</script>";
  }
}
?>
<body>
<?php include("head.php");?>
<form  name="myform" method="post" onSubmit="return CheckPost()" action="" style="margin-bottom:5px;">
  <table width="80%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td height="30" colspan="2" bgcolor="#FFFFFF">用户登录</td>
    </tr>
    <tr>
      <td width="337" align="right" bgcolor="#FFFFFF">用户名:
      </td>
      <td width="422" bgcolor="#FFFFFF"><input type="text" name="username"></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">密 码:
      </td>
      <td bgcolor="#FFFFFF"><input type="password" name="password"></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF"><a href="reg.php">注册新用户</a>
      </td>
      <td bgcolor="#FFFFFF"><input type="submit" name="submit" value="登录"></td>
    </tr>
  </table>
</form>
</body>
</html>