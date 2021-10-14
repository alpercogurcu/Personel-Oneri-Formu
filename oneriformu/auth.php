<?php

require("baglanti.php");
session_start();
ob_start();

;

if(isset($_SESSION['token']))
{
    $token = $_SESSION['token'];
    $tokengetir = $db->prepare("select * from tokenlist WHERE token=:p_token order by tarih desc LIMIT 1");
    $tokengetir->execute(array("p_token" => $token));

    if($tokengetir->rowCount())
    {
    if(isset($_SESSION['id']))
    {
        foreach ($tokengetir as $tokenlist)
        {
           if( $tokenlist['kullanici_id'] == $_SESSION['id'] )
           {

           }
           else
           {
               header("location: login.php");
           }
        }
    }
    else
    {
        header("location: login.php");
    }
}
else{
    header("location: login.php");
}
    
}
else
{
    header("location: login.php");
}
?>