insert into categoria values(1,'Descripción 1','Descripción 1',1);
insert into categoria values(2,'Descripción 2','Descripción 2',1);
insert into categoria values(3,'Descripción 3','Descripción 3',1);
insert into categoria values(4,'Descripción 4','Descripción 4',1);
insert into categoria values(5,'Descripción 5','Descripción 5',1);

/*Es mejor especificar el ID y no depender de la propiedad AutoIncrementable*/
/*Si se especifica el ID, la propiedad AutoIncrementable no se ejecuta, esto conlleva a crear tu propio Procedimiento Almacenado para generar los ID*/
insert into categoria values(1,'Descripción 1','Descripción 1',1);
insert into categoria values(2,'Descripción 2','Descripción 2',1);
insert into categoria values(3,'Descripción 3','Descripción 3',1);
insert into categoria values(4,'Descripción 4','Descripción 4',1);
insert into categoria values(5,'Descripción 5','Descripción 5',1);

/*Si no se especifica el ID, la propiedad AutoIncrementable se ejecuta*/
insert into categoria (nom_cat,des_cat,con_cat) values('Descripción 1','Descripción 1',1);
insert into categoria (nom_cat,des_cat,con_cat) values('Descripción 2','Descripción 2',1);
insert into categoria (nom_cat,des_cat,con_cat) values('Descripción 3','Descripción 3',1);
insert into categoria (nom_cat,des_cat,con_cat) values('Descripción 4','Descripción 4',1);
insert into categoria (nom_cat,des_cat,con_cat) values('Descripción 5','Descripción 5',1);

/*Si no se especifica el ID, la propiedad AutoIncrementable se ejecuta*/
insert into categoria values(null,'Descripción 1','Descripción 1',1);
insert into categoria values(null,'Descripción 2','Descripción 2',1);
insert into categoria values(null,'Descripción 3','Descripción 3',1);
insert into categoria values(null,'Descripción 4','Descripción 4',1);
insert into categoria values(null,'Descripción 5','Descripción 5',1);

commit;