<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}

$bilgiler=iletisimVeri();
$dizi=mysqli_fetch_assoc($bilgiler);

isset($_POST["iletisim_guncelle"]) ? $giris=$_POST["iletisim_guncelle"]:$giris="";
$check=false;
if($giris=="GÜNCELLE"){
    $iframe=$_POST["y_iframe"];
    $adres=$_POST["y_adres"];
    $telefon=$_POST["y_telefon"];
    $mail=$_POST["y_mail"];
    iletisimVeriGuncelle($iframe,$adres,$telefon,$mail);
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
    margin-top: 5px;
}
#y_iframe{width: 40vw;}
#y_adres{width: 30vw;}
.uyari{width: 100%;text-align: center;}
input{margin: 10px;text-align: center;}
input[type="submit"]{margin-top: 10px;}
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
             
                <div class="uyari">
                 <?php if($check==false):?>    
                <div class="alert alert-primary kalam-regular" role="alert">
               ADMİN İLETİŞİM GÜNCELLEME
               </div>
               <?php else:?>
                <div class="alert alert-success kalam-regular" role="alert">
              İLETİŞİM BİLGİLERİ GÜNCELLENDİ
               </div>
                <?php endif;?>
                 </div>
                </div>      
          
            <form action="admin_iletisim.php" method="POST">
            <input type="text" name="y_iframe" id="y_iframe" placeholder="HARİTA BAĞLANTI" class="form-control" value="<?php echo $dizi["harita"]?>" >
            <input type="text" name="y_adres" id="y_adres" placeholder="ADRES" class="form-control" value="<?php echo $dizi["adres"]?>">
            <input type="text" name="y_telefon" id="y_telefon" placeholder="TELEFON" class="form-control" value="<?php echo $dizi["telefon"]?>">
            <input type="text" name="y_mail" id="y_mail" placeholder="MAİL" class="form-control"  value="<?php echo $dizi["mail"]?>"  >
            <input type="submit" value="GÜNCELLE" name="iletisim_guncelle" class="btn btn-danger kalam-regular" style="width:10vw">
            </form>
        
        <a class='btn btn-primary kalam-regular anasayfa' href='admin_anasayfa.php'>ANASAYFA</a>
        </div>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>