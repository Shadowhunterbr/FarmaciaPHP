create database farmacia;

use farmacia;

create table categoria (
	codigo integer primary key auto_increment,
    categoria varchar(30) not null
);

select * from categoria;

create table genero(
	codigo integer primary key,
    genero varchar(12) not null
);
select *from genero;
create table prescricao_medica(
	codigo integer primary key,
    prescricao char not null

);

create table funcionario(
	codigo integer primary key auto_increment,
    nome varchar(60) not null,
    email varchar(50) not null UNIQUE,
    login varchar(50) not null,
    senha varchar(50) not null,
    telefone integer,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    cargo varchar(30) not null, -- podemos mudar para outra tabela
    cod_genero integer, -- fk genero
    foreign key (cod_genero) references genero(codigo)
);
select * from funcionario;
ALTER TABLE pedidos DROP FOREIGN KEY pedidos_ibfk_1;
ALTER TABLE carrinho DROP FOREIGN KEY carrinho_ibfk_1;
alter table fornecedor modify column codigo integer  primary key auto_increment;
ALTER TABLE fornecedor MODIFY COLUMN codigo INTEGER AUTO_INCREMENT;
ALTER TABLE cliente DROP FOREIGN KEY pedidos_ibfk_1;
ALTER TABLE produtos DROP FOREIGN KEY produtos_ibfk_3;
SELECT * FROM funcionario WHERE nome = "Carlos Mendes" and senha = "senha123";


ALTER TABLE produtos 
ADD CONSTRAINT produtos_ibfk_3 
FOREIGN KEY (codigo_fornecedor) REFERENCES fornecedor(codigo);

create table fornecedor (
	codigo integer primary key,
    razao_social varchar(100) not null unique,
    nome_fantasia varchar(50) not null,
    cnpj varchar (16) not null,
    endereco varchar(250) not null,
    cidade VARCHAR(50),
    cep VARCHAR(9),
    pessoa_contato varchar(40),
    telefone integer

);
select * from fornecedor;
alter table fornecedor drop column UF;

CREATE TABLE endereco_cliente (
    codigo INTEGER PRIMARY KEY,
    rua VARCHAR(50),
    numero INTEGER,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    cep VARCHAR(9),
    UF VARCHAR(2)
);

CREATE TABLE cliente(
	codigo integer primary key auto_increment,
    nome varchar(60) not null,
    cod_endereco integer, -- fk endereço
    email varchar(50) not null UNIQUE,
    senha varchar(50) not null,
    telefone integer,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    cod_genero integer, -- fk genero
	data_nascimento DATE not null,
    foreign key (cod_endereco) references endereco_cliente(codigo),
    foreign key (cod_genero) references genero(codigo)
);
select * from cliente;
Alter table cliente add column data_nascimento DATE not null;

CREATE TABLE produtos(
    codigo INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cod_categoria INTEGER, -- FK para Categoria
    cod_fornecedor INTEGER, -- FK para Fornecedor
    cod_prescricao INTEGER, -- FK para prescrioção médica
    data_F DATE NOT NULL,
    data_V DATE NOT NULL,
    preco_custo decimal(10,2),
    preco decimal(10,2),
    quantidade_estoque INT DEFAULT 0,
    descricao_produto TEXT,
    imagem varchar(255),
    FOREIGN KEY (cod_prescricao) REFERENCES prescricao_medica(codigo),
    FOREIGN KEY (cod_categoria) REFERENCES categoria(codigo),
    FOREIGN KEY (cod_fornecedor) REFERENCES fornecedor(codigo)
);

ALTER TABLE produtos 
MODIFY COLUMN nome VARCHAR(50) ;

SELECT * FROM Produtos WHERE codigo = codigo;

alter table cliente modify column codigo integer auto_increment;

-- Tabela Pedidos
CREATE TABLE pedidos(
    codigo INTEGER PRIMARY KEY,
    cod_cliente INTEGER, -- FK para Clientes
    data_pedidos DATE NOT NULL,
    total FLOAT NOT NULL,
    FOREIGN KEY (cod_cliente) REFERENCES cliente(codigo)
);

