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
        name         Varchar (50) NOT NULL ,
        description Varchar (50) NOT NULL ,
        lienSite    Varchar (50) NOT NULL ,
        image varchar(255) ,
);


#------------------------------------------------------------
# Table: Proposition
#------------------------------------------------------------

CREATE TABLE Proposition(
        id          Int  Auto_increment PRIMARY KEY NOT NULL ,
        title         Varchar (50) NOT NULL ,
        description Varchar (50) NOT NULL ,
        date        int NOT NULL,
        image       VarChar (255),
        url         VarChar (255)
); 

#------------------------------------------------------------
# Table: Tags
#------------------------------------------------------------

CREATE TABLE Tags(
        id          Int  Auto_increment PRIMARY KEY NOT NULL ,
        nom         Varchar (50) NOT NULL,
        id_Organisation          Int NOT NULL ,
        FOREIGN KEY (id_Organisation) REFERENCES Organisation(id)
);

#------------------------------------------------------------
# Table: PropositionTags
#------------------------------------------------------------

CREATE TABLE PropositionTags (
        id_Proposition Int NOT NULL ,
        id Int NOT NULL,
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id),
    FOREIGN KEY (id) REFERENCES Tags(id)
);



#------------------------------------------------------------
# Table: OrgMember
#------------------------------------------------------------

CREATE TABLE OrgMember (
        id_Organisation Int NOT NULL ,
        id_Utilisateur Int NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Organisation) REFERENCES Organisation(id)
); 

#------------------------------------------------------------
# Table: OrgAdmin
#------------------------------------------------------------

CREATE TABLE OrgAdmin (
        id_Organisation Int NOT NULL ,
        id_Utilisateur Int NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Organisation) REFERENCES Organisation(id)
); 

#------------------------------------------------------------
# Table: UtilisateurProposition
#------------------------------------------------------------

CREATE TABLE UtilisateurProposition (
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
); 

#------------------------------------------------------------
# Table: OrgProposition
#------------------------------------------------------------

CREATE TABLE OrgProposition (
        id_Proposition Int NOT NULL ,
        id_Organisation Int NOT NULL,
    FOREIGN KEY (id_Organisation) REFERENCES Organisation(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
); 


#------------------------------------------------------------
# Table: PropositionLike
#------------------------------------------------------------

CREATE TABLE PropositionLike (
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL ,
        vote           BOOLEAN NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
); 


#------------------------------------------------------------
# Table: PropositionComment
#------------------------------------------------------------

CREATE TABLE PropositionComment (
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL ,
        commentaire    Varchar (255) NOT NULL ,
        date           Int NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
); 

#------------------------------------------------------------
# Table: PropositionSignalée
#------------------------------------------------------------

CREATE TABLE PropositionSignalee (
        id_Proposition Int NOT NULL ,
        id_Utilisateur Int NOT NULL ,
        message    Varchar (255) NOT NULL ,
        date           Int NOT NULL,
    FOREIGN KEY (id_Utilisateur) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_Proposition) REFERENCES Proposition(id)
);

