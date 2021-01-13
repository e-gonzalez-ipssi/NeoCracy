#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        id     Int  Auto_increment  NOT NULL ,
        nom    Varchar (50) NOT NULL ,
        prenom Varchar (50) NOT NULL ,
        mail   Varchar (50) NOT NULL ,
        tel    Varchar (50) NOT NULL ,
        mdp    Varchar (50) NOT NULL ,
        photo  Varchar (50) NOT NULL ,
        isAdmin Boolean NOT NUll 
        ,CONSTRAINT Utilisateur_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Organisation
#------------------------------------------------------------

CREATE TABLE Organisation(
        id          Int  Auto_increment  NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        description Varchar (50) NOT NULL ,
        lienSite    Varchar (50) NOT NULL
	,CONSTRAINT Organisation_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Proposition
#------------------------------------------------------------

CREATE TABLE Proposition(
        id          Int  Auto_increment  NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        description Varchar (50) NOT NULL ,
        tag         Int NOT NULL ,
        date        Date NOT NULL
	,CONSTRAINT Proposition_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Appartient
#------------------------------------------------------------

CREATE TABLE Appartient(
        id_Organisation Int NOT NULL ,
        id_Utilisateur Int NOT NULL
	,CONSTRAINT Appartient_PK PRIMARY KEY (id_Organisation,id_Utilisateur)

	,CONSTRAINT Appartient_Organisation_FK FOREIGN KEY (id_Organisation) REFERENCES Organisation(id)
	,CONSTRAINT Appartient_Utilisateur0_FK FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: estAdmin
#------------------------------------------------------------

CREATE TABLE estAdmin(
        id_Organisation Int NOT NULL ,
        id_Utilisateur Int NOT NULL
	,CONSTRAINT estAdmin_PK PRIMARY KEY (id_Organisation,id_Utilisateur)

	,CONSTRAINT estAdmin_Organisation_FK FOREIGN KEY (id_Organisation) REFERENCES Organisation(id)
	,CONSTRAINT estAdmin_Utilisateur0_FK FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aCree
#------------------------------------------------------------

CREATE TABLE aCree(
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL
	,CONSTRAINT aCree_PK PRIMARY KEY (id_Proposition,id_Utilisateur)

	,CONSTRAINT aCree_Proposition_FK FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
	,CONSTRAINT aCree_Utilisateur0_FK FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: peutAvoir
#------------------------------------------------------------

CREATE TABLE peutAvoir(
        id_Proposition  Int NOT NULL ,
        id_Organisation Int NOT NULL
	,CONSTRAINT peutAvoir_PK PRIMARY KEY (id_Proposition,id_Organisation)

	,CONSTRAINT peutAvoir_Proposition_FK FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
	,CONSTRAINT peutAvoir_Organisation0_FK FOREIGN KEY (id_Organisation) REFERENCES Organisation(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aLike
#------------------------------------------------------------

CREATE TABLE aLike(
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL ,
        vote           Bool NOT NULL
	,CONSTRAINT aLike_PK PRIMARY KEY (id_Proposition,id_Utilisateur)

	,CONSTRAINT aLike_Proposition_FK FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
	,CONSTRAINT aLike_Utilisateur0_FK FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: aCommente
#------------------------------------------------------------

CREATE TABLE aCommente(
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL ,
        commentaire    Varchar (50) NOT NULL ,
        date           Date NOT NULL
	,CONSTRAINT aCommente_PK PRIMARY KEY (id_Proposition,id_Utilisateur)

	,CONSTRAINT aCommente_Proposition_FK FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
	,CONSTRAINT aCommente_Utilisateur0_FK FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id)
)ENGINE=InnoDB;

