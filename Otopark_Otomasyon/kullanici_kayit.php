<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
   session_start(); 
  isset($_GET["plaka"])? $plaka=$_GET["plaka"]:$plaka="";
  isset($_GET["ad"])? $ad=$_GET["ad"]:$ad="";
  isset($_GET["soyad"])? $soyad=$_GET["soyad"]:$soyad="";    
  isset($_GET["telefon"])? $telefon=$_GET["telefon"]:$telefon="";
  isset($_GET["tarife"])? $tarife=$_GET["tarife"]:$tarife=""; 
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
input{margin: 10px; text-align: center;}
.adSoyad{display: flex;align-items: center;justify-content: center;flex-wrap: wrap;}
.tarihAlani{display: flex;flex-wrap: wrap;}
.form-control{width: 40%;}
.secim{ margin: 10px;width: 25%; text-align: center;}
.label{width: 50%;display: flex;justify-content: space-around;flex-wrap: wrap;}
#plaka1{width: 25%;text-align:center ;}
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
           <form action="kullanici_kontrol.php" method="POST">
           <div class="adSoyad">
           <input type="text" name="k_kayit_kullaniciAdi" id="k_kayit_kullaniciAdi" placeholder="KULLANCI ADI" class="form-control" required maxlength="30">
           <input type="password" name="k_kayit_sifre" id="k_kayit_sifre" placeholder="SIFRE" class="form-control" required maxlength="30">
           </div>
           <input type="text" name="k_kayit_plaka" id="k_kayit_plaka" placeholder="PLAKA"  required class="form-control" value="<?php echo $plaka; ?>" pattern="^(0[1-9]|[1-7]\d|8[0-1])[a-zA-Z]{1,3}(0[1-9]|[1-9]\d{1,3})$" maxlength="9">
           <div class="adSoyad">
           <input type="text" name="k_kayit_ad" id="k_kayit_ad" placeholder="AD" class="form-control" required maxlength="30" value="<?php if(isset($ad)){echo $ad;} ?>">
           <input type="text" name="k_kayit_soyad" id="k_kayit_soyad" placeholder="SOYAD" class="form-control" required maxlength="30" value="<?php if(isset($soyad)){echo $soyad;} ?>">
           </div>
           <input type="text" name="k_kayit_tc_no" id="k_kayit_tc_no" placeholder="TC" class="form-control" required minlength="11" maxlength="11">
           <input type="text" name="k_kayit_tel_no" id="telefon_no" placeholder="TELEFON (5XX0000000)" pattern="5[0-9]{9}" required class="form-control" minlength="10" maxlength="10" value="<?php if(isset($telefon)){echo $telefon;} ?>">
            <select name="tarife" required id="tarife" class="form-control secim">
                <option value="#" >TARİFE ▼</option>
                <?php $sonuc=tarifeVeri();$i=1; while($dizi=mysqli_fetch_assoc($sonuc)):?>
                <option value=<?php echo $dizi["tarife_id"];?> <?php if($tarife==$i){echo "selected";}?>><?php echo strtoupper($dizi["tarife_tipi"])?></option>
                <?php $i++;?>
                <?php endwhile;?>
            </select>
            <div class="anasayfaDon">
            <a class='btn btn-primary kalam-regular anasayfa' href='index.php'>ANASAYFA</a>
            <input type="submit" value="KAYIT OL" required name="kayit_ol" class="btn btn-danger kalam-regular" style="width:8vw">
            </div>  



        </form>
        </div>
    </div>
</div>












<?php include "layers/footer.php"?>