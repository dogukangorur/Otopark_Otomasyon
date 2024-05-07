<?php include "_vars.php";?>
<?php
function tarifeVeri(){
    include "baglan.php";
   $query="SELECT * FROM tarife"; 
   $sonuc=mysqli_query($connection,$query);
   mysqli_close($connection);
   return $sonuc;
}
function iletisimVeri(){
    include "baglan.php";
   $query="SELECT * FROM iletisim"; 
   $sonuc=mysqli_query($connection,$query);
   mysqli_close($connection);
   return $sonuc;
}
function rezervasyonVeri($plaka){
    include "baglan.php";
   $query="SELECT * FROM rezervasyon WHERE arac_id = (SELECT arac_id FROM arac WHERE plaka = '$plaka')"; 
   $sonuc=mysqli_query($connection,$query);
   mysqli_close($connection);
   return $sonuc;
}
function sonRezervasyonVeri($plaka){
    include "baglan.php";
   $query="SELECT * FROM rezervasyon WHERE  arac_id = (SELECT arac_id FROM arac WHERE plaka = '$plaka') ORDER BY rez_id DESC LIMIT 1"; 
   $sonuc=mysqli_query($connection,$query);
   mysqli_close($connection);
   return $sonuc;
}
function kullaniciVeri($plaka){
    include "baglan.php";
   $query="SELECT k.ad, k.soyad, k.tel_No, t.tarife_tipi
   FROM kullanici k
   JOIN arac a ON k.kullanici_id = a.kullanici_id
   JOIN tarife t ON k.tarife_id = t.tarife_id
   WHERE a.plaka = '$plaka';"; 
   $sonuc=mysqli_query($connection,$query);
   mysqli_close($connection);
   return $sonuc;
}
function randevuKontrol($giris,$cikis){
    include "baglan.php";
    $bos_yerler = array();
    global $park_kapasitesi;
    for($i = 1; $i <= $park_kapasitesi; $i++){
        $query = "SELECT rez.rez_id, rez.park_id, ak.tarih
        FROM rezervasyon rez
        JOIN arac_kayit ak ON rez.rez_id = ak.rez_id
        WHERE park_id=$i;";
        $sonuc = mysqli_query($connection, $query);

        if($sonuc){
            $check = false;

            while($dizi = mysqli_fetch_assoc($sonuc)){
                $current_date = $giris; 
            
                while($current_date <= $cikis && !$check){
              
                    if($current_date == $dizi['tarih']){
                        $check = true; 
                        break; 
                    }
                    $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                }
            }

            if(!$check){
                $bos_yerler[] = $i;
            }
        }
    }    
     mysqli_close($connection); 
    return $bos_yerler; 
}

function odeme($kartNo,$cvv,$skt){
    include "baglan.php";
    $kontrol=false;
    $query="SELECT * FROM odeme_dogrulama";
    $sonuc = mysqli_query($connection, $query);
    while($dizi1=mysqli_fetch_assoc($sonuc)){
        if($kartNo==$dizi1["kart_no"] && $cvv==$dizi1["cvv"] && $skt==$dizi1["kart_skt"])
        {
            $kontrol=true;
            break;
        }
    }
    mysqli_close($connection);
    return $kontrol;
}


