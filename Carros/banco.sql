create database veículos;
use veículos;

create table carros(
id int not null primary key auto_increment,
modelo varchar(50),
ano int(4),
placa varchar(7) unique,
cadastro datetime,
alteracaoValor datetime,
valor double(10,2),
cor varchar(30),
seguro varchar(3),
documento int(2),
ocorrência int(2),
bloqueio varchar(12)
);

select * from carros;
-- select * from carros where placa = '1' or id = '1';
-- drop database veículos;