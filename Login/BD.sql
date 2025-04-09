create database Login;
use Login;

create table Dados(
id int not null primary key auto_increment,
nome varchar(50),
email varchar(50),
senha varchar(50),
genero varchar(50)
);

select * from Dados;
#drop database Login;