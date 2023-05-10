use crud;


create table promociones(
id int NOT NULL auto_increment,
promocion varchar(200) default null,
duracion varchar(200) default null,
id_persona int not null,
primary key(id),
key fk_promociones_1_idx (id_persona),
constraint fk_promociones_1 foreign key (id_persona) references persona (id)
);