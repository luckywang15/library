<?php
include("config.php");
header("Content-type:application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition:filename=users.xls"); //输出的表格名称
echo "ID\t";echo "name\t";echo "sex\t";echo "password\t";echo "email\t";echo "tel\t";echo "address\t";echo "usertype\t\n";
//这是表格头字段 加\T就是换格,加\T\N就是结束这一行,换行的意思
$sql="select * from user";
$result=mysqli_query($link,$sql);
while($row=mysqli_fetch_array($result)){
echo $row['id']."\t";
echo $row['name']."\t";
echo $row['sex']."\t";
echo $row['password']."\t";
echo $row['email']."\t";
echo $row['tel']."\t";
echo $row['address']."\t";
echo $row['usertype']."\t\n";
}
?>