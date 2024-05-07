<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_POST["arama"]) ? $arama=$_POST["arama"]:$arama="";
isset($_POST["plaka_arama"]) ? $plaka_arama=$_POST["plaka_arama"]:$plaka_arama="";
$check=false;
if($arama=="ARAMA"){
    $giris=$_POST["g_tarih"];
    $cikis=$_POST["c_tarih"];
    $sonuc=aracArama($giris,$cikis);
    $sonuc2=aracArama($giris,$cikis);
    $veri=mysqli_fetch_row($sonuc2);
    if(!empty($veri)){
        $check=true;
    }
    else{
        $check=false;
    }
}
if($plaka_arama=="ARAMA"){
    $plaka=trim($_POST["ara_plaka"]);
    $sonuc=plakadanBilgi($plaka);
    $sonuc2=plakadanBilgi($plaka);
    $check=true;
    $veri=mysqli_fetch_row($sonuc2);
    if(!empty($veri)){
        $check=true;
    }
    else{
        $check=false;
    }
}


?>
<style>
a{width: 3vw;}
.bilgi{display:flex;justify-content: flex-start;position: relative;top: -20px;}
.secenek{width: 100%;display: flex;justify-content: flex-start;flex-direction: column;}
form{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.label{width: 100%;display: flex;justify-content: flex-start;}
input[type="date"]{margin: 20px;}
label{width: 35%;text-align: center;}
.liste{
    width: 98%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    margin: 0px auto;
    height: 300px;
    overflow: auto;
    padding: 10px;
    border: 5px solid #222d50;
    border-radius: 30px;
    background:white;
}
table{
    width: 100%;
    
}
table,tr,td,th{
    border-bottom: 2px solid #222d50;
    text-align: center; 
}

.anasayfa{width: 10vw;margin-top: 20px;}
.btn-primary{
    background-color: #222d50;
    border-color: #222d50;
}
#ara_plaka{margin: 20px;}
.uyari{width: 100%;display:flex;justify-content: center;align-items: flex-end;}
</style>
</head>
<body>
<div class="kapsayici">

    <div class="icerik">
        <div class="logo">
        <img src="/otopark_otomasyon/img/logo.jpeg" alt=""><br>
        </div>
        
        <div class="bilgi">
                <div class="secenek">
                        <form action="admin_araclar.php" method="POST">
                        <input type="date" name="g_tarih" id="g_tarih"  style="width: 200px;" class="form-control" min="<?php echo date("Y-m-d");?>" max="2028-12-31" value="<?php if($arama=="ARAMA"){echo $giris;}else{echo date("Y-m-d");}?>" onchange="setMinCikisDate()">
                        <input type="date" name="c_tarih" id="c_tarih"  style="width: 200px;" class="form-control" min="<?php echo date("Y-m-d");?>" max="2028-12-31" value="<?php if($arama=="ARAMA"){echo $giris;}else{echo date("Y-m-d");}?>">
                        <input type="submit" value="ARAMA" name="arama" class="btn btn-danger kalam-regular" style="width:10vw">
                        </form>
                        <form action="admin_araclar.php" method="POST">
                        <input type="text" name="ara_plaka" id="ara_plaka" style="width: 200px;" required class="form-control" placeholder="PLAKA" pattern="^(0[1-9]|[1-7]\d|8[0-1])[a-zA-Z]{1,3}(0[1-9]|[1-9]\d{1,3})$" maxlength="9">
                        <input type="submit" value="ARAMA" name="plaka_arama" class="btn btn-danger kalam-regular" style="width:10vw">
                        </form>
                </div>
        <div class="liste">
            <table>
            <?php if($check==true):?>
                <tr>
                    <th>GİRİŞ</th>
                    <th>ÇIKIŞ</th>
                    <th>PARK</th>
                    <th>PLAKA</th>
                    <th>AD</th>
                    <th>SOYAD</th>
                    <th>TC</th>
                    <th>TEL</th>
                    <th></th>
                    
                </tr>

                <?php while($veri=mysqli_fetch_row($sonuc)):?>
                        <tr>
                            <?php for($i=0;$i<count($veri)-1;$i++):?>
                               
                                <?php if($i==(count($veri)-2)):?>
                                   <td><a class='btn btn-danger kalam-regular' href='rezervasyon_iptal.php?plaka=<?php echo $veri[$i]?>&rezId=<?php echo $veri[$i+1]?>' >SİL</a></td>
                                    <?php else:?>
                                        <td><?php echo "<em class='kalam-regular'>$veri[$i]</em>";?></td>
                                <?php endif;?>
                            <?php endfor;?>
                        </tr>    
                    <?php endwhile;?>
                    <?php else:?>
                     <div class="uyari">
                     <p><em class='kalam-regular'><b>*MEVCUT RANDEVU BULUNMAMAKTADIR*</b></em></p>
                     </div> 
                <?php endif;?>                
            </table>


        </div>
        <a class='btn btn-primary kalam-regular anasayfa' href='admin_anasayfa.php'>ANASAYFA</a>
        </div>
       
    </div>
</div>
<script> 
    function setMinCikisDate() {
        var girisTarih = document.getElementById("g_tarih").value;
        document.getElementById("c_tarih").min = girisTarih;
        document.getElementById("c_tarih").value = girisTarih;
    }
</script>
<?php include "layers/footer.php"?>