<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
   session_start();
   if(isset($_SESSION["loggin_k"]) && $_SESSION["loggin_k"]==false){
    header("Location:oturum.php");
    exit;
}
   if(isset($_SESSION["kullanici_bilgi_dizisi"])){
    $kullaniciBilgi=$_SESSION["kullanici_bilgi_dizisi"];
   } 
    $plaka=$kullaniciBilgi["plaka"];
    $ad=$kullaniciBilgi["ad"];
    $soyad=$kullaniciBilgi["soyad"];
    $tc=$kullaniciBilgi["tcNo"];
    $telefon=$kullaniciBilgi["telNo"];
    $tarife=$kullaniciBilgi["tarife_id"] ;
?>

<?php

isset($_POST["k_guncelle"]) ? $durum=$_POST["k_guncelle"]:$durum="";
$check=0;
if($durum=="GÜNCELLE"){
$plakasi=strtoupper($_POST["plaka1"]);
$adi=$_POST["ad"];
$soyadi=$_POST["soyad"];
$tcNo=$_POST["tc_no"];
$telefonNo=$_POST["telefon_no"];
kayitliKullaniciBilgiGuncelle($adi,$soyadi,$tcNo,$telefonNo,$plakasi,$kullaniciBilgi["kullanci_id"]);
$check=1;
}
?>

<style>
.col-12{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
}
form{
    width: 100%;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}
input{margin: 10px;}
.adSoyad{display: flex;align-items: center;justify-content: center;flex-wrap: wrap;}
.tarihAlani{display: flex;flex-wrap: wrap;margin-bottom: 20px;}
.form-control{width: 40%;}
.secim{ margin: 10px;width: 25%; text-align: center;}
.label{width: 60%;display: flex;justify-content: space-around;flex-wrap: wrap;}
label{border-bottom: 5px solid #222d50;width: 10vw;text-align: center;font-size: 20px;}
#plaka1{width: 25%;text-align:center ;}
.btn-primary{
    background-color: #222d50;
    border-color: #222d50;
}
.anasayfaBtn{width: 100%;text-align: center;margin-top: 20px;}
.anasayfaBtn a{width: 10vw;}
.oturumBtn{background-color: #09790b;color: white;border-color:#09790b;box-shadow:#09790b 2px 2px 0 0;}
.oturumBtn:hover{background-color: white;color: black;border-color:#09790b;box-shadow:#09790b 2px 2px 0 0;}
.bilgi{width: 100%;display: flex;justify-content: center;align-items: center;}
.uyari{width: 100%;text-align: center;}
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
        <?php if($check==1):?>
            <div class="uyari">  
                <div class="alert alert-success kalam-regular" role="alert">
               !!! GÜNCELLENDİ !!!
                </div>
                </div> 
         
        <?php endif;?>  

           <form action="kullanici_guncelleme.php" method="POST">
           <input type="text" name="plaka1" id="plaka1" placeholder="PLAKA"  required class="form-control" value="<?php echo $plaka; ?>" pattern="^(0[1-9]|[1-7]\d|8[0-1])[a-zA-Z]{1,3}(0[1-9]|[1-9]\d{1,3})$" maxlength="9" style="text-align: center; " >
           <div class="adSoyad">
           <input type="text" name="ad" id="ad" placeholder="AD" class="form-control" required maxlength="30" value="<?php if(isset($ad)){echo $ad;} ?>"  style="text-align: center; ">
           <input type="text" name="soyad" id="soyad" placeholder="SOYAD" class="form-control" required maxlength="30" value="<?php if(isset($soyad)){echo $soyad;} ?>"  style="text-align: center;">
           </div>
           <input type="text" name="tc_no" id="tc_no" placeholder="TC" class="form-control" required minlength="11" maxlength="11" value="<?php if(isset($tc)){echo $tc;} ?>"  style="text-align: center; ">
           <input type="text" name="telefon_no" id="telefon_no" placeholder="TELEFON (5XX0000000)" required class="form-control" minlength="10" maxlength="10" value="<?php if(isset($telefon)){echo $telefon;} ?>"  style="text-align: center;">

        <div class="anasayfaBtn">
        <a class='btn btn-primary kalam-regular anasayfa' href='kullanici_anasayfa.php' >ANASAYFA</a>
        <input type="submit" value="GÜNCELLE" required name="k_guncelle" class="btn kalam-regular oturumBtn" style="width:10vw">
        </div>
        </form>  
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>