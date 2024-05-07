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
    position: relative;
    top: -50px;
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
           <form action="rezervasyon_kontrol.php" method="POST">
           <input type="text" name="plaka1" id="plaka1" placeholder="PLAKA"  required class="form-control" value="<?php echo $plaka; ?>" pattern="^(0[1-9]|1\d|2\d|3\d|4\d|5\d|6\d|7\d|8\d|9\d)([a-zA-Z]{1,3})(\d{1,3})$" maxlength="9" style="text-align: center; display:none;" >
           <div class="adSoyad">
           <input type="text" name="ad" id="ad" placeholder="AD" class="form-control" required maxlength="30" value="<?php if(isset($ad)){echo $ad;} ?>"  style="text-align: center; display:none;">
           <input type="text" name="soyad" id="soyad" placeholder="SOYAD" class="form-control" required maxlength="30" value="<?php if(isset($soyad)){echo $soyad;} ?>"  style="text-align: center; display:none;">
           </div>
           <input type="text" name="tc_no" id="tc_no" placeholder="TC" class="form-control" required minlength="11" maxlength="11" value="<?php if(isset($tc)){echo $tc;} ?>"  style="text-align: center; display:none;">
           <input type="text" name="telefon_no" id="telefon_no" placeholder="TELEFON (5XX0000000)" required class="form-control" minlength="10" maxlength="10" value="<?php if(isset($telefon)){echo $telefon;} ?>"  style="text-align: center; display:none;">
            <select name="tarife" required id="tarife" class="form-control secim"  style="text-align: center; display:none;">
                <option value="#" >TARİFE ▼</option>
                <?php $sonuc=tarifeVeri(); $i=1; while($dizi=mysqli_fetch_assoc($sonuc)):?>
                <option value=<?php echo $dizi["tarife_id"];?> <?php if($tarife==$i){echo "selected";}?>><?php echo strtoupper($dizi["tarife_tipi"])?></option>
                <?php $i++;?>
                <?php endwhile;?>
            </select>
           <div class="label">
           <label for="girisTarih"  class="form-label kalam-regular">GİRİŞ</label> <label for="cikisTarih" class="form-label kalam-regular">ÇIKIŞ</label>
           </div>
           <div class="tarihAlani">
           <input type="date" name="girisTarih" required id="girisTarih"  style="width: 200px;" class="form-control" min="<?php echo date("Y-m-d");?>" max="2028-12-31" value="<?php echo date("Y-m-d");?>" onchange="setMinCikisDate()">
           <input type="date" name="cikisTarih" id="cikisTarih"  style="width: 200px;" class="form-control" min="<?php echo date("Y-m-d");?>" max="2028-12-31" value="<?php echo date("Y-m-d");?>" >
           </div>
           <div class="anasayfaBtn">
        <a class='btn btn-primary kalam-regular anasayfa' href='kullanici_anasayfa.php' >ANASAYFA</a>
        <input type="submit" value="KAYIT" required name="kayit" class="btn btn-danger kalam-regular" style="width:10vw">

        </div>
        </form>
        </div>
    </div>
</div>
<script>
     function setMinCikisDate() {
        var girisTarih = document.getElementById("girisTarih").value;
        document.getElementById("cikisTarih").min = girisTarih;
        document.getElementById("cikisTarih").value = girisTarih;
    }
</script>
<?php include "layers/footer.php"?>