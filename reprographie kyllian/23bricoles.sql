#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: group
#------------------------------------------------------------

CREATE TABLE groups(
        id  Int  Auto_increment  NOT NULL ,
        nom Text NOT NULL
	,CONSTRAINT group_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE users(
        id       Int  Auto_increment  NOT NULL ,
        nom      Text NOT NULL ,
        prenom   Text NOT NULL ,
        email    Text NOT NULL ,
        password Text NOT NULL ,
        id_group Int NOT NULL
	z,CONSTRAINT user_PK PRIMARY KEY (id)

	,CONSTRAINT user_group_FK FOREIGN KEY (id_group) REFERENCES groups(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: demande
#------------------------------------------------------------

CREATE TABLE demande(
        id                Int  Auto_increment  NOT NULL ,
        datetime_demande  Datetime NOT NULL ,
        timestamp_demande TimeStamp NOT NULL ,
        datetime_dispo    Datetime NOT NULL ,
        timestamp_dispo   TimeStamp NOT NULL ,
        titre             Text NOT NULL ,
        fichier           Text NOT NULL ,
        exemplaires       Int NOT NULL ,
        options           Text NOT NULL ,
        etat              Bool NOT NULL ,
        id_user           Int NOT NULL
	,CONSTRAINT demande_PK PRIMARY KEY (id)

	,CONSTRAINT demande_user_FK FOREIGN KEY (id_user) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: visites
#------------------------------------------------------------

CREATE TABLE visites(
        id        Int  Auto_increment  NOT NULL ,
        id_user   Int NOT NULL ,
        datetime  Datetime NOT NULL ,
        timestamp TimeStamp NOT NULL ,
        ip        Text NOT NULL
	,CONSTRAINT visites_PK PRIMARY KEY (id)
)ENGINE=InnoDB;

