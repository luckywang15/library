<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" >
  <tr>
    <td bgcolor="#FFFFFF"><img src="1.jpg" width="100%" height="200" /></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" height="50" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" background = "2.jpg">
          <a href="index.php" title="首页">首页</a></td>
          <td align="center" background = "2.jpg">
          <a href="myborrow.php" title="我的借阅">我的借阅</a></td>
          <td align="center" background = "2.jpg">
            <form id="form1" name="form1" method="post" action="select.php" style="margin:0px; padding:0px;">
                <table width="35%" height="42" border="0" align="center" cellpadding="0" cellspacing="0" class="bk">
                  <tr>
                      <td width="36%" align="center">
                        <select name="seltype" id="seltype">
                            <option value="id">图书序号</option>
                            <option value="name">图书名称</option>
                            <option value="author">作者</option>
                            <option value="press">出版社</option>
                            <option value="ISBN">ISBN</option>
                            <option value="language">语言</option>
                            <option value="price">图书价格</option>
                            <option value="time">入库时间</option>
                            <option value="remain">剩余数量</option>
                            <option value="type">图书类别</option>
                        </select>
                      </td>
                      <td width="31%" align="center">
                        <input type="text" name="coun" id="coun" />
                      </td>
                      <td width="33%" align="center">
                        <input type="submit" name="button" id="button" value="查询" />
                      </td>
                  </tr>
                </table>
            </form>
          </td>          
          <td align="center" background = "2.jpg">
          <a href="landing.php" title="用户登陆">用户登陆</a>  
          <?php
          if (@$_SESSION['id']){
            echo "<a href='landing.php?tj=out' title='退出'>&nbsp&nbsp&nbsp退出</a>";
          }
          ?>
            
          </td>
        </tr>
      </table></td>
  </tr>
</table>