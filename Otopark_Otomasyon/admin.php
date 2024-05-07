<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
veriSil();

session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==true){
    header("Location:admin_anasayfa.php");
}

isset($_POST["giris"]) ? $giris=$_POST["giris"]:$giris="";
$check=false;
if($giris=="GİRİŞ"){
    $gelen_bilgi=adminBilgi();
    $mydizi=mysqli_fetch_assoc($gelen_bilgi);
    $kullanici_adi=$mydizi["kullanici_adi"];
    $sifre=$mydizi["sifre"];
    $k_adi=$_POST["kullaniciAdi"];
    $k_sifre=$_POST["sifre"];
    if($k_adi==$kullanici_adi && $sifre==$k_sifre){
        $check=true;
        $_SESSION["loggin"]=true;
        header("Location:admin_anasayfa.php");
    }
    else{
        $check=false;
    }


}
?>
<style>
.alert-primary{background-color: #222d50;color: white;}    
.alert-danger{background-color: crimson;color: white;}
.btn-danger{background-color:#222d50;border-color: #222d50;}
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
               ADMİN GİRİŞ
                </div>
                </div>
            <?php endif;?>
            <form action="admin.php" method="POST">
            <input type="text" name="kullaniciAdi" id="kullaniciAdi" placeholder="KULLANICI ADI" class="form-control">
            <input type="password" name="sifre" id="sifre" placeholder="SİFRE" class="form-control">
            <input type="submit" value="GİRİŞ" name="giris" class="btn btn-danger kalam-regular" style="width:10vw">
            </form>
        </div>
      
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>