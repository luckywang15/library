<?php
    
    $imgname = $_FILES['myfile']['name'];
    $tmp = $_FILES['myfile']['tmp_name'];
    $filepath = 'images/';
    $name = $filepath.$imgname;
    if(move_uploaded_file($tmp,$filepath.$imgname)){
        echo "Success!";
        echo $name;
    }else{
        echo "Failed";
    }
?>