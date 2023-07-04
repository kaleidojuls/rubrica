CREATE DATABASE rubrica;

USE rubrica;

create table contacts
(
    id 					int auto_increment              primary key,
    nome         			varchar(40)                 not null,
    cognome      			varchar(40)                 null,
    numero 					varchar(40)                 not null,
    societa      			varchar(40)                 null,
    qualifica         		varchar(40)                 null,
    immagine_contatto       varchar(100)                null,
    email        			varchar(40)       			null,
    compleanno    			date                        null,
    created_at   timestamp default CURRENT_TIMESTAMP 	not null
);

ALTER TABLE contacts ADD FULLTEXT (nome);
ALTER TABLE contacts ADD FULLTEXT (cognome);
ALTER TABLE contacts ADD FULLTEXT (email);
ALTER TABLE contacts ADD FULLTEXT (numero);
ALTER TABLE contacts ADD FULLTEXT (nome,cognome,email,numero);

ALTER TABLE contacts ADD CONSTRAINT UNIQUE(numero);

ALTER TABLE contacts ADD active bool not null default (1);