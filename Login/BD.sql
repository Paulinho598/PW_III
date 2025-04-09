create database Login;
use Login;

create table Dados(
id int not null primary key,
nome varchar(50),
email varchar(50),
senha varchar(50),
genero enum("M,F,NB")
);

select * from Dados;