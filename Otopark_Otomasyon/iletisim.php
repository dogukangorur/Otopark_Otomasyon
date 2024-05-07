<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<style>
.harita{
    width: 100%;
    display: flex;
    justify-content: center;
    position: relative;
    top: 20px;
}   
iframe{
    width: 60%;
    height: 250px;
    border-radius: 20px;
    border: 4px solid #222d50;
    margin-bottom:30px;
}
.iletisim_bilgi{
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.adres{
    text-align: center;color:#222d50;font-weight:500;
    font-size: 15px;
}
address{
    text-align: center;
}
.anasayfa{background-color: #222d50;border-color: #222d50;color:white;width: 10vw;}

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
            <div class="harita">
            <?php $sorgu=iletisimVeri(); while($satir=mysqli_fetch_assoc($sorgu)):?>  
              <iframe src="<?php echo $satir["harita"];?>" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
              </div> 
            </div>
            <div class="col-12">
                <div class="iletisim_bilgi">
                <h4 style="color:#222d50;"><u class="kalam-regular">İLETİŞİM</u></h4>
                <address>  
                <p  class="kalam-regular adres"><?php echo $satir["adres"];?><br><br>
                              Phone: <?php echo $satir["telefon"];?> <br><br>
                             <a href="mailto:<?php echo $satir["mail"];?>" style="color:black;"><?php echo $satir["mail"];?></a>
                             </p> 
                <?php endwhile;?>
                <a class='btn btn-primary kalam-regular anasayfa' style="position:relative;top:-10px;" href='index.php'>ANASAYFA</a>
                </address>
                </div>
               
            </div>
        </div>
    </div>
</div>

<?php include "layers/footer.php"?>