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

<?php

if ($_GET) {
  $id = $_GET['id'];

  $detaygetir = $db->prepare("Select * from oneriformu where id=:id");
  $detaygetir->execute(array("id" => $id));
  if ($detaygetir->rowCount()) {
    foreach ($detaygetir as $detay) {
      $id = $detay['id'];
      $adsoyad = $detay['adsoyad'];
      $bolum = $detay['bolum'];
      $gorev = $detay['gorev'];
      $bildirimturu = $detay['bildirimturu'];
      $konu = $detay['konu'];
      $mesaj = $detay['mesaj'];
      $tarih = $detay['tarih'];
      $hash = $detay['hash'];
      $okundu = $detay['okundu'];
      $atananpersonel = $detay['atananpersonel'];
      $dosyaadlari = array();
    }

    if (isset($_GET['okundu'])) {
      $okunduistek = $_GET['okundu'];

      if ($okunduistek == "e" || $okunduistek == "h") {
        $update = $db->prepare("update oneriformu set okundu=:pOkundu, okuyan=:pOkuyan where id=:pid");
        $updateyap = $update->execute(array("pOkundu" => $okunduistek, "pOkuyan" => $_SESSION['adsoyad'], "pid" => $id));
        if ($updateyap) {
          header("location: formdetay?id=".$id);
        }
      }
    }
  } else {
    header("location: yonetim.php");
  }
} else {
  header("location: yonetim.php");
}

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
    <h1 class="display-4">Form Detayı</h1>
    <div class="container">

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Adı Soyadı</th>
            <th scope="col">Bölümü</th>
            <th scope="col">Görevi</th>
            <th scope="col">Bildirim Türü</th>
            <th scope="col">Tarih</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $adsoyad ?></td>
            <td><?php echo $bolum ?></td>
            <td><?php echo $gorev ?></td>
            <td><?php echo (($bildirimturu == 'oneri') ? 'Öneri' : 'Problem'); ?></td>
            <td><?php echo $tarih ?> echo</td>
          </tr>
        </tbody>
      </table>

      <h5><u>Konu</u></h5><?php echo $konu; ?>
      <br>
      <br>
      <h5><u>Mesaj</u></h5><?php echo $mesaj; ?>
      <br>
      <br>
      <div class="float-right">
        <a href=<?php echo 'formdetay?id=' . $id . '&okundu=' . (($okundu  == "e") ? "h" : "e"); ?>>
          <div class="btn btn-success align-items-end"><?php echo ($okundu == 'e') ? "Okunmadı" : "Okundu" ?> olarak işaretle</div>
        </a>
      </div>
      <?php

      if (isset($hash)) {
        $medyagetir = $db->prepare("Select * from oneriformu_ekler where hash=:hash");
        $medyagetir->execute(array("hash" => $hash));
        $medya2 = $medyagetir;

        $medya_arr = array();
        foreach ($medya2 as $mm) {
          array_push($medya_arr, $mm);
        }


      ?>

        <h3>Eklenen Medyalar</h3>
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Medya Listesi
                </button>
              </h2>
            </div>

            <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <?php
                if ($medyagetir->rowCount()) {
                  foreach ($medya_arr as $medya) {
                    echo '<a href="' . $medya['yol'] . '"><p> ' . $medya['dosya_adi'] . '</p></a>';
                  }
                }
                ?>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Fotoğraf / Video İçeriği
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <?php


                foreach ($medya_arr as $medya1) {
                  $medyatipi = explode("/", $medya1['tip'])[0];
                  if ($medyatipi == "image") {
                    echo '
         <div class="col-sm">
         <a href="' . $medya1['yol'] . '"><img src=' . $medya1['yol'] . ' width="400" /></a>
         </div>';
                  } else if ($medyatipi == "video") {
                    echo '
         <div class="col-sm">
         <video src="' . $medya1['yol'] . '" width="400" controls ></video>
         </div>';
                  } else {
                    echo '
         <div class="col-sm">
         <iframe src="' . $medya1['yol'] . '" width="400" ></video>
         </div>';
                  }
                }



                ?>
              </div>
            </div>
          </div>
        </div>




      <?php

      }


      ?>











    </div>
  </div>
</body>

</html>



<?php
/*
echo '<div class="row">';
foreach($medyagetir as $medya )
{ 

  $medyatipi = explode("/", $medya['tip'])[0];
  if( $medyatipi == "image")
  {
    echo '
    <div class="col-sm">
    <a href="'.$medya['yol'].'"><img src='.$medya['yol'].' width="400" /></a>
    </div>';
  }
  else if($medyatipi == "video")
  {
    echo '
    <div class="col-sm">
    <video src="'.$medya['yol'].'" width="400" controls ></video>
    </div>';
  }
  else
  {
    echo '
    <div class="col-sm">
    <iframe src="'.$medya['yol'].'" width="400" ></video>
    </div>';
  }


}
echo '</div>'; */

?>