<?php
include("config.php");
header("Content-type:application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition:filename=books.xls"); //输出的表格名称
echo "ID\t";echo "name\t";echo "author\t";echo "press\t";echo "datepress\t";echo "ISBN\t";echo "language\t";echo "pages\t";echo "price\t";echo "uploadtime\t";echo "type\t";echo "total\t";echo "remain\t\n";
//这是表格头字段 加\T就是换格,加\T\N就是结束这一行,换行的意思
$sql="select * from books";
$result=mysqli_query($link,$sql);
while($row=mysqli_fetch_array($result)){
echo $row['id']."\t";
echo $row['name']."\t";
echo $row['author']."\t";
echo $row['press']."\t";
echo $row['datepress']."\t";
echo $row['ISBN']."\t";
echo $row['language']."\t";
echo $row['pages']."\t";
echo $row['price']."\t";
echo $row['uploadtime']."\t";
echo $row['type']."\t";
echo $row['total']."\t";
echo $row['remain']."\t\n";
}
?>