-- Tabela Itens_Pedido
CREATE TABLE itens_pedido(
    cod_prod INTEGER, -- FK para Produtos
    cod_ped INTEGER, -- FK para Pedidos
    quantidade INTEGER,
    subtotal FLOAT,
    PRIMARY KEY(cod_prod, cod_ped),
    FOREIGN KEY (cod_ped) REFERENCES pedidos(codigo),
    FOREIGN KEY (cod_prod) REFERENCES produtos(codigo)
);


-- Tabela Carrinho
CREATE TABLE carrinho(
    codigo INTEGER PRIMARY KEY AUTO_INCREMENT,
    cod_cliente INTEGER NOT NULL, -- FK para Clientes
    FOREIGN KEY (cod_cliente) REFERENCES cliente(codigo)
);

-- Tabela Itens_Carrinho
CREATE TABLE itens_carrinho(
    cod_prod INTEGER, -- FK para Produtos
    cod_carrinho INTEGER, -- FK para Carrinho
    quantidade INTEGER NOT NULL,
    subtotal FLOAT NOT NULL,
    PRIMARY KEY (cod_prod, cod_carrinho),
    FOREIGN KEY (cod_prod) REFERENCES produtos(codigo),
    FOREIGN KEY (cod_carrinho) REFERENCES carrinho(codigo)
);

SELECT codigo, nome_fantasia FROM fornecedor;
select * from fornecedor;

ALTER TABLE produtos
ADD preco INT DEFAULT 0 ;
select * from produtos;

alter table produtos add preco_Custo decimal;

alter table produtos modify  preco_custo decimal(10,2);
Use farmacia;

select * from produtos;

INSERT INTO categoria (codigo, categoria) VALUES 
(1, 'Medicamento'),
(2, 'Higiene'),
(3, 'Cosmético'),
(4, 'Suplemento'),
(5, 'Acessório');

INSERT INTO genero (codigo, genero) VALUES 
(1, 'Masculino'),
(2, 'Feminino'),
(3, 'Outro');

INSERT INTO prescricao_medica (codigo, prescricao) VALUES 
(1, 'S'),
(2, 'N');

INSERT INTO fornecedor (codigo, razao_social, nome_fantasia, cnpj, endereco, bairro, cidade, cep, UF, pessoa_contato, telefone) VALUES 
(1, 'Farmácias Unidas S/A', 'Farmácia União', '12345678000195', 'Rua das Flores, 123', 'Centro', 'São Paulo', '01001-000', 'SP', 'Maria Silva', 1122334455),
(2, 'Distribuidora Saúde LTDA', 'Saúde Distribuidora', '98765432000167', 'Av. Brasil, 456', 'Jardim', 'Rio de Janeiro', '20040-010', 'RJ', 'João Souza', 2123456789),
(3, 'BioPharma S.A.', 'BioPharma', '11223344000188', 'Rua da Paz, 789', 'Industrial', 'Belo Horizonte', '30030-040', 'MG', 'Ana Lima', 313332221);

INSERT INTO funcionario (codigo, nome, email, login, senha, telefone, cpf, cargo, cod_genero) VALUES 
(1, 'Carlos Mendes', 'carlos@empresa.com', 'carlosm', 'senha123', 119876543, '12345678901', 'Atendente', 1),
(2, 'Fernanda Lima', 'fernanda@empresa.com', 'fernandal', 'senha456', 2198763, '23456789012', 'Farmacêutica', 2),
(3, 'Julio Santana', 'julio@empresa.com', 'julios', 'senha789', 31987654, '34567890123', 'Gerente', 1);


INSERT INTO produtos (codigo, nome, cod_categoria, cod_fornecedor, cod_prescricao, data_F, data_V, preco) VALUES 
(1, 'Paracetamol 500mg', 1, 1, 1, '2024-01-15', '2025-01-15', 5.99),
(2, 'Shampoo Anticaspa', 2, 2, 2, '2023-11-20', '2025-11-20', 15.49),
(3, 'Protetor Solar FPS 50', 3, 2, 2, '2023-08-10', '2024-08-10', 22.99),
(4, 'Vitamina C 1000mg', 4, 3, 2, '2024-02-05', '2025-02-05', 12.89),
(5, 'Termômetro Digital', 5, 1, 2, '2023-07-25', '2026-07-25', 29.99);

create database testefarmacia;
use testefarmacia;

create table produtos(
codigo integer primary key auto_increment,
nome varchar(50),
preco float

);