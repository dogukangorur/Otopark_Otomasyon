<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
   session_start(); 
   if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==true){
    $admin_aktif=true;
    }
    else{
        $admin_aktif=false;
    }
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
input{margin: 10px;}
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
           <form action="rezervasyon_kontrol.php" method="POST">
           <input type="text" name="plaka1" id="plaka1" placeholder="PLAKA"  required class="form-control" value="<?php echo $plaka; ?>" pattern="^(0[1-9]|[1-7]\d|8[0-1])[a-zA-Z]{1,3}(0[1-9]|[1-9]\d{1,3})$" maxlength="9">
           <div class="adSoyad">
           <input type="text" name="ad" id="ad" placeholder="AD" class="form-control" required maxlength="30" value="<?php if(isset($ad)){echo $ad;} ?>">
           <input type="text" name="soyad" id="soyad" placeholder="SOYAD" class="form-control" required maxlength="30" value="<?php if(isset($soyad)){echo $soyad;} ?>">
           </div>
           <input type="text" name="tc_no" id="tc_no" placeholder="TC" class="form-control" required minlength="11" maxlength="11">
           <input type="text" name="telefon_no" id="telefon_no" placeholder="TELEFON (5XX0000000)" pattern="5[0-9]{9}" required class="form-control" minlength="10" maxlength="10" value="<?php if(isset($telefon)){echo $telefon;} ?>">
            <select name="tarife" required id="tarife" class="form-control secim">
                <option value="#" >TARİFE ▼</option>
                <?php $sonuc=tarifeVeri(); $i=1; while($dizi=mysqli_fetch_assoc($sonuc)):?>
                <option value=<?php echo $dizi["tarife_id"];?> <?php if($tarife==$i){echo "selected";}?>><?php echo strtoupper($dizi["tarife_tipi"])?></option>
                <?php $i++;?>
                <?php endwhile;?>
            </select>
           <div class="label">
           <label for="girisTarih"  class="form-label">GİRİŞ</label> <label for="cikisTarih" class="form-label">ÇIKIŞ</label>
           </div>
           <div class="tarihAlani">
           <input type="date" name="girisTarih" required id="girisTarih"  style="width: 200px;" class="form-control" min="<?php echo date("Y-m-d");?>" max="2028-12-31" value="<?php echo date("Y-m-d");?>" onchange="setMinCikisDate()">
           <input type="date" name="cikisTarih" id="cikisTarih"  style="width: 200px;" class="form-control" min="<?php echo date("Y-m-d");?>" max="2028-12-31" value="<?php echo date("Y-m-d");?>" >
           </div>
           <div class="anasayfaDon">
            <?php if($admin_aktif==true):?>
                <a class='btn btn-primary kalam-regular anasayfa' href='admin.php'>ANASAYFA</a>
            <?php else:?>
                <a class='btn btn-primary kalam-regular anasayfa' href='index.php'>ANASAYFA</a>
            <?php endif;?>    
            <input type="submit" value="KAYIT" required name="kayit" class="btn btn-danger kalam-regular" style="width:8vw">
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