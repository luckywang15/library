<?php
mysqli_query($link,"set names 'utf8'"); //数据库输出编码
mysqli_select_db($link,$database); //打开数据库
$sql = "SELECT lend_time AS 借阅日期,user_id AS 借阅者ID,book_id AS 书本ID FROM lend";
$result = mysqli_query($link,$sql);//打开表
$data="";
$array= array();
class User{
    public $借阅日期;
    public $借阅者ID;
    public $书本ID;
}
//mysql_fetch_array() 函数从结果集中取得一行作为关联数组，返回根据从结果集取得的行生成的数组，如果没有更多行则返回 false
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $user=new User();
    $user->借阅日期 = $row['借阅日期'];
    $user->借阅者ID = $row['借阅者ID'];
    $user->书名 = $row['书本ID'];
    $array[]=$user;//将数据给到数组
}
$data=json_encode($array);//转化为json格式
echo $data;//检查是否能够输出正确的json格式数据。
?>