CREATE TABLE CONSOMMATION_S(
       ID_ConsoS NUMERIC(6) ,
       EmailProp VARCHAR(320),
       EmailConso VARCHAR(320),
       ID_Service NUMERIC(6),
       DateDeb TIMESTAMP NOT NULL,
       DateFin TIMESTAMP NOT NULL,
       /*Verifier longueur*/
       CONSTRAINT PK_ConsoS PRIMARY KEY(ID_ConsoS),
       CONSTRAINT FK_Prop4 FOREIGN KEY(EmailProp) REFERENCES MEMBRE(Email),
       CONSTRAINT FK_Conso2 FOREIGN KEY(EmailConso) REFERENCES MEMBRE(Email),
       CONSTRAINT FK_Service FOREIGN KEY(ID_Service) REFERENCES SERVICE(ID_Service)
);