function randevuKayit($son_rez_id,$giris,$cikis){
    include "baglan.php";
    $giris_tarih = new DateTime($giris);
    $cikis_tarih = new DateTime($cikis);
    if($giris_tarih->format('Y-m-d') == $cikis_tarih->format('Y-m-d')){
        $query = "INSERT INTO arac_kayit(rez_id, tarih) VALUES ($son_rez_id, '" . $giris_tarih->format('Y-m-d') . "')";
        $sonuc = mysqli_query($connection, $query);
        mysqli_close($connection);
    }
    else{
    while ($giris_tarih->format('Y-m-d') != $cikis_tarih->format('Y-m-d')) {
        $query = "INSERT INTO arac_kayit(rez_id, tarih) VALUES ($son_rez_id, '" . $giris_tarih->format('Y-m-d') . "')";
        $sonuc = mysqli_query($connection, $query);
        $giris_tarih->modify('+1 day');
        if($giris_tarih->format('Y-m-d') == $cikis_tarih->format('Y-m-d')){
            $query = "INSERT INTO arac_kayit(rez_id, tarih) VALUES ($son_rez_id, '" . $giris_tarih->format('Y-m-d') . "')";
            $sonuc = mysqli_query($connection, $query);
            break;
        }
     
    }
    mysqli_close($connection);
}
}
function kullaniciKayit($ad,$soyad,$tc,$tel,$tarife){
    include "baglan.php";
    $ad=ucfirst(strtolower($ad));
    $soyad=ucfirst(strtolower($soyad));
    $query="INSERT INTO kullanici(ad, soyad, tc_no, tel_no, tarife_id) VALUES ('$ad', '$soyad', '$tc', '$tel', $tarife)";
    $kontrol=mysqli_query($connection,$query);
    $query2="SELECT kullanici_id FROM kullanici ORDER BY kullanici_id DESC LIMIT 1";
    $kontrol2=mysqli_query($connection,$query2);
    mysqli_close($connection);
    return $kontrol2;
}
function aracKayit($plaka,$kullanici_id){
    include "baglan.php";
    $query="INSERT INTO arac(plaka, kullanici_id) VALUES ('$plaka',$kullanici_id)";
    $kontrol=mysqli_query($connection,$query);
    $query2="SELECT arac_id FROM arac ORDER BY arac_id DESC LIMIT 1";
    $kontrol2=mysqli_query($connection,$query2);
    mysqli_close($connection);
    return $kontrol2;
}
function rezervasyonKayit($baslangic_tarih,$bitis_tarih,$park_id,$arac_id){
    include "baglan.php";
    $query="INSERT INTO rezervasyon(baslangic_tarih, bitis_tarih, park_id, arac_id) VALUES ('$baslangic_tarih','$bitis_tarih', $park_id, $arac_id)";
    $kontrol=mysqli_query($connection,$query);
    $query2="SELECT rez_id FROM rezervasyon ORDER BY rez_id DESC LIMIT 1";
    $kontrol2=mysqli_query($connection,$query2);
    mysqli_close($connection);
    return $kontrol2;
}
function aracIdveKullaniciBul($plaka){
    include "baglan.php";
    $query="SELECT arac_id, kullanici_id FROM arac WHERE plaka='$plaka'";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
    return $kontrol;
}
function aracSil($plaka){
    include "baglan.php";
    $query="DELETE FROM arac WHERE plaka='$plaka'";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function kullaniciSil($kisi_id){
    include "baglan.php";
    $query="DELETE FROM kullanici WHERE kullanici_id=$kisi_id";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function rezervasyonSil($rezervasyon_id){
    include "baglan.php";
    $query="DELETE FROM rezervasyon WHERE rez_id=$rezervasyon_id";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function aracKayitSil($rezervasyon_id){
    include "baglan.php";
    $query="DELETE FROM arac_kayit WHERE rez_id=$rezervasyon_id";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function rezIdBul($arac_id){
    include "baglan.php";
    $query="SELECT rez_id FROM rezervasyon WHERE arac_id=$arac_id";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
    return $kontrol;
}
function fiyatHesapla($tarife,$giris,$cikis){
    include "baglan.php";
    $query="SELECT ucret FROM tarife WHERE tarife_id=$tarife";
    $kontrol=mysqli_query($connection,$query);
    $bilgi=mysqli_fetch_assoc($kontrol);
    $fiyat=$bilgi["ucret"];
    mysqli_close($connection);
    $giris_tarihi=new DateTime($giris);
    $cikis_tarihi=new DateTime($cikis);
    $fark=$giris_tarihi->diff($cikis_tarihi);
    $fark_gun=$fark->d;
    $fark_gun +=1;
    $total=$fark_gun*$fiyat;
    return $total;
}
function rezervasyonFiyat($plaka){
    include "baglan.php";
    $query="SELECT arac_id, kullanici_id FROM arac WHERE plaka='$plaka'";
    $kontrol=mysqli_query($connection,$query);
    $dizi1=mysqli_fetch_assoc($kontrol);
    $arac_id=$dizi1["arac_id"];
    $kullanici_id=$dizi1["kullanici_id"];
    $query2="SELECT baslangic_tarih, bitis_tarih FROM rezervasyon WHERE arac_id=$arac_id";
    $kontrol2=mysqli_query($connection,$query2);
    $dizi2=mysqli_fetch_assoc($kontrol2);
    $baslangic_tarih=$dizi2["baslangic_tarih"];
    $bitis_tarih=$dizi2["bitis_tarih"];
    $query3="SELECT tarife_id FROM kullanici WHERE kullanici_id=$kullanici_id";
    $kontrol3=mysqli_query($connection,$query3);
    $dizi3=mysqli_fetch_assoc($kontrol3);
    $tarife=$dizi3["tarife_id"];
    mysqli_close($connection);
    $total=fiyatHesapla($tarife,$baslangic_tarih,$bitis_tarih);
    return $total;
}
function rezIdrezervasyonFiyat($rez_id){
    include "baglan.php";
    $query="SELECT rez.baslangic_tarih, rez.bitis_tarih,kullanici.tarife_id FROM ((rezervasyon rez JOIN arac ON arac.arac_id=rez.arac_id) JOIN kullanici ON kullanici.kullanici_id=arac.kullanici_id) WHERE rez.rez_id=$rez_id";
    $kontrol=mysqli_query($connection,$query);
    $dizi=mysqli_fetch_assoc($kontrol);
    $baslangic_tarih=$dizi["baslangic_tarih"];
    $bitis_tarih=$dizi["bitis_tarih"];
    $tarife=$dizi["tarife_id"];
    mysqli_close($connection);
    $total=fiyatHesapla($tarife,$baslangic_tarih,$bitis_tarih);
    return $total;
}


function adminBilgi(){
    include "baglan.php";
    $query="SELECT kullanici_adi, sifre FROM admin";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
    return $kontrol;
}
function adminBilgiGuncelleme($kullanici_adi,$sifre){
    include "baglan.php";
    $query="UPDATE admin SET kullanici_adi='$kullanici_adi',sifre='$sifre' WHERE admin_id=1";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function aracArama($giris,$cikis){
    include "baglan.php";
    $query="SELECT
    distinct 
    rez.baslangic_tarih,
    rez.bitis_tarih,
    rez.park_id,
    arac.plaka,
    kullanici.ad,
    kullanici.soyad,
    kullanici.tc_no,
    kullanici.tel_No,
    arac.plaka,
    rez.rez_id
    FROM 
        arac_kayit ak
    JOIN 
        rezervasyon rez ON ak.rez_id = rez.rez_id
    JOIN 
        arac ON rez.arac_id = arac.arac_id
    JOIN 
        kullanici ON arac.kullanici_id = kullanici.kullanici_id
    WHERE 
        ak.tarih between '$giris' and '$cikis'";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
    return $kontrol;
}
function plakadanBilgi($plaka){
    include "baglan.php";
   $query= "SELECT 
	distinct
    rez.baslangic_tarih,
    rez.bitis_tarih,
    rez.park_id,
    arac.plaka,
    kullanici.ad,
    kullanici.soyad,
    kullanici.tc_no,
    kullanici.tel_No,
    arac.plaka,
    rez.rez_id
    FROM 
        arac_kayit ak
    JOIN 
        rezervasyon rez ON ak.rez_id = rez.rez_id
    JOIN 
        arac ON rez.arac_id = arac.arac_id
    JOIN 
        kullanici ON arac.kullanici_id = kullanici.kullanici_id
    WHERE 
        arac.plaka='$plaka'";
        $kontrol=mysqli_query($connection,$query);
        return $kontrol;
}

function tarifeVeriEkle($tarife_adi,$tarife_fiyat){
    include "baglan.php";
    $query="INSERT INTO tarife(tarife_tipi, ucret) VALUES ('$tarife_adi',$tarife_fiyat)";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function tarifeVeriSil($tarife_id){
    include "baglan.php";
    $query="DELETE FROM tarife WHERE tarife_id=$tarife_id";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function tarifeVeriGuncelle($tarife_id,$tarife_adi,$tarife_fiyat){
    include "baglan.php";
    $query="UPDATE tarife SET tarife_tipi='$tarife_adi', ucret=$tarife_fiyat WHERE tarife_id=$tarife_id";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function kartVeri(){
    include "baglan.php";
    $query="SELECT * FROM kart";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
    return $kontrol;
}
function kartVeriEkle($kartNo,$kartSkt,$kartCvv,$kartKullanici){
    include "baglan.php";
    $query="INSERT INTO kart(kart_no, kart_skt, cvv, kullanici_id) VALUES ('$kartNo','$kartSkt','$kartCvv', $kartKullanici)";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function kartVeriSil($kart_id){
    include "baglan.php";
    $query="DELETE FROM kart WHERE kart_id=$kart_id";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function kartVeriGuncelle($kart_id,$kartNo,$kartCvv,$kartSkt){
    include "baglan.php";
    $query="UPDATE kart SET kart_no='$kartNo', kart_skt='$kartSkt', cvv='$kartCvv' WHERE kart_id=$kart_id";
    $kontrol=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function iletisimVeriGuncelle($iframe,$adres,$telefon,$mail){
    include "baglan.php";
   $query="UPDATE iletisim SET adres='$adres', telefon='$telefon', mail='$mail',harita='$iframe'"; 
   $sonuc=mysqli_query($connection,$query);
   mysqli_close($connection);
}
function kullaniciKontrol($kullanci_adi){
    include "baglan.php";
    $query="SELECT kullanici_adi FROM kullanici_kayit where kullanici_adi='$kullanci_adi'";
    $sonuc=mysqli_query($connection,$query);
    mysqli_close($connection);
    $dizi=mysqli_fetch_row($sonuc);
    if(!empty($dizi)){
        return true;
    }
    else{
        return false;
    }
    
}
function kullaniciOturumKayit($kullanici_adi,$sifre,$plaka,$ad,$soyad,$tc,$tel,$tarife){
    include "baglan.php";
    $ad=ucfirst(strtolower($ad));
    $soyad=ucfirst(strtolower($soyad));
    $query1="INSERT INTO kullanici(ad, soyad, tc_no, tel_No, tarife_id) VALUES ('$ad','$soyad','$tc','$tel',$tarife)";
    $sonuc1=mysqli_query($connection,$query1);
    $kullanici_id_bul="SELECT kullanici_id FROM kullanici WHERE ad='$ad' AND soyad='$soyad' AND tc_no='$tc'";
    $sonuc_kid=mysqli_query($connection,$kullanici_id_bul);
    $dizi=mysqli_fetch_row($sonuc_kid);
    $query2="INSERT INTO arac(plaka, kullanici_id) VALUES ('$plaka','$dizi[0]')";
    $sonuc2=mysqli_query($connection,$query2);
    $arac_id_bul="SELECT arac_id FROM arac WHERE plaka='$plaka' AND kullanici_id='$dizi[0]'";
    $sonuc_aid=mysqli_query($connection,$arac_id_bul);
    $dizi2=mysqli_fetch_row($sonuc_aid);
    $query3="INSERT INTO kullanici_kayit(kullanici_adi, sifre, kullanici_id) VALUES ('$kullanici_adi','$sifre',$dizi[0])";
    $sonuc3=mysqli_query($connection,$query3);
    mysqli_close($connection);
}
function kullaniciBilgi($kullanci_adi){
    include "baglan.php";
    $query="SELECT kk.k_kayit_id, kk.kullanici_adi, kk.sifre, arac.arac_id, arac.plaka, kullanici.kullanici_id, kullanici.ad,kullanici.soyad, kullanici.tc_no, kullanici.tel_No, tarife.tarife_id, tarife.tarife_tipi
    FROM (((kullanici_kayit kk JOIN kullanici ON kullanici.kullanici_id=kk.kullanici_id) JOIN arac ON arac.kullanici_id=kullanici.kullanici_id)) JOIN tarife on tarife.tarife_id=kullanici.tarife_id WHERE kullanici_adi='$kullanci_adi'";
    $sonuc=mysqli_query($connection,$query);
    mysqli_close($connection);
    return $sonuc;
}
function kayitli_kullanici_var_mi($plaka){
    include "baglan.php";
    $query="SELECT plaka FROM arac WHERE plaka='$plaka'";
    $sonuc=mysqli_query($connection,$query);
    $dizi=mysqli_fetch_row($sonuc);
    mysqli_close($connection);
    if(!empty($dizi)){
        return true;
    }
    else{
        return false;
    }
}
function kullaniciKayit_var_mi($kullanici_id){
    include "baglan.php";
    $query="SELECT k_kayit_id FROM kullanici_kayit WHERE kullanici_id=$kullanici_id";
    $sonuc=mysqli_query($connection,$query);
    $dizi=mysqli_fetch_row($sonuc);
    mysqli_close($connection);
    if(!empty($dizi)){
        return true;
    }
    else{
        return false;
    }
}
function kayitliKullaniciBilgiGuncelle($ad,$soyad,$tc,$tel,$plaka,$id){
    include "baglan.php";
    $ad=ucfirst(strtolower($ad));
    $soyad=ucfirst(strtolower($soyad));
    $query="UPDATE kullanici SET ad='$ad', soyad='$soyad', tc_no='$tc', tel_No='$tel' WHERE kullanici_id=$id";
    $sonuc=mysqli_query($connection,$query);
    $query2="SELECT kullanici_id FROM kullanici WHERE tc_no='$tc'";
    $sonuc2=mysqli_query($connection,$query2);
    $gelen_bilgi=mysqli_fetch_assoc($sonuc2);
    $kullanici_id=$gelen_bilgi["kullanici_id"];
    $query3="UPDATE arac SET plaka='$plaka' WHERE kullanici_id=$kullanici_id";
    $sonuc3=mysqli_query($connection,$query3);
    mysqli_close($connection);
}
function kayitliKullaniciOturumBilgiGuncelleme($kullanici_adi,$sifre,$id){
    include "baglan.php";
    $query="UPDATE kullanici_kayit SET kullanici_adi='$kullanici_adi', sifre='$sifre' WHERE k_kayit_id=$id";
    $sonuc=mysqli_query($connection,$query);
    mysqli_close($connection);
}
function plakadanRezId($plaka){
    include "baglan.php";
    $query="SELECT arac.plaka, rez.rez_id FROM arac JOIN rezervasyon rez on arac.arac_id=rez.arac_id WHERE arac.plaka='$plaka'";
    $sonuc=mysqli_query($connection,$query);
    $dizi=mysqli_fetch_assoc($sonuc);
    $rez_id=$dizi["rez_id"];
    mysqli_close($connection);
    if(!empty($rez_id)){
        return $rez_id; 
    }
   
}
function kayitlar(){
    include "baglan.php";
    $query="SELECT verilogglama2.plaka, verilogglama1.ad, verilogglama1.soyad, verilogglama1.telefon, verilogglama1.tarife_tipi, verilogglama1.eklenmeTarih FROM verilogglama1  JOIN verilogglama2  ON verilogglama1.verilogglama_id1=verilogglama2.verilogglama_id2";
    $sonuc=mysqli_query($connection,$query);
    mysqli_close($connection);
    return $sonuc;
}

function tarifeSayiBul($tarife_adi){
    include "baglan.php";
    $query="SELECT count(tarife_tipi) FROM verilogglama1  JOIN verilogglama2  ON verilogglama1.verilogglama_id1=verilogglama2.verilogglama_id2 WHERE tarife_tipi='$tarife_adi'";
    $sonuc=mysqli_query($connection,$query);
    $dizi=mysqli_fetch_row($sonuc);
    $sayi=$dizi[0];
    mysqli_close($connection);
    return $sayi;
}
function veriSil(){
    include "baglan.php";

    $bugunun_tarihi = strtotime(date("Y-m-d"));

    for ($i = 1; $i <= 30; $i++) {
        $geri_tarih = strtotime("-$i day", $bugunun_tarihi);
        $g_tarih=date("Y-m-d", $geri_tarih);
        $query4="DELETE FROM arac_kayit WHERE tarih='$g_tarih'";
        $sonuc4 = mysqli_query($connection, $query4);
    }

    $query ="SELECT rez_id FROM rezervasyon";
    $sonuc=mysqli_query($connection,$query);
    $rez_tablo_rez_idler=[];
    $sonuc_dizi=[];
    while($gelen=mysqli_fetch_assoc($sonuc))
    {
        array_push($rez_tablo_rez_idler,$gelen["rez_id"]);
    }
    $query2 ="SELECT DISTINCT rezervasyon.rez_id FROM rezervasyon  JOIN arac_kayit ON rezervasyon.rez_id=arac_kayit.rez_id";
    $sonuc2=mysqli_query($connection,$query2);
    $kesisen_rez_idler=[];
    while($gelen=mysqli_fetch_assoc($sonuc2))
    {
        array_push($kesisen_rez_idler,$gelen["rez_id"]);
    }
    for($i=0;$i<count($rez_tablo_rez_idler);$i++){
        if(!in_array($rez_tablo_rez_idler[$i],$kesisen_rez_idler)){
            array_push($sonuc_dizi,$rez_tablo_rez_idler[$i]);
        }
    }

    for($k=0;$k<count($sonuc_dizi);$k++){
        $query5 ="SELECT arac.kullanici_id FROM rezervasyon JOIN arac ON rezervasyon.arac_id=arac.arac_id WHERE rezervasyon.rez_id=".$sonuc_dizi[$k]."";
        $sonuc5=mysqli_query($connection,$query5);
        $bilgi=mysqli_fetch_assoc($sonuc5);
        $kullanici_id=$bilgi["kullanici_id"];

        $query6 ="SELECT arac.plaka FROM rezervasyon JOIN arac ON rezervasyon.arac_id=arac.arac_id WHERE rezervasyon.rez_id=".$sonuc_dizi[$k]."";
        $sonuc6=mysqli_query($connection,$query6);
        $bilgi2=mysqli_fetch_assoc($sonuc6);
        $plaka=$bilgi2["plaka"];

        $kayitli_kullanici_var_mi= kullaniciKayit_var_mi($kullanici_id);
        if($kayitli_kullanici_var_mi==false){
            rezervasyonSil($sonuc_dizi[$k]);
            aracSil($plaka);
            kullaniciSil($kullanici_id);
            
        }
    }
    mysqli_close($connection);
}
function toplamKayitliVeri(){
    include "baglan.php";
    $query="SELECT * FROM kayitli_veri_sayisi";
    $sonuc=mysqli_query($connection,$query);
    $dizi=mysqli_fetch_row($sonuc);
    $sayi=$dizi[0];
    mysqli_close($connection);
    return $sayi;
}