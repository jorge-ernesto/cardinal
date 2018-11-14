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

insert into articulos (id_categoria,codigo,nombre,stock,descripcion,imagen,estado) values(1,'123456789','Impresora Empson L300',0,null,null,1);

commit;
