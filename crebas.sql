/*==============================================================*/
/* Nom de SGBD :  MySQL 4.0                                     */
/* Date de création :  25/10/2011 08:20:18                      */
/*==============================================================*/


drop table if exists contact;

drop table if exists entreprise;

drop table if exists etudiant;

drop table if exists promotion;

drop table if exists proposition;

drop table if exists responsable;

drop table if exists stage;

/*==============================================================*/
/* Table : contact                                              */
/*==============================================================*/
create table contact
(
   idcontact                      int                            not null,
   identreprise                   int                            not null,
   prenomcontact                  varchar(50),
   nomcontact                     varchar(50),
   fonctioncontact                varchar(50),
   dateajout                      date,
   datederniereactivite           date,
   telfixecontact                 varchar(50),
   telmobilecontact               varchar(50),
   mailcontact                    varchar(50),
   primary key (idcontact)
)
type = innodb;

/*==============================================================*/
/* Table : entreprise                                           */
/*==============================================================*/
create table entreprise
(
   identreprise                   int                            not null,
   nomentreprise                  varchar(50),
   adresseentreprise              varchar(200),
   villeentreprise                varchar(50),
   codepostalentreprise           varchar(50),
   paysentreprise                 varchar(50),
   numerotelephone                varchar(50),
   numerosiret                    varchar(17),
   urlsiteinternet                varchar(50),
   statutjuridique                varchar(50),
   primary key (identreprise)
)
type = innodb;

/*==============================================================*/
/* Table : etudiant                                             */
/*==============================================================*/
create table etudiant
(
   idetudiant                     int                            not null,
   idpromotion                    int                            not null,
   numeroetudiant                 int,
   prenometudiant                 varchar(50),
   nometudiant                    varchar(50),
   mailetudiant                   varchar(50),
   passwordetudiant               varchar(50),
   primary key (idetudiant)
)
type = innodb;

/*==============================================================*/
/* Table : promotion                                            */
/*==============================================================*/
create table promotion
(
   idpromotion                    int                            not null,
   nompromotion                   varchar(50),
   accesentreprises               bool,
   primary key (idpromotion)
)
type = innodb;

/*==============================================================*/
/* Table : proposition                                          */
/*==============================================================*/
create table proposition
(
   idproposition                  int                            not null,
   idetudiant                     int                            not null,
   identreprise                   int,
   idstage                        int,
   nomentreprisep                 varchar(50),
   dateproposition                date,
   adresseentreprisep             varchar(200),
   villeentreprisep               varchar(50),
   codepostalentreprisep          varchar(50),
   paysentreprisep                varchar(50),
   numerotelephonep               varchar(50),
   urlsiteinternetp               varchar(50),
   sujetstagep                    text,
   estvalidee                     bool,
   primary key (idproposition)
)
type = innodb;

/*==============================================================*/
/* index : "propoetudiant_fk"                                            */
/*==============================================================*/
create index propoetudiant_fk
(
   idetudiant
);
/*==============================================================*/
/* index : "propoentreprise_fk"                                            */
/*==============================================================*/
create index propoentreprise_fk
(
   identreprise
);
/*==============================================================*/
/* index : "propositionstage2_fk"                                            */
/*==============================================================*/
create index propositionstage2_fk
(
   idstage
);

/*==============================================================*/
/* Table : responsable                                          */
/*==============================================================*/
create table responsable
(
   idresp                         int                            not null,
   loginresp                      varchar(50),
   passwordresp                   varchar(50),
   mailresp                       varchar(50),
   primary key (idresp)
)
type = innodb;

/*==============================================================*/
/* Table : stage                                                */
/*==============================================================*/
create table stage
(
   idstage                        int                            not null,
   identreprise                   int                            not null,
   idcontact                      int,
   idproposition                  int                            not null,
   idetudiant                     int                            not null,
   sujetstage                     text,
   datevalidation                 date,
   datedebut                      date,
   datefin                        date,
   datesoutenance                 date,
   lieusoutenance                 varchar(50),
   etatstage                      varchar(50),
   noteobtenue                    smallint,
   appreciationobtenue            text,
   remuneration                   text,
   embauche                       bool,
   dateembauche                   date,
   respcivil                      bool,
   promotionstagiaire             varchar(50),
   primary key (idstage)
)
type = innodb;

/*==============================================================*/
/* index : "stage_entreprise_fk"                                            */
/*==============================================================*/
create index stage_entreprise_fk
(
   identreprise
);
/*==============================================================*/
/* index : "stage_contact_fk"                                            */
/*==============================================================*/
create index stage_contact_fk
(
   idcontact
);
/*==============================================================*/
/* index : "stageetudiant_fk"                                            */
/*==============================================================*/
create index stageetudiant_fk
(
   idetudiant
);
/*==============================================================*/
/* index : "propositionstage_fk"                                            */
/*==============================================================*/
create index propositionstage_fk
(
   idproposition
);

alter table contact add constraint fk_entreprise_contact foreign key (identreprise)
      references entreprise (identreprise) on delete restrict on update restrict;

alter table etudiant add constraint fk_etudiantpromotion foreign key (idpromotion)
      references promotion (idpromotion) on delete restrict on update restrict;

alter table proposition add constraint fk_propoentreprise foreign key (identreprise)
      references entreprise (identreprise) on delete restrict on update restrict;

alter table proposition add constraint fk_propoetudiant foreign key (idetudiant)
      references etudiant (idetudiant) on delete restrict on update restrict;

alter table proposition add constraint fk_propositionstage2 foreign key (idstage)
      references stage (idstage) on delete restrict on update restrict;

alter table stage add constraint fk_propositionstage foreign key (idproposition)
      references proposition (idproposition) on delete restrict on update restrict;

alter table stage add constraint fk_stageetudiant foreign key (idetudiant)
      references etudiant (idetudiant) on delete restrict on update restrict;

alter table stage add constraint fk_stage_contact foreign key (idcontact)
      references contact (idcontact) on delete restrict on update restrict;

alter table stage add constraint fk_stage_entreprise foreign key (identreprise)
      references entreprise (identreprise) on delete restrict on update restrict;

