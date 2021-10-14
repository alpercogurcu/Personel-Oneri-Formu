<?php
require("baglanti.php");
if($_POST)
{
    $adsoyad =$_POST['adsoyad'];
    $bolum = $_POST['bolum'];
    $gorev =$_POST['gorev'];
    $bildirim = $_POST['bildirim'];
    $konu = $_POST['konu'];
    $mesaj = $_POST['mesaj'];
    $hash = $_POST['hash'];

    $kontrol = $db->prepare("Select * from oneriformu where hash=:hash");
    $kontrol->execute(array("hash"=> $hash));

    if($kontrol->rowCount())
    {
        $mesaj = "Bu kayıdı zaten oluşturdunuz.";
    }
    else
    {
    $ekle = $db->prepare("insert into oneriformu (adsoyad,bolum,gorev,bildirimturu,mesaj,hash, konu) values (:adsoyad,:bolum,:gorev,:bildirim,:mesaj,:hash, :konu) ");
    if( $ekle->execute(array("adsoyad"=> $adsoyad, "bolum"=>$bolum, "gorev"=>$gorev, "bildirim"=>$bildirim, "mesaj" => $mesaj, "hash"=> $hash, "konu"=> $konu)) )
    {
        $mesaj =  'Formunuz başarı ile kaydedilmiştir.';
    }
    else
    {
        $mesaj = "Bir hata oluştu";
    }
    
}
}

?>



<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optimak STU</title>
    <?php //<link href="style.css" rel="stylesheet"> ?>
    <script src="./js/dropzone.js"></script>
  
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link href="./js/dropzone.css" rel="stylesheet">
</head>
<body>
<body>

    <div class="jumbotron"><div class="container-fluid">
    <img class="rounded mx-auto d-block" src="https://optimak.com.tr/wp-content/uploads/2020/09/optimakkonveyorstrec-sarmahat-sonu-1.png" height="100px"/>
<br>
<br>
  <h4><?php echo $mesaj; ?></h4>
</div>
</div>



</body>

</html>