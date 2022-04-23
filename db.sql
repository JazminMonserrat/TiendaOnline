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

create table productos (
    id_producto int PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(250),
    imagenProducto VARCHAR(250),
    descripcion VARCHAR(250),
    categoria VARCHAR(250),
    precio FLOAT,
    cantidad INT
);


INSERT into usuarios (nombre,contrasena,correo,tipo,telefono,direccion) 
values('Miguel','f688ae26e9cfa3ba6235477831d5122e','correo@gmail.com','admin','2281152024','mi casa');//Hola