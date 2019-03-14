#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: ab0yz_users
#------------------------------------------------------------

CREATE TABLE ab0yz_users(
        id             Int  Auto_increment  NOT NULL ,
        firstname      Varchar (255) NOT NULL ,
        lastname       Varchar (255) NOT NULL ,
        phone          Varchar (10) NOT NULL ,
        mail           Varchar (255) NOT NULL ,
        password       Varchar (255) NOT NULL ,
        creationDate   Date NOT NULL ,
        interieurRules TinyInt NOT NULL ,
        cguChecked     TinyInt NOT NULL
	,CONSTRAINT ab0yz_users_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_genre
#------------------------------------------------------------

CREATE TABLE ab0yz_genre(
        id    Int  Auto_increment  NOT NULL ,
        genre Varchar (10) NOT NULL
	,CONSTRAINT ab0yz_genre_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_typeEvents
#------------------------------------------------------------

CREATE TABLE ab0yz_typeEvents(
        id   Int  Auto_increment  NOT NULL ,
        type Varchar (50) NOT NULL
	,CONSTRAINT ab0yz_typeEvents_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_events
#------------------------------------------------------------

CREATE TABLE ab0yz_events(
        id                  Int  Auto_increment  NOT NULL ,
        dateTime            Datetime NOT NULL ,
        eventDescription    Text NOT NULL ,
        id_ab0yz_typeEvents Int NOT NULL ,
        id_ab0yz_users      Int NOT NULL
	,CONSTRAINT ab0yz_events_PK PRIMARY KEY (id)

	,CONSTRAINT ab0yz_events_ab0yz_typeEvents_FK FOREIGN KEY (id_ab0yz_typeEvents) REFERENCES ab0yz_typeEvents(id)
	,CONSTRAINT ab0yz_events_ab0yz_users0_FK FOREIGN KEY (id_ab0yz_users) REFERENCES ab0yz_users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_status
#------------------------------------------------------------

CREATE TABLE ab0yz_status(
        id     Int  Auto_increment  NOT NULL ,
        status Varchar (50) NOT NULL
	,CONSTRAINT ab0yz_status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_userStatus
#------------------------------------------------------------

CREATE TABLE ab0yz_userStatus(
        id              Int  Auto_increment  NOT NULL ,
        id_ab0yz_users  Int NOT NULL ,
        id_ab0yz_status Int NOT NULL
	,CONSTRAINT ab0yz_userStatus_PK PRIMARY KEY (id)

	,CONSTRAINT ab0yz_userStatus_ab0yz_users_FK FOREIGN KEY (id_ab0yz_users) REFERENCES ab0yz_users(id)
	,CONSTRAINT ab0yz_userStatus_ab0yz_status0_FK FOREIGN KEY (id_ab0yz_status) REFERENCES ab0yz_status(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_eventParticipation
#------------------------------------------------------------

CREATE TABLE ab0yz_eventParticipation(
        id                 Int  Auto_increment  NOT NULL ,
        payment            TinyInt NOT NULL ,
        participantsNumber Int NOT NULL ,
        id_ab0yz_users     Int NOT NULL ,
        id_ab0yz_events    Int NOT NULL
	,CONSTRAINT ab0yz_eventParticipation_PK PRIMARY KEY (id)

	,CONSTRAINT ab0yz_eventParticipation_ab0yz_users_FK FOREIGN KEY (id_ab0yz_users) REFERENCES ab0yz_users(id)
	,CONSTRAINT ab0yz_eventParticipation_ab0yz_events0_FK FOREIGN KEY (id_ab0yz_events) REFERENCES ab0yz_events(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_paiementTypes
#------------------------------------------------------------

CREATE TABLE ab0yz_paiementTypes(
        id   Int  Auto_increment  NOT NULL ,
        type Varchar (10) NOT NULL
	,CONSTRAINT ab0yz_paiementTypes_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_groups
#------------------------------------------------------------

CREATE TABLE ab0yz_groups(
        id    Int  Auto_increment  NOT NULL ,
        `group` Varchar (50) NOT NULL
	,CONSTRAINT ab0yz_groups_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_photos
#------------------------------------------------------------

CREATE TABLE ab0yz_photos(
        id              Int  Auto_increment  NOT NULL ,
        title           Varchar (255) NOT NULL ,
        `source`          Varchar (255) NOT NULL ,
        id_ab0yz_events Int NOT NULL
	,CONSTRAINT ab0yz_photos_PK PRIMARY KEY (id)

	,CONSTRAINT ab0yz_photos_ab0yz_events_FK FOREIGN KEY (id_ab0yz_events) REFERENCES ab0yz_events(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_inscriptionsYear
#------------------------------------------------------------

CREATE TABLE ab0yz_inscriptionsYear(
        id                     Int  Auto_increment  NOT NULL ,
        years                  Year NOT NULL ,
        medicalCertificate     Varchar (255) NOT NULL ,
        numberPayment          Int NOT NULL ,
        alreadyPaid            Float NOT NULL ,
        leftToPay              Float NOT NULL ,
        id_ab0yz_paiementTypes Int NOT NULL
	,CONSTRAINT ab0yz_inscriptionsYear_PK PRIMARY KEY (id)

	,CONSTRAINT ab0yz_inscriptionsYear_ab0yz_paiementTypes_FK FOREIGN KEY (id_ab0yz_paiementTypes) REFERENCES ab0yz_paiementTypes(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_childs
#------------------------------------------------------------

CREATE TABLE ab0yz_childs(
        id                        Int  Auto_increment  NOT NULL ,
        firstname                 Varchar (255) NOT NULL ,
        lastname                  Varchar (255) NOT NULL ,
        birthDate                 Date NOT NULL ,
        imageLaw                  TinyInt NOT NULL ,
        id_ab0yz_users            Int NOT NULL ,
        id_ab0yz_genre            Int NOT NULL ,
        id_ab0yz_groups           Int NOT NULL ,
        id_ab0yz_inscriptionsYear Int NOT NULL
	,CONSTRAINT ab0yz_childs_PK PRIMARY KEY (id)

	,CONSTRAINT ab0yz_childs_ab0yz_users_FK FOREIGN KEY (id_ab0yz_users) REFERENCES ab0yz_users(id)
	,CONSTRAINT ab0yz_childs_ab0yz_genre0_FK FOREIGN KEY (id_ab0yz_genre) REFERENCES ab0yz_genre(id)
	,CONSTRAINT ab0yz_childs_ab0yz_groups1_FK FOREIGN KEY (id_ab0yz_groups) REFERENCES ab0yz_groups(id)
	,CONSTRAINT ab0yz_childs_ab0yz_inscriptionsYear2_FK FOREIGN KEY (id_ab0yz_inscriptionsYear) REFERENCES ab0yz_inscriptionsYear(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ab0yz_emergencyContact
#------------------------------------------------------------

CREATE TABLE ab0yz_emergencyContact(
        id              Int  Auto_increment  NOT NULL ,
        lastname        Varchar (255) NOT NULL ,
        firstname       Varchar (255) NOT NULL ,
        phone           Varchar (10) NOT NULL ,
        id_ab0yz_childs Int NOT NULL
	,CONSTRAINT ab0yz_emergencyContact_PK PRIMARY KEY (id)

	,CONSTRAINT ab0yz_emergencyContact_ab0yz_childs_FK FOREIGN KEY (id_ab0yz_childs) REFERENCES ab0yz_childs(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: havePhoto
#------------------------------------------------------------

CREATE TABLE havePhoto(
        id              Int NOT NULL ,
        id_ab0yz_childs Int NOT NULL
	,CONSTRAINT havePhoto_PK PRIMARY KEY (id,id_ab0yz_childs)

	,CONSTRAINT havePhoto_ab0yz_photos_FK FOREIGN KEY (id) REFERENCES ab0yz_photos(id)
	,CONSTRAINT havePhoto_ab0yz_childs0_FK FOREIGN KEY (id_ab0yz_childs) REFERENCES ab0yz_childs(id)
)ENGINE=InnoDB;

