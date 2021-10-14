<?php
require("baglanti.php");
require("auth.php");
setlocale(LC_TIME, 'tr_TR');


$gunler = array(
  'Pazartesi',
  'Salı',
  'Çarşamba',
  'Perşembe',
  'Cuma',
  'Cumartesi',
  'Pazar'
);

$aylar = array(
  'Ocak',
  'Şubat',
  'Mart',
  'Nisan',
  'Mayıs',
  'Haziran',
  'Temmuz',
  'Ağustos',
  'Eylül',
  'Ekim',
  'Kasım',
  'Aralık'
);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Optimak STU - Yönetici Paneli</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<?php include("navbar.php") ?>
<div class="container-fluid">
<br>
<h1 class="display-4">Öneri Formları</h1>

  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Ad Soyad</th>
      <th scope="col">Bölüm</th>
      <th scope="col">Konu</th>
      <th scope="col">Tarih</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
   

        $oneriformlari = $db->query("Select * from oneriformu where okundu='h' && bildirimturu='oneri'");


        if(isset($_GET['okunmusformlar']))
        {
          $getir = $_GET['okunmusformlar'];
          if($getir == true)
          {
            $oneriformlari = $db->query("Select * from oneriformu where okundu='e' && bildirimturu='oneri' order by id desc");
          }
        }

        if($oneriformlari->rowCount())
        {
          foreach($oneriformlari as $oneri)
          {
            $gun = date("j", strtotime($oneri['tarih']));
            $ay = $aylar[date("m", strtotime($oneri['tarih'])) -1];
            $gun = $gun. ' '.$ay;
            $gun = $gun.' '.$gunler[date("N", strtotime($oneri['tarih'])) -1];
         
            echo ' <tr>
            <th scope="row">'.$oneri["id"].'</th>
            <td>'.$oneri["adsoyad"].'</th>
            <td>'.$oneri["bolum"].'</th>
            <td>'.$oneri["konu"].'</th>
            <td>'. $gun.' ('.date("d.m.y",strtotime(($oneri["tarih"]))).')</th>
            <td><a href="formdetay?id='.$oneri["id"].'"><button type="button" class="btn btn-primary">İncele</button></a></td>
          </tr>';
          }
        }
    ?>
  </tbody>
</table>
<br>
<br>
<br>
<h1 class="display-4">Problem Formları</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Ad Soyad</th>
      <th scope="col">Bölüm</th>
      <th scope="col">Konu</th>
      <th scope="col">Tarih</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $oneriformlari = $db->query("Select * from oneriformu where okundu='h' && bildirimturu='problem'");
       
        
        if(isset($_GET['okunmusformlar']))
        {
          $getir = $_GET['okunmusformlar'];
          if($getir == true)
          {
            $oneriformlari = $db->query("Select * from oneriformu where okundu='e' && bildirimturu='problem' order by id desc");
          }
        }

       
       
       
        if($oneriformlari->rowCount())
        {
          foreach($oneriformlari as $oneri)
          {
            $gun = date("j", strtotime($oneri['tarih']));
            $ay = $aylar[date("m", strtotime($oneri['tarih'])) -1];
            $gun = $gun. ' '.$ay;
            $gun = $gun.' '.$gunler[date("N", strtotime($oneri['tarih'])) -1];
         
            echo ' <tr>
            <th scope="row">'.$oneri["id"].'</th>
            <td>'.$oneri["adsoyad"].'</th>
            <td>'.$oneri["bolum"].'</th>
            <td>'.$oneri["konu"].'</th>
            <td>'. $gun.' ('.date("d.m.y",strtotime(($oneri["tarih"]))).')</th>
            <td><a href="formdetay?id='.$oneri["id"].'"><button type="button" class="btn btn-primary">İncele</button></a></td>
          </tr>';
          }
        }
    ?>
  </tbody>
</table>
</div>
</body>
</html>