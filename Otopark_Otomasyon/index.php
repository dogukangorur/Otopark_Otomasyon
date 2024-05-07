<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<style>
a{
    width: 20vw;
}
.oturum{
    display: flex;
    width: 100%;
    justify-content:center;
}
.oturum a{
    width: 10vw;
    margin: 0px 10px;
}
.cikisBtn{background-color: crimson;color: white;border-color: crimson;box-shadow:crimson 2px 2px 0 0;}
.oturumBtn{background-color: #09790b;color: white;border-color:#09790b;box-shadow:#09790b 2px 2px 0 0;}
</style>
</head>
<body>
<div class="kapsayici">

    <div class="icerik">
        <div class="logo">
        <img src="/otopark_otomasyon/img/logo.jpeg" alt=""><br>
        </div>
        
        <div class="bilgi">
        <a class="button-74 kalam-regular" role="button" href="tarife.php">FİYAT LİSTESİ</a><br>
        <a class="button-74 kalam-regular" role="button" href="rezervasyon.php">REZERVASYON</a><br>
        <a class="button-74 kalam-regular" role="button" href="iletisim.php">İLETİŞİM</a><br>
        <div class="oturum">
        <a class="button-74 kalam-regular oturumBtn" role="button" href="oturum.php">OTURUM AÇ</a>
        <a class="button-74 kalam-regular cikisBtn" role="button" href="kullanici_kayit.php">KAYIT OL</a>
        </div>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>