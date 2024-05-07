<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();

if(isset($_SESSION["loggin_k"]) && $_SESSION["loggin_k"]==true){
    $kullanici_aktif=true;
}
else{$kullanici_aktif=false;
    if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==true){
        $admin_aktif=true;
    }
    else{$admin_aktif=false;}}

isset($_GET["plaka"]) ? $plaka=$_GET["plaka"]:$plaka="";
isset($_GET["rezId"]) ? $rez_id=$_GET["rezId"]:$rez_id="";
$check=false;
if($plaka!="" && $rez_id!=""){
    $sonuc=aracIdveKullaniciBul($plaka);
    $gelenDizi=mysqli_fetch_assoc($sonuc);
    $arac_id=$gelenDizi["arac_id"];
    $kullanici_id=$gelenDizi["kullanici_id"];
    $sonuc2=rezIdBul($arac_id);
    $gelen_dizi=mysqli_fetch_assoc($sonuc2);
    $kullanici_kayitli_mi=kullaniciKayit_var_mi($kullanici_id);
    if($kullanici_kayitli_mi==true){
        aracKayitSil($rez_id);
        rezervasyonSil($rez_id);
        $check=true;
    }
    else{
        aracKayitSil($rez_id);
        rezervasyonSil($rez_id);
        aracSil($plaka);
        kullaniciSil($kullanici_id);
        $check=true;
    }
}
?>
<style>
.alert{
    height: 30%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.alert-danger{
    background-color: crimson;
    color: white;
    border-color: crimson;
}
.alert-success{
    background-color: green;
    color: white;
    border-color: green;
}
.btn-primary{
    background-color: #222d50;
    border-color: #222d50;
}
.bilgi{
    justify-content: flex-start;
    margin-top: 50px;
}
.col-12{
    text-align: center;
}
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
            <?php if($check==true):?>
                <div class="alert alert-success kalam-regular" role="alert">
                RANDEVUNUZ BAŞARILI BİR ŞEKİLDE İPTAL EDİLMİŞTİR.
                </div>

             <?php else:?>   
                <div class="alert alert-danger kalam-regular" role="alert">
                RANDEVUNUZ İPTAL EDİLEMEMİŞTİR. KURUM İLE İLETİŞİME GEÇİNİZ.
                </div>

            <?php endif; ?>    
            <br><br>
            <?php if($kullanici_aktif==true):?>
            <a class='btn btn-primary kalam-regular' href='kullanici_anasayfa.php'  >ANASAYFA</a>
            <?php elseif($admin_aktif==true):?>
                <a class='btn btn-primary kalam-regular' href='admin_anasayfa.php'  >ANASAYFA</a>
            <?php else:?>  
                <a class='btn btn-primary kalam-regular' href='index.php'  >ANASAYFA</a>
             <?php endif; ?> 
        </div>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>