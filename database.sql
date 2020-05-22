CREATE DATABASE diplomski;

CREATE TABLE users(
                      id int(11) AUTO_INCREMENT PRIMARY KEY,
                      firstname TINYTEXT NOT NULL,
                      lastname TINYTEXT NOT NULL ,
                      username TINYTEXT NOT NULL ,
                      email TINYTEXT NOT NULL ,
                      gender VARCHAR(10) NOT NULL ,
                      weight VARCHAR(10) NOT NULL ,
                      birthdate DATETIME NOT NULL ,
                      password LONGTEXT NOT NULL ,
                      joined DATETIME NOT NULL,
                      age VARCHAR(10) NOT NULL
);

CREATE TABLE rememberme(
                           id int(11) AUTO_INCREMENT PRIMARY KEY,
                           user_id int(11),
                           hash LONGTEXT
);



CREATE TABLE user_table(
                           id int(11) auto_increment primary key,
                           user_id int(11) NOT NULL,
                           bp_sys VARCHAR(10) NOT NULL ,
                           bp_dia VARCHAR(10) NOT NULL ,
                           sg VARCHAR(10) NOT NULL ,
                           al VARCHAR(10) NOT NULL ,
                           su VARCHAR(10) NOT NULL ,
                           rbc VARCHAR(10) NOT NULL ,
                           bu VARCHAR(10) NOT NULL ,
                           sc VARCHAR(10) NOT NULL ,
                           sod VARCHAR(10) NOT NULL ,
                           pot VARCHAR(10) NOT NULL ,
                           hemo VARCHAR(10) NOT NULL ,
                           wbcc VARCHAR(10) NOT NULL ,
                           rbcc VARCHAR(10) NOT NULL ,
                           ckd VARCHAR(10) NOT NULL ,
                           bp_note LONGTEXT NOT NULL ,
                           sg_note LONGTEXT NOT NULL ,
                           al_note LONGTEXT NOT NULL ,
                           su_note LONGTEXT NOT NULL ,
                           rbc_note LONGTEXT NOT NULL ,
                           bu_note LONGTEXT NOT NULL ,
                           sc_note LONGTEXT NOT NULL ,
                           sod_note LONGTEXT NOT NULL ,
                           pot_note LONGTEXT NOT NULL ,
                           hemo_note LONGTEXT NOT NULL ,
                           wbcc_note LONGTEXT NOT NULL ,
                           rbcc_note LONGTEXT NOT NULL ,
                           ckd_note LONGTEXT NOT NULL ,
                           created DATETIME NOT NULL
);

CREATE TABLE parameters_notes
(
    id    INT(11) PRIMARY KEY ,
    class VARCHAR(25) NOT NULL,
    note  LONGTEXT    NOT NULL
);


