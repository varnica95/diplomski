CREATE DATABASE diplomski;

CREATE TABLE users(
                      id int(11) AUTO_INCREMENT PRIMARY KEY,
                      firstname TINYTEXT NOT NULL,
                      lastname TINYTEXT NOT NULL ,
                      username TINYTEXT NOT NULL ,
                      email TINYTEXT NOT NULL ,
                      gender VARCHAR(10) NOT NULL ,
                      birthdate DATETIME NOT NULL ,
                      password LONGTEXT NOT NULL ,
                      joined DATETIME NOT NULL
);

CREATE TABLE rememberme(
                           id int(11) AUTO_INCREMENT PRIMARY KEY,
                           user_id int(11),
                           hash LONGTEXT
);

CREATE TABLE parameters_notes(
                                 id int(11) PRIMARY KEY,
                                 parameter_class VARCHAR(60) NOT NULL,
                                 note LONGTEXT
);

INSERT INTO parameters_notes (id, parameter_class, note)
VALUES ('0.0','bp_normal','Your blood pressure (systolic and diastolic) is pretty much normal. Just stick to you diets and everything is going to be fine.'),
       ('1.0','bp_elevated','You have a little bit higher blood pressure than usual. You may experience some chest pain or a headache. But just to be sure, manage your pressure by increasing activity and eating healthy food. If you don’t do that, you will damage your kidneys.'),
       ('2.0','bp_h1','You have first stage of Hypertension. You should really eat more healthy. Stop drinking alcohol and stop smoking cigarettes. Get your stress under a control. There is also a chance that you have a kidney disease caused by higher blood pressure.'),
       ('3.0','bp_h2','You have Hypertension (stage II). You should really eat more healthy food and don’t put too much spices on it. Stop drinking alcohol and stop smoking cigarettes. Manage your stress level. There is also a chance that you have a kidney disease caused by it.'),
       ('4.0','bp_h3','From this systolic and diastolic values I can see that you have third stage of Hypertension. You really should stop eating junk food and increase your physical activity (start working out). Stop drinking alcohol and stop smoking cigarettes. Get your stress under a control if you are. There is also a chance that you have a kidney disease caused by higher blood pressure.'),
       ('5.0','sg_low','You’re having lower specific gravity than you should have. It can be caused by kidney failures (eg. Glomerulonephritis, pyelonephritis), kidney infections.'),
       ('6.0','sg_normal','The specific gravity of your urine is normal. You are very well hydrated.'),
       ('7.0','sg_high','You have high specific gravity in your urine. It means you are dehydrated and you should drink fluids to decrease it.'),
       ('8.0','su_low','Your sugar level is pretty much low. It means you have Hypoglycemia. Also, kidney failures can cause it. Your kidney functions are low. You can try eating some foods with higher level of sugar.'),
       ('9.0','su_normal','Your sugar level is pretty much normal.'),
       ('10.0','su_high','By this value, sugar in your blood is high. It means that you have Diabetes and that can damage blood vessels in kidneys. You should eat less-sugar foods and increase eating carbs and fiber.'),
       ('11.0','rbc_low','You might have a disease called Anemia (decreased total number of red blood cells). This can be normal, but “your body” has to work harder to get oxygen to every cell.'),
       ('12.0','rbc_normal','By this values, your red blood cell count is pretty much normal.'),
       ('13.0','rbc_high','Your red blood cell count is high. It can limit oxygen supply. You should eat more healthy, avoid eating meat.'),
       ('14.0','bu_low','Your blood urea is lower level. This can damage your liver. You should increase eating protein foods.'),
       ('15.0','bu_normal','Your blood urea test gave normal results. Everything is fine.'),
       ('16.0','bu_high','Your blood urea is really high. That can be really bad for your kidneys (acute injury or even chronic disease), urinary system. Stop eating high-protein foods and start eating vegetables.'),
       ('17.0','sc_low','Creatinine levels in your blood are pretty much low. That can be caused by muscle and liver diseases'),
       ('18.0','sc_normal','Your creatinine is normal.'),
       ('19.0','sc_high','Creatinine in your blood is really high. That can be really bad for your kidneys (acute injury or even chronic disease), urinary system.'),
       ('20.0','sod_low','Sodium in your blood is low. That can cause different diseases, like digestive system, diabetes or even kidney failures.'),
       ('21.0','sod_normal','Sodium level in your blood is pretty much normal. It is fine.'),
       ('22.0','sod_high','Your sodium level is high. That can cause adrenal hyperfunction (Cushing syndrome). You should start eating healthier.'),
       ('23.0','pot_low','From this values, your potassium level is pretty much low. Usually, causes are vomiting and diarrhea.'),
       ('24.0','pot_normal','Potassium level in your blood is pretty much normal. It is fine.'),
       ('25.0','pot_high','Your level of potassium is high. High potassium in the blood  may occur in people with chronic kidney disease.'),
       ('26.0','hemo_low','Your hemoglobin level is low. In many cases, this is no problem. But you should increase eating iron-rich food.'),
       ('27.0','hemo_normal','Sodium level in your blood is pretty much normal. It is fine.'),
       ('28.0','hemo_high','Seeing this values, your hemoglobin level is high. You should stop smoking because your body requires more oxygen. And also, your red blood cell production will increase.'),
       ('29.0','rbcc_normal','Red blood cell count in your urine is normal. Do not worry about it.'),
       ('30.0','rbcc_high','By this value, red blood cell count in your urine is pretty much high. That means that you have infection or kidney stones.'),
       ('31.0','wbcc_low','By this number, you have low level of white blood cells in your urine. It means that you might have some kind of kidney or urinary inflammation. You should take an antibiotic.'),
       ('32.0','wbcc_normal','White blood cell count in your urine is normal. Do not worry about it.'),
       ('33.0','wbcc_high','Your white blood cell count in urine is pretty much high. It means that you might have some kind of kidney or urinary inflammation. You should take an antibiotic.'),
       ('34.0','al_normal','Albumin level in your urine is normal. Do not worry about it.'),
       ('35.0','al_micro','It seems like you have Microalbuminuria. It means that you have a kidney disease. Kedneys leak small amount of albumin into your urine. Let me give you some blood pressure medicine.'),
       ('36.0','al_macro','It seems like you have Macroalbuminuria. It means that you have a kidney disease. Kedneys leak big amount of albumin into your urine. Let me give you some blood pressure medicine.');

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
);CREATE DATABASE diplomski;

