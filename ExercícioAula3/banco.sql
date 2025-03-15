create database Zoológico;
use Zoológico;

create table Animais(
id int not null primary key auto_increment,
nome varchar(100),
espécie varchar(100),
dataNascimento date null
);

select * from Animais;