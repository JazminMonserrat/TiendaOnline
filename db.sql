create database tiendaonline;

use tiendaonline;

create table usuarios (
    id_usuario int PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(250),
    contrasena varchar(64),
    correo varchar(100),
    tipo varchar(100),
    telefono varchar(10),
    direccion varchar(100)
);


INSERT into usuarios (nombre,contrasena,correo,tipo,telefono,direccion) 
values('Miguel','f688ae26e9cfa3ba6235477831d5122e','correo@gmail.com','admin','2281152024','mi casa');//Hola