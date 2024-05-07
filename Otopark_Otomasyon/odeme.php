<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<?php

session_start();
if(isset($_SESSION["loggin_k"]) && $_SESSION["loggin_k"]==true){
    $kullanici_aktif=true;
}
else{$kullanici_aktif=false;}
$check=false;
$bilgi1 = $_SESSION['bilgi'];
$secilenAlan=$_SESSION["secilenAlan"];
isset($_POST["odeme"]) ? $odeme=$_POST["odeme"]:$odeme="";   
if($odeme=="ÖDEME"){
   $kart_no= $_POST["kart_no"];
   $cvv= $_POST["cvv"];
   $skt= $_POST["skt"];
   $sonuc=odeme($kart_no,$cvv,$skt);

    if($sonuc==true){
        $check=true;
    }
    else{
        $check=false;
    }


}

?>
    <?php 
       $kontrol=false; 
        if($check==true)
        {
            $dizi=kayitli_kullanici_var_mi($bilgi1["plaka"]);
            if($dizi==true){
                $gelen=aracIdveKullaniciBul($bilgi1["plaka"]);
                $gelen_dizi=mysqli_fetch_assoc($gelen);
                $son_rez_id=rezervasyonKayit($bilgi1["giris"],$bilgi1["cikis"],$secilenAlan,$gelen_dizi["arac_id"]);
                $sonuc3=mysqli_fetch_row($son_rez_id);
                randevuKayit($sonuc3[0],$bilgi1["giris"],$bilgi1["cikis"]);
                $kontrol=true;

            }
            else{
           $son_id=kullaniciKayit($bilgi1["ad"],$bilgi1["soyad"],$bilgi1["tc"],$bilgi1["telefon"],$bilgi1["tarife"]);
           $sonuc=mysqli_fetch_row($son_id);
           $son_arac_id=aracKayit($bilgi1["plaka"],$sonuc[0]);
           $sonuc2=mysqli_fetch_row($son_arac_id);
           $son_rez_id=rezervasyonKayit($bilgi1["giris"],$bilgi1["cikis"],$secilenAlan,$sonuc2[0]);
           $sonuc3=mysqli_fetch_row($son_rez_id);
           randevuKayit($sonuc3[0],$bilgi1["giris"],$bilgi1["cikis"]);
            $kontrol=true;
            }
        }
    else{
      $kontrol=false;
    }  
    ?>

<style>
.alert{
    height: 10%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.alert-danger{
    background-color: crimson;
    color: white;
    border-color: crimson;
}
.alert-success{
    background-color: green;
    color: white;
    border-color: green;
}
.btn-primary{
    background-color: #222d50;
    border-color: #222d50;
}
.bilgi{
    justify-content: flex-start;
    margin-top: 50px;
}
.col-12{
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}
table{
    width: 50%;
    text-align: center;
    
}
table,td,tr,th{
    border: 5px solid #222d50;
}
td{
    padding: 15px 0px;
    border-radius: 10px;
}
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
            
            <?php if($kontrol==true):?>
                <div class="alert alert-success kalam-regular" role="alert">
                ÖDEME BAŞARILI, RANDEVU OLUŞTURULMUŞTUR.
                </div>
               <?php
                $plaka=strtoupper($bilgi1["plaka"]);
                 $sonuc=sonRezervasyonVeri($plaka);
                 $sonuc2=kullaniciVeri($plaka);
                 $rez_id;
                ?>
                    <table>
                        <tr>
                            <th>GİRİŞ TARİHİ</th>
                            <th>ÇIKIŞ TARİHİ</th>
                            <th>PARK YERİ</th>
                        </tr>
                        
                        <?php  while($satir=mysqli_fetch_row($sonuc)):?>
                    <tr>
                        <?php for($i=1;$i<count($satir)-1;$i++):?>
                            <?php $rez_id=$satir[0]; ?>
                                <?php if($i==1 || $i==2):?>
                                        <?php $normalTarih = $satir[$i];
                                        $nTarih = date("d-m-Y", strtotime($normalTarih));?>
                                        <td><?php echo "<em class='kalam-regular'>$nTarih</em>"; ?></td>
                                        <?php else:?>
                                     <td><?php echo "<em class='kalam-regular'>$satir[$i]</em>"; ?></td>
                                <?php endif;?>
                                
                        <?php endfor;?>
                    </tr>
                <?php endwhile;?>
                    </table>

                <br><br>
                <table>
                        <tr>
                            <th>AD</th>
                            <th>SOYAD</th>
                            <th>TELEFON</th>
                            <th>TARİFE</th>
                            <th>TUTAR</th>
                        </tr>
                        
                        <?php  while($satir2=mysqli_fetch_row($sonuc2)):?>
                    <tr>
                        <?php for($j=0;$j<count($satir2);$j++):?>
                                  <td><?php echo "<em class='kalam-regular'>$satir2[$j]</em>" ?></td>
                        <?php endfor;?>
                    
                <?php endwhile;?>
                       <td><?php echo "<em class='kalam-regular'>".rezIdrezervasyonFiyat($rez_id)." ₺</em>" ?></td>     
                </tr>
          
            </table>



               
            <?php else:?>
                <div class="alert alert-danger kalam-regular" role="alert">
                ÖDEME BAŞARISIZ, RANDEVU İŞLEMİ GERÇEKLEŞMEMİŞTİR.
                </div>
                
            <?php endif;?>
            <br><br>

            <?php if($kullanici_aktif==true):?>
                <a class='btn btn-primary kalam-regular' href='kullanici_anasayfa.php'  >ANASAYFA</a>
            <?php else:?>
                <a class='btn btn-primary kalam-regular' href='index.php'  >ANASAYFA</a>
            <?php endif;?>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>