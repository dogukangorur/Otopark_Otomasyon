<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_GET["tarife_id"]) ? $tarife_id=$_GET["tarife_id"]:$tarife_id=-1;
isset($_GET["tarife_adi"]) ? $tarife_ad=$_GET["tarife_adi"]:$tarife_ad="";
isset($_GET["tarife_ucreti"]) ? $tarife_ucreti=$_GET["tarife_ucreti"]:$tarife_ucreti="";

isset($_GET["tarifeGuncelle"]) ? $giris=$_GET["tarifeGuncelle"]:$giris="";
if($giris=="GÜNCELLE"){
    $tarife_id=$_GET["y_tarifeId"];
    $tarife_adi=$_GET["y_tarifeAdi"];
    $tarife_fiyat=$_GET["y_tarifeFiyat"];
    tarifeVeriGuncelle($tarife_id,$tarife_adi,$tarife_fiyat);
    $_SESSION["tarife_ayar"]="güncellendi";
    header("Location:admin_tarife.php");
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
               TARİFE BİLGİ GÜNCELLEME
                </div>
                </div>      
            <?php endif;?>
            <form action="admin_tarife_duzenle.php" method="GET">
            <input type="number" name="y_tarifeId" id="y_tarifeId" style="display: none;"  placeholder="TARİFE ADI" class="form-control" value="<?php if($tarife_id!=-1){echo $tarife_id;}?>">
            <input type="text" name="y_tarifeAdi" id="y_tarifeAdi" placeholder="TARİFE ADI" class="form-control" value="<?php if($tarife_ad!=""){echo $tarife_ad;}?>">
            <input type="number" name="y_tarifeFiyat" id="y_tarifeFiyat" placeholder="FİYAT" class="form-control" value="<?php if($tarife_ucreti!=""){echo $tarife_ucreti;}?>">
            <input type="submit" value="GÜNCELLE" name="tarifeGuncelle" class="btn btn-danger kalam-regular" style="width:10vw">
            </form>
        </div>
        <a class='btn btn-primary kalam-regular anasayfa' href='admin_anasayfa.php'>ANASAYFA</a>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>