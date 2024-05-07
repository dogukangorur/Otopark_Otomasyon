<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<style>
.bilgi{
    justify-content: center;
}    
form{
    width: 40%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.btn-primary{
    background-color: #222d50;
    border-color: #222d50;
}
input[type="submit"]{
    width: 100px;
}
.col-12{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
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
.sakla{
    display: none;
}
.goster{
    display: block;
}
a{
    margin-top: 20px;
    height: 40px;
}
.secenek{
    display: flex;
    width: 40%;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
}
.iptalBtn{height: 40px; margin-top: 0px;}
.anasayfaDon a{width:8vw;background-color: #222d50;border-color: #222d50;margin-right: 5px;}
.randevuBilgi{width: 90%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    margin: 0px auto;
    overflow: auto;
    padding: 10px;
    background:white;}
.randevuTablo{width: 100%}
.randevuTablo {border-bottom: 2px solid #222d50;
    text-align: center; }
    .modal {
  z-index: 1050;
}
.modal-backdrop {
    --bs-backdrop-zindex: 100;
    --bs-backdrop-bg: #000;
    --bs-backdrop-opacity: 0.5;
    position: fixed;
    top: 0;
    left: 0;
    z-index:100;
    width: 100vw;
    height: 100vh;
    background-color: var(--bs-backdrop-bg)
}
.offcanvas,
.offcanvas-lg,
.offcanvas-md,
.offcanvas-sm,
.offcanvas-xl,
.offcanvas-xxl {
   
    --bs-offcanvas-height: 40vh;
  
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
          <form action="rezervasyon.php" method="POST">
            <input type="text" name="plaka" id="plaka" placeholder="PLAKA" class="form-control" pattern="^(0[1-9]|[1-7]\d|8[0-1])[a-zA-Z]{1,3}(0[1-9]|[1-9]\d{1,3})$" maxlength="9" required><br>
            <input type="submit" name="kontrol" value="KONTROL" class="btn btn-primary kalam-regular">
          </form>
          <br><br>
          <?php
          $kontrol=false;
          isset($_POST["kontrol"]) ? $_POST["kontrol"]="KONTROL":$_POST["kontrol"]="";
            if($_POST["kontrol"]=="KONTROL"){
                $plaka=strtoupper($_POST["plaka"]);
                 $sonuc=rezervasyonVeri($plaka);
                 $sonuc2=kullaniciVeri($plaka);
                if($sonuc->num_rows!=0){
                    $rez_id=plakadanRezId($plaka);
                    $kontrol=true;
                    ?>
                       <table>
                        <tr>
                            <th>AD</th>
                            <th>SOYAD</th>
                            <th>TELEFON</th>
                            <th>TARİFE</th>
        
                        </tr>
                        
                        <?php  while($satir2=mysqli_fetch_row($sonuc2)):?>
                    <tr>
                        <?php for($j=0;$j<count($satir2);$j++):?>
                                  <td><?php echo "<em class='kalam-regular'>$satir2[$j]</em>" ?></td>
                        <?php endfor;?>
                    
                <?php endwhile;?>   
                </tr>
          
            </table>
            <br><br>

            <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="randevuBilgi">
            <table class="randevuTablo">
                <tr>
                    <th>GİRİŞ TARİHİ</th>
                    <th>ÇIKIŞ TARİHİ</th>
                    <th>PARK YERİ</th>
                    <th>TUTAR</th>
                    <th></th>
                </tr>
                <?php while($satir=mysqli_fetch_row($sonuc)):?>
                    <tr>
                        <?php for($i=0;$i<count($satir)-1;$i++):?>
                            <?php $id; if($i==0){$id=$satir[$i];continue;}?>
                            <?php if($i==1 || $i==2):?>
                                <?php $normalTarih = $satir[$i];
                                $nTarih = date("d-m-Y", strtotime($normalTarih));?>
                                <td><?php echo "<em class='kalam-regular'>$nTarih</em>"; ?></td>
                            <?php else:?>
                                <td><?php echo "<em class='kalam-regular'>$satir[$i]</em>"; ?></td>
                            <?php endif;?>
                        <?php endfor;?>
                        <td>
                            <em class='kalam-regular'><?php echo rezIdrezervasyonFiyat($id); ?> ₺</em>
                        </td>
                        <td>
                         
                            <button type="button" class="btn btn-danger kalam-regular" data-bs-toggle="modal" data-bs-target="#modal<?php echo $id; ?>">RANDEVU İPTAL</button>
                        </td>
                    </tr>

                 
                    <div class="modal fade" id="modal<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">RANDEVU İPTAL</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Emin misiniz? Bu işlemi geri alamazsınız.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                                    <a class='btn btn-danger kalam-regular' href='rezervasyon_iptal.php?plaka=<?php echo $plaka?>&rezId=<?php echo $id?>'>RANDEVU İPTAL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>
            </table>
        </div>
    </div>
</div>
             </div>
                
             
        <div class="secenek">

        <a class='btn btn-primary kalam-regular anasayfa' style="position:relative;top:-10px;" href='index.php'>ANASAYFA</a>
         <button class="btn btn-success kalam-regular" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" style="width: 150px;">RANDEVULARIM</button>

            </div>
           </div>
         </div>
            </div>          
                 <?php }
                 else{
                    $kontrol=true;
                    echo "<p><em class='kalam-regular'><b>*MEVCUT RANDEVU BULUNMAMAKTADIR*</b></em></p>";
                    echo "<a class='btn btn-success kalam-regular' href='rezervasyon_kayit.php?plaka=$plaka' >RANDEVU AL</a>";
                 }
                 ?>
                
                <?php }?>
            <?php if($kontrol==false):?>
                <div class="anasayfaDon">
            <a class='btn btn-primary kalam-regular anasayfa' href='index.php'>ANASAYFA</a>
            <a class='btn btn-success kalam-regular' href='rezervasyon_kayit.php' style="width: 8vw;background-color:#198754;border-color:#198754;" >RANDEVU AL</a>

            </div>  
            <?php endif;?>
          
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>