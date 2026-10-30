create table dentist(
    did int not null auto_increment,
    first_name varchar(500) not null,
    last_name varchar(500) not null,
    specialty int not null,
    phone varchar(500) not null,
    email varchar(500) not null,
    room int not null,
    primary key(did),
    foreign key (specialty) references speciality(sid)
);