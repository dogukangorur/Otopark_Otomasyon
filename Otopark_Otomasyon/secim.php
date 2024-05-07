<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php
   session_start();
   $bos_yerler=$_SESSION["bos_yerler"];

?>
<style>
.col-12{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    position: relative;
    top: -25px;
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
.bilgiVer{width: 100%;height: 50px;display: flex;justify-content: center;}
.anasayfaBtn{width: 100%;text-align: center;margin-top: 20px;}
.anasayfaBtn a{width: 10vw;}
.aracAlani{width: 80%;max-height: 440px;border: 5px solid #222d50;border-radius: 50px;padding: 0px 50px 50px 50px;}
.arac{
    width: 100px;
    height: 120px;
    border: 1px solid black;
    display: flex;
    justify-content: flex-start;
    flex-direction: column;
    border-radius: 10px;
    margin: 10px 0px;
    text-align: center;
}
.arac p{
    margin: 5px;
    text-align: center;
    font-size: 30px;
}
.bos{background-color: #2aab51;}
.dolu{background-color: crimson;}
form{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: center;
}
.parkAlani{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: center;
    
}
.radioBtn{width: 80%;height: 20px;}
.kirmiziAlan{display: flex;align-items: center;margin: 0px 10px;}
.kirmizi{width: 30px;height: 30px;background-color: crimson;}
.yesilAlan{display: flex;align-items: center;margin: 0px 10px;}
.yesil{width: 30px;height: 30px;background-color: #2aab51;}
em{margin-left: 10px;}
.uyariYap{width: 100%;text-align: center;margin-bottom: 10px;font-weight: 800;}
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
          <div class="aracAlani">
            <div class="bilgiVer">
                <div class="kirmiziAlan">
                    <div class="kirmizi"></div>
                    <em style="font-style: normal;"class="kalam-regular">DOLU</em>
                </div>
                <div class="yesilAlan">
                    <div class="yesil"></div>
                    <em style="font-style: normal ;" class="kalam-regular">BOŞ</em>
                </div>
                
            </div>
            <div class="uyariYap kalam-regular" >LÜTFEN İSTEDİĞİNİZ BOŞ ALANI SEÇİNİZ</div>
            <form action="rezervasyon_kontrol.php" method="GET">
            <div class="parkAlani">
            <?php for($i=1;$i<=$park_kapasitesi;$i++):?>
             <div class="arac <?php if(in_array($i,$bos_yerler)){echo 'bos';}else{echo 'dolu';}?> "><p style="text-align:center;"><?php echo $i;?></p><br>
             <?php if(in_array($i,$bos_yerler)){echo "<input type='radio' class='radioBtn' name='secim' value='$i' id='' required></input>";}?>   
            </div>   
            <?php endfor;?>
            </div>
            <br>
            <input type="submit" class="btn btn-danger" name="gonder" value="İLERLE">
            </form>
            
          </div>
        
        </div>
        
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>