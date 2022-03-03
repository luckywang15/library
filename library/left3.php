<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>图书管理系统</title>
 <style type="text/css">
 
 body {
 margin:0;
 padding:0;
 font-size: 12px;
 }
 #navigation {
 margin:0;
 padding:0;
 width:147px;
 }
 #navigation a.head {
 cursor:pointer;
 background:url(1.gif) no-repeat scroll;
 display:block;
 font-weight:bold;
 margin:0;
 padding:5px 0 5px;
 text-align:center;
 font-size:12px;
 text-decoration:none;
 }
 #navigation ul {
 border-width:0;
 margin:0;
 padding:0;
 text-indent:0;
 }
 #navigation li {
 list-style:none; display:inline;
 }
 #navigation li li a {
 display:block;
 font-size:12px;
 text-decoration: none;
 text-align:center;
 padding:3px;
 }
 #navigation li li a:hover {
 background:url(2.gif) repeat-x;
 border:solid 1px #adb9c2;
 }
 
 </style>
</head>
<body>
<div style="height:100%;">
 <ul id="navigation">
 <li> <a class="head">系统设置</a>
 <ul>
 <li><a href="pwd.php" target="rightFrame">密码修改</a></li>
 </ul>
 </li>
 <li><a class="head">图书管理</a>
 <ul>
 <li><a href="list.php" target="rightFrame">新书管理</a></li>
 <li><a href="add.php" target="rightFrame">新书入库</a></li>
 </ul>
 </li>
 <li><a class="head">查询统计</a>
 <ul>
 <li><a href="select.php" target="rightFrame">图书查询</a></li>
 <li><a href="count.php" target="rightFrame">图书统计</a></li>
 </ul>
 </li>
 <li> <a class="head">版本信息</a>
 <ul>
 <li>
 <div align="center">SS3.3</div>
 </li>
 </ul>
 </li>
 </ul>
</div>
</body>
</html>