/*Si no se especifica el ID, la propiedad AutoIncrementable se ejecuta*/
insert into categorias (nombre,descripcion,estado) values('Categoría 1','descripción 1',1);
insert into categorias (nombre,descripcion,estado) values('Categoría 2','descripción 2',1);
insert into categorias (nombre,descripcion,estado) values('Categoría 3','descripción 3',1);
insert into categorias (nombre,descripcion,estado) values('Categoría 4','descripción 4',1);
insert into categorias (nombre,descripcion,estado) values('Categoría 5','descripción 5',1);

/*Si no se especifica el ID, la propiedad AutoIncrementable se ejecuta*/
insert into categorias values(null,'Categoría 1','descripción 1',1);
insert into categorias values(null,'Categoría 2','descripción 2',1);
insert into categorias values(null,'Categoría 3','descripción 3',1);
insert into categorias values(null,'Categoría 4','descripción 4',1);
insert into categorias values(null,'Categoría 5','descripción 5',1);

/*Si se especifica el ID, la propiedad AutoIncrementable no se ejecuta, esto conlleva a crear tu propio Procedimiento Almacenado para generar el ID*/
insert into categorias values(1,'Categoría 1','descripción 1',1);
insert into categorias values(2,'Categoría 2','descripción 2',1);
insert into categorias values(3,'Categoría 3','descripción 3',1);
insert into categorias values(4,'Categoría 4','descripción 4',1);
insert into categorias values(5,'Categoría 5','descripción 5',1);

insert into articulos (id_categoria,codigo,nombre,stock,descripcion,imagen,estado) values(1,'123456788','Impresora Empson L300',50,null,'1491149398.jpeg',1);
insert into articulos (id_categoria,codigo,nombre,stock,descripcion,imagen,estado) values(1,'123456789','Cable impresora x2mt',50,null,'1485910808.jpg',1);

insert into personas (tipo_persona,nombre,tipo_documento,num_documento,direccion,telefono,email) values('Proveedor','Inversiones Santa Cruz SAC','RUC','2236157773',null,null,null);
insert into personas (tipo_persona,nombre,tipo_documento,num_documento,direccion,telefono,email) values('Proveedor','Inversiones Iglesias SAC','RUC','20415689234','aaa','aaa','aaa@gmail.com');

insert into permisos (nombre) values('Escritorio');
insert into permisos (nombre) values('Almacén');
insert into permisos (nombre) values('Compras');
insert into permisos (nombre) values('Ventas');
insert into permisos (nombre) values('Acceso');
insert into permisos (nombre) values('Consultas');

insert into usuarios (nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,username,password,imagen,estado) values('Jorge Ernesto','DNI','73704296',null,null,null,'Administrador','admin','3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79','1543300033.jpg',1);

insert into usuarios_permisos (id_usuario,id_permiso) values(1,1);
insert into usuarios_permisos (id_usuario,id_permiso) values(1,2);
insert into usuarios_permisos (id_usuario,id_permiso) values(1,3);
insert into usuarios_permisos (id_usuario,id_permiso) values(1,4);
insert into usuarios_permisos (id_usuario,id_permiso) values(1,5);
insert into usuarios_permisos (id_usuario,id_permiso) values(1,6);
insert into usuarios_permisos (id_usuario,id_permiso) values(2,1);

commit;
