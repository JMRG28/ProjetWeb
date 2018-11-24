CREATE TABLE BIEN(
       ID_Bien NUMERIC(6) AUTO_INCREMENT, /*commencera par un B*/
       /*MotClef VARCHAR(30),*/
       Descriptif VARCHAR(180) NOT NULL,
       Photo VARCHAR(300),
       PrixNeuf FLOAT NOT NULL,
       Actif NUMERIC(1) NOT NULL,
       EstDispo BOOLEAN NOT NULL DEFAULT '1',
       DateMES DATE DEFAULT CURRENT_TIMESTAMP,
       EmailProp VARCHAR(320),
       CONSTRAINT PK_BIEN PRIMARY KEY(ID_BIEN),
       CONSTRAINT FK_Prop FOREIGN KEY(EmailProp) REFERENCES MEMBRE(Email),
);
       
