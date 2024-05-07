<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
session_start();
if(isset($_SESSION["loggin_k"]) && $_SESSION["loggin_k"]==true){
    $kullanici_aktif=true;
}
else{$kullanici_aktif=false;}

isset($_POST["kayit"]) ? $durum=$_POST["kayit"]:$durum="";
isset($_GET["gonder"]) ? $durum2=$_GET["gonder"]:$durum2="";

if($durum=="KAYIT"){
$plaka=strtoupper($_POST["plaka1"]);
$ad=$_POST["ad"];
$soyad=$_POST["soyad"];
$tc=$_POST["tc_no"];
$telefon=$_POST["telefon_no"];
$tarife=$_POST["tarife"];
$giris=$_POST["girisTarih"];
$cikis=$_POST["cikisTarih"];
$bos_yerler=randevuKontrol($giris,$cikis);
$check=0;
if(count($bos_yerler)>0){
   $check=0;
   $bilgi=["plaka"=>$plaka,"ad"=>$ad,"soyad"=>$soyad,"tc"=>$tc,"telefon"=>$telefon,"tarife"=>$tarife,"giris"=>$giris,"cikis"=>$cikis,"bos_yer"=>$bos_yerler[0]];
   $_SESSION['bilgi'] = $bilgi;
   $_SESSION["bos_yerler"]=$bos_yerler;
   header("location:secim.php");
}
else{
   $check=1;
}
}
if($durum2=="İLERLE"){
  $_SESSION["secilenAlan"]=$_GET["secim"];
  $check=0;
}

?>
<style>
.bilgi{
    justify-content: flex-start;
    text-align: center;
}
.alert{
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

form{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.kart{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
   
}table{
    width: 25%;
    text-align: center;
    font-family: "Kalam", cursive;
    font-size:18px;
}
img{width: 150px;}
table, td, tr, th{
    border: 5px solid #222d50;
}
tr,td,th{
    padding: 5px;
}
.yaziSitili{color: white;background-color: #222d50;font-weight: 500;border-color: #222d50;}
.checkbox{width:100%;display:flex;flex-wrap: wrap;justify-content: center;}
input[type="checkbox"]{margin:0px 10px;width: 15px;}
#kart_no{width: 50%;text-align: center;}
#cvv,#skt{width: 30%;text-align: center;margin: 10px;}
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

          <?php if($kullanici_aktif==true):?>

            <div class="alert alert-danger" role="alert" style="text-align: center;">
             Seçmiş Olduğunuz Tarihlerde Boş yer Bulunmamaktadır.
            </div>  
        <a class='btn btn-success kalam-regular' href='kullanici_rezervasyon.php'>GERİ DÖN</a>
        <?php else:?> 
          <div class="alert alert-danger" role="alert" style="text-align: center;">
             Seçmiş Olduğunuz Tarihlerde Boş yer Bulunmamaktadır.
            </div>  
        <a class='btn btn-success kalam-regular' href='rezervasyon_kayit.php?plaka=<?php echo $plaka?>&ad=<?php echo $ad?>&soyad=<?php echo $soyad?>&telefon=<?php echo $telefon?>&tarife=<?php echo $tarife?>'>GERİ DÖN</a>

        <?php endif;?>
        <?php else:?>   
         <img src="img/1.png" alt=""><br>
         <form action="odeme.php" method="POST">
            <input type="text" name="kart_no" id="kart_no" placeholder="KART NUMARASI" minlength="16" maxlength="16" class="form-control"><br>
            <div class="kart">
            <input type="text" name="cvv" id="cvv" placeholder="CVV" class="form-control" minlength="3" maxlength="3"> 
            <input type="text" name="skt" id="skt" placeholder="SKT" class="form-control" minlength="5" maxlength="5" pattern="[0-9]{2}/[0-9]{2}">
        </div>
        <br>
        <div class="fiyat">
            <div class="alert alert-info yaziSitili" role="alert">
          TOPLAM FİYAT : <?php echo fiyatHesapla($_SESSION["bilgi"]["tarife"],$_SESSION["bilgi"]["giris"],$_SESSION["bilgi"]["cikis"])." ₺"?>
            </div>
        </div>
        <input type="submit" value="ÖDEME" name="odeme" class="btn btn-danger">
    </form>   
         
        <?php endif;?>
          
        
    </div>
</div>


<script>
  document.getElementById('skt').addEventListener('input', function(e) {
    var input = e.target;
    var value = input.value.replace(/\D/g, ''); 
    var formattedValue = '';
    if (value.length > 2) {
      formattedValue += value.substr(0, 2) + '/';
      if (value.length > 4) {
        formattedValue += value.substr(2, 2);
      } else {
        formattedValue += value.substr(2);
      }
    } else {
      formattedValue = value;
    }
    input.value = formattedValue;
  });
</script>
<?php include "layers/footer.php"?>