CREATE TABLE CONSOMMATION_B(
       ID_ConsoB NUMERIC(6),
       EmailProp VARCHAR(320),
       EmailConso VARCHAR(320),
       ID_Bien NUMERIC(6),
       DateDeb TIMESTAMP NOT NULL,
       DateFin TIMESTAMP NOT NULL,
       CONSTRAINT PK_ConsoB PRIMARY KEY(ID_ConsoB),
       CONSTRAINT FK_Prop3 FOREIGN KEY(EmailProp) REFERENCES MEMBRE(Email),
       CONSTRAINT FK_Conso FOREIGN KEY(EmailConso) REFERENCES MEMBRE(Email),
       CONSTRAINT FK_Bien FOREIGN KEY(ID_Bien) REFERENCES BIEN(ID_Bien)
);