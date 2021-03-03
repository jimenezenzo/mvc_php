drop schema if exists mvc_editado;
create schema if not exists mvc_editado;
use mvc_editado;

create table users(
    id integer unsigned auto_increment primary key,
    email varchar(255),
    password varchar(255),
    verificado char,
    token varchar(255),
    created_at datetime,
    update_at datetime,
    deleted_at datetime,
);



