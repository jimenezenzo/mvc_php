drop schema if exists mvc_editado;
create schema if not exists mvc_editado;
use mvc_editado;

-- create table licencias(
--     id integer unsigned auto_increment primary key,
--     descripcion varchar(255)
-- );

-- create table roles(
--     id integer unsigned auto_increment primary key,
--     descripcion varchar(255)
-- );

-- create table empleados(
--     id integer unsigned auto_increment primary key,
--     nombre varchar(255),
--     apellido varchar(255),
--     dni integer unsigned,
--     fecha_nacimiento date,
--     licencia_id integer unsigned,
--     created_at datetime,
--     update_at datetime,
--     deleted_at datetime,
--     foreign key (licencia_id) references licencias(id)
-- );

create table users(
    id integer unsigned auto_increment primary key,
    email varchar(255),
    password varchar(255),
    -- rol_id integer unsigned null,
    -- empleado_id integer unsigned,
    verificado char,
    token varchar(255),
    created_at datetime,
    update_at datetime,
    deleted_at datetime,
    -- foreign key (rol_id) references roles(id),
    -- foreign key (empleado_id) references empleados(id)
);



