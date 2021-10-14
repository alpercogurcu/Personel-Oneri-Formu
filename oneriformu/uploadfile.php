<?php
    
require("baglanti.php");

try{
$target_dir = "./medya/";

$dosyaismi= $_FILES["file"]["name"];// Dosya adı
$dosyatipi=$_FILES["file"]["type"]; // Dosya tipi


// Sunucuya atılacak dosya için yeni isim üretilmesi
$isim= md5(uniqid(rand()));
// Sunucuya atılacak dosyanın uzantısının alınması
$uzanti=end(explode(".",$dosyaismi));
// Dosya adı ve uzantısının birleştirilmesi
$yeniad=$isim.".".$uzanti;


if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$yeniad)) {

    $ekle = $db->prepare("insert into oneriformu_ekler (hash,dosya_adi, tip, yol, uzanti) values (:hash, :dosya_adi, :tip, :yol, :uzanti)");
    $ekle->execute(array("dosya_adi" => $yeniad, "hash" => $_POST['hash'], "tip"=>$dosyatipi, "yol"=> $target_dir.$yeniad, "uzanti"=> $uzanti));


     $status = 1;
     echo $status;
     
}
else
{
  echo "dosya: ". $_FILES["file"]["tmp_name"];
}
}
catch (Exception $e)
{
    echo 'Yakalanan olağandışılık: ',  $e->getMessage(), "\n";

}


?>