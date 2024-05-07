<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}

?>
<style>
a{width: 20vw;}
.button-74{
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0px 10px;
}
.cikisBtn{background-color: crimson;color: white;border-color: crimson;box-shadow:crimson 2px 2px 0 0;}
.secenek{width: 100%;display: flex;justify-content: center;margin-bottom: 30px;flex-wrap: wrap;}
</style>
</head>
<body>
<div class="kapsayici">

    <div class="icerik">
        <div class="logo">
        <img src="/otopark_otomasyon/img/logo.jpeg" alt=""><br>
        </div>
        <div class="bilgi">
            <div class="secenek">  
        <a class="button-74 kalam-regular" role="button" href="admin_araclar.php">ARAÇ LİSTESİ</a><br>
        <a class="button-74 kalam-regular" role="button" href="rezervasyon_kayit.php">REZERVASYON</a><br>
             </div>
             <div class="secenek">  
        <a class="button-74 kalam-regular" role="button" href="admin_kayitlar.php">KAYITLAR</a><br>
        <a class="button-74 kalam-regular" role="button" href="admin_tarife.php">TARİFE DÜZENLEME</a><br>
             </div>
             <div class="secenek">
        <a class="button-74 kalam-regular" role="button" href="admin_bilgi_duzenle.php">ADMİN BİLGİ DÜZENLEME</a><br>
        <a class="button-74 kalam-regular" role="button" href="admin_kart.php">KART DÜZENLEME</a><br>
            </div>
        <a class="button-74 kalam-regular" role="button" href="admin_iletisim.php">İLETİŞİM DÜZENLEME</a><br>
        <a class="button-74 kalam-regular cikisBtn" role="button" href="admin_cikis.php">ÇIKIŞ</a><br>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>