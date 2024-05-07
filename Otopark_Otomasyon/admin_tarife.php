<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php

session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_SESSION["tarife_ayar"]) ? $check=$_SESSION["tarife_ayar"]:$check="";
?>
<style>
a{width: 3vw;}
.bilgi{display:flex;justify-content: flex-start;}
.secenek{width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: space-between;}
form{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.label{width: 100%;display: flex;justify-content: flex-start;}
input[type="text"],input[type="number"]{margin: 20px 20px;}
input[type="submit"]{margin: 20px;}
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
.anasayfa{width: 10vw;margin-top: 10px;margin-bottom: 10px;}
.btn-primary{
    background-color: #222d50;
    border-color: #222d50;
}
.btn-warning{width: 7vw;}
.alert-success{
    background-color: green;
    color: white;
    border-color: green;
    height: 40px;
    font-size: 15px;
    
}
.alert-warning{background-color: #e8b712;border-color: #e8b712;color:white;}
.alert-danger{background-color: crimson;border-color: crimson;color: white;}
.sonuc{width: 100%;display: flex;justify-content: center;align-items: center;margin-bottom: 5px;}
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
                        <form action="admin_tarife_kayit.php" method="POST">
                        <input type="text" name="yeniTarife_adi" id="yeniTarife_adi" required placeholder="TARİFE ADI" class="form-control">
                        <input type="number" name="yeniTarife_fiyat" id="yeniTarife_fiyat"required placeholder="FIYAT" class="form-control">
                        <input type="submit" value="EKLE" name="ekle" class="btn btn-success kalam-regular" style="width:10vw">
                        </form>
            </div>
            <?php if($check=="eklendi"):?>
            
            <div class="alert alert-success kalam-regular sonuc" role="alert">
                KAYIT EKLEME BAŞARILI
                </div>
               
                <?php elseif($check=="silindi"):?>
                    <div class="alert alert-danger kalam-regular sonuc" role="alert">
                KAYIT SİLME BAŞARILI
                </div>
                <?php else:?>
                    <div class="alert alert-warning kalam-regular sonuc" role="alert">
                KAYIT GÜNCELLEME BAŞARILI
                </div>
            <?php endif;?>
        <div class="liste">
            <table>
            
                <tr>
                    <th>TARIFE ID</th>
                    <th>TARIFE TIPI</th>
                    <th>UCRET</th>
                    <th></th>
                    <th></th>
                </tr>
               
                <?php $kontrol=tarifeVeri(); while($dizi=mysqli_fetch_row($kontrol)):?>
                    <tr>
                        <?php for($i=0;$i<count($dizi)+2;$i++):?>
                            <?php if($i==3):?>
                                <td><a class='btn btn-danger kalam-regular' href='admin_tarife_sil.php?tarife_id=<?php echo $dizi[0]?>' >SİL</a></td>

                            <?php elseif($i==4):?>
                                <td><a class='btn btn-warning kalam-regular' href='admin_tarife_duzenle.php?tarife_id=<?php echo $dizi[0]?>&tarife_adi=<?php echo $dizi[1]?>&tarife_ucreti=<?php echo $dizi[2]?>' >DÜZENLE</a></td>

                             <?php else:?>   
                            <td><?php echo "<em class='kalam-regular'>$dizi[$i]</em>";?></td>

                            <?php endif;?> 
                        <?php endfor;?>
                      
                    </tr>
                <?php endwhile;?> 
            </table>


        </div>
        <a class='btn btn-primary kalam-regular anasayfa' href='admin_anasayfa.php'>ANASAYFA</a>
        </div>
       
    </div>
</div>
<?php include "layers/footer.php"?>