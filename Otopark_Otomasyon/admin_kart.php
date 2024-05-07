<?php include "vars/_vars.php"?>
<?php include "vars/_functions.php"?>
<?php include "layers/header.php"?>
<?php

session_start();
if(isset($_SESSION["loggin"]) && $_SESSION["loggin"]==false){
    header("Location:admin.php");
}
isset($_SESSION["kart_ayar"]) ? $check2=$_SESSION["kart_ayar"]:$check2="";
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
input[type="text"],input[type="number"]{margin: 20px 10px;}
input[type="submit"]{margin: 10px;}
#y_kartNo{width: 180%;}
#y_kullaniciId{width: 90%;}
#y_skt,#y_cvv{width: 50%;}
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
                        <form action="admin_kart_kayit.php" method="POST">
                        <input type="text" name="y_kartNo" id="y_kartNo" required placeholder="KART NO" class="form-control" minlength="16" maxlength="16">
                        <input type="text" name="y_skt" id="y_skt" required placeholder="SKT" class="form-control" minlength="5" maxlength="5" pattern="[0-9]{2}/[0-9]{2}">
                        <input type="text" name="y_cvv" id="y_cvv" required placeholder="CVV" class="form-control" minlength="3" maxlength="3">
                        <input type="number" name="y_kullaniciId" id="y_kullaniciId" required placeholder="KULLANICI ID" class="form-control">
                        <input type="submit" value="EKLE" name="kartEkle" class="btn btn-success kalam-regular" style="width:10vw">
                        </form>
            </div>
            <?php if($check2=="eklendi"):?>
            
            <div class="alert alert-success kalam-regular sonuc" role="alert">
                KAYIT EKLEME BAŞARILI
                </div>
               
                <?php elseif($check2=="silindi"):?>
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
                    <th>KART ID</th>
                    <th>KART NO </th>
                    <th>SKT</th>
                    <th>CVV</th>
                    <th>KULLANICI ID</th>
                    <th>SIL</th>
                    <th>DUZENLE</th>
                </tr>
               
                <?php $kontrol=kartVeri(); while($dizi=mysqli_fetch_row($kontrol)):?>
                    <tr>
                        <?php for($i=0;$i<count($dizi)+2;$i++):?>
                            <?php if($i==5):?>
                                <td><a class='btn btn-danger kalam-regular' href='admin_kart_sil.php?kart_id=<?php echo $dizi[0]?>' >SİL</a></td>

                            <?php elseif($i==6):?>
                                <td><a class='btn btn-warning kalam-regular' href='admin_kart_duzenle.php?kart_id=<?php echo $dizi[0]?>&kart_no=<?php echo $dizi[1]?>&kart_skt=<?php echo $dizi[2]?>&kart_cvv=<?php echo $dizi[3]?>' >DÜZENLE</a></td>

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
<script>
  document.getElementById('y_skt').addEventListener('input', function(e) {
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