INSERT INTO parameters_notes (id, class, note) VALUES
('0','bp_optimum','Nalaz u redu.'),
('1','bp_normal1','Nalaz vam je normalan ali spadate u skupinu osoba s prehipertenzijom. Ne morate se brinuti.'),
('2','bp_normal2','Po ovim vrijednostima, za krvni tlak mozemo reci da vam je „visoko normalan“ te mozemo zakljuciti da spadate u skupinu osoba s prehipernezijom.'),
('3','bp_h1','Krvni tlak vam je malo povisen. Spadate u skupinu osoba koja boluje od prvog stupnja hipertenzije. Cilj je postici optimalne vrijednosti arterijskog tlaka na nacin da prestanete pusiti, stabilizirate tjelesnu masu, prestanete konzumirati alkohol, budete tjelesno aktivniji. Ako se ne postignu normalne vrijednosti krvnog tlaka kroz nekoliko mjeseci, morat cete uvesti lijekove.'),
('4','bp_h2','Krvni tlak vam je dosta povisen. Spadate u skupinu osoba koja boluje od drugog stupnja hipertenzije. Prvo morate prestati konzumirati alkohol i morate prestati pusiti. Takodjer cete morati postati fizicki aktivniji kako bi izgubili tjelesnu masu. Uglavnom morate promijeniti vase zivotne navike kako bi vam se krvni tlakovi mogli stabilizirati. Ako se ne stabiliziraju, uvedite lijekove.'),
('5','bp_h3','Krvni tlak vam je jako povisen. Spadate u skupinu osoba koja boluje od treceg stupnja hipertenzije. Morate odmah promijeniti zivotne navike i zapoceti terapiju lijekovima.'),
('6','rbc_normal','Nalaz je u redu.'),
('7','rbc_high','Imate povecani broj eritrocita. Potrebne dodatne pretrage.'),
('8','rbcc_normal','Nalaz je u redu.'),
('9','rbcc_high','Buduci da vam je kolicina eritrocita povisena, mozemo zakljuciti da imate hematuriju.'),
('10','wbcc_normal','Nalaz je u redu.'),
('11','wbcc_high','Povisen broj leukocita se uglavnom odnosi na infekcije urinarnog sustava i na upalne bubrezne bolesti. Prvo bi trebalo posumnjati na leukocituriju, odnosno piuriju bubreznog porijekla ako postoji proteinurija. Ako se radi o infekcijama urinarnog sustava, piuriju prati bakteriurija. Ovdje je iznimka tuberkuloza, kod koje je urinokultura negativna (piurija sterilna). Neki od uzroka sterilne piurije su vrucica, lijecenje antibioticima, reakcija odbacivanja presadjivanja bubrega, prostatitis i razne infekcije.'),
('12','su_normal','Nalaz je u redu.'),
('13','su_low','Koncentracija glukoze je niska. Potrebne dodatne pretrage.'),
('14','su_high','Koncentracija glukoze je visoka. Potrebne dodatne pretrage.'),
('15','alb_normal','Nalaz je u redu.'),
('16','alb_micro','Buduci da je izlucivanje albumina u urinu abnormalno, mozda imate mikroalbuminuriju. Potrebne dodatne pretrage.'),
('17','alb_high','Izlucivanje albumina u urinu je velika. Potrebno je dodatno pretraziti prije nego sto utvrdimo da se radi o ocitoj dijabetickoj nefropatiji.'),
('18','hemo_normal','Nalaz je u redu.'),
('19','hemo_low','Vrijednost hemoglobina je snizena. Potrebne su dodatne pretrage jer mozda imate anemiju.'),
('20','hemo_high','Vrijednost hemoglobina je povisena. Potrebne su dodatne pretrage.'),
('21','sod_normal','Nalaz je u redu.'),
('22','sod_low','Vrijednost natrija je ispod normalne vrijednosti. Potrebne dodatne pretrage jer mozda imate hiponatrijemiju.'),
('23','sod_high','Vrijednost natrija je visoka. Potrebne dodatne pretrage jer mozda imate hipernatrijemiju.'),
('24','pot_normal','Nalaz je u redu.'),
('25','pot_low','Kalij vam je nizak. Moramo obaviti dodatne pretrage kako bi utvrdili radi li se o hipokalijemiji.'),
('26','pot_high','Vrijednost kalija je iznad normalne vrijednosti. Potrebne dodatne pretrage jer mozda imate hiperkalijemiji.'),
('27','bu_normal','Nalaz je u redu.'),
('28','bu_low','Po ovoj vrijednosti mozemo zakljuciti da vam je razina ureje niska. Uzroci mogu biti ako jedete hranu siromasnu bjelancevinama, tezi oblik bolesti jetre, pretjerane hidracije, pa cak i trudnoca.'),
('29','bu_high','Razina ureje je visoka. Uzroci mogu biti smanjeni dotok krvi u bubreg, katabolicka stanja poput vrucice, sepse. A takodjer, povecana razina moze biti zbog pretjeranog unosa bjelancevina.'),
('30','sc_normal','Nalaz je u redu.'),
('31','sc_low','Razina kreatinina u serumu je niska. Potrebne dodatne pretrage.'),
('32','sc_high','Razina kreatinina u serumu je visoka. Povecana razina kreatinina obicno pokazuje bubreznu bolest. Potrebne dodatne pretrage.'),
('33','sg_normal','Nalaz je u redu.'),
('34','sg_low','Specificna tezina urina je snizena. Uzroci smanjene tezine mogu biti povecano uzimanje tekucine, diuretici, smanjena bubrezna sposobnost koncentriranja urina, pa cak i dijabetes. Potrebne dodatne pretrage.'),
('35','sg_high','Specificna tezina urina je velika. Uzroci smanjene tezine mogu zbog smanjenog uzimanja tekucine, dehidracije, smanjena bubrezna sposobnost koncentriranja urina, pa cak i dijabetes. Potrebne dodatne pretrage. Takodjer je potrebno razmisliti sadrzi li urin radiokontrast ili manitol.'),
('36','acu_preren','Buduci da vam je omjer ureje i serumskog kreatinina veci od 20, mozemo zakljuciti da imate prerenalnu azotomiju. To je najcesi oblik akutnog zatajenja bubrega. Neki od uzroka prerenalne azotomije su krvarenje, dehidracija, opekline i gubitak tekucine u bubrezima. Takodjer postoje i pokazatelji ove bolesti. Anamnesticki (omaglica, zedj, gubitak tekucine putem bubrega) i fizikalni (hipotenzija, suha sluznica).'),
('37','acu_normal','Nalaz je u redu.'),
('38','acu_ren','Po ovim vrijednostima omjera ureje i serumskog kreatinina, imate renalnu azotomiju. Uzrok ove bolesti moze biti zbog zacepljenja bubreznih arterija ili vena. Takodjer osim velikih krvnih zila, razlog moze biti zbog malih krvnih zila i glomerule.'),
('39','crcl_normal','Nalaz je u redu.'),
('40','crcl_mild','Imate blagi stupanj zatajenja bubrega. Potrebno je zapoceti restikciju fosfata i analoga vitamina D.'),
('41','crcl_anem_normal', 'Nema ukazivanja anemije.'),
('42','crcl_anem', 'U vašem trenutnom stupnju oboljenja postoji anemija. Ona je zapravo cesta pojava kada stupanj klirensa kreatinina padne ispod 40 ml/min. Hemoglobin bi se trebao mjeriti svakog tjedna tijekom pocetka lijecenja.'),
('43','crcl_mod','Vas stupanj zatajenje bubrega je umjeren. Za svaki slucaj, potrebno je napraviti plan dijalize bubrega.'),
('44','crcl_heavy','Imate teski oblik zatajenja bubrega. Potrebno je planirati pocetak dijalize ili obratiti paznju na presadjivanje bubrega'),
('45','crcl_dialysis','Hitno potrebna dijaliza bubrega jer vam je razina zatajenja izrazito teska.'),
('46','ckd_0','U vasem slucaju nema ukazivanja zatajenja bubrega.'),
('47','ckd_1','1. stadij kronicnog zatajenja bubrega. Postoji ostecenost bubrega s normalom ili povecanom glomerularnom filtracijom.'),
('48','ckd_2','2. stadij kronicnog zatajenja bubrega. Postoji ostecenost bubrega s blago smanjenom glomerularnom filtracijom.'),
('49','ckd_3','3. stadij kronicnog zatajenja bubrega. Postoji umjereno smanjena glomerularna filtracija.'),
('50','ckd_4','4. stadij kronicnog zatajenja bubrega. Postoji izrazito smanjenja glomerularna filtracija.'),
('51','ckd_5','5. stadij kronicnog zatajenja bubrega. Zatajenja bubrega.');


