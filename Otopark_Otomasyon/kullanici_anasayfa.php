<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();
if(isset($_SESSION["loggin_k"]) && $_SESSION["loggin_k"]==false){
    header("Location:oturum.php");
    exit;
}
?>

<?php
  if(isset($_SESSION["kullanici_bilgi_dizisi"])){
   $kullaniciBilgi=$_SESSION["kullanici_bilgi_dizisi"];
  } 

?>
<style>
a{width: 20vw;}
.button-74{
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cikisBtn{background-color: crimson;color: white;border-color: crimson;box-shadow:crimson 2px 2px 0 0;}
.uyari{width: 100%;text-align: center;}
.alert-primary{background-color: #222d50;color: white;border-color: #222d50;margin-bottom: 30px;}    

</style>
</head>
<body>
<div class="kapsayici">

    <div class="icerik">
        <div class="logo">
        <img src="/otopark_otomasyon/img/logo.jpeg" alt=""><br>
        </div>
        <div class="bilgi">
        <div class="uyari">  
                <div class="alert alert-primary kalam-regular" role="alert">
               MERHABA <em style="font-size: 20px;font-style:normal;color:orange;"><?php echo strtoupper($kullaniciBilgi["ad"])." ".strtoupper($kullaniciBilgi["soyad"]);?></em>
                </div>
                </div> 
        <a class="button-74 kalam-regular" role="button" href="rezervasyonlarim.php">REZERVASYONLARIM</a><br>
        <a class="button-74 kalam-regular" role="button" href="kullanici_rezervasyon.php">REZERVASYON</a><br>
        <a class="button-74 kalam-regular" role="button" href="kullanici_guncelleme.php">BİLGİ GÜNCELLE</a><br>
        <a class="button-74 kalam-regular" role="button" href="kullanici_oturum_duzenleme.php">OTURUM BİLGİ GÜNCELLE</a><br>
        <a class="button-74 kalam-regular cikisBtn" role="button" href="kullanici_cikis.php">ÇIKIŞ</a><br>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>