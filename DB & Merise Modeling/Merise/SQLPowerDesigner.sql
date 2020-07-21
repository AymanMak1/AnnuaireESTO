drop table if exists ADMINISTRATEUR;

drop table if exists APPARTENIR_ENSEIGNANT;

drop table if exists ENSEIGNANT;

drop table if exists ETUDIANT;

drop table if exists FILIERE;

/*==============================================================*/
/* Table : ADMINISTRATEUR                                       */
/*==============================================================*/
create table ADMINISTRATEUR
(
   ID_ADMINISTRATEUR    int not null,
   PPR_ADMINISTRATEUR   varchar(20),
   NOM                  varchar(55),
   PRENOM               varchar(55),
   DESCRIPTION          varchar(20),
   EMAIL                varchar(100),
   TELEPHONE            varchar(10),
   MOTDEPASSE           varchar(255),
   primary key (ID_ADMINISTRATEUR)
);

/*==============================================================*/
/* Table : APPARTENIR_ENSEIGNANT                                */
/*==============================================================*/
create table APPARTENIR_ENSEIGNANT
(
   ID_FILIERE           int not null,
   ID_ENSEIGNANT        int not null,
   primary key (ID_FILIERE, ID_ENSEIGNANT)
);

/*==============================================================*/
/* Table : ENSEIGNANT                                           */
/*==============================================================*/
create table ENSEIGNANT
(
   ID_ENSEIGNANT        int not null,
   PPR_ENSEIGNANT       varchar(20),
   NOM                  varchar(55),
   PRENOM               varchar(55),
   DESCRIPTION          varchar(20),
   EMAIL                varchar(100),
   TELEPHONE            varchar(10),
   MOTDEPASSE           varchar(255),
   CONFIRMED            bool,
   primary key (ID_ENSEIGNANT)
);

/*==============================================================*/
/* Table : ETUDIANT                                             */
/*==============================================================*/
create table ETUDIANT
(
   ID_ETUDIANT          int not null,
   ID_FILIERE           int not null,
   CNE                  varchar(10),
   NOM                  varchar(55),
   PRENOM               varchar(55),
   DESCRIPTION          varchar(20),
   EMAIL                varchar(100),
   TELEPHONE            varchar(10),
   MOTDEPASSE           varchar(255),
   CONFIRMED            bool,
   primary key (ID_ETUDIANT)
);

/*==============================================================*/
/* Table : FILIERE                                              */
/*==============================================================*/
create table FILIERE
(
   ID_FILIERE           int not null,
   ABR_FILIERE          varchar(4),
   LIBELLE              varchar(100),
   primary key (ID_FILIERE)
);

alter table APPARTENIR_ENSEIGNANT add constraint FK_APPARTENIR_ENSEIGNANT foreign key (ID_ENSEIGNANT)
      references ENSEIGNANT (ID_ENSEIGNANT) on delete restrict on update restrict;

alter table APPARTENIR_ENSEIGNANT add constraint FK_APPARTENIR_ENSEIGNANT2 foreign key (ID_FILIERE)
      references FILIERE (ID_FILIERE) on delete restrict on update restrict;

alter table ETUDIANT add constraint FK_APPARTENIR_ETUDIANT foreign key (ID_FILIERE)
      references FILIERE (ID_FILIERE) on delete restrict on update restrict;