CREATE TABLE details_table(
                           id int(11) auto_increment primary key,
                           user_id int(11) NOT NULL,
                           bp_sys VARCHAR(10) NOT NULL ,
                           bp_dia VARCHAR(10) NOT NULL ,
                           sg VARCHAR(10) NOT NULL ,
                           al VARCHAR(10) NOT NULL ,
                           alsc_ratio VARCHAR(10) NOT NULL ,
                           su VARCHAR(10) NOT NULL ,
                           rbc VARCHAR(10) NOT NULL ,
                           bu VARCHAR(10) NOT NULL ,
                           sc VARCHAR(10) NOT NULL ,
                           sod VARCHAR(10) NOT NULL ,
                           pot VARCHAR(10) NOT NULL ,
                           hemo VARCHAR(10) NOT NULL ,
                           wbcc VARCHAR(10) NOT NULL ,
                           rbcc VARCHAR(10) NOT NULL ,
                           ckd VARCHAR(10) NOT NULL ,
                           bun_sc_ratio VARCHAR(10) NOT NULL ,
                           crcl VARCHAR(10) NOT NULL ,
                           gfr VARCHAR(10) NOT NULL ,
                           bp_note LONGTEXT NOT NULL ,
                           rbc_note LONGTEXT NOT NULL ,
                           hemo_note LONGTEXT NOT NULL ,
                           su_note LONGTEXT NOT NULL ,
                           bu_note LONGTEXT NOT NULL ,
                           sc_note LONGTEXT NOT NULL ,
                           sod_note LONGTEXT NOT NULL ,
                           pot_note LONGTEXT NOT NULL ,
                           sg_note LONGTEXT NOT NULL ,
                           al_note LONGTEXT NOT NULL ,
                           wbcc_note LONGTEXT NOT NULL ,
                           rbcc_note LONGTEXT NOT NULL ,
                           ckd_note LONGTEXT NOT NULL ,
                           bun_sc_ratio_note LONGTEXT NOT NULL ,
                           crcl_note LONGTEXT NOT NULL ,
                           crcl_anem_note LONGTEXT NOT NULL,
                           gfr_note LONGTEXT NOT NULL ,
                           created DATETIME NOT NULL
);