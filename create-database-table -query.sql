CREATE DATABASE rubrica;

USE rubrica;

create table contatti
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

ALTER TABLE contatti ADD FULLTEXT (nome);
ALTER TABLE contatti ADD FULLTEXT (cognome);
ALTER TABLE contatti ADD FULLTEXT (email);
ALTER TABLE contatti ADD FULLTEXT (numero);
ALTER TABLE contatti ADD FULLTEXT (nome,cognome,email,numero);

ALTER TABLE contatti ADD CONSTRAINT UNIQUE(numero);

ALTER TABLE contatti ADD active bool not null default (1);