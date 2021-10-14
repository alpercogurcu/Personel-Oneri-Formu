
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


<?php
$hash= md5(uniqid(rand()));
?>


    <div class="jumbotron"><div class="container-fluid">
    <img class="rounded mx-auto d-block" src="https://optimak.com.tr/wp-content/uploads/2020/09/optimakkonveyorstrec-sarmahat-sonu-1.png" height="100px"/>
<br>
<br>
    <form action="onerikayit" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $hash ?>" name="hash" id="hash" >


<div class="form-group">
 <label for="adsoyad">Ad Soyad</label>
<input type="text" class="form-control" id="adsoyad" name="adsoyad" placeholder="Adınız Soyadınız" required> 
</div>

<div class="form-group">
  <label for="bolum">Bölüm</label>
  <input type="text" class="form-control"  id="bolum" name="bolum" placeholder="Bölümünüz" required>
</div>

<div class="form-group">

  <label for="bolum">Görev</label>
  <input type="text" class="form-control" id="gorev" name="gorev" placeholder="Göreviniz" required>
</div>

<div class="form-group">
  <label for="bildirim">Bildirim Türü</label>
  <select id="bildirim" class="custom-select" name="bildirim" required>
    <option value="problem">Problem</option>
    <option value="oneri">Öneri</option>
  </select>
</div>
<?php /*
  <label for="medya">Fotoğraf veya video eklemek ister misiniz?</label>
  <select id="medya" name="medya" required>
    <option value="evet">Evet</option>
    <option value="hayir">Hayır</option>
  </select> */?>
  <div class="form-group">
  <label for="konu">Konu</label>
  <input type="text" class="form-control" id="konu" name="konu" placeholder="Konu" required>
</div>

<div class="form-group">
  <label for="mesaj">Mesaj</label>
  <textarea id="mesaj" class="form-control" name="mesaj" rows="4" cols="50" required>
</textarea>
</div>
<div class="form-group">
<div  class="dropzone"></div>
</div>
<!---  <textarea id="mesaj" name="mesaj" placeholder="Mesaj" style="height:150px;" /> ---->
<div class="form-group">

  <input type="submit" class="btn btn-primary" value="Kaydet"></div>
</div>
</form>
</div>
</div>
<?php /*
<form action="uploadfile.php"
      ="my-awesome-dropzone">
   </form>class="dropzone"
      id*/?>

      <script>
    Dropzone.autoDiscover = false;
    $(document).ready(function () {
        var _dz = new Dropzone(".dropzone", {
            autoProcessQueue: true, // Dosyalar dropzone alanına bırakıldığı anda yüklemeye başlar, false olarak ayarlanırsa bir buton ile tetiklemek gerekir.
            parallelUploads: 10, // Aynı anda kaç dosya yüklenecek. Her hangi bir ayar belirtilmezse varsayılan 2'dir.
            timeout:0,
            dictDefaultMessage:'Yüklemek istediğiniz dosyaları buraya bırakın',
            dictFallbackMessage: "Tarayıcınız sürükle bırak yüklemelerini desteklemiyor",
            dictFileTooBig: "Dosya boyutu çok büyük ({{filesize}} Mb). Yükleyebileceğiniz en büyük dosya boyutu: {{maxFilesize}} Mb.",
            dictInvalidFileType: "Bu tür dosyaları yükleyemezsiniz",
            dictResponseError: "Sunucu hatası. Hata kodu : {{statusCode}}",
            dictCancelUpload: "Yüklemeyi İptal Et",
            dictUploadCanceled: "Yükleme iptal edildi",
            dictCancelUploadConfirmation: "Bu yüklemeyip iptal etmek istediğinizden emin misiniz ?",
            dictRemoveFile: "Dosyayı Sil",
            dictMaxFilesExceeded: "Başka dosya yükleyemezsiniz.",
            acceptedFiles: "image/jpeg,image/png,image/gif,.mp4,.mkv,.avi,.pdf,.xls,.xlsx,.mov,video/*",
            maxFilesize: 512, // MB
            url:'uploadfile.php', // Yükleme işlemini yapacak sunucu dosyası
            removedfile: function(file) {
                //var name = file.name;
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response){
                if(response==1)
                {
                    alert('Dosya başarı ile eklendi!');
                }
                else
                {
                    alert('Dosya Eklenemedi, listeden siliniyor. İlgili hata:' + response);
                    _dz.removeFile(file);
                }
            },
            error: function (file, response) {
                file.previewElement.classList.add("dz-error");
            },
            init: function() {
                this.on("sending", function(file, xhr, formData){
                        formData.append("hash", "<?php echo $hash ?>");
                });
            }
            
        });
    });
</script>


</body>

</html>