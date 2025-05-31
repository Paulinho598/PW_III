create database Loja;
use Loja;

create table produto (
   id int not null auto_increment primary key,
   cod varchar(10) unique,
   descricao varchar(40),
   unidade int(2),
   categoria int(3),
   valor double(5,2),
   ipi double(5,2),
   qtde_min  int,
   cadastro varchar(20),
   alteracao varchar(20),
   dataCadastro date,
   dataAlteracao date
);

create table cliente (
    id int not null auto_increment primary key,
    nome varchar(30),
    endereco varchar(30),
    bairro varchar(30),
    cidade varchar(30),
    uf varchar(2),
    cep varchar(8),
    celular varchar(20),
    email varchar(30),
    cadastro varchar(20),
    alteracao varchar(20),
    dataCadastro date,
    dataAlteracao date
);

create table pedido (
    id int not null auto_increment primary key,
    pedido date,
    numero varchar(10),
    codigoCliente int,
    codigoVenda int,
    finalizado varchar(1),
    notaFiscal int (10),
    data date,
    status varchar(1)
);

create table pedido_detalhe (
    id int not null auto_increment primary key,
    codigo int,
    valor double(7,2),
    quantidade int (5),
    ipi double(5,2),
    data date,
    numero int
);

create table vendedor (
    id int not null auto_increment primary key,
    nome varchar(30),
    email varchar(30),
    celular varchar(30),
    atuacao varchar(2),
    comissao double(7,2),
    status varchar(1)
);

create table observacao (
    id int not null auto_increment primary key,
    tipoReclamente varchar(1),
    reclamado int,
    reclamente int,
    ocorrencia int (3),
    observacao varchar(600),
    data date,
    retorno varchar(1),
    dataRetorno date
);

select * from produto;
select * from cliente;
select * from pedido;
select * from pedido_detalhe;
select * from vendedor;
select * from observacao;

#drop database Loja;