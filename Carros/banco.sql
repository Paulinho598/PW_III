create database veículos;
use veículos;

create table carros(
id int not null primary key auto_increment,
modelo varchar(50),
ano int(4),
placa varchar(7) unique,
cadastro datetime,
valor double(10,2),
cor varchar(30)
);

select * from carros;
-- drop database veículos;