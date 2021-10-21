#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: semaine
#------------------------------------------------------------

CREATE TABLE semaine(
        numero              Int  Auto_increment  NOT NULL ,
        dateDebutProducteur Date NOT NULL ,
        dateFinProducteur   Date NOT NULL ,
        dateFinClient       Date NOT NULL ,
        datevente           Date NOT NULL
	,CONSTRAINT semaine_PK PRIMARY KEY (numero)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commande
#------------------------------------------------------------

CREATE TABLE commande(
        id     Int  Auto_increment  NOT NULL ,
        date   Date NOT NULL ,
        numero Int NOT NULL
	,CONSTRAINT commande_PK PRIMARY KEY (id)

	,CONSTRAINT commande_semaine_FK FOREIGN KEY (numero) REFERENCES semaine(numero)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: fonction
#------------------------------------------------------------

CREATE TABLE fonction(
        code    Varchar (50) NOT NULL ,
        libelle Varchar (50) NOT NULL
	,CONSTRAINT fonction_PK PRIMARY KEY (code)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id         Int  Auto_increment  NOT NULL ,
        mail       Varchar (50) NOT NULL ,
        mdp        Varchar (50) NOT NULL ,
        adresse    Varchar (50) ,
        descriptif Text ,
        cp         Varchar (50) ,
        ville      Varchar (50) ,
        nom        Varchar (50) NOT NULL ,
        prenom     Varchar (50) NOT NULL ,
        code       Varchar (50) NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (id)

	,CONSTRAINT utilisateur_fonction_FK FOREIGN KEY (code) REFERENCES fonction(code)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: produit
#------------------------------------------------------------

CREATE TABLE produit(
        id             Int  Auto_increment  NOT NULL ,
        nom            Varchar (50) NOT NULL ,
        descriptif     Varchar (50) NOT NULL ,
        unite          Varchar (50) NOT NULL ,
        id_utilisateur Int NOT NULL
	,CONSTRAINT produit_PK PRIMARY KEY (id)

	,CONSTRAINT produit_utilisateur_FK FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: vente
#------------------------------------------------------------

CREATE TABLE vente(
        id       Int NOT NULL ,
        numero   Int NOT NULL ,
        quantite Int NOT NULL ,
        prix     DECIMAL (15,3)  NOT NULL
	,CONSTRAINT vente_PK PRIMARY KEY (id,numero)

	,CONSTRAINT vente_produit_FK FOREIGN KEY (id) REFERENCES produit(id)
	,CONSTRAINT vente_semaine0_FK FOREIGN KEY (numero) REFERENCES semaine(numero)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ligne_commande
#------------------------------------------------------------

CREATE TABLE ligne_commande(
        id          Int NOT NULL ,
        id_commande Int NOT NULL ,
        quantite    Int NOT NULL
	,CONSTRAINT ligne_commande_PK PRIMARY KEY (id,id_commande)

	,CONSTRAINT ligne_commande_produit_FK FOREIGN KEY (id) REFERENCES produit(id)
	,CONSTRAINT ligne_commande_commande0_FK FOREIGN KEY (id_commande) REFERENCES commande(id)
)ENGINE=InnoDB;

