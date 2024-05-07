create database otopark_otomasyon;
use otopark_otomasyon;
create table if not exists tarife(
tarife_id INT AUTO_INCREMENT,
tarife_tipi VARCHAR(20),
ucret INT,
PRIMARY KEY(tarife_id)
);

create table if not exists kullanici(
kullanici_id INT AUTO_INCREMENT,
ad VARCHAR(50),
soyad VARCHAR(50),
tc_no VARCHAR(11),
tel_No VARCHAR(10),
tarife_id INT,
PRIMARY KEY(kullanici_id),
FOREIGN KEY(tarife_id) REFERENCES tarife(tarife_id)
);

create table if not exists arac(
arac_id INT AUTO_INCREMENT,
plaka varchar(20) UNIQUE,
kullanici_id INT,
PRIMARY KEY(arac_id),
FOREIGN KEY(kullanici_id) REFERENCES kullanici(kullanici_id)
);

create table if not exists rezervasyon(
rez_id INT AUTO_INCREMENT,
baslangic_tarih DATE,
bitis_tarih DATE,
park_id INT,
arac_id INT,
PRIMARY KEY(rez_id),
FOREIGN KEY(arac_id) REFERENCES arac(arac_id)
);

create table if not exists kart(
kart_id INT AUTO_INCREMENT,
kart_no VARCHAR(16) UNIQUE,
kart_skt VARCHAR(5),
cvv VARCHAR(3),
kullanici_id INT,
PRIMARY KEY(kart_id),
FOREIGN KEY(kullanici_id) REFERENCES kullanici(kullanici_id)
);

create table if not exists arac_kayit(
kayit_id INT AUTO_INCREMENT,
rez_id INT,
tarih DATE,
PRIMARY KEY(kayit_id),
FOREIGN KEY(rez_id) REFERENCES rezervasyon(rez_id)
);

create table if not exists admin(
admin_id INT AUTO_INCREMENT,
kullanici_adi VARCHAR(30),
sifre VARCHAR(30),
PRIMARY KEY(admin_id)
);

create table if not exists iletisim(
iletisim_id INT AUTO_INCREMENT,
adres VARCHAR(100),
telefon varchar(20),
mail VARCHAR(50),
PRIMARY KEY(iletisim_id)
);

create table if not exists kullanici_kayit(
k_kayit_id INT AUTO_INCREMENT,
kullanici_adi varchar(30) UNIQUE,
sifre varchar(30),
kullanici_id INT,
primary key(k_kayit_id),
foreign key(kullanici_id) references kullanici(kullanici_id)
);

create table if not exists veriLogglama1(
verilogglama_id1 INT AUTO_INCREMENT,
ad varchar(50),
soyad varchar(50),
telefon varchar(10),
tarife_tipi varchar(20),
eklenmeTarih timestamp not null default current_timestamp,
primary key(verilogglama_id1)
);

create table if not exists veriLogglama2(
verilogglama_id2 INT AUTO_INCREMENT,
plaka varchar(9) UNIQUE,
verilogglama_id1 INT,
primary key(verilogglama_id2),
foreign key(verilogglama_id1) references veriLogglama1(verilogglama_id1)
);

DELIMITER $$
CREATE TRIGGER veriLogger1
AFTER INSERT ON kullanici
FOR EACH ROW
BEGIN
        INSERT INTO veriLogglama1(ad,soyad,telefon,tarife_tipi) values 
        (
        (select kullanici.ad from kullanici join tarife on kullanici.tarife_id=tarife.tarife_id where kullanici_id=(select kullanici_id from kullanici order by kullanici_id desc limit 1)),
        (select kullanici.soyad from kullanici join tarife on kullanici.tarife_id=tarife.tarife_id where kullanici_id=(select kullanici_id from kullanici order by kullanici_id desc limit 1)),
        (select kullanici.tel_No from kullanici join tarife on kullanici.tarife_id=tarife.tarife_id where kullanici_id=(select kullanici_id from kullanici order by kullanici_id desc limit 1)),
        (select tarife.tarife_tipi from kullanici join tarife on kullanici.tarife_id=tarife.tarife_id where kullanici_id=(select kullanici_id from kullanici order by kullanici_id desc limit 1))
        );
END$$;
DELIMITER ;

DELIMITER $$
CREATE TRIGGER veriLogger2
AFTER INSERT ON arac
FOR EACH ROW
BEGIN
        INSERT INTO veriLogglama2(plaka,verilogglama_id1) values 
        (
        (select plaka from arac where kullanici_id=(select kullanici_id from kullanici order by kullanici_id desc limit 1)),
        (select verilogglama_id1 from verilogglama1 order by verilogglama_id1 desc limit 1)
        );
END$$;
DELIMITER ;

CREATE INDEX plaka_index ON arac(plaka);
CREATE INDEX kullanici_adi_index ON kullanici_kayit(kullanici_adi);
CREATE INDEX admin_bilgi_index ON admin(kullanici_adi, sifre);
CREATE INDEX tarife_index ON tarife(tarife_tipi, ucret);

CREATE VIEW kayitli_veri_sayisi AS
SELECT count(*) FROM verilogglama1  JOIN verilogglama2  ON verilogglama1.verilogglama_id1=verilogglama2.verilogglama_id2;

CREATE VIEW odeme_dogrulama AS
SELECT kart_no, cvv, kart_skt FROM kart;


SET SQL_SAFE_UPDATES = 0;

