<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_POST["guncelle"]) ? $giris=$_POST["guncelle"]:$giris="";
$check=false;
if($giris=="GÜNCELLE"){
    $k_adi=$_POST["y_kullaniciAdi"];
    $k_sifre=$_POST["y_sifre"];
    adminBilgiGuncelleme($k_adi,$k_sifre);
    $check=true;

}
?>
<style>
.alert-success{background-color: green;color: white;}
.alert-primary{background-color: #222d50;color: white;}    
.alert-danger{background-color: crimson;color: white;}
.btn-danger{background-color:crimson;border-color: crimson;}
.col-12{width: 100%;display:flex;justify-content: center;align-items: center;flex-direction: column;}
.bilgi{display: flex;justify-content: flex-start;}
form{
    width: 40%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
}
.uyari{width: 100%;text-align: center;}
input{margin: 20px;text-align: center;}
input[type="submit"]{margin-top: 30px;}
.anasayfa{width: 10vw;margin-top: 20px;background-color: #222d50;border-color: #222d50;}
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
             <?php if($giris=="GÜNCELLE"):?>
                <?php if($check==true):?>
                 <div class="uyari">  
                <div class="alert alert-success kalam-regular" role="alert">
               !!! GÜNCELLENDİ !!!
                </div>
                </div> 
                <?php endif;?>
                <?php else:?>
                <div class="uyari">  
                <div class="alert alert-primary kalam-regular" role="alert">
               ADMİN BİLGİ GÜNCELLEME
                </div>
                </div>      
            <?php endif;?>
            <form action="admin_bilgi_duzenle.php" method="POST">
            <input type="text" name="y_kullaniciAdi" id="y_kullaniciAdi" placeholder="YENİ KULLANICI ADI" class="form-control">
            <input type="password" name="y_sifre" id="y_sifre" placeholder="YENİ SİFRE" class="form-control">
            <input type="submit" value="GÜNCELLE" name="guncelle" class="btn btn-danger kalam-regular" style="width:10vw">
            </form>
        </div>
        <a class='btn btn-primary kalam-regular anasayfa' href='admin_anasayfa.php'>ANASAYFA</a>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>