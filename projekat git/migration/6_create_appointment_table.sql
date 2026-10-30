create table appointment(
     aid int not null auto_increment,
     appointment_status varchar(500) default 'Pending',
     appointment_start datetime not null,
     appointment_end datetime,
     notes varchar(500),
     people int not null,
     dentist int not null,
    treatment int not null,
    app_total_price decimal(8,2),
     primary key(aid),
     foreign key(people) references people(pid),
     foreign key(dentist) references dentist(did),
    foreign key (treatment) references treatment(tid)
);





