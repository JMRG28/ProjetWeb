
CREATE TABLE MEMBRE (
	email VARCHAR(320) NOT NULL,
	mdp_hash VARCHAR(50) NOT NULL,
	nom VARCHAR(25) NOT NULL,
	prenom VARCHAR(25) NOT NULL,
	ville VARCHAR(30) NOT NULL,
	code_telephone NUMERIC(3,0),
	numero_telephone NUMERIC(10,0),
	lien_photo VARCHAR(320),
	description VARCHAR(500),
	sexe CHAR(1) NOT NULL,
	statut VARCHAR(30),
	date_naissance DATE NOT NULL,
	date_inscription DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
	actif BOOLEAN NOT NULL DEFAULT '1',
	suspendu BOOLEAN NOT NULL DEFAULT '0',
	CONSTRAINT PK_email PRIMARY KEY(email),
	CONSTRAINT CHK_sexe CHECK (sexe IN ('H','F','A'))
);
