<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
session_start();
if(isset($_SESSION["loggin_k"]) && $_SESSION["loggin_k"]==true){
    header("Location:kullanici_anasayfa.php");
    
}

isset($_POST["k_giris"]) ? $giris=$_POST["k_giris"]:$giris="";
$check=false;
if($giris=="GİRİŞ"){
    $k_adi=$_POST["k_kullaniciAdi"];
    $k_sifre=$_POST["k_sifre"];
    $gelen_bilgi=kullaniciBilgi($k_adi);
    $mydizi=mysqli_fetch_assoc($gelen_bilgi);
    if(!empty($mydizi))
    {
        $k_kayit_id=$mydizi["k_kayit_id"];
        $kullanici_adi=$mydizi["kullanici_adi"];
        $sifre=$mydizi["sifre"];
        $arac_id=$mydizi["arac_id"];
        $plaka=$mydizi["plaka"];
        $kullanci_id=$mydizi["kullanici_id"];
        $ad=$mydizi["ad"];
        $soyad=$mydizi["soyad"];
        $tcNo=$mydizi["tc_no"];
        $telNo=$mydizi["tel_No"];
        $tarife_id=$mydizi["tarife_id"];
        $tarife_tipi=$mydizi["tarife_tipi"];
        $kullanici_bilgi_dizi=["k_kayit_id"=>$k_kayit_id,"kullanici_adi"=>$kullanici_adi,"sifre"=>$sifre,"arac_id"=>$arac_id,"plaka"=>$plaka,"kullanci_id"=>$kullanci_id,"ad"=>$ad,"soyad"=>$soyad,"tcNo"=>$tcNo,"telNo"=>$telNo,"tarife_id"=>$tarife_id,"tarife_tipi"=>$tarife_tipi];
        $_SESSION["kullanici_bilgi_dizisi"]=$kullanici_bilgi_dizi;
    
    if($k_adi==$kullanici_adi && $sifre==$k_sifre){
        $check=true;
        $_SESSION["loggin_k"]=true;
        header("Location:kullanici_anasayfa.php");
    }
    else{
        $check=false;
    }

}
}
?>
<style>
.alert-primary{background-color: #222d50;color: white;}    
.alert-danger{background-color: crimson;color: white;}
.btn-danger{background-color:#dc3545;border-color: #dc3545;}
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
input[type="submit"]{margin:0px;width: 80px;width:8vw;margin-left: 5px;}
.anasayfaDon a{width:8vw;background-color: #222d50;border-color: #222d50;margin-right: 5px;}
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
             <?php if($giris=="GİRİŞ"):?>
                <?php if($check==false):?>
                 <div class="uyari">  
                <div class="alert alert-danger kalam-regular" role="alert">
               !!! KULLANICI ADI VEYA ŞİFRE HATALI !!!
                </div>
                </div> 
                <?php endif;?>
                <?php else:?>
                <div class="uyari">  
                <div class="alert alert-primary kalam-regular" role="alert">
               KULLANICI GİRİŞ
                </div>
                </div>      
            <?php endif;?>
            <form action="oturum.php" method="POST">
            <input type="text" name="k_kullaniciAdi" id="kullaniciAdi" placeholder="KULLANICI ADI" class="form-control">
            <input type="password" name="k_sifre" id="sifre" placeholder="SİFRE" class="form-control">
            <br>
            <div class="anasayfaDon">
            <a class='btn btn-primary kalam-regular anasayfa' href='index.php'>ANASAYFA</a>
            <input type="submit" value="GİRİŞ" name="k_giris" class="btn btn-danger kalam-regular">
            </div>
            </form>
        </div>
      
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>