create database veículos;
use veículos;

create table carros(
modelo varchar(50),
ano int(4),
placa varchar(7) primary key,
cadastro datetime
);

select * from carros;
-- drop database veículos;