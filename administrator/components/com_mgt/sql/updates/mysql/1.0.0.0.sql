create table `#__mgt_vehicles`
(
  id int auto_increment,
  srv_id tinyint not null comment 'ID Сервера',
  unique_id int not null comment 'ID транспортного средства на сервере',
  num_gos varchar(15) default null null comment 'Гос. номер',
  num_park varchar(15) default null null comment 'Парковый номер',
  fail_sync tinyint(3) default 0 null comment 'Кол-во ошибочных синхронизаций',
  last_sync timestamp default null null comment 'Время последней синхронизации',
  state tinyint default 1 null,
  constraint `#__mgt_vehicles_pk`
    primary key (id)
)
  comment 'Подвижной состав';

create index `#__mgt_vehicles_last_sync_index`
  on `#__mgt_vehicles` (last_sync);

create unique index `#__mgt_vehicles_srv_id_unique_id_uindex`
  on `#__mgt_vehicles` (srv_id, unique_id);

create index `#__mgt_vehicles_state_index`
  on `#__mgt_vehicles` (state desc);

