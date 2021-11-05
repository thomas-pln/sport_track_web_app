
/**

Schéma relationnel:

User(idUser(1), lName(NN), fName(NN), birthday(NN), sexe(NN), height(NN), weight(NN), email(UQ)(NN), pwd(NN))

Activity(idAct(1), date(NN), description(NN), distance, ttTime, startTime, freqMax, freqMoy, freqMin, refUser = @User.idUser (NN))

Data(idData(1), time(NN), cardio(NN), lat(NN), long(NN), alti(NN), dataAct = @Activity.idAct(NN))

Contraintes textuelles:
sexe : soit homme,femme,autre (H, F, A) (-> creation de table)
Toutes les classes ont une clé primaire inchangeable qui s'auto incrémente à chaque nouvelle instance (-> creation de table).
La fréquence maxiamle doit être inferieur à: 220 moins l'âge et supérieur ou égale à la fréquence minimale (-> creation de table et trigger).
La fréquance minimale doit être supérieur à 0 et inférieur ou égale à la fréquence maximale (-> creation de table et trigger).

Distance à calculer à partir de la latitude et de la longitude des datas (php)

*/

DROP TABLE User;
DROP TABLE Activity;
DROP TABLE Data;

DROP TRIGGER trigg_freqMax;

CREATE TABLE User(
   idUser INTEGER
      CONSTRAINT pk_idUser PRIMARY KEY AUTOINCREMENT,

   fName TEXT
      CONSTRAINT nn_fName NOT NULL,

   lName TEXT
      CONSTRAINT nn_lName NOT NULL,

   birthday DATE
      CONSTRAINT nn_birthday NOT NULL,

   sexe CHAR
      CONSTRAINT nn_sexe NOT NULL
      CONSTRAINT ck_sexe CHECK (sexe IN('H','F','A')),

   height INTEGER
      CONSTRAINT nn_height NOT NULL
      CONSTRAINT ck_height CHECK (height >0),

   weight INTEGER
      CONSTRAINT nn_weight NOT NULL
      CONSTRAINT ck_weight CHECK (weight >0),

   email TEXT
      CONSTRAINT nn_email NOT NULL
      CONSTRAINT uq_eamail UNIQUE
      CONSTRAINT ck_email CHECK(email LIKE '%@%.%'),

   pwd TEXT
      CONSTRAINT nn_pwd NOT NULL

);

CREATE TABLE Activity(
   idAct TEXT
      CONSTRAINT pk_idFile PRIMARY KEY,

   date DATE
      CONSTRAINT nn_date NOT NULL,

   description TEXT
      CONSTRAINT nn_description NOT NULL,

   distance NUMBER,

   startTime TEXT,

   ttTime TEXT,

   freqMax INTEGER
    CONSTRAINT ck_freqMax CHECK (freqMin>0 AND freqMax >= freqMin),

   freqMin INTEGER
      CONSTRAINT ck_freqMin CHECK (freqMin>0 AND freqMin <= freqMax),

   freqMoy INTEGER
      CONSTRAINT ck_freqMoy CHECK (freqMoy >= freqMin AND freqMoy <= freqMax),

   refUser INTEGER
      CONSTRAINT fk_Activity_User REFERENCES User(idUser)
      CONSTRAINT nn_refUser NOT NULL
);

CREATE TABLE Data(
   idData INTEGER
      CONSTRAINT pk_idData PRIMARY KEY AUTOINCREMENT,

   time TEXT
      CONSTRAINT nn_time NOT NULL,

   cardio INTEGER
      CONSTRAINT nn_cardio NOT NULL,

   lat FLOAT
      CONSTRAINT nn_lat NOT NULL,

   long FLOAT
      CONSTRAINT nn_long NOT NULL,

   alti FLOAT
      CONSTRAINT nn_alti NOT NULL,

   dataAct TEXT
      CONSTRAINT fk_Data_Activity REFERENCES Activity(idAct)
      CONSTRAINT nn_dataAct NOT NULL
);


CREATE TRIGGER trigg_freqMax
AFTER INSERT ON Data
BEGIN
UPDATE Activity
   SET freqMin = (SELECT MIN(cardio) FROM Data WHERE Activity.idAct =NEW.dataAct),
    freqMoy = (SELECT AVG(cardio) FROM Data WHERE  Activity.idAct= NEW.dataAct),
    freqMax = (SELECT MAX(cardio) FROM Data WHERE Activity.idAct= NEW.dataAct) --,
    /*ttTime = ((SELECT MAX(strftime('%H',time)) FROM Data WHERE Activity.idAct= NEW.dataAct)-(SELECT MIN(strftime('%H',time)) FROM Data WHERE Activity.idAct= NEW.dataAct) || ':' ||(SELECT MAX(strftime('%M',time)) FROM Data WHERE Activity.idAct= NEW.dataAct)-(SELECT MIN(strftime('%M',time)) FROM Data WHERE Activity.idAct= NEW.dataAct))
    WHERE NEW.dataAct = Activity.idAct*/
   ;
/*
   SELECT CASE
      WHEN NEW.cardio > (220 - (SELECT strftime('%Y', CURRENT_TIMESTAMP)) - (SELECT strftime('%Y', birthday) FROM User, Activity WHERE NEW.dataAct = idAct AND refUser = idUser))
      THEN RAISE(FAIL, 'Heartbeat cannot be higher than 220 minus age')
      END;*/
END;
