<?php



?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="yonetim"><img src="https://optimak.com.tr/wp-content/uploads/2020/09/optimakkonveyorstrec-sarmahat-sonu-1.png" height="30px"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="yonetim">Ana Sayfa <span class="sr-only">(current)</span></a>
      </li>
         <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Form İşlemleri
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="yonetim?okunmusformlar=true">Okunmuş Formlar</a>
          <a class="dropdown-item" href="yonetim">Okunmamış Formlar</a>
          <?php  //  <div class="dropdown-divider"></div>
       //   <a class="dropdown-item" href="#">Something else here</a> ?>
        </div>
      </li>
     <?php /*<li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>*/?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
     <?php echo $_SESSION['adsoyad'] ?>
    </form>
    <?php /*
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Ara" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
    </form> */ ?>
  </div>
</nav>