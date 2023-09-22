create database bd_usuario;
use bd_usuario;

create table usuario(
USUARIO VARCHAR(100) PRIMARY KEY,
CLAVE VARCHAR(100),
CORREO VARCHAR (100)
);
create table listas(
id int AUTO_INCREMENT,
USUARIO VARCHAR(100),
task VARCHAR(500),
primary key(id,USUARIO),
FOREIGN KEY (USUARIO) REFERENCES usuario(USUARIO)
);

INSERT INTO usuario VALUES('papita','123456','papita@gmail.com');

