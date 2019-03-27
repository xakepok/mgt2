create table `#__mgt_online`
(
  id int auto_increment,
  dat date not null,
  vehicle_id int not null comment 'ID подвижного состава',
  route varchar(10) not null comment 'Маршрут',
  constraint `#__mgt_online_pk`
    primary key (id),
  constraint `#__mgt_online_#__mgt_vehicles_id_fk`
    foreign key (vehicle_id) references `#__mgt_vehicles` (id)
      on update cascade on delete cascade
)
  comment 'Синхронизация МГТ';

create index `#__mgt_online_dat_index`
  on `#__mgt_online` (dat);

create unique index `#__mgt_online_dat_vehicle_id_route_uindex`
  on `#__mgt_online` (dat, vehicle_id, route);

create index `#__mgt_online_route_index`
  on `#__mgt_online` (route);