CREATE TABLE users(
                      id int(11) AUTO_INCREMENT PRIMARY KEY,
                      firstname TINYTEXT NOT NULL,
                      lastname TINYTEXT NOT NULL ,
                      username TINYTEXT NOT NULL ,
                      email TINYTEXT NOT NULL ,
                      gender VARCHAR(10) NOT NULL ,
                      birthdate DATETIME NOT NULL ,
                      password LONGTEXT NOT NULL ,
                      joined DATETIME NOT NULL
);

CREATE TABLE rememberme(
                           id int(11) AUTO_INCREMENT PRIMARY KEY,
                           user_id int(11),
                           hash LONGTEXT
);

CREATE TABLE IF NOT EXISTS parameters_notes (
                                   id VARCHAR(2) CHARACTER SET utf8,
                                   class VARCHAR(11) CHARACTER SET utf8,
                                   note LONGTEXT CHARACTER SET utf8
);

INSERT INTO parameters_notes (id, class, note) VALUES
('0','bp_optimum','Nalaz u redu.'),
('1','bp_normal1','Nalaz vam je normalan ali spadate u skupinu osoba s prehipertenzijom. Ne morate se brinuti.'),
('2','bp_normal2','Po ovim vrijednostima, za krvni tlak mozemo reci da vam je „visoko normalan“ te mozemo zakljuciti da spadate u skupinu osoba s prehipernezijom.'),
('3','bp_h1','Krvni tlak vam je malo povisen. Spadate u skupinu osoba koja boluje od izolirane sistolicke hipertenzije, tocnije prvog stupnja hipertenzije. Cilj je postici optimalne vrijednosti arterijskog tlaka na nacin da prestanete pusiti, stabilizirate tjelesnu masu, prestanete konzumirati alkohol, budete tjelesno aktivniji. Ako se ne postignu normalne vrijednosti krvnog tlaka kroz nekoliko mjeseci, morat cete uvesti lijekove.'),
('4','bp_h2','Krvni tlak vam je dosta povisen. Spadate u skupinu osoba koja boluje od izolirane sistolicke hipertenzije, tocnije drugog stupnja hipertenzije. Prvo morate prestati konzumirati alkohol i morate prestati pusiti. Takodjer cete morati postati fizicki aktivniji kako bi izgubili tjelesnu masu. Uglavnom morate promijeniti vase zivotne navike kako bi vam se krvni tlakovi mogli stabilizirati. Ako se ne stabiliziraju, uvedite lijekove.'),
('5','bp_h3','Krvni tlak vam je jako povisen. Spadate u skupinu osoba koja boluje od izolirane sistolicke hipertenzije, tocnije treceg stupnja hipertenzije. Morate odmah promijeniti zivotne navike i zapoceti terapiju lijekovima.'),
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
('26','pot_high','Vrijednost kalija je ispod normalne vrijednosti. Potrebne dodatne pretrage jer mozda imate hiperkalijemiji.'),
('27','bu_normal','Nalaz je u redu.'),
('28','bu_low','Po ovoj vrijednosti mozemo zakljuciti da vam je razina ureje niska. Uzroci mogu biti ako jedete hranu siromasnu bjelancevinama, tezi oblik bolesti jetre, pretjerane hidracije, pa cak i trudnoca.'),
('29','bu_high','Razina ureje je visoka. Uzroci mogu biti smanjeni dotok krvi u bubreg, katabolicka stanja poput vrucice, sepse. A takodjer, povecana razina moze biti zbog pretjeranog unosa bjelancevina.'),
('30','sc_normal','Nalaz je u redu.'),
('31','sc_low','Razina kreatinina u serumu je niska. Potrebne dodatne pretrage.'),
('32','sc_high','Razina kreatinina u serumu je visoka. Povecana razina kreatinina obicno pokazuje bubreznu bolest. Potrebne dodatne pretrage.'),
('33','sg_normal','Nalaz je u redu.'),
('34','sg_low','Specificna tezina urina je snizena. Uzroci smanjene tezine mogu biti povecano uzimanje tekucine, diuretici, smanjena bubrezna sposobnost koncentriranja urina, pa cak i dijabetes. Potrebne dodatne pretrage.'),
('35','sg_high','Specificna tezina urina je velika. Uzroci smanjene tezine mogu zbog smanjenog uzimanja tekucine, dehidracije, smanjena bubrezna sposobnost koncentriranja urina, pa cak i dijabetes. Potrebne dodatne pretrage. Takodjer je potrebno razmisliti sadrzi li urin radiokontrast ili manitol.');


CREATE TABLE details_table(
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
                           created DATETIME NOT NULL
);