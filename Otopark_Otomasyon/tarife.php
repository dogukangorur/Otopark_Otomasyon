<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>

<style>
table{
    width:100%;
    text-align: center;
    font-family: "Kalam", cursive;
    font-size:18px;
    height: 300px;
}
.tablo{
    width: 50%;
    height: 300px;
    overflow:auto;
    display: flex;
    justify-content: center;
    align-items: center;
}
.col-12{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
table, td, tr, th{
    border-bottom: 5px solid #222d50;
}
tr,td,th{
    padding: 10px;
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
            <div class="tablo">
            <table>
                <tr>
                    <th>TARİFE</th>
                    <th>ÜCRET</th>
                </tr>
                <?php $veri=tarifeVeri(); while($satir=mysqli_fetch_row($veri)):?>
                    <tr>
                        <?php for($i=1;$i<count($satir);$i++):?>
                               <?php if($i==2):?>
                                <td><?php echo $satir[$i]." ₺";?></td>
                                <?php else:?>
                                <td><?php echo $satir[$i];?></td>  
                                <?php endif;?>
                        <?php endfor;?>
                    </tr>
                <?php endwhile;?>
            </table>
            </div>   
        </div>
        <br>
        <p><em class="kalam-regular">*TARİFE ÜCRETLERİ GÜNLÜK ÜCRETLERDİR*</em></p>
        <a class='btn btn-primary kalam-regular anasayfa' style="position:relative;top:-10px;" href='index.php'>ANASAYFA</a>

        </div>
    </div>
</div>

<?php include "layers/footer.php"?>