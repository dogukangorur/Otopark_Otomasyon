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
    $plaka=$kullaniciBilgi["plaka"];
   } 
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
.anasayfaBtn{width: 100%;text-align: center;}
.uyari{width: 100%;display:flex;justify-content: center;align-items: flex-end;}
</style>
</head>
<body>
<div class="kapsayici">

    <div class="icerik">
        <div class="logo">
        <img src="/otopark_otomasyon/img/logo.jpeg" alt=""><br>
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
        <div class="anasayfaBtn">
        <a class='btn btn-primary kalam-regular anasayfa' href='kullanici_anasayfa.php' >ANASAYFA</a>
        </div>
       
    </div>
</div>

<?php include "layers/footer.php"?>