<?php
$password = "123456";
function salt(){
   $intermediateSalt = md5(uniqid(rand(), true));
   $salt = substr($intermediateSalt, 0, 6);
   return hash("sha256", @$password . $salt);
}

$options = [

    'salt' => salt() //write your own code to generate a suitable salt
   
   ];
$hash = password_hash($password, PASSWORD_DEFAULT, $options);


if (password_verify('123456', $hash)) {

 echo "YES!";

}

else {

 echo "NO!";

}
?>