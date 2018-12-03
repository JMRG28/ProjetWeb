CREATE TABLE SERVICE(
       ID_Service NUMERIC(6),
       /*MotClef VARCHAR(30);*/
       Descriptif VARCHAR(500) NOT NULL,
       Semaines VARCHAR(200) NOT NULL,
       PlagesHoraires VARCHAR (500) NOT NULL,
       PrixH FLOAT NOT NULL,
       Actif BOOLEAN NOT NULL,
       /*Validite ??? */
       EstDispo BOOLEAN NOT NULL DEFAULT '1',
       DateMES DATE DEFAULT CURRENT_TIMESTAMP,
       EmailProp VARCHAR(320),
       /* DEMANDE BOOL*/

       CONSTRAINT PK_Service PRIMARY KEY(ID_Service),
       CONSTRAINT FK_Prop FOREIGN KEY(EmailProp) REFERENCES MEMBRE(Email)
);
