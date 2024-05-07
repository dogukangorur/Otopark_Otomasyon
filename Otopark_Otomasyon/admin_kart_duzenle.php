<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_GET["kart_id"]) ? $kart_id=$_GET["kart_id"]:$kart_id=-1;
isset($_GET["kart_no"]) ? $kart_no=$_GET["kart_no"]:$kart_no="";
isset($_GET["kart_skt"])? $kart_skt=$_GET["kart_skt"]:$kart_skt="";
isset($_GET["kart_skt"])? $kart_skt=$_GET["kart_skt"]:$kart_skt="";
isset($_GET["kart_cvv"]) ? $kart_cvv=$_GET["kart_cvv"]:$kart_cvv="";
isset($_GET["kartGuncelle"]) ? $giris=$_GET["kartGuncelle"]:$giris="";
if($giris=="GÜNCELLE"){
    $kart_id=$_GET["g_kart_id"];
    $kart_no=$_GET["g_kart_no"];
    $kart_cvv=$_GET["g_cvv"];
    $kart_skt=$_GET["g_skt"];
    kartVeriGuncelle($kart_id,$kart_no,$kart_cvv,$kart_skt);
    $_SESSION["kart_ayar"]="güncellendi";
    header("Location:admin_kart.php");
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
    margin-top: 50px;
}
.kart{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 20px 0px;
   
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
.btn-primary{background-color: #222d50;color: white;border-color: #222d50;}
.alert-primary{background-color: #222d50;color: white;border-color: #222d50;}
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
                <div class="alert alert-primary kalam-regular" role="alert">
               KART BİLGİ GÜNCELLEME
                </div>
                </div>      
           
            <form action="admin_kart_duzenle.php" method="GET">
            <input type="text" name="g_kart_no" id="kart_no" placeholder="KART NUMARASI" required minlength="16" maxlength="16" class="form-control" value="<?php if($kart_no!=""){echo $kart_no;}?>"><br>
            <input type="number" name="g_kart_id" id="kart_id" style="display: none;" placeholder="KART NUMARASI" minlength="16" maxlength="16" class="form-control"value="<?php if($kart_id!=-1){echo $kart_id;}?>">
            <div class="kart">
            <input type="text" name="g_cvv" id="cvv" placeholder="CVV" class="form-control"  required minlength="3" maxlength="3" value="<?php if($kart_cvv!=""){echo $kart_cvv;}?>"> 
            <input type="text" name="g_skt" id="skt" placeholder="SKT" class="form-control" required minlength="5" maxlength="5" value="<?php if($kart_skt!=""){echo $kart_skt;}?>" pattern="[0-9]{2}/[0-9]{2}">
            </div>
            <input type="submit" value="GÜNCELLE" name="kartGuncelle" class="btn btn-danger kalam-regular" style="width:10vw">
            </form>
        </div>
        <br><br>
        <a class='btn btn-primary kalam-regular anasayfa' href='admin_anasayfa.php'>ANASAYFA</a>
        </div>
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