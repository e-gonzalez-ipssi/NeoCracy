#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        id     Int  Auto_increment PRIMARY KEY NOT NULL ,
        nom    Varchar (50) NOT NULL ,
        prenom Varchar (50) NOT NULL ,
        mail   Varchar (50) NOT NULL ,
        tel    Varchar (50),
        mdp    Varchar (255) NOT NULL ,
        photo  Varchar (50),
        isAdmin Boolean NOT NUll ,
        token Varchar (255) 
);

#------------------------------------------------------------
# Table: Organisation
#------------------------------------------------------------

CREATE TABLE Organisation(
        id          Int  Auto_increment PRIMARY KEY NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        description Varchar (50) NOT NULL ,
        lienSite    Varchar (50) NOT NULL
);


#------------------------------------------------------------
# Table: Proposition
#------------------------------------------------------------

CREATE TABLE Proposition(
        id          Int  Auto_increment PRIMARY KEY NOT NULL ,
        nom         Varchar (50) NOT NULL ,
        description Varchar (50) NOT NULL ,
        date        int NOT NULL
);

#------------------------------------------------------------
# Table: Tags
#------------------------------------------------------------

CREATE TABLE Tags(
        id          Int  Auto_increment PRIMARY KEY NOT NULL ,
        nom         Varchar (50) NOT NULL
);

#------------------------------------------------------------
# Table: Tags
#------------------------------------------------------------

CREATE TABLE haveTags(
        id_Proposition Int NOT NULL ,
        id_Tag Int NOT NULL,
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id),
    FOREIGN KEY (id_Tag) REFERENCES Tags(id)
);



#------------------------------------------------------------
# Table: Appartient
#------------------------------------------------------------

CREATE TABLE Appartient (
        id_Organisation Int NOT NULL ,
        id_Utilisateur Int NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Organisation) REFERENCES Organisation(id)
); 

#------------------------------------------------------------
# Table: estAdmin
#------------------------------------------------------------

CREATE TABLE estAdmin (
        id_Organisation Int NOT NULL ,
        id_Utilisateur Int NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Organisation) REFERENCES Organisation(id)
); 

#------------------------------------------------------------
# Table: aCree
#------------------------------------------------------------

CREATE TABLE aCree (
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
); 

#------------------------------------------------------------
# Table: peutAvoir
#------------------------------------------------------------

CREATE TABLE peutAvoir (
        id_Proposition Int NOT NULL ,
        id_Organisation Int NOT NULL,
    FOREIGN KEY (id_Organisation) REFERENCES Organisation(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
); 


#------------------------------------------------------------
# Table: aLike
#------------------------------------------------------------

CREATE TABLE aLike (
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL ,
        vote           BOOLEAN NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
); 


#------------------------------------------------------------
# Table: aCommente
#------------------------------------------------------------

CREATE TABLE aCommente (
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL ,
        commentaire    Varchar (50) NOT NULL ,
        date           Date NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
); 

