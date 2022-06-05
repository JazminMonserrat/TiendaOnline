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
    cantidad INT,
    borrado BOOLEAN
);

create table ventas (
    id_venta int PRIMARY KEY auto_increment,
    total FLOAT,
    direccion VARCHAR(250),
    nombreCliente VARCHAR(250),
    fechaVenta date,
    totalVendio int,
    id_usuario int,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

create table venta_producto (
    id_venta int,
    id_producto int,
    cantidad int,
    subtotal float,
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

create table pagos (
    id_pago int PRIMARY KEY auto_increment,
    referencia VARCHAR(250),
    total float,
    cantidadComprada int,
    tipo VARCHAR(250),
    id_venta int,
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta)
);

INSERT into usuarios (nombre,contrasena,correo,tipo,telefono,direccion) 
values('Miguel','f688ae26e9cfa3ba6235477831d5122e','correo@gmail.com','admin','2281152024','mi casa');//Hola
alter table productos add column borrado boolean default false