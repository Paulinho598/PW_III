create database Login;
use Login;

create table Dados(
id int not null primary key auto_increment,
nome varchar(255),
email varchar(255),
senha varchar(255),
genero varchar(255),
endereço varchar(255),
cpf varchar(255),
cnpj varchar(255),
data_cadastro date,
nível int
);

select * from Dados;
#drop database Login;