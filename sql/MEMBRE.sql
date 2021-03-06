
CREATE TABLE MEMBRE (
	Email VARCHAR(320) NOT NULL,
	MdpHash VARCHAR(50) NOT NULL,
	Nom VARCHAR(25) NOT NULL,
	Prenom VARCHAR(25) NOT NULL,
	CodePostal NUMERIC(5) NOT NULL,
	NumeroTel NUMERIC(10,0) NOT NULL,
	Photo VARCHAR(320),
	Description VARCHAR(500),
	Rendu INT DEFAULT '0',
	Recu INT DEFAULT '0',
	Sexe CHAR(1) NOT NULL,
	Statut VARCHAR(30) NOT NULL,
	DateNaiss DATE NOT NULL,
	DateIns DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
	Actif BOOLEAN NOT NULL DEFAULT '1',
	Suspendu BOOLEAN NOT NULL DEFAULT '0',
	CONSTRAINT PK_Email PRIMARY KEY(Email),
	CONSTRAINT CHK_Sexe CHECK (Sexe IN ('H','F'))
);
