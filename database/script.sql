create database crud;
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

use crud;
create table persona(
id int auto_increment primary key,
nombres varchar(100),
apellido_paterno varchar(100),
apellido_materno varchar(100),
fecha_nacimiento date,
celular varchar(12),
);

