<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}

$check=false;
$bilgi=kayitlar();


if($bilgi->num_rows!=0){
    $check=true;
}

?>
<style>
a{width: 3vw;}
.bilgi{display:flex;justify-content: center;position: relative;top: -20px;}
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
    height: 350px;
    overflow: auto;
    padding: 10px;
    border: 5px solid #222d50;
    border-radius: 30px;
    background:white;
    
}
.liste2{
    width: 60%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    margin: 0px auto;
    height: 250px;
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
.uyari{width: 100%;display:flex;justify-content: center;align-items: center;flex-direction: column;}
.offcanvas.offcanvas-bottom {
    height: 70vh;
}
.kapsayici1{width: 100%;height: 100%;display: flex;justify-content: center;align-items: center;}
</style>
</head>
<body>
<div class="kapsayici">

    <div class="icerik">
        <div class="logo">
        <img src="/otopark_otomasyon/img/logo.jpeg" alt=""><br>
        </div>
        
        <div class="bilgi">
        <div class="butonlar">   
        <button class="btn btn-success kalam-regular" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom1" aria-controls="offcanvasBottom" style="width: 150px;margin:0px 10px;">KAYITLAR</button>
        <button class="btn btn-success kalam-regular" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom2" aria-controls="offcanvasBottom" style="width: 150px;margin:0px 10px;">VERİLER</button>
        </div> 
        <a class='btn btn-primary kalam-regular anasayfa' href='admin_anasayfa.php'>ANASAYFA</a>
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom1" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
     <div class="offcanvas-body">
     
                
        <div class="liste">
            <table>
            <?php if($check==true):?>
                <tr>
                    <th>PLAKA</th>
                    <th>AD</th>
                    <th>SOYAD</th>
                    <th>TEL</th>
                    <th>TARİFE</th>
                    <th>KAYIT TARİHİ</th>
                    <th></th>
                    
                </tr>

                <?php while($veri=mysqli_fetch_row($bilgi)):?>
                        <tr>
                            <?php for($i=0;$i<count($veri);$i++):?>
                               
                                <?php if($i==(count($veri)-1)):?>
                                    <?php $tarih=strtotime($veri[$i])?>
                                    <td><?php echo "<em class='kalam-regular'>".date("d-m-Y H:i:s",$tarih)."</em>";?></td>
                                    <?php else:?>
                                        <td><?php echo "<em class='kalam-regular'>$veri[$i]</em>";?></td>
                                <?php endif;?>
                            <?php endfor;?>
                        </tr>    
                    <?php endwhile;?>
                    <?php else:?>
                     <div class="uyari">
                     <p><em class='kalam-regular'><b>*MEVCUT KAYIT BULUNMAMAKTADIR*</b></em></p>
                     </div> 
                <?php endif;?>                
            </table>


        </div>
    </div>
    </div>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom2" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
     <div class="offcanvas-body">
     <div class="kapsayici1">
        <div class="liste2">
            <table>
               
                <tr>
                <?php $getir=tarifeVeri(); while($gelen=mysqli_fetch_assoc($getir)):?>
                    <th style="width:25%"><?php echo $gelen["tarife_tipi"]?></th>
                    <?php endwhile;?>
                </tr>
                <tr>
                <?php $getir=tarifeVeri(); while($gelen=mysqli_fetch_assoc($getir)):?>
                    <td style="width:25%"><?php echo tarifeSayiBul($gelen["tarife_tipi"])?></td>
                    <?php endwhile;?>
                </tr>
                
            </table>
            <div class="uyari">
                    <p><em class='kalam-regular'><b>TOPLAM KAYIT : <?php echo toplamKayitliVeri();?></b></em></p>
                     <p><em class='kalam-regular'><b>*KAYITLI KİŞİLERİN TARİFE TİPİNİ BELİRTİR*</b></em></p>
                     </div>          

        </div>
        </div>
    </div>
    </div>



        
    </div>
</div>

<?php include "layers/footer.php"?>