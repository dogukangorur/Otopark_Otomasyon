<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
session_start();
isset($_POST["kayit_ol"]) ? $durum=$_POST["kayit_ol"]:$durum="";
$check=0;
if($durum=="KAYIT OL"){
$kullanici_adi=$_POST["k_kayit_kullaniciAdi"];
$kullanici_sifre=$_POST["k_kayit_sifre"];
$plaka=strtoupper($_POST["k_kayit_plaka"]);
$ad=$_POST["k_kayit_ad"];
$soyad=$_POST["k_kayit_soyad"];
$tc=$_POST["k_kayit_tc_no"];
$telefon=$_POST["k_kayit_tel_no"];
$tarife=$_POST["tarife"];
$kullanici_varmi=kullaniciKontrol($kullanici_adi);
$check=0;
if($kullanici_varmi==true){
   $check=0;
}
else{
   $check=1;
   kullaniciOturumKayit($kullanici_adi,$kullanici_sifre,$plaka,$ad,$soyad,$tc,$telefon,$tarife);
}
}

?>
<style>
.bilgi{
    justify-content: flex-start;
    text-align: center;
}
.alert{
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100px;
}
.alert-success{
    background-color: green;
    color: white;
    border-color: green;
}
.anasayfa{background-color: #222d50;border-color: #222d50;color:white;width: 10vw;}
</style>
</head>
<body>
<div class="kapsayici">

    <div class="icerik">
        <div class="logo">
        <img src="/otopark_otomasyon/img/logo.jpeg" alt=""><br>
        </div>
        <div class="bilgi">
        <div class="col-12">
            
        <?php if($check==0):?>
            <div class="alert alert-danger kalam-regular" role="alert" style="text-align: center;">
             KULLANICI ZATEN KAYITLI
            </div>  
        <a class='btn btn-success kalam-regular' href='kullanici_kayit.php?plaka=<?php echo $plaka?>&ad=<?php echo $ad?>&soyad=<?php echo $soyad?>&telefon=<?php echo $telefon?>&tarife=<?php echo $tarife?>'>GERİ DÖN</a>
        <?php else:?>    
            <div class="alert alert-success kalam-regular" role="alert" style="text-align: center;">
             KAYIT BAŞARILI
            </div> 
            <a class='btn btn-primary kalam-regular anasayfa' style="position:relative;top:-10px;" href='index.php'>ANASAYFA</a>

          <?php endif;?>


        </div>
    </div>
</div>












<?php include "layers/footer.php"?>