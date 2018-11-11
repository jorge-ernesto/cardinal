/*Si no se especifica el ID, la propiedad AutoIncrementable se ejecuta*/
insert into categorias (nombre,descripcion,estado) values('Descripción 1','wea',1);
insert into categorias (nombre,descripcion,estado) values('Descripción 2','wea',1);
insert into categorias (nombre,descripcion,estado) values('Descripción 3','wea',1);
insert into categorias (nombre,descripcion,estado) values('Descripción 4','wea',1);
insert into categorias (nombre,descripcion,estado) values('Descripción 5','wea',1);

/*Si no se especifica el ID, la propiedad AutoIncrementable se ejecuta*/
insert into categorias values(null,'Descripción 1','wea',1);
insert into categorias values(null,'Descripción 2','wea',1);
insert into categorias values(null,'Descripción 3','wea',1);
insert into categorias values(null,'Descripción 4','wea',1);
insert into categorias values(null,'Descripción 5','wea',1);

/*Si se especifica el ID, la propiedad AutoIncrementable no se ejecuta, esto conlleva a crear tu propio Procedimiento Almacenado para generar el ID*/
insert into categorias values(1,'Descripción 1','wea',1);
insert into categorias values(2,'Descripción 2','wea',1);
insert into categorias values(3,'Descripción 3','wea',1);
insert into categorias values(4,'Descripción 4','wea',1);
insert into categorias values(5,'Descripción 5','wea',1);

insert into articulos (id_categoria,codigo,nombre,stock,descripcion,imagen,estado) values(1,'123456789','Impresora Empson L300',0,null,null,1);

commit;
